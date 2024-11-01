<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<!-- Cookie setting -->
<script>
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        expires = (exdays == 0) ? '' : expires; //For per session data
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    var cname = 'tgdprc_cookie_expiry';
    var cvalue = 'hold';
    var exdays = '';
<?php
//Managing cookies for displaying the cookie bar in the frontend
if ($extra_settings['extra']['cookie_expiry'] == 'show After') {
    echo "exdays = " . intval($extra_settings['extra']['days']) . ";";
} elseif ($extra_settings['extra']['cookie_expiry'] == 'show Once') {
    echo "exdays = 365;";
} elseif ($extra_settings['extra']['cookie_expiry'] == 'per Session') {
    echo "exdays = 0;";
} else {
    echo "exdays = -1;";
}
?>

    window.onload = function () {
<?php if ($extra_settings['extra']['show_cookie_on'] == 'default'): ?>
            showCookie();
<?php endif; ?>
    }


<?php if ($extra_settings['extra']['show_cookie_on'] == 'page load delay'): ?>
        setTimeout(showCookie, (<?php echo $extra_settings['extra']['delay_value']; ?> * 1000));
<?php elseif ($extra_settings['extra']['show_cookie_on'] == 'page scroll'): ?>
        var cookieScrollStatus = true;
        var window_height = jQuery(window).height();
        var document_height = jQuery(document).height();
    <?php if ($extra_settings['extra']['page_scroll'] == 'half way from start'): ?>
            var percentage = 50; //For half way
    <?php elseif ($extra_settings['extra']['page_scroll'] == 'end of document'): ?>
            var percentage = 100; //For End of document
    <?php elseif ($extra_settings['extra']['page_scroll'] == 'by percentage'): ?>
            var percentage = parseFloat(<?php echo (!empty($extra_settings['extra']['scroll_percentage'])) ? floatval($extra_settings['extra']['scroll_percentage']) : 0 ?>);
    <?php endif; ?>
        var support_var = ((document_height / 2) - (window_height / 2)) * (percentage / 100);
        var pivot_pos = support_var + (window_height / 2);
        // alert(pivot_pos);
        if (window_height == document_height) {
            showCookie();
        }
        jQuery(window).scroll(function () {
            if (cookieScrollStatus) {
                var scrollTopPos = jQuery(window).scrollTop();
                var halfwayPos = (scrollTopPos + window_height) / 2;
                if (pivot_pos <= halfwayPos) {
                    showCookie();
                    cookieScrollStatus = false;
                }
            }
        });

<?php endif; ?>

<?php if ($display_settings['layout']['select_template_type'] == 'custom') : ?>
        var font_value = '<?php echo esc_attr($custom_template['font_family']) ?>';
        if (font_value != "default" && font_value != '') {
            WebFont.load({
                google: {
                    families: [font_value]
                }
            });
        }
<?php endif; ?>

    function showCookie() {
        jQuery(".tgdprc-cookie-bar-display").show();
    }

    jQuery(document).ready(function () {
        jQuery('.tgdprc-cookie-bar-more_info').on('click', function () {
            var type = jQuery('#tgdprc_cookie_bar_main_display').data('type');
            var content_type = <?php echo (($general_settings['content']['more_info']['action'] == 'slideout content') ? intval(1) : intval(0)) ?>;
            if (type == 'popup' && content_type == 1) {
                jQuery('#tgdprc_cookie_bar_main_body').toggleClass('tgdprc_popup_div');
            }
        });
    });

<?php if ($display_settings['layout']['display_type'] != 'popup') : ?>
        jQuery(document).mouseup(function (e) {
            var container = jQuery('.tgdprc-cookie-bar-more-info-wrap .tgdprc_info_wrapper .tgdprc-cookie-info-content');
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.parent().parent().removeClass('tgdprc_info_show');
            }
        });

        function more_info_hide($this) {
            jQuery($this).parent().parent().parent().removeClass('tgdprc_info_show');
        }

        function display_info_content() {
            jQuery('.tgdprc-cookie-bar-more-info-wrap').addClass('tgdprc_info_show');
        }
<?php endif; ?>

</script>