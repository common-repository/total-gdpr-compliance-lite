<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<div class="tgdprc_extra_settings_wrap" style="display: none;">
	
	<div class="tgdprc_extra_settings_header">
		<h3><?php esc_attr_e('Extra Settings',TGDPRCL_DOMAIN); ?></h3>
	</div>

	<div class="tgdprc_extra_settings_body">

		<!-- Next display of the cookie notice -->
		<div class="tgdprc_extra_settings_field">
			<label><?php esc_attr_e('Cookie Expiry',TGDPRCL_DOMAIN) ?></label>
			<select name="extra_settings[extra][cookie_expiry]" class="wpcui-show-after-selector">
			<?php foreach ($options['cookie_expiry'] as $index => $value): ?>
				<option

				value="<?php echo esc_attr($value); ?>"

				<?php
					if (isset($extra_settings['extra']['cookie_expiry']) && $extra_settings['extra']['cookie_expiry'] == $value) {
						echo "selected='selected'";
					}
				?>

				><?php echo ucwords(esc_attr($value)); ?></option>
			<?php endforeach ?>
			</select>
		</div>

		<!-- Next display of the cookie notice in days -->
		<div class="tgdprc_extra_settings_field wpcui-show-after-options">
			<label><?php esc_attr_e('Day',TGDPRCL_DOMAIN) ?></label>
			<input type="number" min="0" name="extra_settings[extra][days]" value="<?php echo (!empty($extra_settings['extra']['days']))?esc_attr($extra_settings['extra']['days']):''; ?>"> <?php esc_attr_e('Days',TGDPRCL_DOMAIN) ?>
		</div>

		<!-- Show Cookie Info on input field -->
		<div class="tgdprc_extra_settings_field">
			<label><?php esc_attr_e('Show Cookie Info on',TGDPRCL_DOMAIN) ?></label>
			<select name="extra_settings[extra][show_cookie_on]" id="wpcui_load_on">
			<?php foreach ($options['show_cookie_on'] as $index => $value): ?>
				<option

				value="<?php echo $value; ?>"

				<?php
					if (isset($extra_settings['extra']['show_cookie_on']) && $extra_settings['extra']['show_cookie_on'] == $value) {
						echo "selected='selected'";
					}
				?>

				><?php echo ucwords($value); ?></option>
			<?php endforeach ?>
			</select>
		</div>

		<!-- Load Delay value -->
		<div class="tgdprc_extra_settings_field wpcui_load_on_options" id="wpcui_load_on_page_load_delay">
			<label><?php esc_attr_e('Load Delay value',TGDPRCL_DOMAIN) ?></label>
			<input type="number" name="extra_settings[extra][delay_value]" min="0" value="<?php echo (!empty($extra_settings['extra']['delay_value']))?esc_attr($extra_settings['extra']['delay_value']):''; ?>"> sec
		</div>

		<!-- Scroll Delay value -->
		<div class="tgdprc_extra_settings_field wpcui_load_on_options" id="wpcui_load_on_page_scroll">
			<label><?php esc_attr_e('Page Scroll value',TGDPRCL_DOMAIN) ?></label>
			<select name="extra_settings[extra][page_scroll]" class="wpcui_scroll_selector">
				<?php foreach ($options['scroll_options'] as $index => $value): ?>
					<option value="<?php echo esc_attr($value); ?>"

						<?php selected((!empty($extra_settings['extra']['page_scroll'])?esc_attr($extra_settings['extra']['page_scroll']):''),$value); ?>

						><?php echo esc_attr(ucwords($value)); ?></option>
				<?php endforeach ?>
			</select>
		</div>

		<!-- Scroll Percentage -->
		<div class="tgdprc_extra_settings_field" id="wpcui_scroll_percentage">
			<label><?php esc_attr_e('Percentage',TGDPRCL_DOMAIN) ?></label>
			<input type="number" min="0" max="100" step="0.01" name="extra_settings[extra][scroll_percentage]" value="<?php echo (!empty($extra_settings['extra']['scroll_percentage']))?esc_attr($extra_settings['extra']['scroll_percentage']):''; ?>"><?php esc_attr_e(" %",TGDPRCL_DOMAIN) ?>
			<i class="additional_field_message"><?php esc_attr_e('Only 2 decimal places accepted',TGDPRCL_DOMAIN) ?></i>
		</div>
		
	</div>
</div>