<?php
/**
 * WP File Download
 *
 * @package WP File Download
 * @author  Joomunited
 * @version 1.0.3
 */
defined('ABSPATH') || die();

use Joomunited\WPFramework\v1_0_5\Application;

$download_attributes = apply_filters('wpfd_download_data_attributes_handlebars', '');
$globalConfig        = get_option('_wpfd_global_config');
$selectedDownload    = isset($globalConfig['download_selected']) ? (int) $globalConfig['download_selected'] : 0;

if ($files !== null && is_array($files) && count($files) > 0) : ?>
    <script type="text/javascript">
        wpfdajaxurl = "<?php echo wpfd_sanitize_ajax_url(Application::getInstance('Wpfd')->getAjaxUrl()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Print only ?>";
        function  initdefaultOption() {
            var $           = jQuery;
            var checkitem   = $('.mediaTableMenu .media-item');
            var showList    = [];
            checkitem.each(function () {
                if ($(this).prop("checked") == true) {
                    showList.push($(this).val());
                }
            });
            if (showList.length > 0) {
                jQuery("#total-media-list").val(showList.join(","));
            } else {
                jQuery("#total-media-list").val("");
            }
            var desc = "";
            var ver = "";
            var size = "";
            var hits = "";
            var dateadd = "";
            var download = "";
            for(var i = 0; i<showList.length;i++) {
                if(showList[i] == "Description" ) {
                    desc = "Description";
                }
                if(showList[i] == "Version") {
                    ver = "Version";
                }
                if(showList[i] == "Size") {
                    size = "Size";
                }
                if(showList[i] == "Hits") {
                    hits = "Hits";
                }
                if(showList[i] == "Date added") {
                    dateadd = "Date added";
                }
                if(showList[i] == "Download") {
                    download = "Download";
                }
            }
            if(desc === "Description") {
                jQuery(".file_desc").removeClass('filehidden');
            } else {
                jQuery(".file_desc").addClass('filehidden');
            }
            if (ver === "Version") {
                jQuery(".file_version").removeClass('filehidden');
            } else {
                jQuery(".file_version").addClass('filehidden');
            }
            if (size === "Size") {
                jQuery(".file_size").removeClass('filehidden');
            } else {
                jQuery(".file_size").addClass('filehidden');
            }
            if (hits === "Hits") {
                jQuery(".file_hits").removeClass('filehidden');
            } else {
                jQuery(".file_hits").addClass('filehidden');
            }
            if (dateadd === "Date added") {
                jQuery(".file_created").removeClass('filehidden');
            } else {
                jQuery(".file_created").addClass('filehidden');
            }
            if (download === "Download") {
                jQuery(".file_download").removeClass('filehidden');
            } else {
                jQuery(".file_download").addClass('filehidden');
            }
        }
        
        function initUploadDefaultOption(container) {
            var $           = jQuery;
            var checkitem   = $(".file-upload-content[data-container='" + container + "'] .mediaTableMenu .media-item");
            var showList    = [];
            checkitem.each(function () {
                if ($(this).prop("checked") == true) {
                    showList.push($(this).val());
                }
            });
            if (showList.length > 0) {
                jQuery(".file-upload-content[data-container='" + container + "'] #total-media-list").val(showList.join(","));
            } else {
                jQuery(".file-upload-content[data-container='" + container + "'] #total-media-list").val("");
            }
            var desc        = "";
            var ver         = "";
            var size        = "";
            var hits        = "";
            var dateadd     = "";
            var download    = "";
            for(var i = 0; i<showList.length;i++) {
                if(showList[i] == "Description" ) {
                    desc = "Description";
                }
                if(showList[i] == "Version") {
                    ver = "Version";
                }
                if(showList[i] == "Size") {
                    size = "Size";
                }
                if(showList[i] == "Hits") {
                    hits = "Hits";
                }
                if(showList[i] == "Date added") {
                    dateadd = "Date added";
                }
                if(showList[i] == "Download") {
                    download = "Download";
                }
            }
            if(desc === "Description") {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_desc").removeClass('filehidden');
            } else {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_desc").addClass('filehidden');
            }
            if (ver === "Version") {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_version").removeClass('filehidden');
            } else {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_version").addClass('filehidden');
            }
            if (size === "Size") {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_size").removeClass('filehidden');
            } else {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_size").addClass('filehidden');
            }
            if (hits === "Hits") {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_hits").removeClass('filehidden');
            } else {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_hits").addClass('filehidden');
            }
            if (dateadd === "Date added") {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_created").removeClass('filehidden');
            } else {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_created").addClass('filehidden');
            }
            if (download === "Download") {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_download").removeClass('filehidden');
            } else {
                jQuery(".file-upload-content[data-container='" + container + "'] .file_download").addClass('filehidden');
            }
        }

        function showViewOption() {
            var $         = jQuery;
            var checkitem = $('.mediaTableMenu .media-item');
            $('.mediaTableMenu').unbind("click").click(function () {
                $(this).addClass('showlist');
                checkitem.unbind("click").click(function () {
                    if (!$(this).parents('.file-upload-content').length) {
                        initdefaultOption();
                        if($(".list-results .file_desc").hasClass("filehidden") && $(".list-results .file_created").hasClass("filehidden") ) {
                            $(".list-results .file_download").addClass("file_download_inline");
                        } else {
                            $(".list-results .file_download").removeClass("file_download_inline");
                        }
                        var checkall = $(".list-results .table thead th");
                        if(!checkall.hasClass("filehidden")) {
                            $(".list-results .file_title").addClass("adv_file_tt");
                        } else {
                            $(".list-results .file_title").removeClass("adv_file_tt");
                        }
                    } else {
                        var container = $(this).parents('.file-upload-content').data('container');
                        initUploadDefaultOption(container);
                        if($(".file-upload-content[data-container='" + container + "'] .list-results .file_desc").hasClass("filehidden") && $(".file-upload-content[data-container='" + container + "'] .list-results .file_created").hasClass("filehidden") ) {
                            $(".file-upload-content[data-container='" + container + "'] .list-results .file_download").addClass("file_download_inline");
                        } else {
                            $(".file-upload-content[data-container='" + container + "'] .list-results .file_download").removeClass("file_download_inline");
                        }
                        var checkall = $(".file-upload-content[data-container='" + container + "'] .list-results .table thead th");
                        if(!checkall.hasClass("filehidden")) {
                            $(".file-upload-content[data-container='" + container + "'] .list-results .file_title").addClass("adv_file_tt");
                        } else {
                            $(".file-upload-content[data-container='" + container + "'] .list-results .file_title").removeClass("adv_file_tt");
                        }
                    }
                });

                $(document).mouseup(e => {
                    if (!$(".mediaTableMenu").is(e.target) // if the target of the click isn't the container...
                        && $(".mediaTableMenu").has(e.target).length === 0) // ... nor a descendant of the container
                    {
                        $(".mediaTableMenu").removeClass('showlist');
                    }
                });
            });
        }

        function showtbResultonMobile() {
            if(jQuery("#wpfd-results").width() <=420) {
                jQuery(".file_version").css("display", "none");
                jQuery(".file_size").css("display", "none");
                jQuery(".file_hits").css("display", "none");
                jQuery(".file_created").css("display", "none");
            }
        }

        jQuery(document).ready(function () {
            initdefaultOption();
            showViewOption();
            showtbResultonMobile();
        });

    </script>

    <table class="table">
        <thead>
            <th class="htitle file_title"><?php esc_html_e('Title', 'wpfd'); ?></th>
            <th class="hdescription file_desc"><?php esc_html_e('Description', 'wpfd'); ?></th>
            <th class="hversion file_version"><?php esc_html_e('Version', 'wpfd'); ?></th>
            <th class="hsize file_size"><?php esc_html_e('Size', 'wpfd'); ?></th>
            <th class="hhits file_hits"><?php esc_html_e('Hits', 'wpfd'); ?></th>
            <th class="hcreated file_created"><?php esc_html_e('Date added', 'wpfd'); ?></th>
            <th class="hdownload file_download"><?php esc_html_e('Download', 'wpfd'); ?></th>
            <th class="mediaMenuOption">
                <div class="mediaTableMenu">
                    <a title="Columns"><i class="zmdi zmdi-settings"></i></a>
                    <ul>
                        <li>
                            <input type="checkbox" class="media-item" name="toggle-cols" id="toggle-col-MediaTable-0-1" value="Description" > <label for="toggle-col-MediaTable-0-1"><?php esc_html_e('Description', 'wpfd'); ?></label>
                        </li>
                        <li>
                            <input type="checkbox" class="media-item" name="toggle-cols" id="toggle-col-MediaTable-0-2" value="Version" checked="checked"> <label for="toggle-col-MediaTable-0-2"><?php esc_html_e('Version', 'wpfd'); ?></label>
                        </li>
                        <li>
                            <input type="checkbox" class="media-item" name="toggle-cols" id="toggle-col-MediaTable-0-3" value="Size" checked="checked"> <label for="toggle-col-MediaTable-0-3"><?php esc_html_e('Size', 'wpfd'); ?></label>
                        </li>
                        <li>
                            <input type="checkbox" class="media-item" name="toggle-cols" id="toggle-col-MediaTable-0-4" value="Hits" checked="checked"> <label for="toggle-col-MediaTable-0-4"><?php esc_html_e('Hits', 'wpfd'); ?></label>
                        </li>
                        <li>
                            <input type="checkbox" class="media-item" name="toggle-cols" id="toggle-col-MediaTable-0-5" value="Date added" checked="checked"> <label for="toggle-col-MediaTable-0-5"><?php esc_html_e('Date added', 'wpfd'); ?></label>
                        </li>
                        <li>
                            <input type="checkbox" class="media-item" name="toggle-cols" id="toggle-col-MediaTable-0-6" value="Download" checked="checked"> <label for="toggle-col-MediaTable-0-6"><?php esc_html_e('Download', 'wpfd'); ?></label>
                        </li>
                    </ul>
                    <input type="hidden" class="media-list" name="media-list" id="total-media-list" value="" style="visibility: hidden">
                </div>
            </th>
        </thead>
        <tbody>
        <?php
        $iconSet = isset($config['icon_set']) && $config['icon_set'] !== 'default' ? ' wpfd-icon-set-' . $config['icon_set'] : '';
        foreach ($files as $key => $file) :
            $isProduct = isset($file->show_add_to_cart) ? $file->show_add_to_cart : false;
            ?>
            <?php  if (wpfdPasswordRequired($file, 'file')) : ?>
        <tr class="wpfd-password-protection-form" style="background: #fff">
            <td class="full-width">
                <?php
                $fileTitle = isset($file->post_title) ? $file->post_title : '';
                $passwordFormProtection = '<h3 class="protected-title" title="' . $fileTitle . '">' . esc_html__('Protected: ', 'wpfd') . $fileTitle . '</h3>';
                $passwordFormProtection .= wpfdGetPasswordForm($file, 'file', $file->catid);
                // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Print only
                echo $passwordFormProtection;
                ?>
            </td>
        </tr>
            <?php  else : ?>
            <tr>
                <td class="file_title title">
                    <span class="file-icon">
                    <?php if (isset($config['custom_icon']) && $config['custom_icon'] && $file->file_custom_icon) : ?>
                        <img class="icon-custom" src="<?php echo esc_url($file->file_custom_icon); ?>">
                    <?php else : ?>
                        <i class="ext ext-<?php echo esc_attr($file->ext) . esc_attr($iconSet); ?>"></i>
                    <?php endif; ?>
                    </span>
                    <?php if ($selectedDownload) : ?>
                    <label class="wpfd_checkbox">
                        <input class="cbox_file_download" type="checkbox" data-id="<?php echo esc_attr($file->ID); ?>" data-catid="<?php echo esc_attr($file->catid); ?>" />
                        <span></span>
                    </label>
                    <?php endif; ?>
                    <a <?php echo $download_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Data attributes ?> class="file-item wpfd-file-link" data-id="<?php echo esc_attr($file->ID); ?>"
                       href="<?php echo esc_url($file->linkdownload); ?>" id="file-<?php echo esc_attr($file->ID); ?>"
                       data-catid="<?php echo esc_attr($file->catid); ?>" title="<?php echo isset($file->title) ? esc_attr($file->title) : esc_attr($file->post_title); ?>"
                        <?php if (!wpfd_can_download_files()) : ?>
                             onclick="return false;"
                        <?php endif; ?>
                    >
                        <?php
                        if (isset($file->crop_title)) {
                            echo esc_html($file->crop_title);
                        } else {
                            echo esc_html($file->title);
                        }
                        ?>
                    </a>
                </td>
                <td class="file_desc"><?php echo esc_html($file->description); ?></td>
                <td class="file_version"><?php echo esc_html($file->version); ?></td>
                <td class="file_size"><?php echo esc_html((strtolower($file->size) === 'n/a' || $file->size <= 0) ? 'N/A' : WpfdHelperFiles::bytesToSize($file->size)); ?></td>
                <td class="file_hits"><?php echo esc_html($file->hits); ?></td>
                <td class="file_created"><?php echo esc_html($file->created); ?></td>
                <td class="file_download viewer" colspan="2">
                    <?php if ($isProduct) : ?>
                        <a class="downloadlink wpfd_downloadlink"
                           href="<?php echo esc_html($file->linkdownload); ?>" data-product_id="<?php echo esc_html($file->product_id); ?>">
                            <i class="zmdi zmdi-shopping-cart-plus wpfd-add-to-cart"></i>
                        </a>
                        <a href="<?php echo esc_url($file->viewerlink); ?>" class="wpfd_previewlink openlink" target="_blank">
                            <i class="zmdi zmdi-filter-center-focus wpfd-preview"></i>
                        </a>
                    <?php else : ?>
                        <?php if (wpfd_can_download_files()) : ?>
                        <a class="downloadlink wpfd_downloadlink"
                            <?php echo $download_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Data attributes ?>
                           href="<?php echo esc_html($file->linkdownload); ?>">
                            <i class="zmdi zmdi-cloud-download wpfd-download"></i>
                        </a>
                        <?php endif; ?>
                        <?php if ($viewer !== 'no' && wpfd_can_preview_files()) : ?>
                            <?php
                            if (isset($file->openpdflink)) { ?>
                                <a href="<?php echo esc_url($file->openpdflink); ?>" class="wpfd_previewlink openlink" target="_blank">
                                    <i class="zmdi zmdi-filter-center-focus wpfd-preview"></i>
                                </a>
                            <?php } elseif (isset($file->viewerlink) && $file->viewerlink) { ?>
                                <a data-id="<?php echo esc_attr($file->ID); ?>"
                                   data-catid="<?php echo esc_attr($file->catid); ?>"
                                   data-file-type="<?php echo esc_attr($file->ext); ?>"
                                   class="wpfd_previewlink openlink <?php echo esc_attr(($viewer === 'lightbox') ? 'wpfdlightbox' : ''); ?>"
                                    <?php echo esc_attr(($viewer === 'tab') ? 'target="_blank"' : ''); ?>
                                   href='<?php echo esc_url($file->viewerlink); ?>'>
                                    <i class="zmdi zmdi-filter-center-focus wpfd-preview"></i>
                                </a>
                            <?php } ?>
                        <?php endif; ?>
                    <?php endif;?>
                </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php wpfd_num($limit); ?>
<?php else : ?>
    <p class="text-center">
        <?php esc_html_e("Sorry, we haven't found anything that matches this search query", 'wpfd'); ?>
    </p>

<?php endif; ?>
