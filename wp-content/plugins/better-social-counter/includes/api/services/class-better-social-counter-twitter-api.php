<?php


class Better_Social_Counter_Twitter_API implements Better_Social_Counter_Service_Interface {

	/**
	 * @var string
	 */
	public $access_token = 'AAAAAAAAAAAAAAAAAAAAAJBzagAAAAAAXr%2Fxj2UWtV%2BnQNigsUm%2Bjrlkr4o%3DoYt2AFQFvPpPsJ1wtVmJ3MLetbYnmTWLFzDZJWLnXZtRJRZKOQ';

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

		$request_args = array(
			'httpversion' => '1.1',
			'blocking'    => TRUE,
			'headers'     => array(
				'Authorization' => 'Bearer ' . $this->access_token,
			)
		);

		$url = 'https://api.twitter.com/1.1/users/show.json?screen_name=' . $this->data->id();

		if ( ! $response = Better_Social_Counter_Utilities::request( $url, $request_args ) ) {

			return FALSE;
		}

		return isset( $response['followers_count'] ) ? $response['followers_count'] : FALSE;
	}


	/**
	 * Get page link
	 *
	 *
	 * @return string
	 */
	public function link() {

		return 'https://twitter.com/' . $this->data->id();
	}
}