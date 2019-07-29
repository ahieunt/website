<?php


class Better_Social_Counter_Delicious_API implements Better_Social_Counter_Service_Interface {

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

		$url = 'http://feeds.del.icio.us/v2/json/userinfo/' . $this->data->id();

		if ( ! $response = Better_Social_Counter_Utilities::request( $url, array( 'sslverify' => FALSE ) ) ) {

			return FALSE;
		}

		if ( isset( $response[2]['n'] ) ) {

			return intval( $response[2]['n'] );
		}

		return FALSE;
	}


	/**
	 * Get page link
	 *
	 *
	 * @return string
	 */
	public function link() {

		return 'https://del.icio.us/' . $this->data->id();
	}
}