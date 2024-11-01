(function ($) {
    $(function () {
        /** 
         * Terms Default Variables 
         */
        var default_policy_expiry = $('body').find('#tgdprc-policies-button').data('expiry-duration');
        var redirect_on = $('body').find('#tgdprc-policies-button').data('redirect');
        var redirect_url = $('body').find('#tgdprc-policies-button').data('redirect-url');
        var data_before_accept_text = $('body').find('#tgdprc-policies-button').data('before-accept-text');
        var data_after_accept_text = $('body').find('#tgdprc-policies-button').data('after-accept-text');
        /** 
         * Terms Default Variables
         */
        var default_terms_expiry = $('body').find('#tgdprc-terms-button').data('expiry-duration');
        var terms_redirect_on = $('body').find('#tgdprc-terms-button').data('redirect');
        var terms_redirect_url = $('body').find('#tgdprc-terms-button').data('redirect-url');
        var terms_data_before_accept_text = $('body').find('#tgdprc-terms-button').data('before-accept-text');
        var terms_data_after_accept_text = $('body').find('#tgdprc-terms-button').data('after-accept-text');
        $(".tgdprc-cookie-bar-info-confirm , .tgdprc_close_btn").click(function () {
            $(".tgdprc-cookie-bar-display").fadeOut();
        });
        wpcuiEnableCustomScroller();
        wpcuiPopUpAlternativeClose();
        /**
         * 
         * For Policies Cookie and Ajax run
         * 
         */

        $('body').on('click', '#tgdprc-policies-button', function (e) {
            e.preventDefault();
            error_flag = 0;
            var $this = $(this);
            var id_value = $this.attr('id');
            var policie_stats = $this.data('policie-stats');
            var data_error_text = $this.parent().find('.tgdprc-hidden-display-message').data('error-message');
            $.ajax({
                url: tgdprc_frontend_js.ajax_url,
                data: {
                    _wpnonce: tgdprc_frontend_js.ajax_nonce,
                    id_value: id_value,
                    policie_stats: policie_stats,
                    action: 'tgdprc_terms_policies_button_click_action',
                },
                type: "POST",
                beforeSend: function () {
                    $this.attr("disabled", true);
                    $this.parent().find('.tgdprc-hidden-display-message').html('');
                    $this.parents('.tgdprc-cookie-bar-terms-policy-wrap').find('span.tgdprc-loader').css('display', 'inline-block');
                    return true;
                },
                success: function (response) {
                    var message_return = response.split("&");
                    var message_types = message_return[0].split("=");
                    var message_type = message_types[1];
                    var messages = message_return[1].split("=");
                    var message = messages[1];
                    if (message_type == 'success') {
                        if (policie_stats == 'accepted') {
                            //When privacies are already accepted
                            $this.data('policie-stats', 'unaccepted');
                            $this.parent().find('span.tgdprc-hidden-display-message').removeClass().addClass('tgdprc-hidden-display-message tgdprc-terms-policies-unaccepted').html(message).hide();
                            $this.removeClass().addClass('wpcui_terms_policies_button tgdprc-terms-policies-button-unaccepted').text(data_before_accept_text);
                            check_policy_cookie();
                        } else if (policie_stats == 'unaccepted') {
                            //When privacies are unaccepted
                            $this.data('policie-stats', 'accepted');
                            $this.removeClass().addClass('wpcui_terms_policies_button tgdprc-terms-policies-button-accepted').text(data_after_accept_text);
                            $this.parent().find('span.tgdprc-hidden-display-message').removeClass().addClass('tgdprc-hidden-display-message tgdprc-terms-policies-accepted').html(message).show();
                            check_policy_cookie();
                        }
                        if (redirect_on == 'on') {
                            setTimeout(function () {
                                $(location).attr('href', redirect_url);
                            }, 2000);
                        }
                    } else if (message_type == 'failed') {
                        $this.parent().find('span.tgdprc-hidden-display-message').removeClass().addClass('tgdprc-hidden-display-message tgdprc-terms-policies-unaccepted').html(message).show();
                    } else {
                        $this.parent().find('.tgdprc-hidden-display-message').removeClass().addClass('tgdprc-hidden-display-message tgdprc-terms-policies-unaccepted').html(data_error_text).show();
                    }
                },
                complete: function (response) {
                    $this.attr("disabled", false);
                    $this.parents('.tgdprc-cookie-bar-terms-policy-wrap').find('span.tgdprc-loader').hide();
                    return false;
                }
            });
        });
        /**
         * user consent Checbox control
         */
        $('body').on('click', 'input.tgdprc-advance-cookie-control-check[type=checkbox]', function () {
            var value = $(this).val();
            var selector_this = $(this);
            if (selector_this.prop('checked') === true && value === 'block-all') {
                selector_this.parents('.tgdprc-first-row').find('span.tgdprc-first-row-inner-checks').find('input.tgdprc-advance-cookie-control-check[type=checkbox]').each(function () {
                    $(this).removeAttr('checked');
                });
                selector_this.parents('.tgdprc-advanced-cookies-container-2').find('.tgdprc-second-row .tgdprc-second-row-inner').each(function () {
                    $(this).fadeOut();
                });
            } else if (selector_this.prop('checked') === true && value !== 'block-all') {
                selector_this.parents('.tgdprc-first-row').find('input.tgdprc-advance-cookie-control-check[type=checkbox]:first').removeAttr('checked');
                selector_this.parents('.tgdprc-advanced-cookies-container-2').find('.tgdprc-second-row').find('#tgdprc-cookie-setting-' + value).show();
            } else if (selector_this.prop('checked') === false) {
                selector_this.parents('.tgdprc-advanced-cookies-container-2').find('.tgdprc-second-row').find('#tgdprc-cookie-setting-' + value).hide();
            } else if (selector_this.parents('.tgdprc-first-row').find('span.tgdprc-first-row-inner-checks').find('input.tgdprc-advance-cookie-control-check[type=checkbox]').length > 0) {
                selector_this.parents('.tgdprc-advanced-cookies-container-2').find('#tgdprc-cookie-setting-' + value).fadeOut();
            } else {
                selector_this.parents('.tgdprc-first-row').find('input.tgdprc-advance-cookie-control-check[type=checkbox]:first').setAttribute("checked", "checked");
            }
        });
        /**
         * 
         * For user consent Storage into DB
         * 
         */

        $('body').on('click', '#tgdprc-advanced-cookie-acceptance-button', function (e) {
            e.preventDefault();
            var $this = $(this);
            error_flag = 0;
            if (!$this.parents('.tgdprc-advanced-cookies-setting-wrap').find('input:checkbox[name=advanced_cookie_control_check]').is(':checked')) {
                error_flag = 1;
            } else {
                error_flag = 0;
            }

            var tgdprc_browser_ip = $this.parents('.tgdprc-advanced-cookies-setting-wrap').find('#tgdprc-browser-ip').val();
            var tgdprc_user_agent = $this.parents('.tgdprc-advanced-cookies-setting-wrap').find('#tgdprc-user-agent').val();
            var tgdprc_browser_header = $this.parents('.tgdprc-advanced-cookies-setting-wrap').find('#tgdprc-browser-header').val();
            var tgdprc_consent_id = $this.parents('.tgdprc-advanced-cookies-setting-wrap').find('#tgdprc-consent-id').val();
            var user_current_redirect_url = $this.parents('.tgdprc-user-current-redirect-url').find('#tgdprc-consent-id').val();
            var form_submitted_message = $this.parents('.tgdprc-advanced-cookies-setting-wrap').find('.tgdprc-hidden-display-message').attr('data-message');
            var consent_value = Array();
            $this.parents('.tgdprc-advanced-cookies-setting-wrap').find('input:checkbox[name=advanced_cookie_control_check]:checked').each(function () {
                consent_value.push($(this).val());
            });
            if (error_flag == 0) {
                $.ajax({
                    url: tgdprc_frontend_js.ajax_url,
                    data: {
                        _wpnonce: tgdprc_frontend_js.ajax_nonce,
                        tgdprc_browser_ip: tgdprc_browser_ip,
                        tgdprc_user_agent: tgdprc_user_agent,
                        tgdprc_browser_header: tgdprc_browser_header,
                        consent_value: consent_value,
                        tgdprc_consent_id: tgdprc_consent_id,
                        action: 'tgdprc_advance_cookie_consent_storage',
                    },
                    type: "POST",
                    beforeSend: function () {
                        $this.attr("disabled", true);
                        $this.parents('.tgdprc-advanced-cookies-setting-wrap').find('span.tgdprc-loader').css('display', 'inline-block');
                        return true;
                    },
                    success: function (response) {
                        var message_return = response.split("&");
                        var message_types = message_return[0].split("=");
                        var message_type = message_types[1];
                        var messages = message_return[1].split("=");
                        var message_consent_id = messages[1];
                        if (message_type == 'success') {
                            $this.parents('.tgdprc-advanced-cookies-setting-wrap').find('#tgdprc-consent-id').val(message_consent_id);
                            $this.parent().find('span.tgdprc-hidden-display-message').removeClass().addClass('tgdprc-hidden-display-message tgdprc-advanced-cookie-success').html(form_submitted_message).show();
                        }
                        setTimeout(function () {
                            $(location).attr('href', user_current_redirect_url);
                        }, 2000);
                    },
                    complete: function (response) {
                        $this.attr("disabled", false);
                        $this.parents('.tgdprc-advanced-cookies-setting-wrap').find('span.tgdprc-loader').hide();
                        setTimeout(function () {
                            $this.parents('.tgdprc-advanced-cookies-setting-wrap').find('.tgdprc-advanced-cookie-button-wrap').find('span.tgdprc-hidden-display-message').html('').fadeOut();
                        }, 10000);
                        return false;
                    }
                });
            }
        });
        /**
         * set policy cookie
         * @param {type} cname
         * @param {type} cvalue
         * @param {type} exdays
         * @returns {undefined}
         */
        function set_policy_cookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toGMTString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        }

        /**
         * get policy cookie
         * @param {type} cname
         * @returns {String}
         */
        function get_policy_cookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ')
                    c = c.substring(1);
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        /**
         * check policy cookie
         * @returns {undefined}
         */
        function check_policy_cookie() {
            var cname = 'tgdprc_policie_cookie';
            var policie_cookie = get_policy_cookie(cname);
            if (policie_cookie !== "") {
                //cookie is set
                delete_policy_cookie("tgdprc_policie_cookie");
            } else {
                //Cookie is not set
                set_policy_cookie("tgdprc_policie_cookie", cname, default_policy_expiry);
            }
        }

        /**
         * delete policy cookie
         * @param {type} name
         * @returns {undefined}
         */
        function delete_policy_cookie(name) {
            document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }

        /** 
         * For Terms Cookie and Ajax run
         * 
         */
        $('body').on('click', '#tgdprc-terms-button', function (e) {
            e.preventDefault();
            error_flag = 0;
            var $this = $(this);
            var id_value = $this.attr('id');
            var policie_stats = $this.data('terms-stats'); //policie Status variable but used for Term Status

            var data_error_text = $this.parent().find('.tgdprc-hidden-display-message').data('error-message');
            $.ajax({
                url: tgdprc_frontend_js.ajax_url,
                data: {
                    _wpnonce: tgdprc_frontend_js.ajax_nonce,
                    id_value: id_value,
                    policie_stats: policie_stats,
                    action: 'tgdprc_terms_policies_button_click_action',
                },
                type: "POST",
                beforeSend: function () {
                    $this.attr("disabled", true);
                    $this.parent().find('.tgdprc-hidden-display-message').html('');
                    $this.parents('.tgdprc-cookie-bar-terms-policy-wrap').find('span.tgdprc-loader').css('display', 'inline-block');
                    return true;
                },
                success: function (response) {
                    var message_return = response.split("&");
                    var message_types = message_return[0].split("=");
                    var message_type = message_types[1];
                    var messages = message_return[1].split("=");
                    var message = messages[1];
                    if (message_type == 'success') {
                        if (policie_stats == 'accepted') {
                            //When privacies are already accepted
                            $this.data('terms-stats', 'unaccepted');
                            $this.parent().find('span.tgdprc-hidden-display-message').removeClass().addClass('tgdprc-hidden-display-message tgdprc-terms-policies-unaccepted').html(message).hide();
                            $this.removeClass().addClass('wpcui_terms_policies_button tgdprc-terms-policies-button-unaccepted').text(terms_data_before_accept_text);
                            check_terms_cookie();
                        } else if (policie_stats == 'unaccepted') {
                            //When privacies are unaccepted
                            $this.data('terms-stats', 'accepted');
                            $this.removeClass().addClass('wpcui_terms_policies_button tgdprc-terms-policies-button-accepted').text(terms_data_after_accept_text);
                            $this.parent().find('span.tgdprc-hidden-display-message').removeClass().addClass('tgdprc-hidden-display-message tgdprc-terms-policies-accepted').html(message).show();
                            check_terms_cookie();
                        }
                        if (terms_redirect_on == 'on') {
                            setTimeout(function () {
                                $(location).attr('href', terms_redirect_url);
                            }, 2000);
                        }
                    } else if (message_type == 'failed') {
                        $this.parent().find('span.tgdprc-hidden-display-message').removeClass().addClass('tgdprc-hidden-display-message tgdprc-terms-policies-unaccepted').html(message).show();
                    } else {
                        $this.parent().find('.tgdprc-hidden-display-message').removeClass().addClass('tgdprc-hidden-display-message tgdprc-terms-policies-unaccepted').html(data_error_text).show();
                    }
                },
                complete: function (response) {
                    $this.attr("disabled", false);
                    $this.parents('.tgdprc-cookie-bar-terms-policy-wrap').find('span.tgdprc-loader').hide();
                    return false;
                }
            });
        });
        /** 
         * For User data tab form submission
         * 
         */
        $('body').on('click', '.tgdprc-user-data-submit-button', function (e) {
            e.preventDefault();
            error_flag = 0;
            var $this = $(this);
            var email_address_value = $this.parent().find('.tgdprc-email-field').val();
            var user_data_submit_type = $this.parents('.tgdprc-user-data-tabs-content').data('submit-type');
            var filter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (user_data_submit_type == 'data-access') {
                /** 
                 * Consent Check field validation for User Data Access Request 
                 */
                if (!$('input[name="tgdprc_data_access_request_consent"]:checked').is(':checked')) {
                    var error_flag = 1;
                    $this.parent().find('#tgdprc-userdata-access-consent-checkfield').addClass('tgdprc-required-class');
                } else {
                    $this.parent().find('#tgdprc-userdata-access-consent-checkfield').removeClass('tgdprc-required-class');
                }
            } else if (user_data_submit_type == 'data-rectification') {
                var old_data_to_rectify = $this.parent().find('.tgdprc-rectified-older-data-field').val();
                var new_data_rectify = $this.parent().find('.tgdprc-rectified-newer-data-field').val()

                /** 
                 * Json field validation check 
                 */
                if ((isJSON(old_data_to_rectify) == false || isJSON(new_data_rectify) == false) || (old_data_to_rectify == '' || new_data_rectify == '')) {
                    var error_flag = 1;
                    $this.parent().find('.tgdprc-rectified-older-data-field').addClass('tgdprc-required-class');
                    $this.parent().find('.tgdprc-rectified-newer-data-field').addClass('tgdprc-required-class');
                } else {
                    $this.parent().find('.tgdprc-rectified-older-data-field').removeClass('tgdprc-required-class');
                    $this.parent().find('.tgdprc-rectified-newer-data-field').removeClass('tgdprc-required-class');
                }

                /** 
                 * Consent Check field validation for User Data Rectification Request 
                 */
                if (!$('input[name="tgdprc_data_rectification_request_consent"]:checked').is(':checked')) {
                    var error_flag = 1;
                    $this.parent().find('#tgdprc-userdata-rectification-consent-checkfield').addClass('tgdprc-required-class');
                } else {
                    $this.parent().find('#tgdprc-userdata-rectification-consent-checkfield').removeClass('tgdprc-required-class');
                }
            } else if (user_data_submit_type == 'data-forget') {
                /** 
                 * Consent Check field validation for User Data Rectification Request 
                 */
                if (!$('input[name="tgdprc_data_forget_request_consent"]:checked').is(':checked')) {
                    var error_flag = 1;
                    $this.parent().find('#tgdprc-userdata-forget-consent-checkfield').addClass('tgdprc-required-class');
                } else {
                    $this.parent().find('#tgdprc-userdata-forget-consent-checkfield').removeClass('tgdprc-required-class');
                }
            } else {
                var old_data_to_rectify = '';
                var new_data_rectify = '';
            }

            if ($this.parent().find('.tgdprc-fe-form-field').val() == '') {
                var error_flag = 1;
                $this.parent().find('.tgdprc-email-field').addClass('tgdprc-required-class');
            } else if (!filter.test(email_address_value)) {
                error_flag = 1;
                $(this).parent().find('.tgdprc-email-field').addClass('tgdprc-required-class');
            } else {
                $(this).parent().find('.tgdprc-email-field').removeClass('tgdprc-required-class');
            }
            if (error_flag == 1) {
                return false;
            } else if (error_flag == 0) {
                $.ajax({
                    url: tgdprc_frontend_js.ajax_url,
                    data: {
                        _wpnonce: tgdprc_frontend_js.ajax_nonce,
                        user_data_submit_type: user_data_submit_type,
                        email_address_value: email_address_value,
                        old_data_to_rectify: old_data_to_rectify,
                        new_data_rectify: new_data_rectify,
                        action: 'tgdprc_user_data_process_action',
                    },
                    type: "POST",
                    beforeSend: function () {
                        $this.attr("disabled", true);
                        $this.closest('.tgdprc-user-data-content-inner').find('span.tgdprc-form-message').html('').hide();
                        $this.parent().find('.tgdprc-fe-form-field').each(function () {
                            var form_empty_this = $(this);
                            form_empty_this.removeClass('tgdprc-required-class');
                        });
                        $this.parents('.tgdprc-user-data-form-wrap').find('span.tgdprc-loader').css('display', 'inline-block');
                        return true;
                    },
                    success: function (response) {
                        console.log(response);
                        var message_return = response.split("&");
                        var message_types = message_return[0].split("=");
                        var message_type = message_types[1];
                        var messages = message_return[1].split("=");
                        var message = messages[1];
                        if (message_type == 'success') {
                            $this.closest('.tgdprc-user-data-content-inner').find('span.tgdprc-form-message').removeClass().addClass('tgdprc-form-message tgdprc-userdata-form-success-message').html(message).show();
                            $this.parent().find('.tgdprc-fe-form-field').val('');
                        } else if (message_type == 'failed') {
                            $this.closest('.tgdprc-user-data-content-inner').find('span.tgdprc-form-message').removeClass().addClass('tgdprc-form-message tgdprc-userdata-form-failure-message').html(message).show();
                        }
                    },
                    complete: function () {
                        $this.attr("disabled", false);
                        $this.parents('.tgdprc-user-data-form-wrap').find('span.tgdprc-loader').hide();
                        return false;
                    }
                });
            }
        });

        function isJSON(str) {
            if (/^\s*$/.test(str))
                return false;
            str = str.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@');
            str = str.replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']');
            str = str.replace(/(?:^|:|,)(?:\s*\[)+/g, '');
            return (/^[\],:{}\s]*$/).test(str);
        }

        /**
         * set terms cookie
         * @param {type} cname
         * @param {type} cvalue
         * @param {type} exdays
         * @returns {undefined}
         */
        function set_terms_cookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toGMTString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        }

        /** 
         * get terms cookie
         * @param {type} cname
         * @returns {String}
         */
        function get_terms_cookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ')
                    c = c.substring(1);
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        /**
         * check terms cookie
         * @returns {undefined}
         */
        function check_terms_cookie() {
            var cname = 'tgdprc_terms_cookie';
            var terms_cookie = get_terms_cookie(cname);
            if (terms_cookie !== "") {
                //cookie is set
                delete_terms_cookie("tgdprc_terms_cookie");
            } else {
                //Cookie is not set
                set_terms_cookie("tgdprc_terms_cookie", cname, default_terms_expiry);
            }
        }
        /**
         * delete terms cookie
         * @param {type} name
         * @returns {undefined}
         */
        function delete_terms_cookie(name) {
            document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }

        /**
         * User Data Tab
         */
        $(".tgdprc-nav-tab-user-data").on("click", function () {
            $(".tgdprc-nav-tab-user-data").removeClass("nav-tab-active tgdprc-user-nav-tab-active");
            $(this).addClass("nav-tab-active tgdprc-user-nav-tab-active");
            var selectedTab = $(this).attr('id');
            // alert("#" + selectedTab + "_tab");
            $(".tgdprc-user-data-tabs-content").hide();
            $("#tgdprc-userdata-tabs-content-" + selectedTab).show();
        });

        $('.tgdprc-floating-trigger-wrap').on('click', function (e) {
            e.preventDefault();
            $(this).parent().find('.tgdprc-floating-trigger-content-wrap').fadeIn();
            $(this).parent().find('.tgdprc-floating-trigger-content-wrap').removeClass('').addClass('tgdprc-floating-trigger-content-wrap tgdprc-floating-trigger-shown');
        });

        $('.tgdprc-floating-close-trigger-inner').on('click', function (e) {
            e.preventDefault();
            $(this).parents('.tgdprc-floating-trigger-parent-wrap').find('.tgdprc-floating-trigger-content-wrap').fadeOut();
            $(this).parents('.tgdprc-floating-trigger-parent-wrap').find('.tgdprc-floating-trigger-content-wrap').removeClass('').addClass('tgdprc-floating-trigger-content-wrap tgdprc-floating-trigger-hidden');
        });

        /** Tag Box */
//        $("#tgdprc-userdata-tabs-content-tgdprc-data-forget #tgdprc-tag-input-field textarea#tgdprc-additional-entry-field").on({
//            focusout: function () {
//                var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig, ''); // allowed characters
//                if (txt)
//                    $("<span/>", {text: txt.toLowerCase(), append: this});
//                this.value = "";
//            },
//            keyup: function (ev) {
        // if: comma|enter (delimit more keyCodes with | pipe)
//                if (/(188|13)/.test(ev.which))
//                    $(this).focusout();
//            }
//        });
//        $('#tgdprc-userdata-tabs-content-tgdprc-data-forget #tgdprc-tag-input-field').on('click', 'span', function () {
//            if (confirm("Remove " + $(this).text() + "?"))
//                $(this).remove();
//        });

    }); //funtion
}(jQuery)); //main function end

function display_info_content() {
    jQuery('.tgdprc-cookie-bar-more-info-wrap').addClass('tgdprc_info_show');
}

function wpcuiEnableCustomScroller($ = jQuery) {
    if ($('.tgdprc-cookie-bar-display').hasClass('tgdprc_cookie_notice_popup')) {
        if ($('.tgdprc-cookie-bar-body').hasClass('tgdprc_template_Template-11')) {
            wpcuiSetPopupCustomScrollBarHeight('270px', '270px'); // param 1: Info Height, param 2: more info height
        } else if ($('.tgdprc-cookie-bar-body').hasClass('tgdprc_template_Template-12')) {
            wpcuiSetPopupCustomScrollBarHeight('232px', '232px'); // param 1: Info Height, param 2: more info height
        } else if ($('.tgdprc-cookie-bar-body').hasClass('tgdprc_template_Template-13')) {
            wpcuiSetPopupCustomScrollBarHeight('225px', '225px'); // param 1: Info Height, param 2: more info height
        } else if ($('.tgdprc-cookie-bar-body').hasClass('tgdprc_template_Template-14')) {
            wpcuiSetPopupCustomScrollBarHeight('240px', '240px'); // param 1: Info Height, param 2: more info height
        } else if ($('.tgdprc-cookie-bar-body').hasClass('tgdprc_template_Template-15')) {
            wpcuiSetPopupCustomScrollBarHeight('240px', '240px'); // param 1: Info Height, param 2: more info height
        }
    } else if (
            ($('.tgdprc-cookie-bar-display').hasClass('tgdprc_cookie_notice_bar')) ||
            ($('.tgdprc-cookie-bar-display').hasClass('tgdprc_cookie_notice_floating'))
            ) {
        wpcuimCustomScrollbar('.tgdprc-cookie-info-content div#tgdprc_content_area', ($(window).height() - 120) + 'px');
}
}

function wpcuiSetPopupCustomScrollBarHeight(content_height = '200px', more_info_height = '200px') {
    wpcuimCustomScrollbar('.tgdprc-cookie-info-content', content_height);
    wpcuimCustomScrollbar('.tgdprc_cookie_notice_popup .tgdprc_text_container_wrap', more_info_height);
}
function wpcuimCustomScrollbar(content, max_height, $ = jQuery) {
    $(content).mCustomScrollbar({
        theme: 'dark',
        setHeight: max_height,
        scrollInertia: '100'
    });
}

function wpcuiPopUpAlternativeClose($ = jQuery) {
    if ($('#tgdprc_cookie_bar_main_display').hasClass('tgdprc_cookie_notice_popup')) {
        $(document).on('mousedown', function (e) {
            var container = $("#tgdprc_cookie_bar_main_body");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0)
            {
                // alert();
                container.parent().fadeOut();
            }
        });
        $(document).on('keyup', function (e) {
            if (e.keyCode == 27) { // escape key maps to keycode `27`
                $('#tgdprc_cookie_bar_main_display').fadeOut();
            }
        });
}
}