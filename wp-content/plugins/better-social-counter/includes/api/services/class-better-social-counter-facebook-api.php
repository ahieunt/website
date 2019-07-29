<?php


class Better_Social_Counter_Facebook_API implements Better_Social_Counter_Service_Interface {

	protected $auth = array(

		array(
			'628341623933053',
			'fa85e47820eea0943e270866b82fd6de'
		),

		array(
			'137700946743769',
			'02fbb8b47ef2ab9959eb669969960204'
		),

		array(
			'1371946829525082',
			'7c313e6ca551ee652cbef3becace3fb3'
		),

		array(
			'1796275967299269',
			'21f18e737642e4dd077e5049452b2c7b'
		),

		array(
			'211826695956763',
			'c98034423a06b99504d7bf1b013c7818'
		)
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

		$facebook_page = $this->sanitize_username( $this->data->id() );
		$auth_data     = $this->get_auth_data();

		$endpoint_url = sprintf(
			'https://graph.facebook.com/v2.6/%1$s?access_token=%2$s|%3$s&fields=fan_count',
			$facebook_page,
			$auth_data['app_id'],
			$auth_data['app_secret']
		);

		if ( ! $response = Better_Social_Counter_Utilities::request( $endpoint_url ) ) {

			return FALSE;
		}

		return isset( $response['fan_count'] ) ? $response['fan_count'] : FALSE;
	}


	/**
	 * Get page link
	 *
	 *
	 * @return string
	 */
	public function link() {

		return 'https://www.facebook.com/' . $this->data->id();
	}

	/**
	 * Get random authentication info
	 *
	 * @return array
	 */
	public function get_auth_data() {

		$app_index = array_rand( $this->auth );

		return array(
			'app_id'     => $this->auth[ $app_index ][0],
			'app_secret' => $this->auth[ $app_index ][1],
		);
	}

	/**
	 * @param string $username
	 *
	 * @return string
	 */
	public function sanitize_username( $username ) {

		return preg_replace( '/[^a-zA-Z0-9_\-\.]/', '', $username );
	}

}