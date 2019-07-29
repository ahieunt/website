<?php


class Better_Social_Counter_Instagram_API implements Better_Social_Counter_Service_Interface {

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

		$url     = 'http://instagram.com/' . $this->data->id() . '#';
		$results = Better_Social_Counter_Utilities::request( $url, array( 'sslverify' => FALSE ), TRUE );


		$pattern = "/followed_by\":[ ]*{\"count\":(.*?)}/";

		if ( preg_match( $pattern, $results, $matches ) ) {

			return intval( $matches[1] );
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

		return 'https://instagram.com/' . $this->data->id();
	}
}