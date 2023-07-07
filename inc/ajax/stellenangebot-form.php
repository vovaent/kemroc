<?php
/**
 * Stellenangebot form processing
 * 
 * @package kemroc 
 */

/**
 * Ajax_stellenangebot_action_callback
 */
function kemroc_ajax_stellenangebot_action_callback() {
	if ( isset( $_POST['nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'stellenangebot-nonce' ) ) {
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
	
	$uploaded_file_path = '';
	if ( isset( $_FILES['resume'] ) ) {
		$resume_file =  $_FILES['resume']; //phpcs:ignore

		if ( isset( $_FILES['resume']['error'] ) && 0 < $resume_file['error'] ) {
			$err_message['resume'] = sanitize_text_field( wp_unslash( $resume_file['error'] ) );
		} else {
			$upload_dir       = wp_upload_dir();
			$uploads_path     = $upload_dir['path'];
			$file_path        = $uploads_path . '/' . sanitize_text_field( wp_unslash( $resume_file['name'] ) );
			$file_is_uploaded = move_uploaded_file( 
				sanitize_text_field( 
					wp_unslash( $resume_file['tmp_name'] ) 
				), 
				$file_path 
			);

			if ( $file_is_uploaded ) {
				$uploaded_file_path = $file_path;
			}
		}
	}
	
	if ( $err_message ) {
		wp_send_json_error( $err_message );
	} else {   
		if ( isset( $_POST['custom_email_to'] ) ) {
			$email_to = sanitize_textarea_field( wp_unslash( $_POST['custom_email_to'] ) );
		} else {
			$email_to = get_option( 'admin_email' );
		}

		$site_url = get_site_url();

		$body  = esc_html__( 'Name', 'kemroc' ) . ": $name \n";
		$body .= esc_html__( 'Telefon', 'kemroc' ) . ": $phone \n";
		$body .= esc_html__( 'E-Mail', 'kemroc' ) . ": $email \n";
		$body .= esc_html__( 'Website url', 'kemroc' ) . ": $site_url";

		$headers = 'From: ' . $name . ' < ' . $email_to . ' > ' . "\r\n" . 'Reply - To: ' . $email_to;
		
		$mail_is_send = wp_mail( $email_to, esc_html__( 'Reaktion auf die freie Stelle', 'kemroc' ), $body, $headers, $uploaded_file_path );

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
	add_action( 'wp_ajax_stellenangebot_action', 'kemroc_ajax_stellenangebot_action_callback' );
	add_action( 'wp_ajax_nopriv_stellenangebot_action', 'kemroc_ajax_stellenangebot_action_callback' );
}
