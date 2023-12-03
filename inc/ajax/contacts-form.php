<?php
/**
 * Contacts form processing
 * 
 * @package kemroc 
 */

/**
 * Ajax_contacts_action_callback
 */
function kemroc_ajax_contacts_action_callback() {
	if ( isset( $_POST['nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'contacts-nonce' ) ) {
		wp_die( esc_html__( 'Daten, die von einer fremden Adresse gesendet werden', 'kemroc' ) );
	}

	if ( isset( $_POST['anticheck'] ) && false === $_POST['anticheck'] || ! empty( $_POST['submitted'] ) ) {
		wp_die( esc_html__( 'Spam', 'kemroc' ) );
	}

	$err_message = array();
	$email_reg   = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';

	if ( ! isset( $_POST['agree'] ) ) {
		$err_message['agree'] = 'empty';
	}

	if ( empty( $_POST['name'] ) || ! isset( $_POST['name'] ) ) {
		$err_message['name'] = 'empty';
	} else {
		$name = sanitize_text_field( wp_unslash( $_POST['name'] ) );
	}

	if ( empty( $_POST['phone'] ) || ! isset( $_POST['phone'] ) ) {
		$err_message['phone'] = 'empty';
	} else {
		$phone = sanitize_text_field( wp_unslash( $_POST['phone'] ) );
	}

	if ( empty( $_POST['email'] ) || ! isset( $_POST['email'] ) ) {
		$err_message['email'] = 'empty';
	} elseif ( ! preg_match(
		$email_reg,
		sanitize_text_field( wp_unslash( $_POST['email'] ) )
	) ) {
		$err_message['email'] = 'invalidEmail';
	} else {
		$email = sanitize_email( wp_unslash( $_POST['email'] ) );

	}
	
	if ( empty( $_POST['subject'] ) || ! isset( $_POST['subject'] ) ) {
		$err_message['subject'] = 'empty';
	} else {
		$subject = sanitize_text_field( wp_unslash( $_POST['subject'] ) );
	}

	if ( empty( $_POST['message'] ) || ! isset( $_POST['message'] ) ) {
		$err_message['message'] = 'empty';
	} else {
		$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ) );
	}

	if ( $err_message ) {
		wp_send_json_error( $err_message );
	} else {
		$street = '';
		if ( isset( $_POST['street'] ) ) {
			$street = sanitize_textarea_field( wp_unslash( $_POST['street'] ) );
		}
		$house = '';
		if ( isset( $_POST['house'] ) ) {
			$house = sanitize_textarea_field( wp_unslash( $_POST['house'] ) );
		}
		$zip_code = '';
		if ( isset( $_POST['zip_code'] ) ) {
			$zip_code = sanitize_textarea_field( wp_unslash( $_POST['zip_code'] ) );
		}
		$location = '';
		if ( isset( $_POST['location'] ) ) {
			$location = sanitize_textarea_field( wp_unslash( $_POST['location'] ) );
		}
		$company = '';
		if ( isset( $_POST['company'] ) ) {
			$company = sanitize_textarea_field( wp_unslash( $_POST['company'] ) );
		}
		$add_phone = '';
		if ( isset( $_POST['add_phone'] ) ) {
			$add_phone = sanitize_textarea_field( wp_unslash( $_POST['add_phone'] ) );
		}
		$fax = '';
		if ( isset( $_POST['fax'] ) ) {
			$fax = sanitize_textarea_field( wp_unslash( $_POST['fax'] ) );
		}

		$recipient_email_address = get_field( 'recipient_email_address', 'option' );
		
		if ( isset( $_POST['custom_email_to'] ) ) {
			$email_to = sanitize_textarea_field( wp_unslash( $_POST['custom_email_to'] ) );
		} elseif ( $recipient_email_address ) {
			$email_to = $recipient_email_address;
		} else {
			$email_to = get_option( 'admin_email' );
		}

		$site_url = get_site_url();

		$body    = esc_html__( 'Name', 'kemroc' ) . ": $name \n";
		$body   .= esc_html__( 'Straße', 'kemroc' ) . ": $street \n";
		$body   .= esc_html__( 'Hausnummer', 'kemroc' ) . ": $house \n";
		$body   .= esc_html__( 'PLZ', 'kemroc' ) . ": $zip_code \n";
		$body   .= esc_html__( 'Ort', 'kemroc' ) . ": $location \n";
		$body   .= esc_html__( 'Unternehmen', 'kemroc' ) . ": $company \n";
		$body   .= esc_html__( 'Telefon', 'kemroc' ) . ": $phone \n";
		$body   .= esc_html__( 'Telefon alternativ', 'kemroc' ) . ": $add_phone \n";
		$body   .= esc_html__( 'E-Mail', 'kemroc' ) . ": $email \n";
		$body   .= esc_html__( 'Fax', 'kemroc' ) . ": $fax \n\n";
		$body   .= esc_html__( 'Betreff', 'kemroc' ) . ": $subject \n";
		$body   .= esc_html__( 'Nachricht', 'kemroc' ) . ": $message\n\n";
		$body   .= esc_html__( 'Website url', 'kemroc' ) . ": $site_url";
		$headers = 'From: ' . $name . ' < ' . $email_to . ' > ' . "\r\n" . 'Reply - To: ' . $email_to;

		$mail_is_send = wp_mail( $email_to, $subject, $body, $headers );

		if ( $mail_is_send ) {
			$mes_success = array(
				'mes'    => esc_html__( 'Daten erfolgreich gesendet', 'kemroc' ),
				'letter' => $body,
			);
			wp_send_json_success( $mes_success );
		} else {
			wp_send_json_error( esc_html__( 'Brief nicht abgeschickt', 'kemroc' ) );
		} 
	}

	wp_die();
}

if ( wp_doing_ajax() ) {
	add_action( 'wp_ajax_contacts_action', 'kemroc_ajax_contacts_action_callback' );
	add_action( 'wp_ajax_nopriv_contacts_action', 'kemroc_ajax_contacts_action_callback' );
}
