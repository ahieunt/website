<?php


class Better_Social_Counter_Dribbble_API implements Better_Social_Counter_Service_Interface {

	/**
	 * @var string
	 */
	public $token = 'b290669f9190657eea521b46fbe0d615811b98263afc673cf58161d061b5076a';

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

		$url = sprintf(
			'http://api.dribbble.com/v1/users/%s?access_token=%s',
			$this->data->id(),
			$this->token
		);

		$request_args = array(
			'sslverify' => FALSE,
		);


		if ( ! $response = Better_Social_Counter_Utilities::request( $url, $request_args ) ) {

			return FALSE;
		}

		return isset( $response['followers_count'] ) ? $response['followers_count'] : FALSE;
	}


	/**
	 * @return string
	 */
	public function link() {

		return 'https://dribbble.com/' . $this->data->id();
	}
}