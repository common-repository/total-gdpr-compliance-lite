<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<?php
$policies_settings = get_option('tgdprc-policies-settings');

if (isset($policies_settings['button_design_type']) && $policies_settings['button_design_type'] == 'custom') {
    ?>
    <style>
        .tgdprc-cookie-bar-terms-policy-wrap #tgdprc-policies-button{
            <?php
            if (isset($policies_settings['button_text_color']) && !empty($policies_settings['button_text_color'])) {
                echo 'color:' . esc_attr($policies_settings['button_text_color']) . ';';
            }
            ?>
            <?php
            if (isset($policies_settings['button_bg']) && !empty($policies_settings['button_bg'])) {
                echo 'background-color:' . esc_attr($policies_settings['button_bg']) . ';';
            }
            ?>
            <?php
            if (isset($policies_settings['button_border_color']) && !empty($policies_settings['button_border_color'])) {
                echo 'border:3px solid' . esc_attr($policies_settings['button_border_color']) . ';';
            }
            ?>
        }
        .tgdprc-cookie-bar-terms-policy-wrap #tgdprc-policies-button:hover{
            <?php
            if (isset($policies_settings['hover_button_text_color']) && !empty($policies_settings['hover_button_text_color'])) {
                echo 'color:' . esc_attr($policies_settings['hover_button_text_color']) . ';';
            }
            ?>
            <?php
            if (isset($policies_settings['button_bg_hover_color']) && !empty($policies_settings['button_bg_hover_color'])) {
                echo 'background-color:' . esc_attr($policies_settings['button_bg_hover_color']) . ';';
            }
            ?>
            <?php
            if (isset($policies_settings['button_hover_border_color']) && !empty($policies_settings['button_hover_border_color'])) {
                echo 'border:3px solid' . esc_attr($policies_settings['button_hover_border_color']) . ';';
            }
            ?>
        }
    </style>
    <?php
}
?>
<div class="tgdprc-cookie-bar-terms-policy-wrap" id="wpcui-cookie-bar-policy-wrap">
    <button class="wpcui_terms_policies_button <?php
    if (isset($_COOKIE['tgdprc_policie_cookie'])) {
        echo 'tgdprc-terms-policies-button-accepted';
    }
    ?>" id="tgdprc-policies-button" data-policie-stats="<?php
            if (isset($_COOKIE['tgdprc_policie_cookie'])) {
                echo 'accepted';
            } else {
                echo 'unaccepted';
            }
            ?>" 
            data-before-accept-text="<?php
            if (isset($policies_settings['display_text']) && !empty($policies_settings['display_text'])) {
                echo esc_attr($policies_settings['display_text']);
            } else {
                echo __('Accept Policies', TGDPRCL_DOMAIN);
            }
            ?>" 
            data-after-accept-text="<?php
            if (isset($policies_settings['after_accept_button_text']) && !empty($policies_settings['after_accept_button_text'])) {
                echo esc_attr($policies_settings['after_accept_button_text']);
            } else {
                echo __('Accepted', TGDPRCL_DOMAIN);
            }
            ?>" 
            data-expiry-duration ="<?php
            if (isset($policies_settings['consent_expiry_time']) && !empty($policies_settings['consent_expiry_time'])) {
                echo esc_attr($policies_settings['consent_expiry_time']);
            } else {
                echo __('365', TGDPRCL_DOMAIN);
            }
            ?>"  
            data-redirect ="<?php
            if (isset($policies_settings['redirect_enabled']) && $policies_settings['redirect_enabled'] == 'on') {
                echo esc_attr($policies_settings['redirect_enabled']);
            } else {
                echo __('off', TGDPRCL_DOMAIN);
            }
            ?>"
            data-redirect-url ="<?php
            if (isset($policies_settings['redirect_page_after_acceptance']) && $policies_settings['redirect_page_after_acceptance'] == 'default') {
                echo esc_url($_SERVER['REQUEST_URI']);
            } else {
                echo esc_url(get_permalink($policies_settings['redirect_page_after_acceptance']));
            }
            ?>"
            <?php
            if (isset($policies_settings['require_logged_in']) && $policies_settings['require_logged_in'] == 'on' && !is_user_logged_in()) {
                echo 'disabled="disabled"';
            }
            ?>>
                <?php
                if (isset($_COOKIE['tgdprc_policie_cookie'])) {
                    if (isset($policies_settings['after_accept_button_text']) && !empty($policies_settings['after_accept_button_text'])) {
                        echo esc_attr($policies_settings['after_accept_button_text']);
                    } else if (!isset($policies_settings['display_text'])) {
                        echo __('Policies Accepted', TGDPRCL_DOMAIN);
                    } else {
                        echo __('Policies Accepted', TGDPRCL_DOMAIN);
                    }
                } else {
                    if (isset($policies_settings['display_text']) && !empty($policies_settings['display_text'])) {
                        echo esc_attr($policies_settings['display_text']);
                    } else if (!isset($policies_settings['display_text'])) {
                        echo __('Accept Policies', TGDPRCL_DOMAIN);
                    } else {
                        echo __('Accept Policies', TGDPRCL_DOMAIN);
                    }
                }
                ?>
    </button>
    <span class="tgdprc-hidden-display-message" data-error-message = "<?php
    if (isset($policies_settings['action_failed_error_text']) && !empty($policies_settings['action_failed_error_text'])) {
        echo esc_attr($policies_settings['action_failed_error_text']);
    } else if (!isset($policies_settings['action_failed_error_text'])) {
        echo __('Something Wrong. Please Try Again.', TGDPRCL_DOMAIN);
    } else {
        echo __('Something Wrong. Please Try Again.', TGDPRCL_DOMAIN);
    }
    ?>" <?php
          if (isset($_COOKIE['tgdprc_policie_cookie'])) {
              echo 'style="display:block;"';
          } else {
              echo 'style="display:none;"';
          }
          ?>>
              <?php
              if (isset($_COOKIE['tgdprc_policie_cookie']) && isset($policies_settings['require_logged_in']) && !is_user_logged_in()) {
                  echo esc_attr($policies_settings['after_accept_message']) . '|' . isset($policies_settings['login_required_message']) && !empty($policies_settings['login_required_message']) ? esc_attr($policies_settings['login_required_message']) : '';
              } else if (isset($_COOKIE['tgdprc_policie_cookie']) && isset($policies_settings['require_logged_in']) && is_user_logged_in()) {
                  echo isset($policies_settings['after_accept_message']) && !empty($policies_settings['after_accept_message']) ? esc_attr($policies_settings['after_accept_message']) : '';
              } else if (!isset($_COOKIE['tgdprc_policie_cookie']) && isset($policies_settings['require_logged_in']) && !is_user_logged_in()) {
                  echo isset($policies_settings['login_required_message']) && !empty($policies_settings['login_required_message']) ? esc_attr($policies_settings['login_required_message']) : '';
              }
              ?>
    </span>
    <span class="tgdprc-loader" style="display:none;"><img src="<?php echo TGDPRCL_IMAGE . 'tgdprc-loader.gif'; ?>"/></span>
</div>