/**
 * Wpfd
 *
 * We developed this code with our hearts and passion.
 * We hope you found it useful, easy to understand and to customize.
 * Otherwise, please feel free to contact us at contact@joomunited.com *
 * @package WP File Download
 * @copyright Copyright (C) 2013 JoomUnited (http://www.joomunited.com). All rights reserved.
 * @copyright Copyright (C) 2013 Damien Barrère (http://www.crac-design.com). All rights reserved.
 * @license GNU General Public License version 2 or later; http://www.gnu.org/licenses/gpl-2.0.html
 */

jQuery(document).ready(function ($) {
    var sourcefile = $("#wpfd-template-preview-box").html();
    var preview_hash = window.location.hash;
    var preview_cParents = {};
    var preview_tree = $('.wpfd-foldertree-preview');
    var preview_root_cat = $('.wpfd-content-preview').data('category');
    var preview_subcategories_hover_color_list = {};
    if (window.wpfdAjax === undefined) {
        window.wpfdAjax = {};
    }
    window.wpfdAjax[preview_root_cat] = {category: null, file: null};
    $(".wpfd-content-preview").each(function () {
        var preview_topCat = $(this).data('category');
        if (preview_topCat == 'all_0') {
            preview_cParents[preview_topCat] = {parent: 0, term_id: 0, name: $(this).find("h2").text()};
        } else {
            preview_cParents[preview_topCat] = {parent: 0, term_id: preview_topCat, name: $(this).find("h2").text()};
        }

        $(this).find(".wpfdcategory.catlink").each(function () {
            var tempidCat = $(this).data('idcat');
            preview_cParents[tempidCat] = {parent: preview_topCat, term_id: tempidCat, name: $(this).text()};
        });
        initInputSelected(preview_topCat);
        initDownloadSelected(preview_topCat);
    });

    Handlebars.registerHelper('bytesToSize', function (bytes) {
        if (typeof bytes === "undefined") {
            return 'n/a';
        }

        return bytes.toString().toLowerCase() === 'n/a' ? bytes : bytesToSize(bytes);
    });

    initClickFile();

    function preview_initClick() {
        $('.wpfd-content-preview .catlink').unbind('click').click(function (e) {
            e.preventDefault();
            load($(this).parents('.wpfd-content-preview').data('category'), $(this).data('idcat'));
        });
    }

    function initInputSelected(sc) {
        $(document).on('change', ".wpfd-content-preview.wpfd-content-multi[data-category=" + sc + "] input.cbox_file_download", function (e) {
            e.stopPropagation();
            var rootCat = ".wpfd-content-preview.wpfd-content-multi[data-category=" + sc + "]";
            var selectedFiles = $(rootCat + " input.cbox_file_download:checked");
            var filesId = [];
            if (selectedFiles.length) {
                selectedFiles.each(function (index, file) {
                    filesId.push($(file).data('id'));
                });
            }
            if (filesId.length > 0) {
                $(rootCat + " .wpfdSelectedFiles").remove();
                $('<input type="hidden" class="wpfdSelectedFiles" value="' + filesId.join(',') + '" />')
                    .insertAfter($(rootCat).find(" #current_category_slug_" + sc));
                hideDownloadAllBtn(sc, true);
                $(rootCat + " .preview-download-selected").remove();
                var downloadSelectedBtn = $('<a href="javascript:void(0);" class="preview-download-selected" style="display: block;">' + wpfdparams.translates.download_selected + '<i class="zmdi zmdi-check-all wpfd-download-category"></i></a>');
                downloadSelectedBtn.insertAfter($(rootCat).find(" #current_category_slug_" + sc));
            } else {
                $(rootCat + " .wpfdSelectedFiles").remove();
                $(rootCat + " .preview-download-selected").remove();
                hideDownloadAllBtn(sc, false);
            }
            preview_init_pagination($(rootCat).next(".wpfd-pagination"));
        });
    }

    function hideDownloadAllBtn(sc, hide) {
        var rootCat = ".wpfd-content-preview.wpfd-content-multi[data-category=" + sc + "]";
        var downloadCatButton = $(rootCat + " .preview-download-category");
        if (downloadCatButton.length === 0 || downloadCatButton.hasClass('display-download-category')) {
            return;
        }
        if (hide) {
            $(rootCat + " .preview-download-category").hide();
        } else {
            $(rootCat + " .preview-download-category").show();
        }
    }

    function initDownloadSelected(sc) {
        var rootCat = ".wpfd-content-preview.wpfd-content-multi[data-category=" + sc + "]";
        $(document).on('click', rootCat + ' .preview-download-selected', function () {
            if ($(rootCat).find('.wpfdSelectedFiles').length > 0) {
                var current_category = $(rootCat).find('#current_category_' + sc).val();
                var category_name = $(rootCat).find('#current_category_slug_' + sc).val();
                var selectedFilesId = $(rootCat).find('.wpfdSelectedFiles').val();
                $.ajax({
                    url: wpfdparams.wpfdajaxurl + "?action=wpfd&task=files.zipSeletedFiles&filesId=" + selectedFilesId + "&wpfd_category_id=" + current_category,
                    dataType: "json",
                }).done(function (results) {
                    if (results.success) {
                        var hash = results.data.hash;
                        window.location.href = wpfdparams.wpfdajaxurl + "?action=wpfd&task=files.downloadZipedFile&hash=" + hash + "&wpfd_category_id=" + current_category + "&wpfd_category_name=" + category_name;
                    } else {
                        alert(results.data.message);
                    }
                })
            }
        });
    }
    preview_initClick();

    preview_hash = preview_hash.replace('#', '');
    if (preview_hash !== '') {
        var hasha = preview_hash.split('-');
        var re = new RegExp("^(p[0-9]+)$");
        var page = null;
        var stringpage = hasha.pop();

        if (re.test(stringpage)) {
            page = stringpage.replace('p', '');
        }

        var hash_category_id = hasha[1];
        var hash_sourcecat = hasha[0];

        if (parseInt(hash_category_id) > 0 || hash_category_id === 'all_0') {
            if (hash_category_id == 'all_0') {
                hash_category_id = 0;
            }
            setTimeout(function () {
                load(hash_sourcecat, hash_category_id, page);
            }, 100)
        }
    }

    function initClickFile() {
        $('.wpfd-content .wpfd-file-link').unbind('click').click(function (e) {
            var atthref = $(this).attr('href');
            if (atthref !== '#') {
                return;
            }
            e.preventDefault();
            var fileid = $(this).data('id');
            var categoryid = $(this).data('category_id');
            $.ajax({
                url: wpfdparams.wpfdajaxurl + "task=file.display&view=file&id=" + fileid + "&categoryid=" + categoryid + "&rootcat=" + preview_root_cat,
                dataType: "json",
                beforeSend: function() {
                    // setting a timeout
                    if($('body').has('wpfd-preview-box-loader') !== true) {
                        $('body').append('<div class="wpfd-preview-box-loader"></div>');
                    }
                }
            }).done(function (file) {
                var template = Handlebars.compile(sourcefile);
                var html = template(file);
                var box = $("#wpfd-preview-box");
                $('.wpfd-preview-box-loader').each(function () {
                    $(this).remove();
                });
                if (box.length === 0) {
                    $('body').append('<div id="wpfd-preview-box" style="display: none;"></div>');
                    box = $("#wpfd-preview-box");
                }
                box.empty();
                box.prepend(html);
                box.click(function (e) {
                    if ($(e.target).is('#wpfd-preview-box')) {
                        box.hide();
                    }
                    $('#wpfd-preview-box').unbind('click.box').bind('click.box', function (e) {
                        if ($(e.target).is('#wpfd-preview-box')) {
                            box.hide();
                        }
                    });
                });
                $('#wpfd-preview-box .wpfd-close').click(function (e) {
                    e.preventDefault();
                    box.hide();
                });

                box.show();

                var dropblock = box.find('.dropblock');
                if ($(window).width() < 400) {
                    dropblock.css('margin-top', '0');
                    dropblock.css('margin-left', '0');
                    dropblock.css('top', '0');
                    dropblock.css('left', '0');
                    dropblock.height($(window).height() - parseInt(dropblock.css('padding-top'), 10) - parseInt(dropblock.css('padding-bottom'), 10));
                    dropblock.width($(window).width() - parseInt(dropblock.css('padding-left'), 10) - parseInt(dropblock.css('padding-right'), 10));
                } else {
                    dropblock.css('margin-top', (-(dropblock.height() / 2) - 20) + 'px');
                    dropblock.css('margin-left', (-(dropblock.width() / 2) - 20) + 'px');
                    dropblock.css('height', '');
                    dropblock.css('width', '');
                    dropblock.css('top', '');
                    dropblock.css('left', '');
                }

                if (typeof wpfdColorboxInit !== 'undefined') {
                    wpfdColorboxInit();
                }
                wpfdTrackDownload();

                $('body.elementor-default #wpfd-preview-box a.wpfd_downloadlink').on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var link = $(this).attr('href');
                    window.location.href = link;
                });
            });
        });
    }

    function load(sourcecat, catid, page) {
        $(document).trigger('wpfd:category-loading');
        var pathname = window.location.href.replace(window.location.hash, '');
        var container = $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "]");
        var view_empty_subcategories = $(".wpfd-content-preview[data-category=" + sourcecat + "] #wpfd_is_empty_subcategories");
        var view_empty_files = $(".wpfd-content-preview[data-category=" + sourcecat + "] #wpfd_is_empty_files");
        container.find('#current_category_' + sourcecat).val(catid);
        container.next('.wpfd-pagination').remove();
        $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview").empty();
        $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview").html($('#wpfd-loading-wrap').html());

        if (view_empty_subcategories.length) {
            view_empty_subcategories.val('1');
        }

        if (view_empty_files.length) {
            view_empty_files.val('1');
        }

        //Get categories
        var oldCategoryAjax = window.wpfdAjax[preview_root_cat].category;
        var previewCategoriesAjaxUrl = wpfdparams.wpfdajaxurl + "task=categories.display&view=categories&id=" + catid + "&top=" + sourcecat;
        if (oldCategoryAjax !== null) {
            oldCategoryAjax.abort();
        }
        window.wpfdAjax[preview_root_cat].category = $.ajax({
            url: previewCategoriesAjaxUrl,
            dataType: "json",
            cache: true,
            beforeSend: function () {
                if (wpfdPreviewCategoriesLocalCache.exist(previewCategoriesAjaxUrl)) {
                    var triggerPreviewCategories = wpfdPreviewCategoriesLocalCache.get(previewCategoriesAjaxUrl);
                    wpfdPreviewCategoriesLocalCacheTrigger(triggerPreviewCategories, sourcecat, page, pathname, catid, container, view_empty_subcategories);

                    return false;
                }

                return true;
            }
        }).done(function (categories) {

            // Set categories trigger
            wpfdPreviewCategoriesLocalCache.set(previewCategoriesAjaxUrl, categories);

            if (page !== null && page !== undefined) {
                window.history.pushState('', document.title, pathname + '#' + sourcecat + '-' + catid + '-' + categories.category.slug + '-p' + page);
            } else {
                window.history.pushState('', document.title, pathname + '#' + sourcecat + '-' + catid + '-' + categories.category.slug);
            }

            container.find('#current_category_slug_' + sourcecat).val(categories.category.slug);
            var sourcecategories = $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-template-categories").html();
            if (sourcecategories) {
                var template = Handlebars.compile(sourcecategories);
                var html = template(categories);
                $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview").prepend(html);
            }
            if (categories.category.breadcrumbs !== undefined) {
                $(".wpfd-content-preview[data-category=" + sourcecat + "] .breadcrumbs").html(categories.category.breadcrumbs);
            }
            for (var i = 0; i < categories.categories.length; i++) {
                preview_cParents[categories.categories[i].term_id] = categories.categories[i];
            }

            preview_breadcrum(sourcecat, catid, categories.category);
            preview_initClick();
            if (preview_tree.length) {
                var currentTree = container.find('.wpfd-foldertree-preview');
                currentTree.find('li').removeClass('selected');
                currentTree.find('i.md').removeClass('md-folder-open').addClass("md-folder");

                currentTree.jaofiletree('open', catid, currentTree);

                var el = currentTree.find('a[data-file="' + catid + '"]').parent();
                el.find(' > i.md').removeClass("md-folder").addClass("md-folder-open");

                if (!el.hasClass('selected')) {
                    el.addClass('selected');
                }
                var ps = currentTree.find('.icon-open-close');

                $.each(ps.get().reverse(), function (i, p) {
                    if (typeof $(p).data() !== 'undefined' && $(p).data('id') == Number(hash_category_id)) {
                        hash_category_id = $(p).data('parent_id');
                        $(p).click();
                    }
                });

            }
            wpfd_preview_subcategory_class();

            if (typeof(preview_subcategories_hover_color_list) !== 'undefined') {
                var root_key_exists = sourcecat in preview_subcategories_hover_color_list;
                if (root_key_exists) {
                    var color = preview_subcategories_hover_color_list[sourcecat];
                    wpfd_preview_subcategories_hover_color(sourcecat, color);
                }
            }

            if (view_empty_subcategories.length) {
                view_empty_subcategories.val(categories.categories.length);
                wpfd_view_fire_empty_category_message(sourcecat);
            }
        });
        var ordering = $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "]").find('#current_ordering_' + sourcecat).val();
        var orderingDirection = $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "]").find('#current_ordering_direction_' + sourcecat).val();
        var params = $.param({
            task: 'files.display',
            view: 'files',
            id: catid,
            rootcat: sourcecat,
            page: page,
            orderCol: ordering,
            orderDir: orderingDirection
        });
        //Get files
        var oldFileAjax = window.wpfdAjax[preview_root_cat].file;
        var previewFilesAjaxUrl = wpfdparams.wpfdajaxurl + params;
        if (oldFileAjax !== null) {
            oldFileAjax.abort();
        }
        window.wpfdAjax[preview_root_cat].file = $.ajax({
            url: previewFilesAjaxUrl,
            dataType: "json",
            cache: true,
            beforeSend: function () {
                if (wpfdPreviewFilesLocalCache.exist(previewFilesAjaxUrl)) {
                    var previewTriggerFiles = wpfdPreviewFilesLocalCache.get(previewFilesAjaxUrl);
                    wpfdPreviewFilesLocalCacheTrigger(previewTriggerFiles, sourcecat, view_empty_files);

                    return false;
                }

                return true;
            }
        }).done(function (content) {

            // Set preview files cache
            wpfdPreviewFilesLocalCache.set(previewFilesAjaxUrl, content);

            if (content.files.length) {
                $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "]  .preview-download-category").removeClass("display-download-category");
            } else {
                $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "]  .preview-download-category").addClass("display-download-category");
            }

            $(".wpfd-content-preview[data-category=" + sourcecat + "]").after(content.pagination);
            delete content.pagination;
            var sourcefiles = $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "]  .wpfd-template-files").html();
            var template = Handlebars.compile(sourcefiles);
            var html = template(content);
            html = $('<textarea/>').html(html).val();
            $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview").append(html);

            if (typeof (content.filepasswords) !== 'undefined') {
                $.each(content.filepasswords, function( file_id, pw_form ) {
                    var protected_file = $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview").find('.wpfd-file-link[data-id="' + file_id + '"]').parent();
                    protected_file.empty();
                    protected_file.addClass('wpfd-password-protection-form');
                    protected_file.append(pw_form);
                });
            }

            if (content.uploadform !== undefined && content.uploadform.length) {
                var upload_form_html = '<div class="wpfd-upload-form" style="margin: 20px 10px">';
                upload_form_html += content.uploadform;
                upload_form_html += '</div>';
                $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview").append(upload_form_html);

                if (typeof (Wpfd) === 'undefined') {
                    Wpfd = {};
                }

                _wpfd_text = function (text) {
                    if (typeof (l10n) !== 'undefined') {
                        return l10n[text];
                    }
                    return text;
                };

                function toMB(mb) {
                    return mb * 1024 * 1024;
                }

                var allowedExt = wpfdparams.allowed;
                allowedExt = allowedExt.split(',');
                allowedExt.sort();

                var initUploader = function (currentContainer) {
                    // Init the uploader
                    var uploader = new Resumable({
                        target: wpfdparams.wpfduploadajax + '?action=wpfd&task=files.upload&upload_from=front',
                        query: {
                            id_category: $(currentContainer).find('input[name=id_category]').val(),
                        },
                        fileParameterName: 'file_upload',
                        simultaneousUploads: 2,
                        maxFileSize: toMB(wpfdparams.maxFileSize),
                        maxFileSizeErrorCallback: function (file) {
                            bootbox.alert(file.name + ' ' + _wpfd_text('is too large') + '!');
                        },
                        chunkSize: wpfdparams.serverUploadLimit - 50 * 1024, // Reduce 50KB to avoid error
                        forceChunkSize: true,
                        fileType: allowedExt,
                        fileTypeErrorCallback: function (file) {
                            bootbox.alert(file.name + ' cannot upload!<br/><br/>' + _wpfd_text('This type of file is not allowed to be uploaded. You can add new file types in the plugin configuration'));
                        },
                        generateUniqueIdentifier: function (file, event) {
                            var relativePath = file.webkitRelativePath || file.fileName || file.name;
                            var size = file.size;
                            var prefix = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                            return (prefix + size + '-' + relativePath.replace(/[^0-9a-zA-Z_-]/img, ''));
                        }
                    });

                    if (!uploader.support) {
                        bootbox.alert(_wpfd_text('Your browser does not support HTML5 file uploads!'));
                    }

                    if (typeof (willUpload) === 'undefined') {
                        var willUpload = true;
                    }

                    uploader.on('filesAdded', function (files) {
                        files.forEach(function (file) {
                            var progressBlock = '<div class="wpfd_process_block" id="' + file.uniqueIdentifier + '">'
                                + '<div class="wpfd_process_fileinfo">'
                                + '<span class="wpfd_process_filename">' + file.fileName + '</span>'
                                + '<span class="wpfd_process_cancel">Cancel</span>'
                                + '</div>'
                                + '<div class="wpfd_process_full" style="display: block;">'
                                + '<div class="wpfd_process_run" data-w="0" style="width: 0%;"></div>'
                                + '</div></div>';

                            //$('#preview', '.wpreview').before(progressBlock);
                            currentContainer.find('#preview', '.wpreview').before(progressBlock);
                            $(currentContainer).find('.wpfd_process_cancel').unbind('click').click(function () {
                                fileID = $(this).parents('.wpfd_process_block').attr('id');
                                fileObj = uploader.getFromUniqueIdentifier(fileID);
                                uploader.removeFile(fileObj);
                                $(this).parents('.wpfd_process_block').fadeOut('normal', function () {
                                    $(this).remove();
                                });

                                if (uploader.files.length === 0) {
                                    $(currentContainer).find('.wpfd_process_pause').fadeOut('normal', function () {
                                        $(this).remove();
                                    });
                                }

                                $.ajax({
                                    url: wpfdparams.wpfduploadajax + '?action=wpfd&task=files.upload',
                                    method: 'POST',
                                    dataType: 'json',
                                    data: {
                                        id_category: $('input[name=id_category]').val(),
                                        deleteChunks: fileID
                                    },
                                    success: function (res, stt) {
                                        if (res.response === true) {
                                        }
                                    }
                                })
                            });
                        });

                        // Do not run uploader if no files added or upload same files again
                        if (files.length > 0) {
                            uploadPauseBtn = $(currentContainer).find('.wpreview').find('.wpfd_process_pause').length;
                            restableBlock = $(currentContainer).find('.wpfd_process_block');

                            if (!uploadPauseBtn) {
                                restableBlock.before('<div class="wpfd_process_pause">Pause</div>');
                                $(currentContainer).find('.wpfd_process_pause').unbind('click').click(function () {
                                    if (uploader.isUploading()) {
                                        uploader.pause();
                                        $(this).text('Start');
                                        $(this).addClass('paused');
                                        willUpload = false;
                                    } else {
                                        uploader.upload();
                                        $(this).text('Pause');
                                        $(this).removeClass('paused');
                                        willUpload = true;
                                    }
                                });
                            }

                            uploader.opts.query = {
                                id_category: currentContainer.find('input[name=id_category]').val()
                            };

                            if (willUpload) uploader.upload();
                        }
                    });

                    uploader.on('fileProgress', function (file) {
                        $(currentContainer).find('.wpfd_process_block#' + file.uniqueIdentifier)
                            .find('.wpfd_process_run').width(Math.floor(file.progress() * 100) + '%');
                    });

                    uploader.on('fileSuccess', function (file, res) {
                        var thisUploadBlock = currentContainer.find('.wpfd_process_block#' + file.uniqueIdentifier);
                        thisUploadBlock.find('.wpfd_process_cancel').addClass('uploadDone').text('OK').unbind('click');
                        thisUploadBlock.find('.wpfd_process_full').remove();

                        var response = JSON.parse(res);
                        if (response.response === false && typeof(response.datas) !== 'undefined') {
                            if (typeof(response.datas.code) !== 'undefined' && response.datas.code > 20) {
                                bootbox.alert('<div>' + response.datas.message + '</div>');
                                return false;
                            }
                        }
                        if (typeof(response) === 'string') {
                            bootbox.alert('<div>' + response + '</div>');
                            return false;
                        }

                        if (response.response !== true) {
                            bootbox.alert(response.response);
                            return false;
                        }
                    });

                    uploader.on('fileError', function (file, msg) {
                        thisUploadBlock = currentContainer.find('.wpfd_process_block#' + file.uniqueIdentifier);
                        thisUploadBlock.find('.wpfd_process_cancel').addClass('uploadError').text('Error').unbind('click');
                        thisUploadBlock.find('.wpfd_process_full').remove();
                    });

                    uploader.on('complete', function () {
                        var fileCount  = $(currentContainer).find('.wpfd_process_cancel').length;
                        var categoryId = $(currentContainer).find('input[name=id_category]').val();

                        $.ajax({
                            url: wpfdparams.wpfduploadajax + '?action=wpfd&task=files.wpfdPendingUploadFiles',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                uploadedFiles: fileCount,
                                id_category: categoryId,
                            },
                            success: function (res) {
                                currentContainer.find('.progress').delay(300).fadeIn(300).hide(300, function () {
                                    $(this).remove();
                                });
                                currentContainer.find('.uploaded').delay(300).fadeIn(300).hide(300, function () {
                                    $(this).remove();
                                });
                                $('#wpreview .file').delay(1200).show(1200, function () {
                                    $(this).removeClass('done placeholder');
                                });

                                $('.gritter-item-wrapper ').remove();
                                $(currentContainer).find('#wpfd-upload-messages').append('File(s) uploaded with success!');
                                $(currentContainer).find('#wpfd-upload-messages').delay(1200).fadeIn(1200, function () {
                                    $(currentContainer).find('#wpfd-upload-messages').empty();
                                    $(currentContainer).find('.wpfd_process_pause').remove();
                                    $(currentContainer).find('.wpfd_process_block').remove();
                                });

                                // Call list files
                                if (currentContainer.parent('.wpfd-upload-form').length) {
                                    var preview_sourcecat = currentContainer.parents('.wpfd-content.wpfd-content-multi').data('category');
                                    var current_category  = currentContainer.parents('.wpfd-content.wpfd-content-multi').find('#current_category_' + preview_sourcecat).val();
                                    load(preview_sourcecat, current_category);
                                }
                            }
                        });
                    });

                    uploader.assignBrowse($(currentContainer).find('#upload_button'));
                    uploader.assignDrop($(currentContainer).find('.jsWpfdFrontUpload'));
                }

                var containers = $(".wpfd-content-preview[data-category=" + sourcecat + "] div[class*=wpfdUploadForm]");
                if (containers.length > 0) {
                    containers.each(function(i, el) {
                        initUploader($(el));
                    });
                }
            }

            // View files
            if (typeof (content.fileview) !== 'undefined' && content.fileview.length) {
                content.fileview.forEach(function (viewFile) {
                    var preview_dropblock = $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview .wpfd-file-link[data-id='"+ viewFile.id +"'] .dropblock");
                    if (viewFile.view === true) {
                        preview_dropblock.css({'background-image': 'url('+ viewFile.link +')'});
                        preview_dropblock.addClass(viewFile.view_class);
                    } else {
                        preview_dropblock.addClass('wpfd-view-default');
                    }
                });
            }

            initClickFile();

            preview_init_pagination($('.wpfd-content-preview[data-category=' + sourcecat + '] + .wpfd-pagination'));

            wpfd_remove_loading($(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview"));
            $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "] .wpfdSelectedFiles").remove();
            $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "] .preview-download-selected").remove();
            hideDownloadAllBtn(sourcecat, false);

            if (view_empty_files.length) {
                view_empty_files.val(content.files.length);
                wpfd_view_fire_empty_category_message(sourcecat);
            }
        });

        $(document).trigger('wpfd:category-loaded');
    }

    function preview_breadcrum(preview_topCat, catid, category) {
        var links = [];
        var current_Cat = preview_cParents[catid];
        if (!current_Cat) {
            $(".wpfd-content-preview[data-category=" + preview_topCat + "] .preview-download-category").attr('href', category.linkdownload_cat);
            return false;
        }
        links.unshift(current_Cat);
        if (current_Cat.parent !== 0) {
            while (preview_cParents[current_Cat.parent]) {
                current_Cat = preview_cParents[current_Cat.parent];
                links.unshift(current_Cat);
            }
        }

        var html = '';
        for (var i = 0; i < links.length; i++) {
            if (i < links.length - 1) {
                html += '<li><a class="catlink" data-idcat="' + links[i].term_id + '" href="javascript:void(0)">';
                html += links[i].name + '</a><span class="divider"> &gt; </span></li>';
            } else {
                html += '<li><span>' + links[i].name + '</span></li>';
            }
        }
        $(".wpfd-content-preview[data-category=" + preview_topCat + "] .wpfd-breadcrumbs-preview li").remove();
        $(".wpfd-content-preview[data-category=" + preview_topCat + "] .wpfd-breadcrumbs-preview").append(html);

        $(".wpfd-content-preview[data-category=" + preview_topCat + "] .catlink").click(function (e) {
            e.preventDefault();
            load(preview_topCat, $(this).data('idcat'));
            initClickFile();
        });
        $(".wpfd-content-preview[data-category=" + preview_topCat + "] .preview-download-category").attr('href', category.linkdownload_cat);
    }

    if (preview_tree.length) {
        preview_tree.each(function () {
            var preview_topCat = $(this).parents('.wpfd-content-preview.wpfd-content-multi').data('category');
            $(this).jaofiletree({
                script: wpfdparams.wpfdajaxurl + 'task=categories.getCats',
                usecheckboxes: false,
                root: preview_topCat,
                showroot: preview_cParents[preview_topCat].name,
                onclick: function (elem, file) {
                    var preview_topCat = $(elem).parents('.wpfd-content-preview.wpfd-content-multi').data('category');
                    if (preview_topCat !== file) {
                        $('.directory', $(elem).parents('.wpfd-content-preview.wpfd-content-multi')).each(function() {
                            if (!$(this).hasClass('selected') && $(this).find('> ul > li').length === 0) {
                                $(this).removeClass('expanded');
                            }
                        });

                        $(elem).parents('.directory').each(function () {
                            var $this = $(this);
                            var category = $this.find(' > a');
                            var parent = $this.find('.icon-open-close');
                            if (parent.length > 0) {
                                if (typeof preview_cParents[category.data('file')] === 'undefined') {
                                    preview_cParents[category.data('file')] = {
                                        parent: parent.data('parent_id'),
                                        term_id: category.data('file'),
                                        name: category.text()
                                    };
                                }
                            }
                        });

                    }

                    load(preview_topCat, file);
                }
            });
        })
    }

    $('.wpfd-content-preview + .wpfd-pagination').each(function (index, elm) {
        var $this = $(elm);
        preview_init_pagination($this);
    });

    function preview_init_pagination($this) {

        var number = $this.find(':not(.current)');

        var wrap = $this.prev('.wpfd-content-preview');

        var sourcecat = wrap.data('category');
        var current_category = wrap.find('#current_category_' + sourcecat).val();

        number.unbind('click').bind('click', function () {
            var page_number = $(this).attr('data-page');
            var current_sourcecat = $(this).attr('data-sourcecat');
            var wrap = $(".wpfd-content-preview[data-category=" + current_sourcecat + "]");
            var current_category = $(".wpfd-content-preview[data-category=" + current_sourcecat + "]").find('#current_category_' + current_sourcecat).val();
            if (typeof page_number !== 'undefined') {
                var pathname = window.location.href.replace(window.location.hash, '');
                var category = $(".wpfd-content-preview[data-category=" + current_sourcecat + "]").find('#current_category_' + current_sourcecat).val();
                var category_slug = $(".wpfd-content-preview[data-category=" + current_sourcecat + "]").find('#current_category_slug_' + current_sourcecat).val();
                var ordering = $(".wpfd-content-preview[data-category=" + current_sourcecat + "]").find('#current_ordering_' + current_sourcecat).val();
                var orderingDirection = $(".wpfd-content-preview[data-category=" + current_sourcecat + "]").find('#current_ordering_direction_' + current_sourcecat).val();

                window.history.pushState('', document.title, pathname + '#' + current_sourcecat + '-' + category + '-' + category_slug + '-p' + page_number);

                $(".wpfd-content-preview[data-category=" + current_sourcecat + "] .wpfd-container-preview .wpfd_list").remove();
                $(".wpfd-content-preview[data-category=" + current_sourcecat + "] .wpfd-container-preview").append($('#wpfd-loading-wrap').html());

                var params = $.param({
                    task: 'files.display',
                    view: 'files',
                    id: current_category,
                    rootcat: current_sourcecat,
                    page: page_number,
                    orderCol: ordering,
                    orderDir: orderingDirection
                });

                //Get files
                $.ajax({
                    url: wpfdparams.wpfdajaxurl + params,
                    dataType: "json",
                    beforeSend: function () {
                        $('html, body').animate({scrollTop: $(".wpfd-content[data-category=" + current_sourcecat + "]").offset().top}, 'fast');
                    }
                }).done(function (content) {
                    delete content.category;
                    wrap.next('.wpfd-pagination').remove();
                    wrap.after(content.pagination);
                    delete content.pagination;
                    var sourcefiles = $(".wpfd-content-preview.wpfd-content-multi[data-category=" + current_sourcecat + "]  .wpfd-template-files").html();
                    var template = Handlebars.compile(sourcefiles);
                    var html = template(content);

                    if ($(".wpfd-content-preview[data-category=" + current_sourcecat + "] .wpfd-container-preview .wpfd-upload-form").length) {
                        $(".wpfd-content-preview[data-category=" + current_sourcecat + "] .wpfd-container-preview .wpfd-upload-form").before(html);
                    } else {
                        $(".wpfd-content-preview[data-category=" + current_sourcecat + "] .wpfd-container-preview").append(html);
                    }
                    initClickFile();
                    // View files
                    if (typeof (content.fileview) !== 'undefined' && content.fileview.length) {
                        content.fileview.forEach(function (viewFile) {
                            var preview_dropblock = $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview .wpfd-file-link[data-id='"+ viewFile.id +"'] .dropblock");
                            if (viewFile.view === true) {
                                preview_dropblock.css({'background-image': 'url('+ viewFile.link +')'});
                                preview_dropblock.addClass(viewFile.view_class);
                            } else {
                                preview_dropblock.addClass('wpfd-view-default');
                            }
                        });
                    }
                    preview_init_pagination(wrap.next('.wpfd-pagination'));
                    wpfd_remove_loading($(".wpfd-content-preview[data-category=" + current_sourcecat + "] .wpfd-container-preview"));
                });
            }
        });

    }

    function wpfd_preview_container_with_foldertree() {
        $('.wpfd-content-preview .wpfd-container').each(function () {
            if($(this).children('.with_foldertree').length > 0) {
                $(this).addClass('wpfd_previewcontainer_foldertree');
            } else {
                if($(this).hasClass('wpfd_previewcontainer_foldertree')) {
                    $(this).removeClass('wpfd_previewcontainer_foldertree');
                }
            }
        });

        //parent-content
        $('.wpfd-content-preview').each(function () {
            if($(this).children().has('.wpfd-foldertree').length > 0) {
                $(this).addClass('wpfdcontent_preview_folder_tree');
            } else {
                if($(this).hasClass('wpfdcontent_preview_folder_tree')) {
                    $(this).removeClass('wpfdcontent_preview_folder_tree');
                }
            }
        });
    }

    wpfd_preview_container_with_foldertree();

    function wpfd_preview_subcategory_class() {
        var preview_subcategory = $('.wpfd-content-preview a.wpfdcategory');
        if (preview_subcategory.length) {
            preview_subcategory.addClass('preview_category');
        }
    }
    wpfd_preview_subcategory_class();

    function wpfd_preview_subcategories_hover_color(root_category, color) {
        if (typeof (color) === 'undefined' || color === '') {
            color = '#3e3294';
        }
        var style_el = 'wpfd-view-custom-colors-' + root_category;
        var custom_color = $('<style class="'+ style_el +'">.wpfd-content.wpfd-content-preview[data-category="' + root_category + '"] .preview_category .wpfd-folder:before{color: ' + color + ' !important; }</style>');

        if (! $('.' + style_el).length) {
            $('head').append(custom_color);
        }

        $('.wpfd-content.wpfd-content-preview[data-category="' + root_category + '"] .preview_category').on('mouseover', function () {
            $(this).css({'background-color': color});
        }).on('mouseout', function () {
            $(this).css({'background-color': '#fff'});
        });
    }

    if ($('.wpfd_subcategories_hover_color').length) {
        $('.wpfd_subcategories_hover_color').each(function () {
            var color = $(this).val();
            var root_category = $(this).parents('.wpfd-content').data('category');
            wpfd_preview_subcategories_hover_color(root_category, color);
            preview_subcategories_hover_color_list[root_category] = color;
        });
    }

    function wpfd_view_fire_empty_category_message(category_id) {
        if (!category_id) {
            return;
        }
        var root_category = '.wpfd-content-preview.wpfd-content-multi[data-category=' + category_id + ']';
        var display_empty_category_message = $(root_category).find('#wpfd_display_empty_category_message').val();
        var empty_category_message_val = $(root_category).find('#wpfd_empty_category_message_val').val();
        var is_empty_subcategories = $(root_category).find('#wpfd_is_empty_subcategories').val();
        var is_empty_files = $(root_category).find('#wpfd_is_empty_files').val();

        if (parseInt(display_empty_category_message) !== 1
            || parseInt(is_empty_subcategories) !== 0 || parseInt(is_empty_files) !== 0 ) {
            return;
        }

        var code = '<div class="wpfd-empty-category-message-section">';
        code += '<p class="wpfd-empty-category-message">';
        code += empty_category_message_val;
        code += '</p>';
        code += '</div>';

        $(root_category).find('.wpfd-empty-category-message-section').remove();
        $(root_category).find('.wpfd-container-preview').append(code);
    }

    var destroy_upload = $('.wpfd-upload-form.destroy');
    if (destroy_upload.length) {
        destroy_upload.remove();
    }

    function wpfdPreviewCategoriesLocalCacheTrigger(triggerPreviewCategories, sourcecat, page, pathname, catid, container, view_empty_subcategories) {
        if (page !== null && page !== undefined) {
            window.history.pushState('', document.title, pathname + '#' + sourcecat + '-' + catid + '-' + triggerPreviewCategories.category.slug + '-p' + page);
        } else {
            window.history.pushState('', document.title, pathname + '#' + sourcecat + '-' + catid + '-' + triggerPreviewCategories.category.slug);
        }

        container.find('#current_category_slug_' + sourcecat).val(triggerPreviewCategories.category.slug);
        var sourcecategories = $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-template-categories").html();
        if (sourcecategories) {
            var template = Handlebars.compile(sourcecategories);
            var html = template(triggerPreviewCategories);
            $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview").prepend(html);
        }
        if (triggerPreviewCategories.category.breadcrumbs !== undefined) {
            $(".wpfd-content-preview[data-category=" + sourcecat + "] .breadcrumbs").html(triggerPreviewCategories.category.breadcrumbs);
        }
        for (var i = 0; i < triggerPreviewCategories.categories.length; i++) {
            preview_cParents[triggerPreviewCategories.categories[i].term_id] = triggerPreviewCategories.categories[i];
        }

        preview_breadcrum(sourcecat, catid, triggerPreviewCategories.category);
        preview_initClick();
        if (preview_tree.length) {
            var currentTree = container.find('.wpfd-foldertree-preview');
            currentTree.find('li').removeClass('selected');
            currentTree.find('i.md').removeClass('md-folder-open').addClass("md-folder");

            currentTree.jaofiletree('open', catid, currentTree);

            var el = currentTree.find('a[data-file="' + catid + '"]').parent();
            el.find(' > i.md').removeClass("md-folder").addClass("md-folder-open");

            if (!el.hasClass('selected')) {
                el.addClass('selected');
            }
            var ps = currentTree.find('.icon-open-close');

            $.each(ps.get().reverse(), function (i, p) {
                if (typeof $(p).data() !== 'undefined' && $(p).data('id') == Number(hash_category_id)) {
                    hash_category_id = $(p).data('parent_id');
                    $(p).click();
                }
            });

        }
        wpfd_preview_subcategory_class();

        if (typeof(preview_subcategories_hover_color_list) !== 'undefined') {
            var root_key_exists = sourcecat in preview_subcategories_hover_color_list;
            if (root_key_exists) {
                var color = preview_subcategories_hover_color_list[sourcecat];
                wpfd_preview_subcategories_hover_color(sourcecat, color);
            }
        }

        if (view_empty_subcategories.length) {
            view_empty_subcategories.val(triggerPreviewCategories.categories.length);
            wpfd_view_fire_empty_category_message(sourcecat);
        }
    }

    function wpfdPreviewFilesLocalCacheTrigger(previewTriggerFiles, sourcecat, view_empty_files) {
        if (previewTriggerFiles.files.length) {
            $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "]  .preview-download-category").removeClass("display-download-category");
        } else {
            $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "]  .preview-download-category").addClass("display-download-category");
        }

        $(".wpfd-content-preview[data-category=" + sourcecat + "]").after(previewTriggerFiles.pagination);
        delete previewTriggerFiles.pagination;
        var sourcefiles = $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "]  .wpfd-template-files").html();
        var template = Handlebars.compile(sourcefiles);
        var html = template(previewTriggerFiles);
        html = $('<textarea/>').html(html).val();
        $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview").append(html);

        if (typeof (previewTriggerFiles.filepasswords) !== 'undefined') {
            $.each(previewTriggerFiles.filepasswords, function( file_id, pw_form ) {
                var protected_file = $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview").find('.wpfd-file-link[data-id="' + file_id + '"]').parent();
                protected_file.empty();
                protected_file.addClass('wpfd-password-protection-form');
                protected_file.append(pw_form);
            });
        }

        if (previewTriggerFiles.uploadform !== undefined && previewTriggerFiles.uploadform.length) {
            var upload_form_html = '<div class="wpfd-upload-form" style="margin: 20px 10px">';
            upload_form_html += previewTriggerFiles.uploadform;
            upload_form_html += '</div>';
            $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview").append(upload_form_html);

            if (typeof (Wpfd) === 'undefined') {
                Wpfd = {};
            }

            _wpfd_text = function (text) {
                if (typeof (l10n) !== 'undefined') {
                    return l10n[text];
                }
                return text;
            };

            function toMB(mb) {
                return mb * 1024 * 1024;
            }

            var allowedExt = wpfdparams.allowed;
            allowedExt = allowedExt.split(',');
            allowedExt.sort();

            var initUploader = function (currentContainer) {
                // Init the uploader
                var uploader = new Resumable({
                    target: wpfdparams.wpfduploadajax + '?action=wpfd&task=files.upload&upload_from=front',
                    query: {
                        id_category: $(currentContainer).find('input[name=id_category]').val(),
                    },
                    fileParameterName: 'file_upload',
                    simultaneousUploads: 2,
                    maxFileSize: toMB(wpfdparams.maxFileSize),
                    maxFileSizeErrorCallback: function (file) {
                        bootbox.alert(file.name + ' ' + _wpfd_text('is too large') + '!');
                    },
                    chunkSize: wpfdparams.serverUploadLimit - 50 * 1024, // Reduce 50KB to avoid error
                    forceChunkSize: true,
                    fileType: allowedExt,
                    fileTypeErrorCallback: function (file) {
                        bootbox.alert(file.name + ' cannot upload!<br/><br/>' + _wpfd_text('This type of file is not allowed to be uploaded. You can add new file types in the plugin configuration'));
                    },
                    generateUniqueIdentifier: function (file, event) {
                        var relativePath = file.webkitRelativePath || file.fileName || file.name;
                        var size = file.size;
                        var prefix = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                        return (prefix + size + '-' + relativePath.replace(/[^0-9a-zA-Z_-]/img, ''));
                    }
                });

                if (!uploader.support) {
                    bootbox.alert(_wpfd_text('Your browser does not support HTML5 file uploads!'));
                }

                if (typeof (willUpload) === 'undefined') {
                    var willUpload = true;
                }

                uploader.on('filesAdded', function (files) {
                    files.forEach(function (file) {
                        var progressBlock = '<div class="wpfd_process_block" id="' + file.uniqueIdentifier + '">'
                            + '<div class="wpfd_process_fileinfo">'
                            + '<span class="wpfd_process_filename">' + file.fileName + '</span>'
                            + '<span class="wpfd_process_cancel">Cancel</span>'
                            + '</div>'
                            + '<div class="wpfd_process_full" style="display: block;">'
                            + '<div class="wpfd_process_run" data-w="0" style="width: 0%;"></div>'
                            + '</div></div>';

                        //$('#preview', '.wpreview').before(progressBlock);
                        currentContainer.find('#preview', '.wpreview').before(progressBlock);
                        $(currentContainer).find('.wpfd_process_cancel').unbind('click').click(function () {
                            fileID = $(this).parents('.wpfd_process_block').attr('id');
                            fileObj = uploader.getFromUniqueIdentifier(fileID);
                            uploader.removeFile(fileObj);
                            $(this).parents('.wpfd_process_block').fadeOut('normal', function () {
                                $(this).remove();
                            });

                            if (uploader.files.length === 0) {
                                $(currentContainer).find('.wpfd_process_pause').fadeOut('normal', function () {
                                    $(this).remove();
                                });
                            }

                            $.ajax({
                                url: wpfdparams.wpfduploadajax + '?action=wpfd&task=files.upload',
                                method: 'POST',
                                dataType: 'json',
                                data: {
                                    id_category: $('input[name=id_category]').val(),
                                    deleteChunks: fileID
                                },
                                success: function (res, stt) {
                                    if (res.response === true) {
                                    }
                                }
                            })
                        });
                    });

                    // Do not run uploader if no files added or upload same files again
                    if (files.length > 0) {
                        uploadPauseBtn = $(currentContainer).find('.wpreview').find('.wpfd_process_pause').length;
                        restableBlock = $(currentContainer).find('.wpfd_process_block');

                        if (!uploadPauseBtn) {
                            restableBlock.before('<div class="wpfd_process_pause">Pause</div>');
                            $(currentContainer).find('.wpfd_process_pause').unbind('click').click(function () {
                                if (uploader.isUploading()) {
                                    uploader.pause();
                                    $(this).text('Start');
                                    $(this).addClass('paused');
                                    willUpload = false;
                                } else {
                                    uploader.upload();
                                    $(this).text('Pause');
                                    $(this).removeClass('paused');
                                    willUpload = true;
                                }
                            });
                        }

                        uploader.opts.query = {
                            id_category: currentContainer.find('input[name=id_category]').val()
                        };

                        if (willUpload) uploader.upload();
                    }
                });

                uploader.on('fileProgress', function (file) {
                    $(currentContainer).find('.wpfd_process_block#' + file.uniqueIdentifier)
                        .find('.wpfd_process_run').width(Math.floor(file.progress() * 100) + '%');
                });

                uploader.on('fileSuccess', function (file, res) {
                    var thisUploadBlock = currentContainer.find('.wpfd_process_block#' + file.uniqueIdentifier);
                    thisUploadBlock.find('.wpfd_process_cancel').addClass('uploadDone').text('OK').unbind('click');
                    thisUploadBlock.find('.wpfd_process_full').remove();

                    var response = JSON.parse(res);
                    if (response.response === false && typeof(response.datas) !== 'undefined') {
                        if (typeof(response.datas.code) !== 'undefined' && response.datas.code > 20) {
                            bootbox.alert('<div>' + response.datas.message + '</div>');
                            return false;
                        }
                    }
                    if (typeof(response) === 'string') {
                        bootbox.alert('<div>' + response + '</div>');
                        return false;
                    }

                    if (response.response !== true) {
                        bootbox.alert(response.response);
                        return false;
                    }
                });

                uploader.on('fileError', function (file, msg) {
                    thisUploadBlock = currentContainer.find('.wpfd_process_block#' + file.uniqueIdentifier);
                    thisUploadBlock.find('.wpfd_process_cancel').addClass('uploadError').text('Error').unbind('click');
                    thisUploadBlock.find('.wpfd_process_full').remove();
                });

                uploader.on('complete', function () {
                    var fileCount  = $(currentContainer).find('.wpfd_process_cancel').length;
                    var categoryId = $(currentContainer).find('input[name=id_category]').val();

                    $.ajax({
                        url: wpfdparams.wpfduploadajax + '?action=wpfd&task=files.wpfdPendingUploadFiles',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            uploadedFiles: fileCount,
                            id_category: categoryId,
                        },
                        success: function (res) {
                            currentContainer.find('.progress').delay(300).fadeIn(300).hide(300, function () {
                                $(this).remove();
                            });
                            currentContainer.find('.uploaded').delay(300).fadeIn(300).hide(300, function () {
                                $(this).remove();
                            });
                            $('#wpreview .file').delay(1200).show(1200, function () {
                                $(this).removeClass('done placeholder');
                            });

                            $('.gritter-item-wrapper ').remove();
                            $(currentContainer).find('#wpfd-upload-messages').append('File(s) uploaded with success!');
                            $(currentContainer).find('#wpfd-upload-messages').delay(1200).fadeIn(1200, function () {
                                $(currentContainer).find('#wpfd-upload-messages').empty();
                                $(currentContainer).find('.wpfd_process_pause').remove();
                                $(currentContainer).find('.wpfd_process_block').remove();
                            });

                            // Call list files
                            if (currentContainer.parent('.wpfd-upload-form').length) {
                                var preview_sourcecat = currentContainer.parents('.wpfd-content.wpfd-content-multi').data('category');
                                var current_category  = currentContainer.parents('.wpfd-content.wpfd-content-multi').find('#current_category_' + preview_sourcecat).val();
                                load(preview_sourcecat, current_category);
                            }
                        }
                    });
                });

                uploader.assignBrowse($(currentContainer).find('#upload_button'));
                uploader.assignDrop($(currentContainer).find('.jsWpfdFrontUpload'));
            }

            var containers = $(".wpfd-content-preview[data-category=" + sourcecat + "] div[class*=wpfdUploadForm]");
            if (containers.length > 0) {
                containers.each(function(i, el) {
                    initUploader($(el));
                });
            }
        }

        // View files
        if (typeof (previewTriggerFiles.fileview) !== 'undefined' && previewTriggerFiles.fileview.length) {
            previewTriggerFiles.fileview.forEach(function (viewFile) {
                var preview_dropblock = $(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview .wpfd-file-link[data-id='"+ viewFile.id +"'] .dropblock");
                if (viewFile.view === true) {
                    preview_dropblock.css({'background-image': 'url('+ viewFile.link +')'});
                    preview_dropblock.addClass(viewFile.view_class);
                } else {
                    preview_dropblock.addClass('wpfd-view-default');
                }
            });
        }

        initClickFile();

        preview_init_pagination($('.wpfd-content-preview[data-category=' + sourcecat + '] + .wpfd-pagination'));

        wpfd_remove_loading($(".wpfd-content-preview[data-category=" + sourcecat + "] .wpfd-container-preview"));
        $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "] .wpfdSelectedFiles").remove();
        $(".wpfd-content-preview.wpfd-content-multi[data-category=" + sourcecat + "] .preview-download-selected").remove();
        hideDownloadAllBtn(sourcecat, false);

        if (view_empty_files.length) {
            view_empty_files.val(previewTriggerFiles.files.length);
            wpfd_view_fire_empty_category_message(sourcecat);
        }
    }
});

// Preview categories local cache
var wpfdPreviewCategoriesLocalCache = {
    data: {},
    remove: function (url) {
        delete wpfdPreviewCategoriesLocalCache.data[url];
    },
    exist: function (url) {
        return wpfdPreviewCategoriesLocalCache.data.hasOwnProperty(url) && wpfdPreviewCategoriesLocalCache.data[url] !== null;
    },
    get: function (url) {
        return wpfdPreviewCategoriesLocalCache.data[url];
    },
    set: function (url, cachedData) {
        wpfdPreviewCategoriesLocalCache.remove(url);
        wpfdPreviewCategoriesLocalCache.data[url] = cachedData;
    }
};

// Preview files local cache
var wpfdPreviewFilesLocalCache = {
    data: {},
    remove: function (url) {
        delete wpfdPreviewFilesLocalCache.data[url];
    },
    exist: function (url) {
        return wpfdPreviewFilesLocalCache.data.hasOwnProperty(url) && wpfdPreviewFilesLocalCache.data[url] !== null;
    },
    get: function (url) {
        return wpfdPreviewFilesLocalCache.data[url];
    },
    set: function(url, cachedData) {
        wpfdPreviewFilesLocalCache.remove(url);
        wpfdPreviewFilesLocalCache.data[url] = cachedData;
    }
};