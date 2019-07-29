<?php


class Better_Social_Counter_Google_API implements Better_Social_Counter_Service_Interface {

	/**
	 * @var string
	 */
	public $key = 'AIzaSyBAwpfyAadivJ6EimaAOLh-F1gBeuwyVoY';

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


		$username = $this->data->id();

		if ( ! preg_match( '/^(\d{20,22})$/', $username ) ) {
			$username = "+$username";
		}

		$url = sprintf(
			'https://www.googleapis.com/plus/v1/people/%s?key=%s',
			$username,
			$this->key
		);

		if ( ! $response = Better_Social_Counter_Utilities::request( $url ) ) {

			return FALSE;
		}

		return isset( $response['circledByCount'] ) ? $response['circledByCount'] : FALSE;
	}


	/**
	 * Get page link
	 *
	 *
	 * @return string
	 */
	public function link() {

		return 'https://plus.google.com/' . $this->data->id();
	}
}