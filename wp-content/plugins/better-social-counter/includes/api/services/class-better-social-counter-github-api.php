<?php


class Better_Social_Counter_Github_API implements Better_Social_Counter_Service_Interface {

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

		$url = 'https://api.github.com/users/' . $this->data->id();

		if ( ! $response = Better_Social_Counter_Utilities::request( $url, array( 'sslverify' => FALSE ) ) ) {

			return FALSE;
		}

		if ( isset( $response['followers'] ) ) {

			return intval( $response['followers'] );
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

		return 'https://github.com/' . $this->data->id();
	}
}