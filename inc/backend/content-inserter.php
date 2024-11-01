<div class="tgdprc-input-field-wrap" id="tgdprc-main-custom-shortcode-popup" style="display:none">
    <label>
        <?php echo __('Select Shorcode Type', TGDPRCL_DOMAIN); ?>
    </label>
    <div class="ttp-input-field">
        <select name="tgdprc_shortcode_inserter" id="tgdprc-shortcode-content-insertion-type" class="ttp-dropdown">
            <option value=""><?php _e('Choose Shortcodes', TGDPRCL_DOMAIN); ?></option>
            <option value="terms"><?php _e('Terms & Condition Accept Button', TGDPRCL_DOMAIN); ?></option>
            <option value="policies"><?php _e('Policies Accept Button', TGDPRCL_DOMAIN); ?></option>
            <option value="services"><?php _e('Displaying All Lists of Services', TGDPRCL_DOMAIN); ?></option>
            <option value="advanced-cookie"><?php _e('Advanced User Cookie Control Setting', TGDPRCL_DOMAIN); ?></option>
            <option value="user-data"><?php _e('User Data Form Setting', TGDPRCL_DOMAIN); ?></option>
        </select>
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        //Shortcode Inserter
        jQuery('body').on('change', '#tgdprc-shortcode-content-insertion-type', function () {
            contet_type = jQuery("#tgdprc-shortcode-content-insertion-type option:selected").val();
            if (contet_type !== '') {
                if (contet_type == 'terms') {
                    window.send_to_editor("[tgdprc-terms-conditions]");
                } else if (contet_type == 'policies') {
                    window.send_to_editor("[tgdprc-policies]");
                } else if (contet_type == 'services') {
                    window.send_to_editor("[tgdprc-cookies-used]");
                } else if (contet_type == 'advanced-cookie') {
                    window.send_to_editor("[tgdprc-advanced-cookie-setting]");
                } else if (contet_type == 'user-data') {
                    window.send_to_editor("[tgdprc-userdata-form]");
                }
            }
            jQuery(this).prop('selectedIndex', 0);
        });
    });
</script>