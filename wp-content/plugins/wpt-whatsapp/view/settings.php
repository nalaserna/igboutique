<?php

/**
 * Controller: settings.php
 */

/* Stop immediately if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function wptwa_displayAvailabilityOptions ( $time, $value ) {
	$limit = 'hour' === $time ? 23 : 59;
	
	for ( $i = 0; $i <= $limit; $i++ ) {
		$text_number = strlen( $i ) < 2 ? '0' . $i : $i;
		$selected = intval( $value) === $i ? 'selected' : '';
		echo '<option value="' . $text_number . '" ' . $selected . '>' . $text_number . '</option>';
	}
	
}

function wptwa_displayAccounts (
	$id = '',
	$number = '',
	$name = '',
	$title = '',
	$picture_url = '',
	$auto_text = '',
	$hour_start = '00',
	$minute_start = '00',
	$hour_end = '23',
	$minute_end = '59',
	$sunday = 'on',
	$monday = 'on',
	$tuesday = 'on',
	$wednesday = 'on',
	$thursday = 'on',
	$friday = 'on',
	$saturday = 'on'
	) {
	
	$id = '' !== $id ? filter_var( $id, FILTER_SANITIZE_NUMBER_INT ) : '#id#';
	$number = '' !== $id ? sanitize_text_field( $number ) : '';
	$name = '' !== $id ? sanitize_text_field( $name ) : '';
	$title = '' !== $id ? sanitize_text_field( $title ) : '';
	$picture_url = '' !== $id ? sanitize_text_field( $picture_url ) : '';
	$auto_text = '' !== $id ? sanitize_text_field( $auto_text ) : '';
	
	$hour_start = '' !== $id ? sanitize_text_field( $hour_start ) : '9';
	$minute_start = '' !== $id ? sanitize_text_field( $minute_start ) : '';
	$hour_end = '' !== $id ? sanitize_text_field( $hour_end ) : '17';
	$minute_end = '' !== $id ? sanitize_text_field( $minute_end ) : '';
	
	$sunday = '' !== $id ? sanitize_text_field( $sunday ) : 'on';
	$monday = '' !== $id ? sanitize_text_field( $monday ) : 'on';
	$tuesday = '' !== $id ? sanitize_text_field( $tuesday ) : 'on';
	$wednesday = '' !== $id ? sanitize_text_field( $wednesday ) : 'on';
	$thursday = '' !== $id ? sanitize_text_field( $thursday ) : 'on';
	$friday = '' !== $id ? sanitize_text_field( $friday ) : 'on';
	$saturday = '' !== $id ? sanitize_text_field( $saturday ) : 'on';
	
	?>
	<table class="form-table wptwa-account-item">
		<tbody>
			<tr>
				<th scope="row"><label for="account[<?php echo $id; ?>][number]"><?php esc_html_e( 'WhatsApp Number or Group Chat URL', 'wptwa' ); ?></label></th>
				<td>
					<input type="text" id="account[<?php echo $id; ?>][number]" name="account[<?php echo $id; ?>][number]" value="<?php echo $number; ?>" class="regular-text" />
					<p class="description"><?php printf( esc_html__( 'This field is required. Either a WhatsApp number or a Group Chat URL. If it is a WhatsApp number, it should be in international format. Refer to %s for a detailed explanation.', 'wptwa' ), '<br/><a href="https://faq.whatsapp.com/en/general/21016748" target="_blank">https://faq.whatsapp.com/en/general/21016748</a>' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="account[<?php echo $id; ?>][name]"><?php esc_html_e( 'Name', 'wptwa' ); ?></label></th>
				<td>
					<input type="text" id="account[<?php echo $id; ?>][name]" name="account[<?php echo $id; ?>][name]" value="<?php echo $name; ?>" class="regular-text" />
					<p class="description"><?php esc_html_e( 'Name is also required. If left blank, this account will not be saved.', 'wptwa' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="account[<?php echo $id; ?>][title]"><?php esc_html_e( 'Title', 'wptwa' ); ?></label></th>
				<td>
					<input type="text" id="account[<?php echo $id; ?>][title]" name="account[<?php echo $id; ?>][title]" value="<?php echo $title; ?>" class="regular-text" />
					<p class="description"><?php esc_html_e( 'Title will be displayed above Name.', 'wptwa' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="account[<?php echo $id; ?>][picture_url]"><?php esc_html_e( 'Picture', 'wptwa' ); ?></label></th>
				<td>
					<input type="text" id="account[<?php echo $id; ?>][picture_url]" name="account[<?php echo $id; ?>][picture_url]" value="<?php echo $picture_url; ?>" data-button-text="<?php esc_attr_e( 'Choose Picture', 'wptwa' ); ?>" class="regular-text media-picker" />
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="account[<?php echo $id; ?>][auto_text]"><?php esc_html_e( 'Auto Text', 'wptwa' ); ?></label></th>
				<td>
					<input type="text" id="account[<?php echo $id; ?>][auto_text]" name="account[<?php echo $id; ?>][auto_text]" value="<?php echo $auto_text; ?>" class="regular-text" />
					<p class="description"><?php esc_html_e( 'This text will pre-populate the chat textfield.', 'wptwa' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label><?php esc_html_e( 'Time Availability', 'wptwa' ); ?></label></th>
				<td>
					<p><?php esc_html_e( 'Set the time in which the account should be displayed.', 'wptwa' ); ?></p>
					<p>
						<select name="account[<?php echo $id; ?>][hour_start]" id="account[<?php echo $id; ?>][hour_start]">
							<?php wptwa_displayAvailabilityOptions( 'hour', $hour_start ); ?>
						</select> :
						<select name="account[<?php echo $id; ?>][minute_start]" id="account[<?php echo $id; ?>][minute_start]">
							<?php wptwa_displayAvailabilityOptions( 'minute', $minute_start ); ?>
						</select> to
						<select name="account[<?php echo $id; ?>][hour_end]" id="account[<?php echo $id; ?>][hour_end]">
							<?php wptwa_displayAvailabilityOptions( 'hour', $hour_end ); ?>
						</select> :
						<select name="account[<?php echo $id; ?>][minute_end]" id="account[<?php echo $id; ?>][minute_end]">
							<?php wptwa_displayAvailabilityOptions( 'minute', $minute_end ); ?>
						</select>
					</p>
					<?php if ( '' === trim( get_option( 'timezone_string' ) ) ) : ?>
						
						<p><a href="options-general.php"><?php esc_html_e( 'Please set your time zone first so we can have an accurate time availability.', 'wptwa' ); ?></a></p>
						
					<?php else : ?>
						
						<p class="description"><?php printf( esc_html__( 'Note that the timezone currently in use is %s', 'wptwa' ), '<a href="options-general.php#timezone_string" target="_blank">' . get_option( 'timezone_string' ) . '</a>' ); ?></p>
						
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label><?php esc_html_e( 'Day Availability', 'wptwa' ); ?></label></th>
				<td>
					<p><?php esc_html_e( 'Check the days in which the account should be displayed.', 'wptwa' ); ?></p>
					<p><input type="checkbox" id="account[<?php echo $id; ?>][sunday]" name="account[<?php echo $id; ?>][sunday]" <?php echo 'on' === $sunday ? 'checked' : ''; ?> /> <label for="account[<?php echo $id; ?>][sunday]"><?php esc_html_e( 'Sunday', 'wptwa' ); ?></label></p>
					<p><input type="checkbox" id="account[<?php echo $id; ?>][monday]" name="account[<?php echo $id; ?>][monday]" <?php echo 'on' === $monday ? 'checked' : ''; ?> /> <label for="account[<?php echo $id; ?>][monday]"><?php esc_html_e( 'Monday', 'wptwa' ); ?></label></p>
					<p><input type="checkbox" id="account[<?php echo $id; ?>][tuesday]" name="account[<?php echo $id; ?>][tuesday]" <?php echo 'on' === $tuesday ? 'checked' : ''; ?> /> <label for="account[<?php echo $id; ?>][tuesday]"><?php esc_html_e( 'Tuesday', 'wptwa' ); ?></label></p>
					<p><input type="checkbox" id="account[<?php echo $id; ?>][wednesday]" name="account[<?php echo $id; ?>][wednesday]" <?php echo 'on' === $wednesday ? 'checked' : ''; ?> /> <label for="account[<?php echo $id; ?>][wednesday]"><?php esc_html_e( 'Wednesday', 'wptwa' ); ?></label></p>
					<p><input type="checkbox" id="account[<?php echo $id; ?>][thursday]" name="account[<?php echo $id; ?>][thursday]" <?php echo 'on' === $thursday ? 'checked' : ''; ?> /> <label for="account[<?php echo $id; ?>][thursday]"><?php esc_html_e( 'Thursday', 'wptwa' ); ?></label></p>
					<p><input type="checkbox" id="account[<?php echo $id; ?>][friday]" name="account[<?php echo $id; ?>][friday]" <?php echo 'on' === $friday ? 'checked' : ''; ?> /> <label for="account[<?php echo $id; ?>][friday]"><?php esc_html_e( 'Friday', 'wptwa' ); ?></label></p>
					<p><input type="checkbox" id="account[<?php echo $id; ?>][saturday]" name="account[<?php echo $id; ?>][saturday]" <?php echo 'on' === $saturday ? 'checked' : ''; ?> /> <label for="account[<?php echo $id; ?>][saturday]"><?php esc_html_e( 'Saturday', 'wptwa' ); ?></label></p>
					
					<?php if ( 	'on' !== $sunday &&
								'on' !== $monday &&
								'on' !== $tuesday &&
								'on' !== $wednesday &&
								'on' !== $thursday &&
								'on' !== $friday &&
								'on' !== $saturday ) : ?>
						
						<p class="wptwa-warning"><?php esc_html_e( 'Day availability should at least have one day checked.', 'wptwa' ); ?></p>
						
					<?php endif; ?>
					
					<div class="wptwa-account-actions wptwa-clearfix">
						<a href="#" class="wptwa-remove-account"><?php esc_html_e( 'Remove this account', 'wptwa' ); ?></a>
						<div class="wptwa-queue-buttons">
							<span class="wptwa-move-up" title="<?php esc_attr_e( 'Move up', 'wptwa' ); ?>"><i class="dashicons dashicons-arrow-up-alt2"></i></span><!--
							--><span class="wptwa-move-down" title="<?php esc_attr_e( 'Move down', 'wptwa' ); ?>"><i class="dashicons dashicons-arrow-down-alt2"></i></span>
						</div>
					</div>
					
				</td>
			</tr>
		</tbody>
	</table>
	<?php
	
}

$target = json_decode( WPTWA_Utils::getSetting( 'target' ) );
$target = is_array( $target ) ? $target : array();

$included_ids = json_decode( WPTWA_Utils::getSetting( 'included_ids' ) );
$included_html = '';

if ( count( $included_ids ) > 0 ) {
	global $post;
	$included_posts = get_posts( array(
		'posts_per_page' => -1,
		'post__in' => $included_ids,
		'post_type' => 'any'
	) );

	foreach ( $included_posts as $post ) {
		setup_postdata( $post );
		
		$included_html.= '
		<li id="wptwa-included-' . get_the_ID() . '">
			<p class="wptwa-title">' . get_the_title() . '</p>
			<p class="wptwa-permalink"><a href="' . esc_url( get_the_permalink() ) . '" target="_blank">' . esc_url( get_the_permalink() ) . '</a></p>
			<span class="dashicons dashicons-no"></span>
			<input type="hidden" name="included[]" value="' . get_the_ID() . '"/>
		</li>';
		
	}
	wp_reset_postdata();
}

$excluded_ids = json_decode( WPTWA_Utils::getSetting( 'excluded_ids' ) );
$excluded_html = '';

if ( count( $excluded_ids ) > 0 ) {
	global $post;
	$excluded_posts = get_posts( array(
		'posts_per_page' => -1,
		'post__in' => $excluded_ids,
		'post_type' => 'any'
	) );

	foreach ( $excluded_posts as $post ) {
		setup_postdata( $post );
		
		$excluded_html.= '
		<li id="wptwa-excluded-' . get_the_ID() . '">
			<p class="wptwa-title">' . get_the_title() . '</p>
			<p class="wptwa-permalink"><a href="' . esc_url( get_the_permalink() ) . '" target="_blank">' . esc_url( get_the_permalink() ) . '</a></p>
			<span class="dashicons dashicons-no"></span>
			<input type="hidden" name="excluded[]" value="' . get_the_ID() . '"/>
		</li>';
		
	}
	wp_reset_postdata();
}

$box_position = '' === WPTWA_Utils::getSetting( 'box_position' ) ? 'right' : WPTWA_Utils::getSetting( 'box_position' );

?>
<div class="wrap">
	<h1><?php esc_html_e( 'WhatsApp Click to Chat Settings', 'wptwa' ); ?></h1>
	
	<?php settings_errors(); ?>
	
	<form action="" method="post" novalidate="novalidate">
		
		<h2><?php esc_html_e( 'Display Settings', 'wptwa' ); ?></h2>
		
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="toggle_text"><?php esc_html_e( 'Toggle Text', 'wptwa' ); ?></label></th>
					<td>
						<input name="toggle_text" type="text" id="toggle_text" class="regular-text" value="<?php echo esc_attr( WPTWA_Utils::getSetting( 'toggle_text' ) ); ?>">
						<p class="description"><?php esc_html_e( "If left blank, the toggle will be round regardless of the Toggle Type by Device fields' values.", "wptwa" );?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="toggle_text_color"><?php esc_html_e( 'Toggle Text Color', 'wptwa' ); ?></label></th>
					<td>
						<input name="toggle_text_color" type="text" id="toggle_text_color" class="minicolors" value="<?php echo esc_attr( WPTWA_Utils::getSetting( 'toggle_text_color' ) ); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="toggle_background_color"><?php esc_html_e( 'Toggle Background Color', 'wptwa' ); ?></label></th>
					<td>
						<input name="toggle_background_color" type="text" id="toggle_background_color" class="minicolors" value="<?php echo esc_attr( WPTWA_Utils::getSetting( 'toggle_background_color' ) ); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row"><label><?php esc_html_e( 'Toggle Type by Device', 'wptwa' ); ?></label></th>
					<td>
						<p><input name="toggle_round_on_desktop" type="checkbox" id="toggle_round_on_desktop" value="on" <?php echo 'on' === WPTWA_Utils::getSetting( 'toggle_round_on_desktop' ) ? 'checked' : ''; ?>> <label for="toggle_round_on_desktop"><?php esc_html_e( 'Show rounded toggle on desktop', 'wptwa' ); ?></label></p>
						<p><input name="toggle_round_on_mobile" type="checkbox" id="toggle_round_on_mobile" value="on" <?php echo 'on' === WPTWA_Utils::getSetting( 'toggle_round_on_mobile' ) ? 'checked' : ''; ?>> <label for="toggle_round_on_mobile"><?php esc_html_e( 'Show rounded toggle on mobile', 'wptwa' ); ?></label></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="description"><?php esc_html_e( 'Description', 'wptwa' ); ?></label></th>
					<td>
						<textarea name="description" id="description" cols="30" rows="3" class="regular-text"><?php echo stripslashes( WPTWA_Utils::getSetting( 'description' ) ); ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="container_text_color"><?php esc_html_e( 'Container Text Color', 'wptwa' ); ?></label></th>
					<td>
						<input name="container_text_color" type="text" id="container_text_color" class="minicolors" value="<?php echo esc_attr( WPTWA_Utils::getSetting( 'container_text_color' ) ); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="container_background_color"><?php esc_html_e( 'Container Background Color', 'wptwa' ); ?></label></th>
					<td>
						<input name="container_background_color" type="text" id="container_background_color" class="minicolors" value="<?php echo esc_attr( WPTWA_Utils::getSetting( 'container_background_color' ) ); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="account_hover_background_color"><?php esc_html_e( 'Account Item Background Color on Hover', 'wptwa' ); ?></label></th>
					<td>
						<input name="account_hover_background_color" type="text" id="account_hover_background_color" class="minicolors" value="<?php echo esc_attr( WPTWA_Utils::getSetting( 'account_hover_background_color' ) ); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="account_hover_text_color"><?php esc_html_e( 'Account Item Text Color on Hover', 'wptwa' ); ?></label></th>
					<td>
						<input name="account_hover_text_color" type="text" id="account_hover_text_color" class="minicolors" value="<?php echo esc_attr( WPTWA_Utils::getSetting( 'account_hover_text_color' ) ); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="border_color_between_accounts"><?php esc_html_e( 'Border Color Between Accounts', 'wptwa' ); ?></label></th>
					<td>
						<input name="border_color_between_accounts" type="text" id="border_color_between_accounts" class="minicolors" value="<?php echo esc_attr( WPTWA_Utils::getSetting( 'border_color_between_accounts' ) ); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="container_max_width"><?php esc_html_e( 'Container Maximum Width', 'wptwa' ); ?></label></th>
					<td>
						<input name="container_max_width" type="number" min="360" max="620" id="container_max_width" value="<?php echo filter_var( WPTWA_Utils::getSetting( 'container_max_width' ), FILTER_SANITIZE_NUMBER_INT ); ?>"> <?php esc_html_e( 'px', 'wptwa' ); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="box_position"><?php esc_html_e( 'Box Position', 'wptwa' ); ?></label></th>
					<td>
						<p><input type="radio" name="box_position" value="left" id="box_position_left" <?php echo 'left' === $box_position ? 'checked' : ''; ?> /> <label for="box_position_left"><?php esc_html_e( 'Bottom Left', 'wptwa' ); ?></label></p>
						<p><input type="radio" name="box_position" value="right" id="box_position_right" <?php echo 'right' === $box_position ? 'checked' : ''; ?> /> <label for="box_position_right"><?php esc_html_e( 'Bottom Right', 'wptwa' ); ?></label></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for=""><?php esc_html_e( 'Display based on screen width', 'wptwa' ); ?></label></th>
					<td>
						<p><input type="checkbox" name="hide_on_large_screen" value="on" id="hide_on_large_screen" <?php echo 'on' === WPTWA_Utils::getSetting( 'hide_on_large_screen' ) ? 'checked' : ''; ?> /> <label for="hide_on_large_screen"><?php esc_html_e( 'Hide on large screen (wider than 782px)', 'wptwa' ); ?></label></p>
						<p><input type="checkbox" name="hide_on_small_screen" value="on" id="hide_on_small_screen" <?php echo 'on' === WPTWA_Utils::getSetting( 'hide_on_small_screen' ) ? 'checked' : ''; ?> /> <label for="hide_on_small_screen"><?php esc_html_e( 'Hide on small screen (narrower than 783px)', 'wptwa' ); ?></label></p>
					</td>
				</tr>
			</tbody>
		</table>
		
		<h2><?php esc_html_e( 'Load-in Settings', 'wptwa' ); ?></h2>
		
		<p class="description"><?php esc_html_e( 'The fields below should have a numeric value of more than 0 for the feature to work.', 'wptwa' ); ?></p>
		
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="delay_time"><?php esc_html_e( 'Delay Time', 'wptwa' ); ?></label></th>
					<td>
						<input name="delay_time" type="number" min="0" max="999" id="delay_time" value="<?php echo filter_var( WPTWA_Utils::getSetting( 'delay_time' ), FILTER_SANITIZE_NUMBER_INT ); ?>"> <?php esc_html_e( 'second(s)', 'wptwa' ); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="inactivity_time"><?php esc_html_e( 'Inactivity Time', 'wptwa' ); ?></label></th>
					<td>
						<input name="inactivity_time" type="number" min="0" max="999" id="inactivity_time" value="<?php echo filter_var( WPTWA_Utils::getSetting( 'inactivity_time' ), FILTER_SANITIZE_NUMBER_INT ); ?>"> <?php esc_html_e( 'second(s)', 'wptwa' ); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="scroll_length"><?php esc_html_e( 'Scroll Length', 'wptwa' ); ?></label></th>
					<td>
						<input name="scroll_length" type="number" min="0" max="100" id="scroll_length" value="<?php echo filter_var( WPTWA_Utils::getSetting( 'scroll_length' ), FILTER_SANITIZE_NUMBER_INT ); ?>">  <?php esc_html_e( '%', 'wptwa' ); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="auto_display_on_mobile"><?php esc_html_e( 'Auto Display on Mobile', 'wptwa' ); ?></label></th>
					<td>
						<input type="checkbox" name="auto_display_on_mobile" id="auto_display_on_mobile" value="on" <?php echo 'on' === WPTWA_Utils::getSetting( 'auto_display_on_mobile' ) ? 'checked' : ''; ?> /> <label for="auto_display_on_mobile"><?php esc_html_e( 'Turn on auto-display on mobile', 'wptwa' ); ?></label>
					</td>
				</tr>
			</tbody>
		</table>
		
		<h2><?php esc_html_e( 'Page Targeting', 'wptwa' ); ?></h2>
		
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php esc_html_e( 'Show on these post types', 'wptwa' ); ?></th>
					<td>
						<p>
							<input type="checkbox" name="target[home]" id="target[home]" value="home" <?php echo in_array( 'home', $target ) ? 'checked' : '' ?> />
							<label for="target[home]"><?php esc_html_e( 'Homepage', 'wptwa' ); ?></label>
						</p>
						<p>
							<input type="checkbox" name="target[blog]" id="target[blog]" value="blog" <?php echo in_array( 'blog', $target ) ? 'checked' : '' ?> />
							<label for="target[blog]"><?php esc_html_e( 'Blog Index', 'wptwa' ); ?></label>
						</p>
						<p>
							<input type="checkbox" name="target[archive]" id="target[archive]" value="archive" <?php echo in_array( 'archive', $target ) ? 'checked' : '' ?> />
							<label for="target[archive]"><?php esc_html_e( 'Archives', 'wptwa' ); ?></label>
						</p>
						<p>
							<input type="checkbox" name="target[page]" id="target[page]" value="page" <?php echo in_array( 'page', $target ) ? 'checked' : '' ?> />
							<label for="target[page]"><?php esc_html_e( 'Pages', 'wptwa' ); ?></label>
						</p>
						<p>
							<input type="checkbox" name="target[post]" id="target[post]" value="post" <?php echo in_array( 'post', $target ) ? 'checked' : '' ?> />
							<label for="target[post]"><?php esc_html_e( 'Blog posts', 'wptwa' ); ?></label>
						</p>
						<?php foreach ( get_post_types( array( '_builtin' => false ), 'objects' ) as $post_type ) : ?>
						<p>
							<input type="checkbox" name="target[<?php echo $post_type->name; ?>]" id="target[<?php echo $post_type->name; ?>]" value="<?php echo $post_type->name; ?>" <?php echo in_array( $post_type->name, $target ) ? 'checked' : '' ?>/>
							<label for="target[<?php echo $post_type->name; ?>]"><?php echo esc_html( $post_type->label ); ?></label>
						</p>
						<?php endforeach; ?>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php esc_html_e( 'Include Pages' , 'wptwa'); ?></th>
					<td>
						<div class="wptwa-search-posts">
							<input type="text" class="regular-text" placeholder="<?php esc_attr_e( 'Type the title of page/post to include', 'wptwa' ); ?>" data-nonce="<?php echo wp_create_nonce( 'wptwa-search-nonce' ); ?>" />
							<div class="wptwa-search-result">
								<ul></ul>
							</div>
						</div>
						<p class="wptwa-listing-info"><span><?php esc_html_e( 'Included pages:', 'wptwa' ); ?></span></p>
						
						<ul class="wptwa-inclusion wptwa-included-posts" data-delete-label="<?php esc_attr_e( 'Delete', 'wptwa' ); ?>">
							<?php echo $included_html; ?>
							<li class="wptwa-placeholder"><?php esc_html_e( 'No specific page is included.', 'wptwa' ); ?></li>
						</ul>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'Exclude Pages' , 'wptwa'); ?></th>
					<td>
						<div class="wptwa-search-posts">
							<input type="text" class="regular-text" placeholder="<?php esc_attr_e( 'Type the title of page/post to exclude', 'wptwa' ); ?>" data-nonce="<?php echo wp_create_nonce( 'wptwa-search-nonce' ); ?>" />
							<div class="wptwa-search-result">
								<ul></ul>
							</div>
						</div>
						<p class="wptwa-listing-info"><span><?php esc_html_e( 'Excluded pages:', 'wptwa' ); ?></span></p>
						
						<ul class="wptwa-inclusion wptwa-excluded-posts" data-delete-label="<?php esc_attr_e( 'Delete', 'wptwa' ); ?>">
							<?php echo $excluded_html; ?>
							<li class="wptwa-placeholder"><?php esc_html_e( 'None. All pages from checked post types above are included.', 'wptwa' ); ?></li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>
		
		<h2 id="wc-button-settings"><?php esc_html_e( 'WooCommerce Product Page Button', 'wptwa' ); ?></h2>
		<p class="description"><?php esc_html_e( 'Set a default value for the button on WooCommerce product page. This feature only works when WhatsApp Number field is set.', 'wptwa' ); ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="wc_account_number"><?php esc_html_e( 'WhatsApp Number', 'wptwa' ); ?></label></th>
					<td><input type="text" id="wc_account_number" class="regular-text" name="wc_account_number" value="<?php echo sanitize_text_field( WPTWA_Utils::getSetting( 'wc_account_number' ) ); ?>"/></td>
				</tr>
				<tr>
					<th scope="row"><label for="wc_button_text_label"><?php esc_html_e( 'Button Text Label', 'wptwa' ); ?></label></th>
					<td><input name="wc_button_text_label" type="text" id="wc_button_text_label" class="regular-text" value="<?php echo sanitize_text_field( WPTWA_Utils::getSetting( 'wc_button_text_label' ) ); ?>"></td>
				</tr>
				<tr>
					<th scope="row"><label for="wc_button_auto_text"><?php esc_html_e( 'Button Auto Text', 'wptwa' ); ?></label></th>
					<td>
						<input name="wc_button_auto_text" type="text" id="wc_button_auto_text" class="regular-text" value="<?php echo sanitize_text_field( WPTWA_Utils::getSetting( 'wc_button_auto_text' ) ); ?>">
						<p class="description"><?php esc_html_e( 'Using the shortcode [product_title] in the textbox will get the product title automatically for each product.', 'wptwa' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="wc_button_position"><?php esc_html_e( 'Button Position', 'wptwa' ); ?></label></th>
					<td>
						<select name="wc_button_position" id="wc_button_position">
							<option value="after_description" <?php selected( WPTWA_Utils::getSetting( 'wc_button_position' ), 'after_description' ); ?>><?php esc_html_e( 'After Product Description', 'wptwa' ); ?></option>
							<option value="above" <?php selected( WPTWA_Utils::getSetting( 'wc_button_position' ), 'above' ); ?>><?php esc_html_e( 'Above Add to Cart Button', 'wptwa' ); ?></option>
							<option value="below" <?php selected( WPTWA_Utils::getSetting( 'wc_button_position' ), 'below' ); ?>><?php esc_html_e( 'Below Add to Cart Button', 'wptwa' ); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="wc_button_background_color"><?php esc_html_e( 'Button Background Color', 'wptwa' ); ?></label></th>
					<td><input name="wc_button_background_color" type="text" id="wc_button_background_color" class="minicolors" value="<?php echo sanitize_text_field( WPTWA_Utils::getSetting( 'wc_button_background_color' ) ); ?>"></td>
				</tr>
				<tr>
					<th scope="row"><label for="wc_button_text_color"><?php esc_html_e( 'Button Text Color', 'wptwa' ); ?></label></th>
					<td><input name="wc_button_text_color" type="text" id="wc_button_text_color" class="minicolors" value="<?php echo sanitize_text_field( WPTWA_Utils::getSetting( 'wc_button_text_color' ) ); ?>"></td>
				</tr>
				<tr>
					<th scope="row"><label for="wc_button_background_color_on_hover"><?php esc_html_e( 'Button Background Color on Hover', 'wptwa' ); ?></label></th>
					<td><input name="wc_button_background_color_on_hover" type="text" id="wc_button_background_color_on_hover" class="minicolors" value="<?php echo sanitize_text_field( WPTWA_Utils::getSetting( 'wc_button_background_color_on_hover' ) ); ?>"></td>
				</tr>
				<tr>
					<th scope="row"><label for="wc_button_text_color_on_hover"><?php esc_html_e( 'Button Text Color on Hover', 'wptwa' ); ?></label></th>
					<td><input name="wc_button_text_color_on_hover" type="text" id="wc_button_text_color_on_hover" class="minicolors" value="<?php echo sanitize_text_field( WPTWA_Utils::getSetting( 'wc_button_text_color_on_hover' ) ); ?>"></td>
				</tr>
			</tbody>
		</table>
		
		<h2><?php esc_html_e( 'WhatsApp Accounts', 'wptwa' ); ?></h2>
		<div class="wptwa-account-items">
		
			<?php
			
			/* Loop through all accounts and display the HTML */
			
			$accounts = json_decode( WPTWA_Utils::getSetting( 'accounts' ), true );
			$accounts = is_array( $accounts ) ? $accounts : array();
			foreach ( $accounts as $k => $v ) {
				
				$number = esc_attr( $v['number'] );
				$name = esc_attr( $v['name'] );
				$title = esc_attr( $v['title'] );
				$picture_url = esc_url( $v['picture_url'] );
				$auto_text = esc_attr( $v['auto_text'] );
				
				$hour_start = filter_var( $v['hour_start'], FILTER_SANITIZE_NUMBER_INT );
				$minute_start = filter_var( $v['minute_start'], FILTER_SANITIZE_NUMBER_INT );
				$hour_end = filter_var( $v['hour_end'], FILTER_SANITIZE_NUMBER_INT );
				$minute_end = filter_var( $v['minute_end'], FILTER_SANITIZE_NUMBER_INT );
				
				$sunday = esc_attr( $v['sunday'] );
				$monday = esc_attr( $v['monday'] );
				$tuesday = esc_attr( $v['tuesday'] );
				$wednesday = esc_attr( $v['wednesday'] );
				$thursday = esc_attr( $v['thursday'] );
				$friday = esc_attr( $v['friday'] );
				$saturday = esc_attr( $v['saturday'] );
				
				wptwa_displayAccounts( $k, $number, $name, $title, $picture_url, $auto_text, $hour_start, $minute_start, $hour_end, $minute_end, $sunday, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday );
			}
			
			?>
		
		</div>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"></th>
					<td>
						<span class="wptwa-add-account button"><?php esc_html_e( 'Add Account', 'wptwa' ); ?></span>
					</td>
				</tr>
			</tbody>
		</table>
		
		<?php wp_nonce_field( 'wptwa_settings_form', 'wptwa_settings_form_nonce' ); ?>
		<input type="hidden" name="wptwa_settings" value="submit" />
		<input type="hidden" name="submit" value="submit" />
		<p class="submit"><input type="submit" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'wptwa' ); ?>"></p>
		
	</form>
</div>

<template id="account-item">
	<?php wptwa_displayAccounts(); ?>
</template>