<?php


class Better_Social_Counter_SoundCloud_API implements Better_Social_Counter_Service_Interface {

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

		$url = "http://api.soundcloud.com/users/" . $this->data->id() . ".json?consumer_key=" . $this->data->get( 'api_key' );

		if ( ! $response = Better_Social_Counter_Utilities::request( $url, array( 'sslverify' => FALSE ) ) ) {

			return FALSE;
		}

		if ( isset( $response['followers_count'] ) ) {

			return intval( $response['followers_count'] );
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

		return 'https://soundcloud.com/' . $this->data->id();
	}
}