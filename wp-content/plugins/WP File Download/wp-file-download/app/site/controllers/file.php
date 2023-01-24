<?php
/**
 * WP File Download
 *
 * @package WP File Download
 * @author  Joomunited
 * @version 1.0
 */

use Joomunited\WPFramework\v1_0_5\Application;
use Joomunited\WPFramework\v1_0_5\Controller;
use Joomunited\WPFramework\v1_0_5\Utilities;
use Joomunited\WPFramework\v1_0_5\Model;

defined('ABSPATH') || die();

/**
 * Class WpfdControllerFile
 */
class WpfdControllerFile extends Controller
{

    /**
     * Method to download a file
     *
     * @param integer $id      File id
     * @param integer $catid   Category id
     * @param integer $preview Is preview
     *
     * @return void
     */
    public function download($id = 0, $catid = 0, $preview = 0)
    {
        if (empty($catid)) {
            $catid = Utilities::getInput('wpfd_category_id', 'GET', 'none');
        }
        if (empty($id)) {
            $id = Utilities::getInput('wpfd_file_id', 'GET', 'none');
        }
        if (empty($preview)) {
            $preview = Utilities::getInput('preview', 'GET', 'none');
        }
        if (empty($id) || empty($catid)) {
            exit();
        }

        $token = Utilities::getInput('token', 'GET', 'string');

        if (!$preview && !wpfd_can_download_files()) {
            /**
             * Action fire when current user not enough permission to download this file.
             *
             * @param string|integer
             * @param string|integer
             * @param integer
             */
            do_action('wpfd_download_file_permission', $id, $catid, $preview);
            exit(esc_html__('You don\'t have permission to download this file.', 'wpfd'));
        }

        if ($preview && !wpfd_can_preview_files() && $token === '') {
            /**
             * Action fire when current user not enough permission to preview this file.
             *
             * @param string|integer
             * @param string|integer
             * @param integer
             */
            do_action('wpfd_preview_file_permission', $id, $catid, $preview);
            exit(esc_html__('You don\'t have permission to preview this file.', 'wpfd'));
        }
        if (WpfdHelperFile::wpfdIsExpired((int)$id) === true) {
            /**
             * Action for the expired download page
             *
             * @param string|integer
             * @param string|integer
             * @param integer
             */
            do_action('wpfd_download_link_expired', $id, $catid, $preview);
            exit();
        }
        Application::getInstance('Wpfd');
        $modelCategory = $this->getModel('categoryfront');
        $modelConfig   = $this->getModel('configfront');
        $model         = $this->getModel('filefront');
        $modelNotify   = $this->getModel('notification');
        $modelTokens   = $this->getModel('tokens');

        $config       = $modelConfig->getGlobalConfig();
        $category     = $modelCategory->getCategory($catid);
        $configNotify = $modelNotify->getNotificationsConfig();


        if (empty($category) || is_wp_error($category)) {
            exit(esc_html__('Category is not correct', 'wpfd'));
        }


        /**
         * Filter to check category source
         *
         * @param integer Term id
         *
         * @return string
         *
         * @internal
         */
        $categoryFrom = apply_filters('wpfdAddonCategoryFrom', $catid);
        if ($categoryFrom === 'googleDrive') {
            /**
             * Filter to check google category
             *
             * @param integer Term id
             * @param string  File id
             *
             * @internal
             *
             * @return string
             */
            $catid = apply_filters('wpfdAddonDownloadCheckGoogleDriveCategory', $catid, $id);
            if (empty($catid)) {
                exit(esc_html__('Download url is not correct', 'wpfd'));
            }
        } elseif ($categoryFrom === 'dropbox') {
            /**
             * Filter to check dropbox category
             *
             * @param integer Term id
             * @param string  File id
             *
             * @internal
             *
             * @return string
             */
            $catid = apply_filters('wpfdAddonDownloadCheckDropboxCategory', $catid, $id);
            if (empty($catid)) {
                exit(esc_html__('Download url is not correct', 'wpfd'));
            }
        } elseif ($categoryFrom === 'onedrive') {
            /**
             * Filter to check onedrive category
             *
             * @param integer Term id
             * @param string  File id
             *
             * @internal
             *
             * @return string
             */
            $catid = apply_filters('wpfdAddonDownloadCheckOneDriveCategory', $catid, $id);

            if (empty($catid)) {
                exit(esc_html__('Download url is not correct', 'wpfd'));
            }
        } elseif ($categoryFrom === 'onedrive_business') {
            /**
             * Filter to check onedrive business category
             *
             * @param integer Term id
             * @param string  File id
             *
             * @internal
             *
             * @return string
             */
            $catid = apply_filters('wpfdAddonDownloadCheckOneDriveBusinessCategory', $catid, $id);
            if (empty($catid)) {
                exit(esc_html__('Download url is not correct', 'wpfd'));
            }
        } else {
            $file_catid = $model->getFileCategory($id);
            if ((int) $catid !== (int) $file_catid) {
                // Try to get ref catid
                if (!$model->isValidRefCatId($id, $catid)) {
                    exit(esc_html__('Download url is not correct', 'wpfd'));
                }
            }
        }

        if ((int) $category->access === 1) {
            $user  = wp_get_current_user();
            $roles = array();
            foreach ($user->roles as $role) {
                $roles[] = strtolower($role);
            }
            $allows = array_intersect($roles, $category->roles);

            if (empty($allows)) {
                $modelTokens->removeTokens();
                $tokenId = $modelTokens->tokenExists($token);
                if ($tokenId) {
                    $modelTokens->updateToken($tokenId);
                } else {
                    if (isset($category->params['canview']) && !empty($category->params['canview'])) {
                        if ((int) $category->params['canview'] !== 0 && (int) $category->params['canview'] !== $user->ID) {
                            /**
                             * Filter to redirect user when they don't have permission to download current file
                             *
                             * @param string
                             */
                            $redirect = apply_filters('wpfd_you_dont_have_permission_redirect_url', false);
                            if ($redirect) {
                                if (!wp_safe_redirect($redirect)) {
                                    header('HTTP/1.0 403 You don\'t have permission');
                                    exit();
                                } else {
                                    exit;
                                }
                            } else {
                                header('HTTP/1.0 403 You don\'t have permission');
                                exit();
                            }
                        }
                    } else {
                        $redirectPageId = isset($config['not_authorized_page']) ? intval($config['not_authorized_page']) : 0;
                        $pageUri = get_permalink($redirectPageId);
                        /**
                         * Filter to redirect user when they not authorized to download current file
                         *
                         * @param string
                         */
                        $redirect = apply_filters('wpfd_not_authorized_redirect_url', $pageUri);
                        if ($redirect) {
                            if (!wp_safe_redirect($redirect)) {
                                header('HTTP/1.0 403 Not authorized');
                                exit();
                            } else {
                                exit;
                            }
                        } else {
                            header('HTTP/1.0 403 Not authorized');
                            exit();
                        }
                    }
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit;
        }

        /**
         * Download file from WP FileDownload when not exist $fileInfo or wpfdAddon not active
         */
        if ($categoryFrom === 'googleDrive') {
            /**
             * Action fire before get file information from cloud.
             *
             * @param object File id
             * @param string Cloud type
             *
             * @internal
             * @ignore
             */
            do_action('wpfd_before_cloud_download_file', $id, $categoryFrom, $category->term_id);
            /**
             * Filters to get google file info
             *
             * @param string File id
             *
             * @internal
             *
             * @return object
             */
            $file = apply_filters('wpfdAddonDownloadGoogleDriveFile', $id);
            if ((int) $preview === 1) {
                $contenType = WpfdHelperFile::mimeType(strtolower($file->ext));
            } else {
                if (strtolower($file->ext) === 'pdf' && (int) $config['open_pdf_in'] === 1) {
                    $contenType = WpfdHelperFile::mimeType(strtolower($file->ext));
                } else {
                    $contenType = 'application/octet-stream';
                }
            }

            /**
             * Action fire right before a file download.
             * Do not echo anything here or file download will corrupt
             *
             * @param object  File id
             * @param array   Source
             */
            do_action('wpfd_file_download', $id, array('source' => 'googledrive'));

            $googleCate = new wpfdAddonGoogleDrive;
            // Serve download for google document
            if (strpos($file->mimeType, 'vnd.google-apps') !== false) { // Is google file
                // GuzzleHttp\Psr7\Response
                $fileData = $googleCate->downloadGoogleDocument($file->id, $file->exportMineType);
                if ($fileData instanceof \GuzzleHttp\Psr7\Response) {
                    $contentLength = $fileData->getHeaderLine('Content-Length');
                    $contentType = $fileData->getHeaderLine('Content-Type');
                    if ($fileData->getStatusCode() === 200) {
                        $this->downloadHeader(
                            $file->title . '.' . $file->ext,
                            (int) $contentLength,
                            $contentType,
                            $config,
                            $file,
                            $preview
                        );
                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- file content output
                        echo $fileData->getBody();
                    }
                }
            } else {
                $googleCate->downloadLargeFile($file, $contenType, false, intval($preview));
            }

            $this->sendEmail('', $category->params['category_own'], $configNotify, $category->name, $file->title);
        } elseif ($categoryFrom === 'dropbox') {
            /**
             * Action fire before get file information from cloud.
             *
             * @param object File id
             * @param string Cloud type
             *
             * @internal
             * @ignore
             */
            do_action('wpfd_before_cloud_download_file', $id, $categoryFrom, $category->term_id);
            /**
             * Filters to get dropbox file info
             *
             * @param string File id
             *
             * @internal
             *
             * @return object
             */
            list($file, $fMeta) = apply_filters('wpfdAddonDownloadDropboxFile', $id);
            $ext = strtolower(pathinfo($fMeta['path_display'], PATHINFO_EXTENSION));
            setlocale(LC_ALL, 'en_US.UTF-8');
            $title = pathinfo($fMeta['path_display'], PATHINFO_FILENAME);

            if ((int) $preview === 1) {
                $contenType = WpfdHelperFile::mimeType(strtolower($ext));
            } else {
                if (strtolower($ext) === 'pdf' && (int) $config['open_pdf_in'] === 1) {
                    $contenType = WpfdHelperFile::mimeType(strtolower($ext));
                } else {
                    $contenType = 'application/octet-stream';
                }
            }

            //incr hits
            $fileInfos = WpfdAddonHelper::getDropboxFileInfos();
            if (!empty($fileInfos)) {
                if (isset($fileInfos[$catid][$id]) && isset($fileInfos[$catid][$id]['hits'])) {
                    $hits                           = $fileInfos[$catid][$id]['hits'] + 1;
                    $fileInfos[$catid][$id]['hits'] = $hits;
                } else {
                    $fileInfos[$catid][$id] = array('hits' => 1);
                }
            } else {
                $fileInfos[$catid][$id]['hits'] = 1;
            }
            WpfdAddonHelper::setDropboxFileInfos($fileInfos);

            $fileObj        = new stdClass();
            $fileObj->ext   = $ext;
            $fileObj->title = $title;
            $this->sendEmail('', $category->params['category_own'], $configNotify, $category->name, $fileObj->title);

            /**
             * Action fire right before a Dropbox file download.
             * Do not echo anything here or file download will corrupt
             *
             * @param object  File id
             * @param array   Source
             *
             * @ignore Hook already documented
             */
            do_action('wpfd_file_download', $id, array('source' => 'dropbox'));

            $this->downloadHeader(
                $fileObj->title . '.' . $ext,
                (int) filesize($file),
                $contenType,
                $config,
                $fileObj,
                $preview
            );
            readfile($file);
            unlink($file);
        } elseif ($categoryFrom === 'onedrive') {
            /**
             * Action fire before get file information from cloud.
             *
             * @param object File id
             * @param string Cloud type
             *
             * @internal
             * @ignore
             */
            do_action('wpfd_before_cloud_download_file', $id, $categoryFrom, $category->term_id);
            /**
             * Filters to get onedrive file info
             *
             * @param string File id
             *
             * @internal
             *
             * @return object
             */
            $file = apply_filters('wpfdAddonDownloadOneDriveFile', $id);
            if ((int) $preview === 1) {
                $contenType = WpfdHelperFile::mimeType(strtolower($file->ext));
            } else {
                if (strtolower($file->ext) === 'pdf' && (int) $config['open_pdf_in'] === 1) {
                    $contenType = WpfdHelperFile::mimeType(strtolower($file->ext));
                } else {
                    $contenType = 'application/octet-stream';
                }
            }
            $filedownload = $file->title . '.' . $file->ext;

            /**
             * Action fire right before a Onedrive file download.
             * Do not echo anything here or file download will corrupt
             *
             * @param object  File id
             * @param array   Source
             *
             * @ignore Hook already documented
             */
            do_action('wpfd_file_download', $id, array('source' => 'onedrive', 'catid' => $catid));

            $this->sendEmail('', $category->params['category_own'], $configNotify, $category->name, $file->title);
            if (defined('WPFD_ONEDRIVE_DIRECT') && WPFD_ONEDRIVE_DIRECT) {
                header('Location: ' . $file->datas);
            } else {
                $this->downloadHeader($filedownload, (int) $file->size, $contenType, $config, $file, $preview);
                // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- file content output
                echo $file->datas;
            }
        } elseif ($categoryFrom === 'onedrive_business') {
            /**
             * Action fire before get file information from cloud.
             *
             * @param object File id
             * @param string Cloud type
             *
             * @internal
             * @ignore
             */
            do_action('wpfd_before_cloud_download_file', $id, $categoryFrom, $category->term_id);
            /**
             * Filters to get onedrive file info
             *
             * @param string File id
             *
             * @internal
             *
             * @return object
             */
            $file = apply_filters('wpfdAddonDownloadOneDriveBusinessFile', $id);
            if ((int) $preview === 1) {
                $contenType = WpfdHelperFile::mimeType(strtolower($file->ext));
            } else {
                if (strtolower($file->ext) === 'pdf' && (int) $config['open_pdf_in'] === 1) {
                    $contenType = WpfdHelperFile::mimeType(strtolower($file->ext));
                } else {
                    $contenType = 'application/octet-stream';
                }
            }
            $filedownload = $file->title . '.' . $file->ext;

            /**
             * Action fire right before a Onedrive file download.
             * Do not echo anything here or file download will corrupt
             *
             * @param object  File id
             * @param array   Source
             *
             * @ignore Hook already documented
             */
            do_action('wpfd_file_download', $id, array('source' => 'onedrive_business', 'catid' => $catid));

            $this->sendEmail('', $category->params['category_own'], $configNotify, $category->name, $file->title);
            if (defined('WPFD_ONEDRIVE_BUSINESS_DIRECT') && WPFD_ONEDRIVE_BUSINESS_DIRECT) {
                header('Location: ' . $file->datas);
            } else {
                $this->downloadHeader($filedownload, (int) $file->size, $contenType, $config, $file, $preview);
                // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- file content output
                echo $file->datas;
            }
        } else {
            $file      = $model->getFullFile($id);
            $file_meta = get_post_meta($id, '_wpfd_file_metadata', true);
            /**
             * Action fire before statistic count and a file download.
             * Do not echo anything here or file download will corrupt
             *
             * @param object  File id
             * @param array   File meta data
             *
             * @internal
             * @ignore
             */
            do_action('wpfd_before_download_file', $file, $file_meta);
            $remote_url = isset($file_meta['remote_url']) ? $file_meta['remote_url'] : false;

            $model->hit($id);
            //$model->addCountChart($id);

            // New statistics insert
            $statisticsType = ((int) $preview === 1) ? 'preview' : 'default';
            WpfdHelperFile::addStatisticsRow($id, $statisticsType);


            //todo : verifier les droits d'acces à la catéorgie du fichier
            if (!empty($file) && $file->ID) {
                $filename = WpfdHelperFile::santizeFileName($file->title);
                if ($filename === '') {
                    $filename = 'download';
                }
                if ($remote_url) {
                    $url = $file_meta['file'];
                    header('Location: ' . $url);
                } else {
                    $preview = Utilities::getInput('preview', 'GET', 'none');
                }

                $sysfile = WpfdBase::getFilesPath($file->catid) . $file->file;
                if (file_exists($sysfile)) {
                    $filedownload = $filename . '.' . $file->ext;
                    /**
                     * Action fire right before a file download.
                     * Do not echo anything here or file download will corrupt
                     *
                     * @param object  File id
                     * @param array   Source
                     *
                     * @ignore Hook already documented
                     */
                    do_action('wpfd_file_download', $id, array('source' => 'local'));
                    $result = WpfdHelperFile::sendDownload(
                        $sysfile,
                        $filedownload,
                        $file->ext,
                        ((int) $preview === 1) ? true : false,
                        ((int) $config['open_pdf_in'] === 1) ? true : false
                    );
                    if ($result) {
                        $this->sendEmail(
                            $file->author,
                            $category->params['category_own'],
                            $configNotify,
                            $category->name,
                            $file->title
                        );
                    }
                } else {
                    exit(esc_html__('File not found', 'wpfd'));
                }
            }
        }
        exit();
    }

    /**
     * Download header file
     *
     * @param string  $filename   File name
     * @param integer $size       Size
     * @param string  $contenType Content type
     * @param array   $config     Config
     * @param object  $ob         File object
     * @param integer $preview    Preview
     *
     * @return void
     */
    public function downloadHeader($filename, $size, $contenType, $config, $ob, $preview)
    {
        while (ob_get_level()) {
            ob_end_clean();
        }
        ob_start();
        if ((int) $config['open_pdf_in'] === 1 && strtolower($ob->ext) === 'pdf' && (int) $preview === 1) {
            header('Content-Disposition: inline; filename="' . $filename . '"; filename*=UTF-8\'\'' . $filename);
        } else {
            header('Content-Disposition: attachment; filename="' . $filename . '"; filename*=UTF-8\'\'' . $filename);
        }

        $contentTypeSetted = false;
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $agent = $_SERVER['HTTP_USER_AGENT'];
            if (strlen(strstr($agent, 'Firefox')) > 0 && $contenType === 'application/pdf' && !$preview) {
                header('Content-Type: application/force-download; charset=utf-8');
                $contentTypeSetted = true;
            }
        }
        if (!$contentTypeSetted) {
            header('Content-Type: ' . esc_attr($contenType));
        }
        header('Content-Description: File Transfer');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        if ($size !== 0) {
            header('Content-Length: ' . $size);
        }
        ob_clean();
        flush();
    }

    /**
     * Method send email notification
     *
     * @param integer $user_id      User id
     * @param integer $cat_userid   Category owner user id
     * @param array   $configNotifi Config
     * @param string  $cat_name     Category name
     * @param string  $file_title   File title
     *
     * @return void
     */
    public function sendEmail($user_id, $cat_userid, $configNotifi, $cat_name, $file_title)
    {
        $send_mail_active = array();
        $cat_user_id[]    = $cat_userid;
        $list_superAdmin  = WpfdHelperFiles::getListIDSuperAdmin();

        if ((int) $configNotifi['notify_file_owner'] === 1 && $user_id !== null) {
            $user = get_userdata($user_id)->data;
            array_push($send_mail_active, $user->user_email);
            WpfdHelperFiles::sendMail('download', $user, $cat_name, get_site_url(), $file_title);
        }
        if ((int) $configNotifi['notify_category_owner'] === 1) {
            foreach ($cat_user_id as $item) {
                $user = get_userdata($item)->data;
                if (!in_array($user->user_email, $send_mail_active)) {
                    array_push($send_mail_active, $user->user_email);
                    WpfdHelperFiles::sendMail('download', $user, $cat_name, get_site_url(), $file_title);
                }
            }
        }
        if ($configNotifi['notify_download_event_email'] !== '') {
            if (strpos($configNotifi['notify_download_event_email'], ',')) {
                $emails = explode(',', $configNotifi['notify_download_event_email']);
            } else {
                $emails = array($configNotifi['notify_download_event_email']);
            }

            foreach ($emails as $item) {
                $obj_user               = new stdClass;
                $obj_user->display_name = '';
                $obj_user->user_email   = $item;
                if (!in_array($item, $send_mail_active)) {
                    array_push($send_mail_active, $item);
                    WpfdHelperFiles::sendMail('download', $obj_user, $cat_name, get_site_url(), $file_title);
                }
            }
        }
        if ((int) $configNotifi['notify_super_admin'] === 1) {
            foreach ($list_superAdmin as $items) {
                $user = get_userdata($items)->data;
                if (!in_array($user->user_email, $send_mail_active)) {
                    array_push($send_mail_active, $user->user_email);
                    WpfdHelperFiles::sendMail('download', $user, $cat_name, get_site_url(), $file_title);
                }
            }
        }
    }

    /**
     * AJAX: Preview file
     *
     * @return void
     */
    public function preview()
    {
        $catid = Utilities::getInput('wpfd_category_id', 'GET', 'none');
        $id = Utilities::getInput('wpfd_file_id', 'GET', 'none');
        if (empty($id) || empty($catid)) {
            die(esc_html__('Hard try huh?', 'wpfd'));
        }
        Application::getInstance('Wpfd');
        $modelConfig = Model::getInstance('configfront');
        $config = $modelConfig->getGlobalConfig();
        $useGeneratedPreview = isset($config['auto_generate_preview']) && intval($config['auto_generate_preview']) === 1 ? true : false;
        $restrictFile = isset($config['restrictfile']) && intval($config['restrictfile']) === 1 ? true : false;

        if (is_numeric($id)) {
            $previewFilePath = get_post_meta($id, '_wpfd_preview_file_path', true);
        } else {
            $previewFileInfo = get_option('_wpfdAddon_preview_info_' . md5($id), false);
            $previewFilePath = is_array($previewFileInfo) && isset($previewFileInfo['path']) ? $previewFileInfo['path'] : false;
        }

        $allowPreview = false;
        $allowSingleUser = true;
        if ($useGeneratedPreview && $previewFilePath) {
            $previewFilePath = WP_CONTENT_DIR . $previewFilePath;
            if (file_exists($previewFilePath)) {
                // Secure preview, use same as file permission for the preview file
                $categoryModel = Model::getInstance('categoryfront');
                $category = $categoryModel->getCategory($catid);

                if (!$category || empty($category) || is_wp_error($category)) {
                    die(esc_html__('Category not validate!', 'wpfd'));
                }

                $user = wp_get_current_user();

                if ($category->access === 1) { // Private category
                    $roles = array();
                    foreach ($user->roles as $role) {
                        $roles[] = strtolower($role);
                    }
                    $allows = array_intersect($roles, $category->roles);
                    if (!empty($allows)) {
                        // User allowed
                        $allowPreview = true;
                    }
                } else {
                    // Public category
                    $allowPreview = true;
                }

                if ($restrictFile) {
                    $metadata = get_post_meta($id, '_wpfd_file_metadata', true);
                    $canview = isset($metadata['canview']) ? $metadata['canview'] : 0;
                    if ($canview) {
                        $canview = array_map('intval', explode(',', $canview));
                        if ($user->ID) {
                            if (!in_array($user->ID, $canview)) {
                                $allowSingleUser = false;
                            }
                        }
                    }
                }

                if ($allowPreview && $allowSingleUser) {
                    // Print preview file content
                    $fileInfo = pathinfo($previewFilePath);
                    $contentType = WpfdHelperFile::mimeType($fileInfo['extension']);
                    header('Content-Disposition: inline; filename="' . esc_html($previewFilePath) . '"');
                    header('Content-Type: ' . esc_attr($contentType));
                    header('Content-Description: File Transfer');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($previewFilePath));
                    readfile($previewFilePath);
                    die;
                }
            }
        }
        die(esc_html__('You don\'t have permission to view this preview file', 'wpfd'));
    }

    /**
     * AJAX: Preview download
     *
     * Webhook to receive information from preview generator API
     *
     * @return void
     */
    public function previewdownload()
    {
        Application::getInstance('Wpfd');
        $generatePreviewModel = $this->getModel('generatepreview');
        $generatePreviewModel->previewDownload();
    }

    /**
     * Process password
     *
     * @return void
     */
    public function processPasswordProtection()
    {
        $passwordId     = Utilities::getInput('wpfd_password_id', 'POST', 'none');
        $passwordType   = Utilities::getInput('wpfd_password_type', 'POST', 'none');
        $password       = Utilities::getInput('wpfd_password_value', 'POST', 'none');
        $categoryId     = Utilities::getInput('wpfd_password_category_id', 'POST', 'none');
        $modelCategory  = Model::getInstance('categoryfront');
        $modelTokens    = Model::getInstance('tokens');
        $userId         = get_current_user_id();
        $token          = $modelTokens->getOrCreateNew();

        // Check password
        if (empty($password) || $password === '') {
            wp_safe_redirect(wp_get_referer());
            exit;
        }

        if ($passwordType === 'category') {
            $category       = $modelCategory->getCategory($passwordId);
            $params         = $category->params;
            if ((string) $params['category_password'] !== (string) $password) {
                $missReferer = wp_get_referer();
                if ($missReferer) {
                    $security = ( 'https' === parse_url($missReferer, PHP_URL_SCHEME) );
                } else {
                    $security = false;
                }
                setcookie('wp-wpfd-category-wrong-password', $passwordId, time() + 10 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, $security);
                wp_safe_redirect(wp_get_referer());
                exit;
            }
        } elseif ($passwordType === 'file') {
            if (is_numeric($passwordId)) {
                $row = get_post($passwordId, ARRAY_A);
                $params['file_password'] = $row['post_password'];
                if ((string) $params['file_password'] !== (string) $password) {
                    $missReferer = wp_get_referer();
                    if ($missReferer) {
                        $security = ( 'https' === parse_url($missReferer, PHP_URL_SCHEME) );
                    } else {
                        $security = false;
                    }
                    setcookie('wp-wpfd-file-wrong-password', $passwordId, time() + 10 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, $security);
                    wp_safe_redirect(wp_get_referer());
                    exit;
                }
            } else {
                $categoryFrom = apply_filters('wpfdAddonCategoryFrom', $categoryId);
                if ($categoryFrom === 'googleDrive') {
                    $params = apply_filters('wpfdAddonGetGoogleDriveFile', $passwordId, $categoryId, $token);
                    if ((string) $params['file_password'] !== (string) $password) {
                        $missReferer = wp_get_referer();
                        if ($missReferer) {
                            $security = ( 'https' === parse_url($missReferer, PHP_URL_SCHEME) );
                        } else {
                            $security = false;
                        }
                        setcookie('wp-wpfd-file-wrong-password', $passwordId, time() + 10 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, $security);
                        wp_safe_redirect(wp_get_referer());
                        exit;
                    }
                } elseif ($categoryFrom === 'dropbox') {
                    $params = apply_filters('wpfdAddonGetDropboxFile', $passwordId, $categoryId, $token);
                    if ((string) $params['file_password'] !== (string) $password) {
                        $missReferer = wp_get_referer();
                        if ($missReferer) {
                            $security = ( 'https' === parse_url($missReferer, PHP_URL_SCHEME) );
                        } else {
                            $security = false;
                        }
                        setcookie('wp-wpfd-file-wrong-password', $passwordId, time() + 10 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, $security);
                        wp_safe_redirect(wp_get_referer());
                        exit;
                    }
                } elseif ($categoryFrom === 'onedrive') {
                    $params = apply_filters('wpfdAddonGetOneDriveFile', $passwordId, $categoryId, $token);
                    if ((string) $params['file_password'] !== (string) $password) {
                        $missReferer = wp_get_referer();
                        if ($missReferer) {
                            $security = ( 'https' === parse_url($missReferer, PHP_URL_SCHEME) );
                        } else {
                            $security = false;
                        }
                        setcookie('wp-wpfd-file-wrong-password', $passwordId, time() + 10 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, $security);
                        wp_safe_redirect(wp_get_referer());
                        exit;
                    }
                } elseif ($categoryFrom === 'onedrive_business') {
                    $params = apply_filters('wpfdAddonGetOneDriveBusinessFile', $passwordId, $categoryId, $token);
                    if ((string) $params['file_password'] !== (string) $password) {
                        $missReferer = wp_get_referer();
                        if ($missReferer) {
                            $security = ( 'https' === parse_url($missReferer, PHP_URL_SCHEME) );
                        } else {
                            $security = false;
                        }
                        setcookie('wp-wpfd-file-wrong-password', $passwordId, time() + 10 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, $security);
                        wp_safe_redirect(wp_get_referer());
                        exit;
                    }
                }
            }
        } else {
            wp_safe_redirect(wp_get_referer());
            exit;
        }

        require_once ABSPATH . WPINC . '/class-phpass.php';
        $hasher = new PasswordHash(8, true);

        /**
         * Filters the life span of the post password cookie.
         *
         * By default, the cookie expires 10 days from creation. To turn this
         * into a session cookie, return 0.
         *
         * @param int $expires The expiry time, as passed to setcookie().
         */
        $expire  = apply_filters('wpfd_password_expires', time() + 10 * DAY_IN_SECONDS);
        $referer = wp_get_referer();

        if ($referer) {
            $secure = ( 'https' === parse_url($referer, PHP_URL_SCHEME) );
        } else {
            $secure = false;
        }

        if ($passwordType === 'category') {
            setcookie('wp-wpfd-password-category-' . $passwordId . '_' . COOKIEHASH, $hasher->HashPassword(wp_unslash($password)), $expire, COOKIEPATH, COOKIE_DOMAIN, $secure);
            setcookie('wp-wpfd-user-login-category-'. $passwordId, $userId, $expire, COOKIEPATH, COOKIE_DOMAIN, $secure);
        } elseif ($passwordType === 'file') {
            setcookie('wp-wpfd-password-file-' . $passwordId . '_' . COOKIEHASH, $hasher->HashPassword(wp_unslash($password)), $expire, COOKIEPATH, COOKIE_DOMAIN, $secure);
            setcookie('wp-wpfd-user-login-file-'. $passwordId, $userId, $expire, COOKIEPATH, COOKIE_DOMAIN, $secure);
        }

        // Clear all missing password
        setcookie('wp-wpfd-file-wrong-password', ' ', time() - YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
        setcookie('wp-wpfd-category-wrong-password', ' ', time() - YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);

        wp_safe_redirect(wp_get_referer());
        exit;
    }
}
