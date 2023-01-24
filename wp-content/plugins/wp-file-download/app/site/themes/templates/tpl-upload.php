<?php
/**
 * WP File Download
 *
 * @package WP File Download
 * @author  Joomunited
 * @version 1.0.3
 */

defined('ABSPATH') || die();
?>
<div class="file-upload-content clearfix row-fluid wpfdUploadForm-<?php echo esc_attr($formId); ?>" style="display: block;" data-container="<?php echo esc_attr($formId); ?>">
    <div class="wpreview border jsWpfdFrontUpload">
        <div class="file-upload-top clearfix">
            <div class="pull-center"><strong><?php esc_html_e('File Upload', 'wpfd'); ?></strong></div>
            <?php if (!isset($category_id)) : ?>
            <div class="wpfd-category-target-section">
                <p><?php esc_html_e('Category target:', 'wpfd'); ?></p>
                <select id="wpfd-upload-category-target" class="wpfd-upload-category-target">
                    <?php if (isset($categoriesList)) : ?>
                        <?php foreach ($categoriesList as $category) : ?>
                            <?php echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html(str_repeat('-', $category->level - 1)) . esc_html($category->name) . '</option>'; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <?php endif; ?>
        </div>
        <div id="preview" class="wpfd_preview has-wpfd ui-sortable">
            <div class="wpdf_dropbox">
                <span class="message"><?php esc_html_e('Drag & Drop your Document here', 'wpfd'); ?></span>
                <input class="hide upload_input" type="file" id="upload_input<?php echo esc_attr($formId); ?>" multiple="">
                <input type="hidden" id="id_category" name="id_category" value="<?php echo isset($category_id) ? esc_attr($category_id) : 0; ?>">
                <span href="#" id="upload_button" class="button button-primary button-big">
                    <?php esc_html_e('Select files', 'wpfd'); ?>
                </span>
            </div>
            <div id="wpfd-upload-messages" class="wpfd-upload-messages"></div>
            <div class="clr"></div>
        </div>
    </div>
    <?php if (isset($display_files) && (int) $display_files === 1) : ?>
    <div id="wpfd-upload-display-files">
        <?php if ((int)$category_id > 0) : ?>
            <?php if (isset($variables) && isset($variables['files']) && !empty($variables['files'])) : ?>
                <div class="category-name-section">
                    <h4><?php echo isset($categoryName) ? esc_attr($categoryName) : ''; ?></h4>
                </div>
                <div id="wpfd-results" class="list-results">
                <?php wpfd_get_template('tpl-search-results.php', $variables); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div id="mybootstrap" style="margin:0"></div>
</div>
