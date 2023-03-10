<?php
/**
 * WP File Download
 *
 * @package WP File Download
 * @author  Joomunited
 * @version 1.0
 */

use Joomunited\WPFramework\v1_0_5\Application;
use Joomunited\WPFramework\v1_0_5\Model;

defined('ABSPATH') || die();

/**
 * Class WpfdModelFiles
 */
class WpfdModelFiles extends Model
{
    /**
     * Search files
     *
     * @param string         $s           Search string
     * @param string|integer $id_category Category to search
     * @param string         $ordering    Ordering
     * @param string         $dir         Ordering Direction
     *
     * @return array
     */
    public function searchfilexx($s, $id_category, $ordering, $dir)
    {
        $modelConfig = $this->getInstance('config');
        $params      = $modelConfig->getConfig();

        $args = array(
            'posts_per_page' => -1,
            'post_type'      => 'wpfd_file'
        );
        if (isset($s) && $s !== '') {
            $args['s'] = $s;
        }
        if (!empty($id_category)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy'         => 'wpfd-category',
                    'terms'            => (int) $id_category,
                    'include_children' => true
                )
            );
        }
        $results = get_posts($args);
        $files   = array();
        foreach ($results as $result) {
            $metaData         = get_post_meta($result->ID, '_wpfd_file_metadata', true);
            $result->ext      = isset($metaData['ext']) ? $metaData['ext'] : '';
            $result->hits     = isset($metaData['hits']) ? (int) $metaData['hits'] : 0;
            $result->versionNumber  = isset($metaData['version']) ? $metaData['version'] : '';
            $result->size     = isset($metaData['size']) ? $metaData['size'] : 0;
            $result->created_time = get_date_from_gmt($result->post_date_gmt);
            $result->modified_time = get_date_from_gmt($result->post_modified_gmt);
            $result->created  = mysql2date(
                WpfdBase::loadValue($params, 'date_format', get_option('date_format')),
                $result->created_time
            );
            $result->modified = mysql2date(
                WpfdBase::loadValue($params, 'date_format', get_option('date_format')),
                $result->modified_time
            );
            $term_list        = wp_get_post_terms($result->ID, 'wpfd-category', array('fields' => 'ids'));
            $wpfd_term        = get_term($term_list[0], 'wpfd-category');
            $result->catname  = sanitize_title($wpfd_term->name);
            if (!is_wp_error($term_list)) {
                $result->catid = $term_list[0];
            } else {
                $result->catid = 0;
            }
            $linkdownload_str     = admin_url('admin-ajax.php') . '?juwpfisadmin=false&action=wpfd&task=file.download';
            $linkdownload_str     .= '&wpfd_category_id=' . $result->catid . '&wpfd_file_id=' . $result->ID;
            $result->linkdownload = $linkdownload_str;
            $files[]              = $result;
        }

        if (in_array($ordering, array('type', 'title', 'created', 'updated', 'size'))) {
            switch ($ordering) {
                case 'type':
                    if ($dir === 'desc') {
                        usort($files, array('WpfdModelFiles', 'cmpTypeDesc'));
                    } else {
                        usort($files, array('WpfdModelFiles', 'cmpType'));
                    }
                    break;
                case 'created':
                    if ($dir === 'desc') {
                        usort($files, array('WpfdModelFiles', 'cmpCreatedDesc'));
                    } else {
                        usort($files, array('WpfdModelFiles', 'cmpCreated'));
                    }
                    break;
                case 'updated':
                    if ($dir === 'desc') {
                        usort($files, array('WpfdModelFiles', 'cmpModifiedDesc'));
                    } else {
                        usort($files, array('WpfdModelFiles', 'cmpModified'));
                    }
                    break;

                case 'size':
                    if ($dir === 'desc') {
                        usort($files, array('WpfdModelFiles', 'cmpSizeDesc'));
                    } else {
                        usort($files, array('WpfdModelFiles', 'cmpSize'));
                    }
                    break;
                case 'title':
                default:
                    if ($dir === 'desc') {
                        usort($files, array('WpfdModelFiles', 'cmpTitleDesc'));
                    } else {
                        usort($files, array('WpfdModelFiles', 'cmpTitle'));
                    }
                    break;
            }
        }

//        $limit = 100;
//        if ($limit > 0) {
//            $files = array_slice($files, 0, $limit);
//        }

        return $files;
    }

    /**
     * Search file in local storage
     *
     * @param string  $file_type   File type
     * @param integer $weight_from Min file weight
     * @param integer $weight_to   Max file weight
     * @param array   $args        Post arguments
     * @param array   $params      Search params
     *
     * @return array|boolean
     */
    public function searchLocal($file_type, $weight_from, $weight_to, $args, $params)
    {
        $results = get_posts($args);

        if (is_wp_error($results)) {
            return false;
        }
        $files = array();
        foreach ($results as $result) {
            // Filter by meta
            $metaData = get_post_meta($result->ID, '_wpfd_file_metadata', true);
            $ext = isset($metaData['ext']) ? $metaData['ext'] : '';
            // Extension check
            if (!empty($file_type)) {
                if (empty($ext) || $ext !== $file_type) {
                    continue;
                }
            }
            // File size check
            $size = isset($metaData['size']) ? intval($metaData['size']) : 0;
            if (!empty($weight_from) && !empty($weight_to)) {
                if ($size < $weight_from || $size > $weight_to) {
                    continue;
                }
            } elseif (!empty($weight_from) && empty($weight_to)) {
                if ($size < $weight_from) {
                    continue;
                }
            } elseif (empty($weight_from) && !empty($weight_to)) {
                if ($size > $weight_to) {
                    continue;
                }
            }
            // Assign file metadata
            $result->ext = $ext;
            $result->hits = isset($metaData['hits']) ? (int)$metaData['hits'] : 0;
            $result->versionNumber = isset($metaData['version']) ? $metaData['version'] : '';
            $result->size = $size;
            $result->created_time = get_date_from_gmt($result->post_date_gmt);
            $result->modified_time = get_date_from_gmt($result->post_modified_gmt);
            $result->created = mysql2date(
                WpfdBase::loadValue($params, 'date_format', get_option('date_format')),
                $result->created_time
            );
            $result->modified = mysql2date(
                WpfdBase::loadValue($params, 'date_format', get_option('date_format')),
                $result->modified_time
            );
            $term_list = wp_get_post_terms($result->ID, 'wpfd-category', array('fields' => 'ids'));
            $wpfd_term = get_term($term_list[0], 'wpfd-category');
            $result->catname = sanitize_title($wpfd_term->name);
            if (!is_wp_error($term_list)) {
                $result->catid = $term_list[0];
            } else {
                $result->catid = 0;
            }
            $linkdownload_str = admin_url('admin-ajax.php') . '?juwpfisadmin=false&action=wpfd&task=file.download';
            $linkdownload_str .= '&wpfd_category_id=' . $result->catid . '&wpfd_file_id=' . $result->ID;
            $result->linkdownload = $linkdownload_str;
            $files[] = $result;
        }

        return $files;
    }


    /**
     * Search file
     *
     * @param string  $keyword      Keyword
     * @param integer $catId        Category Id
     * @param string  $ordering     Ordering
     * @param string  $dir          Ordering direction
     * @param string  $file_type    File type
     * @param string  $created_date Create date
     * @param string  $updated_date Updated date
     * @param string  $weight_from  File size from
     * @param string  $weight_to    File size to
     *
     * @return array|boolean
     */
    public function searchFilesV2($keyword, $catId = 0, $ordering = 'title', $dir = 'ASC', $file_type = '', $created_date = '', $updated_date = '', $weight_from = '', $weight_to = '')
    {
        Application::getInstance('Wpfd');
        $modelConfig = $this->getInstance('config');
        $modelCategories = $this->getInstance('categories');
        $params      = $modelConfig->getConfig();
        $categories = $modelCategories->getCategories();
        $ownCategories = array_map(function ($category) {
            return $category->term_id;
        }, $categories);

        $args = array(
            'posts_per_page' => -1,
            'post_type'      => 'wpfd_file'
        );

        $cloud_cond = array();
        $cloud_cond[] = "mimeType != 'application/vnd.google-apps.folder' and trashed = false";

        if (isset($keyword) && $keyword !== '') {
            $args['s'] = $keyword;
            $cloud_cond[] = "fullText contains '\"" . $keyword . "\"'";
        }
        $categoryFrom = false;
        $searchAllCategories = false;

        if (!is_null($catId) && $catId > 0) {
            $args['tax_query'] = array(
                array(
                    'taxonomy'         => 'wpfd-category',
                    'terms'            => (int) $catId,
                    'include_children' => true
                )
            );
            $categoryFrom = apply_filters('wpfdAddonCategoryFrom', $catId);
        } else {
            $args['tax_query'] = array(
                array(
                    'taxonomy'         => 'wpfd-category',
                    'terms'            => $ownCategories,
                    'include_children' => false
                )
            );
            $searchAllCategories = true;
        }
        // Add Date query
        $dateArgs = array();

        if ($created_date) {
            $dateArgs[] = array('column' => 'post_date',
                'after' => $created_date . ' 00:00:00',
                'before' => $created_date . ' 23:59:59',
            );
            $cloud_cond[] = " createdDate >= '" . $created_date . " 00:00:00' and createdDate <= '" . $created_date . " 23:59:59'";
        }

        if ($updated_date) {
            $dateArgs[] = array('column' => 'post_modified',
                'after' => $updated_date . ' 00:00:00',
                'before' => $updated_date . ' 23:59:59',
            );
            $cloud_cond[] = " modifiedDate >= '" . $created_date . " 00:00:00' and modifiedDate <= '" . $created_date . " 23:59:59'";
        }

        if (count($dateArgs)) {
            $args['date_query'] = array(
                'relation' => 'AND',
                $dateArgs
            );
        }

        if (!$searchAllCategories) {
            switch ($categoryFrom) {
                case 'googleDrive':
                    if (has_filter('wpfdAddonSearchCloud', 'wpfdAddonSearchCloud')) {
                        $filters = array(
                            'catid' => WpfdAddonHelper::getGoogleDriveIdByTermId($catId),
                            'exclude' => '',
                            'q' => $keyword
                        );

                        /**
                         * Filters to search in google drive
                         *
                         * @param array Google search condition
                         * @param array Search condition
                         *
                         * @return array
                         *
                         * @internal
                         */
                        $files = apply_filters('wpfdAddonSearchCloud', $cloud_cond, $filters);
                    }
                    break;

                case 'onedrive':
                    if (has_filter('wpfdAddonSearchOneDrive', 'wpfdAddonSearchOneDrive')) {
                        $filters = array(
                            'catid' => WpfdAddonHelper::getOneDriveIdByTermId($catId),
                            'exclude' => '',
                            'q' => $keyword
                        );

                        /**
                         * Filters to search in onedrive
                         *
                         * @param array Search condition
                         *
                         * @return array
                         *
                         * @internal
                         */
                        $files = apply_filters('wpfdAddonSearchOneDrive', $filters);
                    }

                    break;

                case 'onedrive_business':
                    if (has_filter('wpfdAddonSearchOneDriveBusiness', 'wpfdAddonSearchOneDriveBusiness')) {
                        $filters = array(
                            'catid' => WpfdAddonHelper::getOneDriveBusinessIdByTermId($catId),
                            'exclude' => '',
                            'q' => $keyword
                        );

                        /**
                         * Filters to search in onedrive business
                         *
                         * @param array Search condition
                         *
                         * @return array
                         *
                         * @internal
                         */
                        $files = apply_filters('wpfdAddonSearchOneDriveBusiness', $filters);
                    }
                    break;

                case 'dropbox':
                    if (has_filter('wpfdAddonSearchDropbox', 'wpfdAddonSearchDropbox')) {
                        $filters = array(
                            'catid' => WpfdAddonHelper::getDropboxIdByTermId($catId),
                            'exclude' => '',
                            'q' => $keyword
                        );

                        /**
                         * Filters to search in dropbox
                         *
                         * @param array Search condition
                         *
                         * @return array
                         *
                         * @internal
                         */
                        $files = apply_filters('wpfdAddonSearchDropbox', $filters);
                    }
                    break;
                default:
                    $files = $this->searchLocal($file_type, $weight_from, $weight_to, $args, $params);
                    break;
            }
        } else {
            $filters = array(
                'catid' => 0,
                'exclude' => '',
                'q' => $keyword
            );
            $arr1 = array();
            $arr2 = array();
            $arr3 = array();
            $arr4 = array();
            if (has_filter('wpfdAddonSearchDropbox', 'wpfdAddonSearchDropbox')) {
                /**
                 * Filters to search in dropbox
                 *
                 * @param array Search condition
                 *
                 * @return array
                 *
                 * @internal
                 */
                $arr1 = apply_filters('wpfdAddonSearchDropbox', $filters);
            }
            if (has_filter('wpfdAddonSearchCloud', 'wpfdAddonSearchCloud')) {
                /**
                 * Filters to search in google drive
                 *
                 * @param array Google search condition
                 * @param array Search condition
                 *
                 * @return array
                 *
                 * @internal
                 */
                $arr2 = apply_filters('wpfdAddonSearchCloud', $cloud_cond, $filters);
            }
            if (has_filter('wpfdAddonSearchOneDrive', 'wpfdAddonSearchOneDrive')) {
                /**
                 * Filters to search in onedrive
                 *
                 * @param array Search condition
                 *
                 * @return array
                 *
                 * @internal
                 */
                $arr3 = apply_filters('wpfdAddonSearchOneDrive', $filters);
            }
            if (has_filter('wpfdAddonSearchOneDriveBusiness', 'wpfdAddonSearchOneDriveBusiness')) {
                /**
                 * Filters to search in onedrive
                 *
                 * @param array Search condition
                 *
                 * @return array
                 *
                 * @internal
                 */
                $arr4 = apply_filters('wpfdAddonSearchOneDriveBusiness', $filters);
            }
            $array1 = array_merge($arr1, $arr2, $arr3, $arr4);
            $array2 = $this->searchLocal($file_type, $weight_from, $weight_to, $args, $params);

            if (is_array($array1) && is_array($array2)) {
                $files = array_merge($array1, $array2);
            } elseif (count($array1) > 0 && !is_array($array2)) {
                $files = $array1;
            } elseif (!is_array($array1) && count($array2) > 0) {
                $files = $array2;
            } else {
                $files = array();
            }
        }

        if (in_array($ordering, array('type', 'title', 'created', 'updated', 'size'))) {
            switch ($ordering) {
                case 'type':
                    if (strtolower($dir) === 'desc') {
                        usort($files, array('WpfdModelFiles', 'cmpTypeDesc'));
                    } else {
                        usort($files, array('WpfdModelFiles', 'cmpType'));
                    }
                    break;
                case 'created':
                    if (strtolower($dir) === 'desc') {
                        usort($files, array('WpfdModelFiles', 'cmpCreatedDesc'));
                    } else {
                        usort($files, array('WpfdModelFiles', 'cmpCreated'));
                    }
                    break;
                case 'updated':
                    if (strtolower($dir) === 'desc') {
                        usort($files, array('WpfdModelFiles', 'cmpModifiedDesc'));
                    } else {
                        usort($files, array('WpfdModelFiles', 'cmpModified'));
                    }
                    break;

                case 'size':
                    if (strtolower($dir) === 'desc') {
                        usort($files, array('WpfdModelFiles', 'cmpSizeDesc'));
                    } else {
                        usort($files, array('WpfdModelFiles', 'cmpSize'));
                    }
                    break;
                case 'title':
                default:
                    if (strtolower($dir) === 'desc') {
                        usort($files, array('WpfdModelFiles', 'cmpTitleDesc'));
                    } else {
                        usort($files, array('WpfdModelFiles', 'cmpTitle'));
                    }
                    break;
            }
        }

//        $limit = 100;
//        if ($limit > 0) {
//            $files = array_slice($files, 0, $limit);
//        }

        return $files;
    }

    /**
     * Method compare type
     *
     * @param object $a First file object
     * @param object $b Second file object
     *
     * @return integer
     */
    private function cmpType($a, $b)
    {
        if (strtolower($a->ext) === strtolower($b->ext)) {
            return strcmp($a->title, $b->title);
        }

        return strcmp($a->ext, $b->ext);
    }

    /**
     * Method compare type DESC
     *
     * @param object $a First file object
     * @param object $b Second file object
     *
     * @return integer
     */
    private function cmpTypeDesc($a, $b)
    {
        if (strtolower($a->ext) === strtolower($b->ext)) {
            return strcmp($a->title, $b->title);
        }

        return strcmp($b->ext, $a->ext);
    }

    /**
     * Get file referent to category
     *
     * @param integer|string $id_category   Category id
     * @param array          $list_id_files List files id
     * @param string         $ordering      Ordering
     * @param string         $ordering_dir  Order direction
     *
     * @return array
     */
    public function getFilesRef($id_category, $list_id_files, $ordering = 'menu_order', $ordering_dir = 'ASC')
    {
        /**
         * Filter to check category source
         *
         * @param integer Term id
         *
         * @return string
         *
         * @internal
         *
         * @ignore
         */
        $categoryFrom = apply_filters('wpfdAddonCategoryFrom', $id_category);
        if (in_array($categoryFrom, wpfd_get_support_cloud())) {
            /**
             * Filters to get files from google drive
             *
             * @param integer Category id
             * @param array   List file id
             *
             * @internal
             *
             * @return array
             */
            $files = apply_filters('wpfd_addon_get_files', $id_category, $categoryFrom, $list_id_files);
        } else {
            Application::getInstance('Wpfd');
            $modelConfig = $this->getInstance('config');
            $params      = $modelConfig->getConfig();
            $rmdownloadext = (int) WpfdBase::loadValue($params, 'rmdownloadext', 1) === 1;
            if ($ordering === 'ordering') {
                $ordering = 'menu_order';
            } elseif ($ordering === 'created_time') {
                $ordering = 'date';
            } elseif ($ordering === 'modified_time') {
                $ordering = 'modified';
            }
            $args    = array(
                'posts_per_page' => -1,
                'post_type'      => 'wpfd_file',
                'post_status'    => 'any',
                'orderby'        => $ordering,
                'order'          => $ordering_dir,
                'tax_query'      => array(
                    array(
                        'taxonomy'         => 'wpfd-category',
                        'terms'            => (int) $id_category,
                        'include_children' => false
                    )
                )

            );
            $results = get_posts($args);
            $files   = array();

            $config = get_option('_wpfd_global_config');
            if (empty($config) || empty($config['uri'])) {
                $seo_uri = 'download';
            } else {
                $seo_uri = rawurlencode($config['uri']);
            }
            $perlink       = get_option('permalink_structure');
            $rewrite_rules = get_option('rewrite_rules');

            foreach ($results as $result) {
                if (!in_array($result->ID, $list_id_files)) {
                    continue;
                }
                $metaData = get_post_meta($result->ID, '_wpfd_file_metadata', true);

                $result->ext      = isset($metaData['ext']) ? $metaData['ext'] : '';
                $result->hits     = isset($metaData['hits']) ? (int) $metaData['hits'] : 0;
                $result->version  = isset($metaData['version']) ? $metaData['version'] : '';
                $result->size     = isset($metaData['size']) ? $metaData['size'] : 0;
                $result->created_time = get_gmt_from_date($result->post_date_gmt);
                $result->modified_time = get_gmt_from_date($result->post_modified_gmt);
                $result->created  = mysql2date(
                    WpfdBase::loadValue($params, 'date_format', get_option('date_format')),
                    $result->created_time
                );
                $result->modified = mysql2date(
                    WpfdBase::loadValue($params, 'date_format', get_option('date_format')),
                    $result->modified_time
                );
                $term_list        = wp_get_post_terms($result->ID, 'wpfd-category', array('fields' => 'ids'));
                $wpfd_term        = get_term($term_list[0], 'wpfd-category');
                $result->catname  = sanitize_title($wpfd_term->name);
                if (!is_wp_error($term_list)) {
                    $result->catid = $term_list[0];
                } else {
                    $result->catid = 0;
                }
                $result->seouri = $seo_uri;

                if (!empty($rewrite_rules)) {
                    if (strpos($perlink, 'index.php')) {
                        $linkdownload         = get_site_url() . '/index.php/' . $seo_uri . '/' . $result->catid . '/';
                        $linkdownload         .= $result->catname . '/' . $result->ID . '/' . $result->post_name;
                        $result->linkdownload = $linkdownload;
                    } else {
                        $linkdownload         = get_site_url() . '/' . $seo_uri . '/' . $result->catid . '/';
                        $linkdownload         .= $result->catname . '/' . $result->ID . '/' . $result->post_name;
                        $result->linkdownload = $linkdownload;
                    }
                    if ($result->ext && !$rmdownloadext) {
                        $result->linkdownload .= '.' . $result->ext;
                    };
                } else {
                    $linkdownload         = admin_url('admin-ajax.php') . '?juwpfisadmin=false&action=wpfd&task=file.download';
                    $linkdownload         .= '&wpfd_category_id=' . $result->catid . '&wpfd_file_id=' . $result->ID;
                    $result->linkdownload = $linkdownload;
                }
                $files[] = $result;
            }
        }
        $reverse = strtoupper($ordering_dir) === 'DESC' ? true : false;

        if ($ordering === 'size') {
            $files = wpfd_sort_by_property($files, 'size', 'ID', $reverse);
        } elseif ($ordering === 'version') {
            $files = wpfd_sort_by_property($files, 'version', 'ID', $reverse);
        } elseif ($ordering === 'hits') {
            $files = wpfd_sort_by_property($files, 'hits', 'ID', $reverse);
        } elseif ($ordering === 'ext') {
            $files = wpfd_sort_by_property($files, 'ext', 'ID', $reverse);
        } elseif ($ordering === 'description') {
            $files = wpfd_sort_by_property($files, 'description', 'ID', $reverse);
        } elseif ($ordering === 'title') {
            $files = wpfd_sort_by_property($files, 'post_name', 'ID', $reverse);
        }

        return $files;
    }

    /**
     * Method compare Create date
     *
     * @param object $a First file object
     * @param object $b Second file object
     *
     * @return integer
     */
    private function cmpCreated($a, $b)
    {
        return (strtotime($a->created_time) < strtotime($b->created_time)) ? -1 : 1;
    }

    /**
     * Method compare Create date desc
     *
     * @param object $a First file object
     * @param object $b Second file object
     *
     * @return integer
     */
    private function cmpCreatedDesc($a, $b)
    {
        return (strtotime($a->created_time) > strtotime($b->created_time)) ? -1 : 1;
    }

    /**
     * Method compare Modified date
     *
     * @param object $a First file object
     * @param object $b Second file object
     *
     * @return integer
     */
    private function cmpModified($a, $b)
    {
        return (strtotime($a->modified_time) < strtotime($b->modified_time)) ? -1 : 1;
    }

    /**
     * Method compare Modified date desc
     *
     * @param object $a First file object
     * @param object $b Second file object
     *
     * @return integer
     */
    private function cmpModifiedDesc($a, $b)
    {
        return (strtotime($a->modified_time) > strtotime($b->modified_time)) ? -1 : 1;
    }

    /**
     * Method compare size
     *
     * @param object $a First file object
     * @param object $b Second file object
     *
     * @return integer
     */
    private function cmpSize($a, $b)
    {
        return ($b->size > $a->size) ? -1 : 1;
    }

    /**
     * Method compare size desc
     *
     * @param object $a First file object
     * @param object $b Second file object
     *
     * @return integer
     */
    private function cmpSizeDesc($a, $b)
    {
        return ($a->size > $b->size) ? -1 : 1;
    }

    /**
     * Method compare title
     *
     * @param object $a First file object
     * @param object $b Second file object
     *
     * @return integer
     */
    private function cmpTitle($a, $b)
    {
        return strcmp($a->title, $b->title);
    }

    /**
     * Method compare title desc
     *
     * @param object $a First file object
     * @param object $b Second file object
     *
     * @return integer
     */
    private function cmpTitleDesc($a, $b)
    {
        return strcmp($b->title, $a->title);
    }


    /**
     * Get file by ordering
     *
     * @param integer|string $id_category  Category id
     * @param string         $ordering     Ordering
     * @param string         $ordering_dir Order direction
     *
     * @return array
     */
    public function getFiles($id_category, $ordering = 'menu_order', $ordering_dir = 'ASC')
    {
        Application::getInstance('Wpfd');
        $modelConfig = $this->getInstance('config');
        $params      = $modelConfig->getConfig();
        $rmdownloadext = (int) Wpfdbase::loadValue($params, 'rmdownloadext', 1) === 1;
        if ($ordering === 'ordering') {
            $ordering = 'menu_order';
        } elseif ($ordering === 'created_time') {
            $ordering = 'date';
        } elseif ($ordering === 'modified_time') {
            $ordering = 'modified';
        }
        $args    = array(
            'posts_per_page' => -1,
            'post_type'      => 'wpfd_file',
            'post_status'    => 'any',
            'orderby'        => $ordering,
            'order'          => $ordering_dir,
            'tax_query'      => array(
                array(
                    'taxonomy'         => 'wpfd-category',
                    'terms'            => (int) $id_category,
                    'include_children' => false
                )
            )

        );
        $results = get_posts($args);
        $files   = array();
        $config  = get_option('_wpfd_global_config');
        if (empty($config) || empty($config['uri'])) {
            $seo_uri = 'download';
        } else {
            $seo_uri = rawurlencode($config['uri']);
        }
        $perlink       = get_option('permalink_structure');
        $rewrite_rules = get_option('rewrite_rules');

        foreach ($results as $result) {
            $metaData = get_post_meta($result->ID, '_wpfd_file_metadata', true);
            $result->ext      = isset($metaData['ext']) ? $metaData['ext'] : '';
            $result->hits     = isset($metaData['hits']) ? (int) $metaData['hits'] : 0;
            $result->versionNumber  = isset($metaData['version']) ? $metaData['version'] : '';
            $result->size     = isset($metaData['size']) ? $metaData['size'] : 0;
            $result->created_time = get_date_from_gmt($result->post_date_gmt);
            $result->modified_time = get_date_from_gmt($result->post_modified_gmt);
            $result->created  = mysql2date(
                WpfdBase::loadValue($params, 'date_format', get_option('date_format')),
                $result->created_time
            );
            $result->modified = mysql2date(
                WpfdBase::loadValue($params, 'date_format', get_option('date_format')),
                $result->modified_time
            );
            $term_list        = wp_get_post_terms($result->ID, 'wpfd-category', array('fields' => 'ids'));
            $wpfd_term        = get_term($term_list[0], 'wpfd-category');
            $result->catname  = sanitize_title($wpfd_term->name);
            if (!is_wp_error($term_list)) {
                $result->catid = $term_list[0];
            } else {
                $result->catid = 0;
            }
            $result->seouri = $seo_uri;
            if (!empty($rewrite_rules)) {
                if (strpos($perlink, 'index.php')) {
                    $linkdownload         = get_site_url() . '/index.php/' . $seo_uri . '/' . $result->catid . '/';
                    $linkdownload         .= $result->catname . '/' . $result->ID . '/' . $result->post_name;
                    $result->linkdownload = $linkdownload;
                } else {
                    $linkdownload         = get_site_url() . '/' . $seo_uri . '/' . $result->catid . '/' . $result->catname;
                    $linkdownload         .= '/' . $result->ID . '/' . $result->post_name;
                    $result->linkdownload = $linkdownload;
                }
                if ($result->ext && !$rmdownloadext) {
                    $result->linkdownload .= '.' . $result->ext;
                };
            } else {
                $linkdownload         = admin_url('admin-ajax.php') . '?juwpfisadmin=false&action=wpfd&task=file.download';
                $linkdownload         .= '&wpfd_category_id=' . $result->catid . '&wpfd_file_id=' . $result->ID;
                $result->linkdownload = $linkdownload;
            }
            $files[] = $result;
        }
        $reverse = strtoupper($ordering_dir) === 'DESC' ? true : false;
        if ($ordering === 'size') {
            $files = wpfd_sort_by_property($files, 'size', 'ID', $reverse);
        } elseif ($ordering === 'version') {
            $files = wpfd_sort_by_property($files, 'versionNumber', 'ID', $reverse);
        } elseif ($ordering === 'hits') {
            $files = wpfd_sort_by_property($files, 'hits', 'ID', $reverse);
        } elseif ($ordering === 'ext') {
            $files = wpfd_sort_by_property($files, 'ext', 'ID', $reverse);
        } elseif ($ordering === 'description') {
            $files = wpfd_sort_by_property($files, 'description', 'ID', $reverse);
        } elseif ($ordering === 'title') {
            $files = wpfd_sort_by_property($files, 'post_name', 'ID', $reverse);
        }

        /**
         * Filter admin files
         *
         * @param array
         *
         * @internal
         */
        return apply_filters('wpfd_admin_files', $files);
    }

    /**
     * Get extension file
     *
     * @param string $fileName File name
     *
     * @return array|null Returns the last value of array. If array is empty (or is not an array), NULL will be returned.
     */
    public function fileExt($fileName)
    {
        $pieces = explode('.', $fileName);
        return array_pop($pieces);
    }

    /**
     * Method to add a file into database
     *
     * @param array   $data       File data
     * @param boolean $remote_url Is the file or remote file
     *
     * @return integer|WP_Error The post ID on success. The value 0 or WP_Error on failure.
     */
    public function addFile($data, $remote_url = false)
    {
        global $wpdb;

        // Remove file guid
        $fileGuid = $data['file'];
        unset($data['file']);
        $userId = get_current_user_id();
        /**
         * Filter before upload file
         *
         * @param array   File data
         * @param integer Current user id
         *
         * @return array
         */
        $data = apply_filters('wpfd_before_upload_file', $data, $userId);

        // Revert guid to file data
        $data['file'] = $fileGuid;

        // Get the path to the upload directory.
        $wp_upload_dir = wp_upload_dir();
        if ($remote_url) {
            $filename = $data['file'];
        } else {
            $filename = $wp_upload_dir['basedir'] . '/wpfd/' . $data['id_category'] . '/' . $data['file'];
        }
        // Check the type of file. We'll use this as the 'post_mime_type'.
        $filetype = wp_check_filetype(basename($filename), null);

        // Prepare an array of post data for the attachment.
        $attachment = array(
            'guid'           => $filename,
            'post_type'      => 'wpfd_file',
            'post_mime_type' => $filetype['type'],
            'post_title'     => $data['title'],
            'post_content'   => '',
            'post_status'    => 'publish',
            'post_excerpt'   => (isset($data['post_excerpt'])) ? $data['post_excerpt'] : ''
        );
        $attach_id  = wp_insert_post($attachment);
        if ($attach_id) {
            // Generate the metadata for the attachment, and update the database record.
            //$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
            //wp_update_attachment_metadata( $attach_id, $attach_data );

            $metadata               = array();
            $metadata['ext']        = $data['ext'];
            $metadata['size']       = $data['size'];
            $metadata['hits']       = 0;
            $metadata['version']    = '';
            $metadata['file']       = $data['file'];
            $metadata['remote_url'] = $remote_url;
            update_post_meta($attach_id, '_wpfd_file_metadata', $metadata);

            wp_set_post_terms($attach_id, $data['id_category'], 'wpfd-category');
        }
        /**
         * Action fire after file uploaded
         *
         * @param integer|WP_Error The file ID on success. The value 0 or WP_Error on failure.
         * @param array            Additional information
         */
        do_action('wpfd_file_uploaded', $attach_id, $data['id_category'], array('source' => 'local'));

        return $attach_id;
    }

    /**
     * Methode to retrieve the next file ordering for a category
     *
     * @param integer $id_category Category id
     *
     * @return integer Next ordering
     */
    private function getNextPosition($id_category)
    {
        global $wpdb;
        $result = $wpdb->query(
            $wpdb->prepare(
                'SELECT ordering FROM ' . $wpdb->prefix . 'wpfd_files WHERE catid=%d ORDER BY ordering DESC LIMIT 0,1',
                (int) $id_category
            )
        );
        if ($result === false) {
            return false;
        }
        // phpcs:ignore WordPress.Security.EscapeOutput.NotPrepared -- nothing need escape
        $ordering = $wpdb->get_var(null);
        if ($ordering > 0) {
            return $ordering + 1;
        }

        return 0;
    }

    /**
     * Reorder file
     *
     * @param array $files Files
     *
     * @return boolean
     */
    public function reorder($files)
    {
        global $wpdb;
        foreach ($files as $key => $file) {
            $wpdb->update($wpdb->posts, array('menu_order' => $key), array('ID' => intval($file)));
        }

        return true;
    }
}
