<?php


class Better_Social_Counter_Forrst_API implements Better_Social_Counter_Service_Interface {

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

		$url = 'http://forrst.com/api/v2/users/info?username=' . $this->data->id();

		$results = Better_Social_Counter_Utilities::request( $url, array( 'sslverify' => FALSE ) );

		if ( isset( $results['resp']['typecast_followers'] ) ) {

			return intval( $results['resp']['typecast_followers'] );
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

		return 'http://zurb.com/forrst/people/' . $this->data->id();
	}
}