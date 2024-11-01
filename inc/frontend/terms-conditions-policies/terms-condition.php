<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<?php
$terms_and_condition_settings = get_option('tgdprc-terms-settings');
//var_dump($terms_and_condition_settings);

if (isset($terms_and_condition_settings['button_design_type']) && $terms_and_condition_settings['button_design_type'] == 'custom') {
    ?>
    <style>
        .tgdprc-cookie-bar-terms-policy-wrap #tgdprc-terms-button{
            <?php
            if (isset($terms_and_condition_settings['button_text_color']) && !empty($terms_and_condition_settings['button_text_color'])) {
                echo 'color:' . esc_attr($terms_and_condition_settings['button_text_color']) . ';';
            }
            ?>
            <?php
            if (isset($terms_and_condition_settings['button_bg']) && !empty($terms_and_condition_settings['button_bg'])) {
                echo 'background-color:' . esc_attr($terms_and_condition_settings['button_bg']) . ';';
            }
            ?>
            <?php
            if (isset($terms_and_condition_settings['button_border_color']) && !empty($terms_and_condition_settings['button_border_color'])) {
                echo 'border:3px solid' . esc_attr($terms_and_condition_settings['button_border_color']) . ';';
            }
            ?>
        }
        .tgdprc-cookie-bar-terms-policy-wrap #tgdprc-terms-button:hover{
            <?php
            if (isset($terms_and_condition_settings['hover_button_text_color']) && !empty($terms_and_condition_settings['hover_button_text_color'])) {
                echo 'color:' . esc_attr($terms_and_condition_settings['hover_button_text_color']) . ';';
            }
            ?>
            <?php
            if (isset($terms_and_condition_settings['button_bg_hover_color']) && !empty($terms_and_condition_settings['button_bg_hover_color'])) {
                echo 'background-color:' . esc_attr($terms_and_condition_settings['button_bg_hover_color']) . ';';
            }
            ?>
            <?php
            if (isset($terms_and_condition_settings['button_hover_border_color']) && !empty($terms_and_condition_settings['button_hover_border_color'])) {
                echo 'border:3px solid' . esc_attr($terms_and_condition_settings['button_hover_border_color']) . ';';
            }
            ?>
        }
    </style>
    <?php
}
?>

<div class="tgdprc-cookie-bar-terms-policy-wrap" id="wpcui-cookie-bar-terms-wrap">
    <button class="wpcui_terms_policies_button <?php
    if (isset($_COOKIE['tgdprc_terms_cookie'])) {
        echo 'tgdprc-terms-policies-button-accepted';
    }
    ?>" id="tgdprc-terms-button" data-terms-stats="<?php
            if (isset($_COOKIE['tgdprc_terms_cookie'])) {
                echo 'accepted';
            } else {
                echo 'unaccepted';
            }
            ?>" 
            data-before-accept-text="<?php
            if (isset($terms_and_condition_settings['display_text']) && !empty($terms_and_condition_settings['display_text'])) {
                echo esc_attr($terms_and_condition_settings['display_text']);
            } else {
                echo __('Accept Terms and Conditions', TGDPRCL_DOMAIN);
            }
            ?>" 
            data-after-accept-text="<?php
            if (isset($terms_and_condition_settings['after_accept_button_text']) && !empty($terms_and_condition_settings['after_accept_button_text'])) {
                echo esc_attr($terms_and_condition_settings['after_accept_button_text']);
            } else {
                echo __('Accepted', TGDPRCL_DOMAIN);
            }
            ?>" 
            data-expiry-duration ="<?php
            if (isset($terms_and_condition_settings['consent_expiry_time']) && !empty($terms_and_condition_settings['consent_expiry_time'])) {
                echo esc_attr($terms_and_condition_settings['consent_expiry_time']);
            } else {
                echo __('365', TGDPRCL_DOMAIN);
            }
            ?>"  
            data-redirect ="<?php
            if (isset($terms_and_condition_settings['redirect_enabled']) && $terms_and_condition_settings['redirect_enabled'] == 'on') {
                echo esc_attr($terms_and_condition_settings['redirect_enabled']);
            } else {
                echo __('off', TGDPRCL_DOMAIN);
            }
            ?>"
            data-redirect-url ="<?php
            if (isset($terms_and_condition_settings['redirect_page_after_acceptance']) && $terms_and_condition_settings['redirect_page_after_acceptance'] == 'default') {
                echo esc_url($_SERVER['REQUEST_URI']);
            } else {
                echo esc_url(get_permalink($terms_and_condition_settings['redirect_page_after_acceptance']));
            }
            ?>"
            <?php
            if (isset($terms_and_condition_settings['require_logged_in']) && $terms_and_condition_settings['require_logged_in'] == 'on' && !is_user_logged_in()) {
                echo 'disabled="disabled"';
            }
            ?>>
                <?php
                if (isset($_COOKIE['tgdprc_terms_cookie'])) {
                    if (isset($terms_and_condition_settings['after_accept_button_text']) && !empty($terms_and_condition_settings['after_accept_button_text'])) {
                        echo esc_attr($terms_and_condition_settings['after_accept_button_text']);
                    } else if (!isset($policies_settings['display_text'])) {
                        echo __('Terms Accepted', TGDPRCL_DOMAIN);
                    } else {
                        echo __('Terms Accepted', TGDPRCL_DOMAIN);
                    }
                } else {
                    if (isset($terms_and_condition_settings['display_text']) && !empty($terms_and_condition_settings['display_text'])) {
                        echo esc_attr($terms_and_condition_settings['display_text']);
                    } else if (!isset($terms_and_condition_settings['display_text'])) {
                        echo __('Accept Terms and Conditions', TGDPRCL_DOMAIN);
                    } else {
                        echo __('Accept Terms and Conditions', TGDPRCL_DOMAIN);
                    }
                }
                ?>
    </button>
    <span class="tgdprc-hidden-display-message" data-error-message = "<?php
    if (isset($terms_and_condition_settings['action_failed_error_text']) && !empty($terms_and_condition_settings['action_failed_error_text'])) {
        echo esc_attr($terms_and_condition_settings['action_failed_error_text']);
    } else if (!isset($terms_and_condition_settings['action_failed_error_text'])) {
        echo __('Something Wrong. Please Try Again.', TGDPRCL_DOMAIN);
    } else {
        echo __('Something Wrong. Please Try Again.', TGDPRCL_DOMAIN);
    }
    ?>" <?php
          if (isset($_COOKIE['tgdprc_terms_cookie'])) {
              echo 'style="display:block;"';
          } else {
              echo 'style="display:none;"';
          }
          ?>>
              <?php
              if (isset($_COOKIE['tgdprc_terms_cookie']) && isset($terms_and_condition_settings['require_logged_in']) && !is_user_logged_in()) {
                  echo esc_attr($terms_and_condition_settings['after_accept_message']) . '|' . isset($terms_and_condition_settings['login_required_message']) && !empty($terms_and_condition_settings['login_required_message']) ? esc_attr($terms_and_condition_settings['login_required_message']) : '';
              } else if (isset($_COOKIE['tgdprc_terms_cookie']) && isset($terms_and_condition_settings['require_logged_in']) && is_user_logged_in()) {
                  echo isset($terms_and_condition_settings['after_accept_message']) && !empty($terms_and_condition_settings['after_accept_message']) ? esc_attr($terms_and_condition_settings['after_accept_message']) : '';
              } else if (!isset($_COOKIE['tgdprc_terms_cookie']) && isset($terms_and_condition_settings['require_logged_in']) && !is_user_logged_in()) {
                  echo isset($terms_and_condition_settings['login_required_message']) && !empty($terms_and_condition_settings['login_required_message']) ? esc_attr($terms_and_condition_settings['login_required_message']) : '';
              }
              ?>
    </span>
    <span class="tgdprc-loader" style="display:none;"><img src="<?php echo TGDPRCL_IMAGE . 'tgdprc-loader.gif'; ?>"/></span>
</div>