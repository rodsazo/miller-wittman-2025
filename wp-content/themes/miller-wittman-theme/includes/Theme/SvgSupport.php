<?php

namespace Theme;

class SvgSupport{
    static function start() : void
    {
        self::addMimeTypesFilter();
        self::printAdminStyles();
        self::printAdminScripts();
    }

    protected static function addMimeTypesFilter() : void
    {
        add_filter( 'upload_mimes', function($mimes) {
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        } );
    }

    protected static function printAdminStyles() : void
    {
        add_action('admin_head', function(){
            ?>

            <style type="text/css" id="svg-support-styles">
                .attachment-266x266, .thumbnail img {
                    width: 100% !important;
                    height: auto !important;
                }
            </style>

            <?php
        });
    }

    protected static function printAdminScripts() : void
    {
        add_action('admin_footer', function(){
            ?>

            <script type="text/javascript" id="svg-support-script">
                (function($){

                    var mediaGridObserver = new MutationObserver(function (mutations) {

                        for (var i = 0; i < mutations.length; i++)
                        {

                            for (var j = 0; j < mutations[i].addedNodes.length; j++)
                            {
                                element = $(mutations[i].addedNodes[j]);

                                if (element.attr('class'))
                                {
                                    elementClass = element.attr('class');
                                    if (element.attr('class').indexOf('attachment') != -1)
                                    {

                                        attachmentPreview = element.children('.attachment-preview');
                                        if (attachmentPreview.length != 0)
                                        {
                                            if (attachmentPreview.attr('class').indexOf('subtype-svg+xml') != -1)
                                            {
                                                var handler = function (element) {

                                                    jQuery.ajax({

                                                        url: script_vars.AJAXurl,
                                                        type: "POST",
                                                        dataType: 'html',
                                                        data: {
                                                            'action': 'svg_get_attachment_url',
                                                            'attachmentID': element.attr('data-id')
                                                        },
                                                        success: function (data) {
                                                            if (data)
                                                            {
                                                                element.find('img').attr('src', data);
                                                                element.find('.filename').text('SVG Image');
                                                            }
                                                        }
                                                    });

                                                }(element);

                                            }
                                        }
                                    }
                                }
                            }
                        }
                    });

                    var attachmentPreviewObserver = new MutationObserver(function (mutations) {
                        for (var i = 0; i < mutations.length; i++)
                        {
                            for (var j = 0; j < mutations[i].addedNodes.length; j++)
                            {
                                var element = $(mutations[i].addedNodes[j]);
                                var onAttachmentPage = false;
                                if ((element.hasClass('attachment-details')) || element.find('.attachment-details').length != 0)
                                {
                                    onAttachmentPage = true;
                                }

                                if (onAttachmentPage == true)
                                {
                                    var urlLabel = element.find('label[data-setting="url"]');
                                    if (urlLabel.length != 0)
                                    {
                                        var value = urlLabel.find('input').val();
                                        element.find('.details-image').attr('src', value);
                                    }
                                }
                            }
                        }
                    });

                    jQuery(document).ready(function ($) {

                        mediaGridObserver.observe(document.body, {
                            childList: true,
                            subtree: true
                        });

                        attachmentPreviewObserver.observe(document.body, {
                            childList: true,
                            subtree: true
                        });


                    });

                })( jQuery );

            </script>
            <?php
        }, 99);
    }
}
