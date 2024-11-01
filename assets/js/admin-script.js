jQuery(document).ready(function () {

    jQuery(".nav-tab").on("click", function (e) {
        // e.preventDefault();
        jQuery(".nav-tab").removeClass("nav-tab-active");
        jQuery(this).addClass("nav-tab-active");

        //Hide all sections of settings
        jQuery(".tgdprc_struct_settings_wrap").hide();
        jQuery(".tgdprc_design_settings_wrap").hide();
        jQuery(".tgdprc_extra_settings_wrap").hide();
        jQuery(".tgdprc_floating_advanced_cookie_wrap").hide();

        jQuery(".nav-tab").each(function () {
            if (jQuery(this).hasClass('nav-tab-active')) {
                if (jQuery(this).attr('id') == 'tgdprc_content_nav_tab') {
                    jQuery(".tgdprc_struct_settings_wrap").show();
                }
                if (jQuery(this).attr('id') == 'tgdprc_design_nav_tab') {
                    jQuery(".tgdprc_design_settings_wrap").show();
                }
                if (jQuery(this).attr('id') == 'tgdprc_extra_nav_tab') {
                    jQuery(".tgdprc_extra_settings_wrap").show();
                }
                if (jQuery(this).attr('id') == 'tgdprc_policies_nav_tab') {
                    jQuery(".tgdprc_policies_nav_settings").show();
                }
                if (jQuery(this).attr('id') == 'tgdprc_floating_advanced_cookie_nav_tab') {
                    jQuery(".tgdprc_floating_advanced_cookie_wrap").show();
                }
            }
        });
    });

    jQuery("#delete-cookies-policy-from-browser").on("click", function (e) {
        jQuery(this).parent().append('<span class="policy-cookies-cleared-message" style="margin-left: 20%;">Cookies Cleared.</span>').fadeIn(1500);
        jQuery(this).parent().find('span.policy-cookies-cleared-message').fadeOut(2000);
        var d = -1;
        var expires = "expires=" + d.toGMTString();
        document.cookie = "tgdprc_policie_cookie" + "=" + "tgdprc_policie_cookie" + "; " + expires;
    });



// Adding select option
    jQuery('select').niceSelect();

    (function ($) {

        $(function () {
            // Add Color Picker to all inputs that have 'color-field' class
            $('.color-field').wpColorPicker();
        });
    })(jQuery);


// Validation starts here

    var error1 = false;
    var error2 = false;

    jQuery(".tgdprc_title_field input[type='text']").on("change keyup", function () {
        if (jQuery(this).val().length != 0) {
            jQuery(this).parent().children("span").remove();
            error1 = false;
        }
    });

    jQuery(".tgdprc_struct_settings_field textarea#wpcui_wp_editor_in_settings").on("change keyup", function () {
        if (jQuery(this).val().length != 0) {
            jQuery(this).parent().children("span").remove();
            error2 = false;
        }
    });

    jQuery("#manageForm").on("submit", function (event) {
        if (jQuery(".tgdprc_title_field input[type='text']")[0] && jQuery(".tgdprc_struct_settings_field textarea#wpcui_wp_editor_in_settings")[0]) {
            var text_val = jQuery(".tgdprc_title_field input[type='text']").val().trim();
            var textarea_val = jQuery(".tgdprc_struct_settings_field textarea#wpcui_wp_editor_in_settings").val().trim();

            if (text_val.length == 0) {
                jQuery(".tgdprc_title_field input[type='text']").parent().children("span").remove();
                jQuery(".tgdprc_title_field input[type='text']").parent().append("<span style='color:red;'>This field should not be left empty</span>");
                error1 = true;
            }
            if (textarea_val.length == 0) {
                jQuery(".tgdprc_struct_settings_field textarea#wpcui_wp_editor_in_settings").parent().children("span").remove();
                jQuery(".tgdprc_struct_settings_field textarea#wpcui_wp_editor_in_settings").parent().append("<span style='color:red;'>This field should not be left empty</span>");
                error2 = true;
            }

            if (error1 || error2) {
                event.preventDefault();
            } else {
                return;
            }
        }
    });

    var error3 = false;

    jQuery(".wpcui_custom_template_name").on("change keyup", function () {
        if (jQuery(this).val().length != 0) {
            jQuery(this).parent().children("span").remove();
            error3 = false;
        }
    });

    jQuery(".tgdprc_custom_template_form").on("submit", function (event) {
        var custom_name = jQuery(".wpcui_custom_template_name").val().trim();
        if (custom_name.length == 0) {
            jQuery(".wpcui_custom_template_name").parent().children("span").remove();
            jQuery(".wpcui_custom_template_name").parent().append("<span style='color:red;'>This field should not be left empty</span>");
            error3 = true;
        }
        if (error3) {
            event.preventDefault();
        } else {
            return;
        }
    });
// Validation ends here








//Show and hide on checked and unchecked
    jQuery(".tgdprc-bulb-switch").on("change", function () {

        if (jQuery(this).attr('checked') == 'checked') {
            // alert('checked');
            jQuery(this).parent().parent().children(".tgdprc-bulb-light").show();
            jQuery(this).parent().parent().parent().children(".tgdprc-bulb-light").show();
        } else {
            // alert('unchecked');
            jQuery(this).parent().parent().children(".tgdprc-bulb-light").hide();
            jQuery(this).parent().parent().parent().children(".tgdprc-bulb-light").hide();
        }
    });
    jQuery(".tgdprc-bulb-switch").trigger("change");





//Show or hide on specific value in select option
    jQuery(".wpcui-show-after-selector").on("change", function () {
        if (jQuery(".wpcui-show-after-selector option:selected").val() == 'show After') {
            jQuery(this).parent().parent().children(".wpcui-show-after-options").show();
        } else {
            jQuery(this).parent().parent().children(".wpcui-show-after-options").hide();
        }
    });
    jQuery(".wpcui-show-after-selector").trigger("change");





// Image preview of built in templates
    jQuery(".wpcui-template-bar-image-selector").on("change", function () {
        // var filename = jQuery(this).val().toLowerCase().replace(/\s/g,'');
        var img_link = jQuery(this).find('option:selected').data('img');
        jQuery("img.wpcui-template-bar-image-container").attr('src', img_link);
    });
    jQuery(".wpcui-template-bar-image-selector").trigger("change");





// Default and custom template option in layout options
    jQuery("#wpcui_select_template_type").on("change", function () {
        var template_select = jQuery(this).val();
        if (template_select == 'default') {
            jQuery('.wpcui_select_custom_template_section').hide();
        } else if (template_select == 'custom') {
            jQuery('.wpcui_select_custom_template_section').show();
        }
    });
    jQuery("#wpcui_select_template_type").trigger("change");





    /*Start of Content Area Live preview*/

// color picker live preview for text color
    var myOptions = {
        palettes: true,
        change: function (event, ui) {
            jQuery('.tgdprc_custom_template_preview_selector').parent().siblings('#tgdprc_custom_template_preview_wrap').children('#wpcui_custom_template_font').css('color', ui.color.toString());
        },
    };

    var myOptions1 = {
        palettes: true,
        change: function (event, ui) {
            jQuery('.tgdprc_custom_template_preview_selector').parent().siblings('#tgdprc_custom_template_preview_wrap').css('background', ui.color.toString());
        },
    };

// Backend custom template preview
    jQuery(".tgdprc_custom_template_preview_selector").on("change", function () {
        var wpcui_font_color = jQuery("#wpcui_preview_font_color").val();
        var font_value = jQuery('#tgdprc_preview_font_family option:selected').val();
        var wpcui_bg_color = jQuery("#tgdprc_preview_bg_color").val();

        jQuery('.tgdprc_custom_template_preview_selector').parent().siblings('#tgdprc_custom_template_preview_wrap').children('#wpcui_custom_template_font').css({
            'color': wpcui_font_color,
            'font-family': font_value
        });

        jQuery('.tgdprc_custom_template_preview_selector').parent().siblings('#tgdprc_custom_template_preview_wrap').css({
            'background': wpcui_bg_color
        });


        if (font_value != "default" && font_value != '') {
            WebFont.load({
                google: {
                    families: [font_value]
                }
            });
        }



    });
    jQuery(".tgdprc_custom_template_preview_selector").trigger("change");

// Implementing Font Color
    jQuery('#wpcui_preview_font_color').wpColorPicker(myOptions);
    jQuery("#tgdprc_preview_bg_color").wpColorPicker(myOptions1);

    /*End of Content Area Live preview*/




    /* Start of More Info Content Area Live Preview*/

    var myOptions = {
        palettes: true,
        change: function (event, ui) {
            jQuery('.tgdprc_more_info_content_preview_selector').parent().siblings('#tgdprc_custom_template_preview_wrap').children('#wpcui_custom_template_font').css('color', ui.color.toString());
        },
    };

    var myOptions1 = {
        palettes: true,
        change: function (event, ui) {
            jQuery('.tgdprc_more_info_content_preview_selector').parent().siblings('#tgdprc_custom_template_preview_wrap').css('background', ui.color.toString());
        },
    };

    jQuery('.tgdprc_more_info_content_preview_selector').on('change', function () {
        var wpcui_font_color = jQuery("#wpcui_preview_more_info_font_color").val();
        var font_value = jQuery('#tgdprc_preview_more_info_font_family option:selected').val();
        var wpcui_bg_color = jQuery("#wpcui_preview_more_info_bg_color").val();

        jQuery('.tgdprc_more_info_content_preview_selector').parent().siblings("#tgdprc_custom_template_preview_wrap").children('#wpcui_custom_template_font').css({
            'color': wpcui_font_color,
            'font-family': font_value
        });

        jQuery('.tgdprc_more_info_content_preview_selector').parent().siblings("#tgdprc_custom_template_preview_wrap").css({
            'background': wpcui_bg_color
        });


        if (font_value != "default" && font_value != '') {
            WebFont.load({
                google: {
                    families: [font_value]
                }
            });
        }
    });

    // Implementing Font Color
    jQuery('#wpcui_preview_more_info_font_color').wpColorPicker(myOptions);
    jQuery("#wpcui_preview_more_info_bg_color").wpColorPicker(myOptions1);

    /* End of More Info Content Area Live Preview*/

    /**
     * Color tabs in the Custom Template
     */
    jQuery(".tgdprc_color_tab_selector").on("click", function () {
        jQuery(".tgdprc_color_tab_selector").removeClass("tgdprc_bar_colors");
        jQuery(this).addClass("tgdprc_bar_colors");

        var selectedTab = jQuery(this).attr('id');
        // alert("#" + selectedTab + "_tab");
        jQuery(".tgdprc_color_customizations").hide();
        jQuery("#" + selectedTab + "_tab").show();
    });

    /**
     * Consent tab  
     */
    jQuery(".tgdprc-consent-tabs").on("click", function () {
        jQuery(".tgdprc-consent-tabs").removeClass("tgdprc_bar_colors");
        jQuery(this).addClass("tgdprc_bar_colors");

        var selectedTab = jQuery(this).attr('id');
        // alert("#" + selectedTab + "_tab");
        jQuery(".tgdprc-consent-tabs-content").hide();
        jQuery("#tgdprc-consent-tabs-content-" + selectedTab).show();
        jQuery("#tdprc_current_active_tab").val(selectedTab);

    });

    /**
     * Terms and Conditions tab  
     */
    jQuery(".tgdprc-nav-tab-terms-condition-policies").on("click", function () {
        jQuery(".tgdprc-nav-tab-terms-condition-policies").removeClass("tgdprc_bar_colors");
        jQuery(this).addClass("tgdprc_bar_colors");

        var selectedTab = jQuery(this).attr('id');
        // alert("#" + selectedTab + "_tab");
        jQuery(".tgdprc-terms-policies-tabs-content").hide();
        jQuery("#tgdprc-terms-policies-tabs-content-" + selectedTab).show();
    });

    /**
     * User Data Tab
     */
    jQuery(".tgdprc-nav-tab-user-data").on("click", function () {
        jQuery(".tgdprc-nav-tab-user-data").removeClass("tgdprc_bar_colors");
        jQuery(this).addClass("tgdprc_bar_colors");

        var selectedTab = jQuery(this).attr('id');
        // alert("#" + selectedTab + "_tab");
        jQuery(".tgdprc-user-data-tabs-content").hide();
        jQuery("#tgdprc-userdata-tabs-content-" + selectedTab).show();
    });

    jQuery('#wpcui_bar_positional').on('change', function () {
        var selection = jQuery(this).val();
        position = selection.split(' ')[0];
        jQuery('.wpcui_more_info_position .tgdprc_design_settings_field').hide();
        jQuery('.wpcui_more_info_position .wpcui_' + position + '_style').show();
        jQuery('.wpcui_more_info_position .tgdprc_design_settings_field select').prop('disabled', true);
        jQuery('.wpcui_more_info_position .wpcui_' + position + '_style select').prop('disabled', false);

    });
    jQuery('#wpcui_bar_positional').trigger('change');


// Switch between slideout and redirect action for more info in the cookie bar display
    jQuery("#wpcui_more_info_action_selector").on("change", function () {
        var selector_value = jQuery('#wpcui_more_info_action_selector').val().replace(/ /g, '_');
        jQuery(".tgdprc_more_info_action_options").hide();
        jQuery("#wpcui_more_info_" + selector_value).show();

        var type = jQuery('#tgdprc_display_type_selector option:selected').val();

        if ((selector_value == 'slideout_content') && ((type == 'bar') || (type == 'floating'))) {
            jQuery('.wpcui_more_info_position').show();
        } else {
            jQuery('.wpcui_more_info_position').hide();
        }
    });
    jQuery("#wpcui_more_info_action_selector").trigger("change");

// Switch between bar and popup
    jQuery("#tgdprc_display_type_selector").on("change", function () {
        var selector_value = jQuery("#tgdprc_display_type_selector option:selected").val();
        jQuery(".tgdprc_display_type").hide();
        jQuery("#wpcui_" + selector_value + "_display_type").show();
        jQuery('.wpcui_position_field').hide();
        jQuery('.wpcui_' + selector_value + '_position_field').show();
        if ((selector_value == 'bar') || (selector_value == 'floating')) {
            var action = jQuery('#wpcui_more_info_action_selector option:selected').val();
            if (action == 'slideout content') {
                jQuery('.wpcui_more_info_position').show();
            } else {
                jQuery('.wpcui_more_info_position').hide();
            }
        } else {
            jQuery('.wpcui_more_info_position').hide();
        }
    });
    jQuery("#tgdprc_display_type_selector").trigger("change");

// Bar Image changer jquery
    jQuery(".wpcui-template-bar-image-selector").on("change", function () {
        // var filename = jQuery(this).val().toLowerCase().replace(/\s/g,'');
        var img_link = jQuery(this).find('option:selected').data('img');
        jQuery("img.wpcui-template-bar-image-container").attr('src', img_link);
    });

// Popup Image changer jquery
    jQuery(".wpcui-template-popup-image-selector").on("change", function () {
        // var filename = jQuery(this).val().toLowerCase().replace(/\s/g,'');
        var img_link = jQuery(this).find('option:selected').data('img');
        jQuery("img.wpcui-template-popup-image-container").attr('src', img_link);
    });

// Floating Image changer jquery
    jQuery(".wpcui-template-floating-image-selector").on("change", function () {
        // var filename = jQuery(this).val().toLowerCase().replace(/\s/g,'');
        var img_link = jQuery(this).find('option:selected').data('img');
        jQuery("img.wpcui-template-floating-image-container").attr('src', img_link);
    });

// Switch between on load and on scroll before cookie bar display
    if (jQuery("wpcui_load_on")[0]) {
        jQuery("#wpcui_load_on").on("change", function () {
            var selector_value = jQuery(this).val().replace(/ /g, '_');
            jQuery(".wpcui_load_on_options").hide();
            jQuery("#wpcui_load_on_" + selector_value).show();

            if (selector_value == 'page_scroll' && jQuery('.wpcui_scroll_selector option:selected').val() == 'by percentage') {
                jQuery('#wpcui_scroll_percentage').show();
            } else {
                d
                jQuery('#wpcui_scroll_percentage').hide();
            }
        });
        jQuery("#wpcui_load_on").trigger("change");
    }


    jQuery('.wpcui_scroll_selector').on("change", function () {
        if (jQuery('.wpcui_scroll_selector option:selected').val() == 'by percentage') {
            jQuery('#wpcui_scroll_percentage').show();
        } else {
            jQuery('#wpcui_scroll_percentage').hide();
        }
    });
    jQuery('.wpcui_scroll_selector').trigger('change');


//Show or hide on specific page in select option in the choose a setting page
    jQuery(".tgdprc-show-specific-page-selector").on("change", function () {
        if (jQuery('.tgdprc-show-specific-page-selector option:selected').val() == 'specific page') {
            jQuery(this).parent().parent().find('.wpcui-show-specific-options').show();
            jQuery('.tgdprc_post_type_data').show();
            jQuery('.tgdprc_post_type_requester').prop('disabled', false);
        } else {
            jQuery(this).parent().parent().find(".wpcui-show-specific-options").hide();
            jQuery('.tgdprc_post_type_data').hide();
            jQuery('.tgdprc_post_type_requester').prop('disabled', true);
        }
    });

    jQuery(".tgdprc-show-specific-page-selector").trigger("change");

    jQuery('.wpcui_download_btn').on('click', function (e) {
        var json_data = jQuery('.wpcui_export_info_value').val();
        if (json_data == 'null' || json_data == '') {
            e.preventDefault();
            alert('No data choosen');
        } else {
            var status = confirm('Do you wish to export ?');
            if (!status) {
                e.preventDefault();
            }
        }
    });


    jQuery('.tgdprc_json_import_type').on('change', function () {
        var selector_value = jQuery(this).val();

        jQuery('.tgdprc_json_code').hide();
        jQuery('.tgdprc_json_code_' + selector_value).show();
        jQuery('.tgdprc_json_code').children('.tgdprc_import_value').prop('disabled', true);
        jQuery('.tgdprc_json_code_' + selector_value).children('.tgdprc_import_value').prop('disabled', false);
        if (selector_value == 'snip') {
            jQuery('.tgdprc_import_button').show();
        }
    });



    jQuery('button.tgdprc_media_manager').click(function (e) {

        var title = 'Choose an Icon';
        var button = 'Select Icon';
        var hidden_field = jQuery(this).data('input');
        var preview_img = jQuery(this).data('preview');

        if (jQuery(this).attr('id') == 'tgdprc_bg_image_manager') {
            title = 'Select Background Image';
            button = 'Select Image';
        }

        e.preventDefault();
        $this = this;
        var image = wp.media({
            title: title,
            multiple: false,
            library: {
                type: 'image',
            },
            button: {
                text: button
            }
        }).open()
                .on('select', function (e) {
                    var uploaded_image = image.state().get('selection').first();
                    var wpcui_img_url = uploaded_image.toJSON().url;
                    jQuery($this).parent().children('.' + hidden_field).val(uploaded_image.id);
                    jQuery($this).parent().children('.' + preview_img).attr('src', wpcui_img_url);
                });

    });


    jQuery('.tgdprc_bg_type_selector').on("change", function () {
        var div_selector = jQuery('.tgdprc_bg_type_selector option:selected').val();
        jQuery('.tgdprc_bg_section').hide();
        jQuery('.tgdprc_bg_section_' + div_selector).show();
    });
    jQuery('.tgdprc_bg_type_selector').trigger("change");

    jQuery('.tgdprc_more_info_bg_type_selector').on("change", function () {
        var div_selector = jQuery('.tgdprc_more_info_bg_type_selector option:selected').val();
        jQuery('.tgdprc_more_info_bg_section').hide();
        jQuery('.tgdprc_more_info_bg_section_' + div_selector).show();
    });
    jQuery('.tgdprc_more_info_bg_type_selector').trigger("change");


    jQuery('.tgdprc_bg_image_preview_selector').on('change', function () {
        var selected_img = jQuery('.tgdprc_bg_image_preview_selector option:selected').data('img');
        jQuery(this).siblings('img').attr('src', selected_img);
    });
    jQuery('.tgdprc_bg_image_preview_selector').trigger('change');

    jQuery('.tgdprc_more_info_bg_image_preview_selector').on('change', function () {
        var selected_img = jQuery('.tgdprc_more_info_bg_image_preview_selector option:selected').data('img');
        jQuery(this).siblings('img').attr('src', selected_img);
    });
    jQuery('.tgdprc_more_info_bg_image_preview_selector').trigger('change');


    jQuery('.tgdprc_icon_type_selector').on("change", function () {
        var div_id = jQuery(this).attr('id');
        var type_selector = jQuery('#' + div_id + ' option:selected').val();
        if (type_selector != null) {
            jQuery(this).parent().parent().children('.tgdprc_icon_type_field').hide();
            jQuery(this).parent().parent().children('#tgdprc_icon_type_' + type_selector).show();
        }
    });
    jQuery('.tgdprc_icon_type_selector').trigger("change");

// Switch between slideout and redirect action for more info in the cookie bar display
    jQuery(".tgdprc-show-specific-page-selector").on("change", function () {
        var selector_value = jQuery('.tgdprc-show-specific-page-selector option:selected').val().replace(/ /g, '_');
        jQuery('.tgdprc_notice_display_option').hide();
        jQuery(".tgdprc_field_of_" + selector_value).show();
    });
    jQuery(".tgdprc-show-specific-page-selector").trigger("change");


// Throwing data for pagination ajax 
    jQuery('div.tgdprc_choice_settings_field').on('click', '.tgdprc_pagination_links a', function (e) {
        e.preventDefault();
        var checked_state = jQuery('#tgdprc_checked_cma').val();
        var pagination_nonce = jQuery('.tgdprc_choice_settings_field #pagination_nonce').val();
        var key_val_pair = new Array();
        var link = jQuery(this).attr('href');
        var query_string = link.split('?')[1];
        var parameters = query_string.split('&');
        var iterator = 0;
        jQuery(this).parents('.tgdprc_posts_of_post_type').find('span.tgdprc-loader').css('display', 'inline-block');
        for (index in parameters) {
            if (parameters[index].search('paged') > -1) {
                // alert(parameters[index]);
                // agruments[iterator] = parameters[index];
                key_val_pair[iterator] = parameters[index];
                iterator++;
                jQuery('.tgdprc_pagination_links').each(function () {
                    var data_val = jQuery(this).data('paged');
                    var data_key_val = data_val.split('=')[0];
                    var para_key_val = parameters[index].split('=')[0];
                    if (data_key_val != para_key_val) {
                        key_val_pair[iterator] = data_val;
                        iterator++;
                    }
                });
            }
        }
        // alert(key_val_pair);
        jQuery.post(
                ajaxurl,
                {
                    'action': 'tgdprc_pagination_links',
                    'key_val_pair': key_val_pair,
                    'checked_state': checked_state,
                    'nonce_pagination': pagination_nonce
                },
                function (response) {
                    var clear_response = response.slice(0, -1);
                    jQuery('.tgdprc_choice_settings_field .tgdprc_post_types_div').html(clear_response);
                    jQuery(this).parents('.tgdprc_posts_of_post_type').find('span.tgdprc-loader').hide();
                }
        );
    });

// Saving the State of checked posts of post types
    jQuery('div.tgdprc_choice_settings_field').on('click', 'div.tgdprc_individual_term .tgdprc_post_type_term', function () {
        var selected_id = jQuery(this).val();
        var hidden_field_value = jQuery('#tgdprc_checked_cma').val();
        var hidden_field_array = hidden_field_value.split(',');
        if (jQuery(this).prop('checked')) {
            if (hidden_field_value != '') {
                var match_status = false;
                for (index in hidden_field_array) {
                    if (hidden_field_array[index] == selected_id) {
                        match_status = true;
                    }
                }
                if (!match_status) {
                    jQuery('#tgdprc_checked_cma').val(hidden_field_value + ',' + selected_id);
                }
            } else {
                jQuery('#tgdprc_checked_cma').val(selected_id);
            }

        } else {
            var new_hidden_field = new Array();
            iterator = 0;
            for (index in hidden_field_array) {
                if (hidden_field_array[index] != selected_id) {
                    new_hidden_field[iterator] = hidden_field_array[index];
                    iterator++;
                }
            }
            var hidden_field_string = new_hidden_field.join();
            jQuery('#tgdprc_checked_cma').val(hidden_field_string);
        }
    });

    jQuery('.tgdprc_copy_to_clipboard').on('click', function () {
        var copyText = jQuery(this).siblings('.tgdprc_copy_from_field');
        if (copyText.val() != '') {
            copyText.select();
            document.execCommand("Copy");
            copyText.blur();
            jQuery(this).text('Copied').delay(8000);
            jQuery(this).text('Copy to Clipboard');
        }
    });

// Checked and unchecked for wpcui_elements
    jQuery('.tgdprc_mark_all_elements').on('click', function () {
        if (jQuery(this).prop('checked')) {
            jQuery('.tgdprc_mark_all_elements').prop('checked', true);
            jQuery('.tgdprc_mark_individual').each(function () {
                jQuery(this).prop('checked', true);
            });
            jQuery('.tgdprc_delete_marked').show();
        } else {
            jQuery('.tgdprc_mark_all_elements').prop('checked', false);
            jQuery('.tgdprc_mark_individual').each(function () {
                jQuery(this).prop('checked', false);
            });
            jQuery('.tgdprc_delete_marked').hide();
        }
    });

    jQuery('.tgdprc_mark_individual').on('click', function () {
        var status = true;
        var individuals = false;
        jQuery('.tgdprc_mark_individual').each(function () {
            if (!jQuery(this).prop('checked')) {
                status = false;
            } else {
                individuals = true;
            }
        });
        if (individuals) {
            jQuery('.tgdprc_delete_marked').show();
        } else {
            jQuery('.tgdprc_delete_marked').hide();
        }
        jQuery('.tgdprc_mark_all_elements').prop('checked', status);
    });

    jQuery('.tgdprc_delete_marked').on('click', function () {
        var selected_elements = new Array();
        var type = jQuery(this).data('source');
        var action = (type == 'element') ? ('tgdprc_delete_marked') : ((type == 'template') ? ('tgdprc_delete_marked_template') : '');
        var del_nonce = jQuery('#wpcui_del_mark_field').val();
        var iterator = 0;
        jQuery('.tgdprc_mark_individual').each(function () {
            if (jQuery(this).prop('checked')) {
                selected_elements[iterator] = jQuery(this).val();
                iterator++;
            }
        });
        var status = confirm(iterator + ' elements selected. Do you wish to delete selected elements?');
        if (status) {
            jQuery.post(
                    ajaxurl,
                    {
                        'action': action,
                        'nonce': del_nonce,
                        'selected_elements': selected_elements
                    },
                    function (response) {
                        var clear_response = response.slice(0, -1);
                        alert(clear_response);
                        location.reload();
                    }
            );
        } else {
            alert('Thats ok');
        }
    });

    /**
     * For Advanced Cookie Show/hide individual categerory elements
     */
    jQuery('body').on('click', '.tgdprc_adv_cookie_settings_ind_head_wrap', function () {
        jQuery(this).parents().children('.tgdprc_struct_settings_body_inner').slideToggle(300);
        jQuery(this).find('i').toggleClass('fa-sort-down fa-sort-up');
        jQuery(this).parents().children('.tgdprc_struct_settings_body').toggleClass('tgdprc-open-field-div');
    });

    /**
     *change description dynamically
     */
    jQuery('body').on('keyup', '#tgdprc-advanced-cookie-indv-title', function () {
        var desc = jQuery(this).val();
        jQuery(this).parents('.tgdprc_struct_settings_body').find('.tgdprc-adv-cookie-indv-cookie-setting-title').text(desc);
    });

}); //End of JQuery