<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<div class="tgdprc_container">
    <?php
    $title = esc_attr__('Introductory Page To Basics of GDPR', TGDPRCL_DOMAIN);
    include_once TGDPRCL_PATH . 'inc/backend/includes/tgdprc-header.php';
    ?>
    <form method="post" id="manageForm">
        <div class="tgdprc_struct_settings_header">
            <img src="<?php echo TGDPRCL_IMAGE . 'european-union.jpg'; ?>" height="auto" width="100%" alt="Total GDPR Compliance - European Union Flag"  style="
            height: auto;
            width: 40%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            "/>
        </div>
        <div class="tgdprc_struct_settings_header">
            <h3><?php echo __('What is  General Data Protection Regulation (GDPR)?', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_main_function_wrap">
            <p><?php echo __('General Data Protection Regulation (GDPR) is a set of regulations built to give users more control over their personal data. It aims to simplify the regulatory environment for business in both personal users and businesses in the European Union.', TGDPRCL_DOMAIN); ?></p>
        </div>

        <div class="tgdprc_struct_settings_header">
            <h3><?php echo __('Who are Affected By GDPR?', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_main_function_wrap">
            <p><?php echo __('This rule and policies applies to any personal and business that deal with providing services to customer inside the European Union(EU). Or to any one who are outside the EU but are in linked with the sales to customer and business within EU.', TGDPRCL_DOMAIN); ?></p>
        </div>

        <div class="tgdprc_struct_settings_header">
            <h3><?php echo __('What is GDPR Compliance?', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_main_function_wrap">
            <p><?php echo __('It is the process or method to ensure that the personal data of the user are either collected with user consent or by law. And to make sure the data won\'t be misused under any circumtances and would be penalize if they fail to do so.', TGDPRCL_DOMAIN); ?></p>
        </div>
        <div class="tgdprc_struct_settings_header">
            <h3><?php echo __('What is GDPR for Business?', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_main_function_wrap">
            <p><?php echo __('GDPR is regulation that guarantees data protection, safeguards built into products and services providing data protection by ensuring that no data is being collected involuntarily or no data is being misused by the business..', TGDPRCL_DOMAIN); ?></p>
        </div>
        <div class="tgdprc_struct_settings_header">
            <h3><?php echo __('What is Personal Data?', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_main_function_wrap">
            <p><?php echo __('Personal data is any information that relates to an individual. Different data scattered across collectively also constitute personal data. It could be a name, email, your public IP address,residence address, cookies etc.', TGDPRCL_DOMAIN); ?></p>
        </div>
        <div class="tgdprc_struct_settings_header">
            <h3><?php echo __('Learn More About the GDPR?', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <div class="tgdprc_main_function_wrap">
            <p><?php echo __('The provisions of the GDPR are publicly viewable from the EU from here', TGDPRCL_DOMAIN); ?> <a target="_blanks" href="https://gdpr-info.eu/">https://gdpr-info.eu/</a></p>
        </div>
        <div class="tgdprc_struct_settings_header">
            <h3><?php echo __('Some of the Basic Shortcodes Available In Our Plugin', TGDPRCL_DOMAIN); ?></h3>
        </div>
        <hr/>
        <div class="tgdprc_main_function_wrap">
            <p><strong><?php echo __('Terms & Condition Accept Button', TGDPRCL_DOMAIN); ?></strong>: [tgdprc-terms-conditions] </p>
        </div>
        <div class="tgdprc_main_function_wrap">
            <p><strong><?php echo __('Policies Accept Button', TGDPRCL_DOMAIN); ?></strong>: [tgdprc-policies] </p>
        </div>
        <div class="tgdprc_main_function_wrap">
            <p><strong><?php echo __('Displaying All Lists of Services', TGDPRCL_DOMAIN); ?></strong>: [tgdprc-cookies-used] </p>
        </div>
        <div class="tgdprc_main_function_wrap">
            <p><strong><?php echo __('Advanced User Cookie Control Setting', TGDPRCL_DOMAIN); ?></strong>: [tgdprc-advanced-cookie-setting]</p>
        </div>
        <div class="tgdprc_main_function_wrap">
            <p><strong><?php echo __('User Data Form Setting', TGDPRCL_DOMAIN); ?></strong>: [tgdprc-userdata-form]</p>
        </div>
    </form>
</div>
<div id="tgdprcl-postbox-container-1" class="tgdprcl-postbox-container">
    <?php include(TGDPRCL_PATH . 'inc/backend/tgdprcl-sidebar.php'); ?>
</div>