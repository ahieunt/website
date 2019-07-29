<?php


class Better_Social_Counter_Vimeo_API implements Better_Social_Counter_Service_Interface {

	/**
	 * @var string
	 */
	public $tokens = array(
		'f8ef92f31c737be59223b8448c9c1045',
		'e3ac7d85daf38bc652890e6d1dae9b06',
		'f0971d776f10b153b9dea8b19f836f1e',
	);

	/**
	 * @var Better_Social_Counter_Data
	 */
	protected $data;


	/**
	 * Get input data
	 *
	 * @param Better_Social_Counter_Data $data
	 *
	 * @return bool
	 */
	public function init( $data ) {

		$this->data = $data;

		return TRUE;
	}


	/**

	 *
	 * @return int
	 */
	public function count() {

		$type  = $this->data->get( 'type' );
		$field = $this->data->get( 'field' );


		$valid       = FALSE;
		$total       = 0;
		$data_fields = array();

		if ( $field === 'total' ) {

			$data_fields[] = 'followers';
			$data_fields[] = 'videos';

		} elseif ( $field === 'videos' ) {

			$data_fields[] = 'videos';

		} else {

			$data_fields[] = 'followers';

		}

		$_check = array(
			'user'    => 'users',
			'channel' => 'channels',
		);

		if ( isset( $_check[ $type ] ) ) {
			$results = $this->request( '/' . $_check[ $type ] . '/' . $this->data->id() );
		}

		foreach ( $data_fields as $field ) {

			if ( $type === 'channel' && $field === 'followers' ) {
				$index = 'users';
			} else {
				$index = $field;
			}

			if ( isset( $results['metadata']['connections'][ $index ]['total'] ) ) {

				$valid = TRUE;
				$total += $results['metadata']['connections'][ $index ]['total'];
			}
		}

		return $valid ? $total : FALSE;
	}


	public function request( $endpoint ) {

		/**
		 * Choose a token
		 */
		$current_token = FALSE;

		foreach ( $this->tokens as $token ) {

			if ( get_transient( 'tk-stat-' . $token ) !== 'disabled' ) {

				$current_token = $token;
				break;
			}
		}

		if ( ! $current_token ) {
			return FALSE;
		}

		$url = 'https://api.vimeo.com/' . ltrim( $endpoint, '/' );

		$response = wp_remote_get( $url, array(
			'headers'   => array(
				'Authorization' => 'Bearer ' . $current_token,
			),
			'sslverify' => FALSE
		) );

		if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {

			return FALSE;
		}

		/**
		 * Temporary disable token if needed
		 */

		$remaining = (int) wp_remote_retrieve_header( $response, 'x-ratelimit-remaining' );

		if ( $remaining < 2 ) {

			$reset = wp_remote_retrieve_header( $response, 'x-ratelimit-reset' );
			$reset = strtotime( $reset ) - time();

			if ( $reset > 0 ) {

				set_transient( 'tk-stat-' . $current_token, 'disabled', $reset );
			}
		}

		$data = wp_remote_retrieve_body( $response );

		return json_decode( $data, TRUE );
	}

	/**
	 * @return string
	 */
	public function link() {

		$link = 'https://vimeo.com/';

		if ( $this->data->get( 'type' ) == 'channel' ) {
			$link .= 'channels/' . $this->data->id();
		} else {
			$link .= $this->data->id();
		}

		return $link;
	}
}