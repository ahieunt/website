<?php


class Better_Social_Counter_Envato_API implements Better_Social_Counter_Service_Interface {


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

		$url     = 'http://marketplace.envato.com/api/edge/user:' . $this->data->id() . '.json';
		$results = Better_Social_Counter_Utilities::request( $url, array( 'sslverify' => FALSE ) );

		if ( isset( $results['user']['followers'] ) ) {

			return intval( $results['user']['followers'] );
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

		return 'https://' . $this->data->get( 'marketplace' ) . '.net/user/' . $this->data->id() . '?ref=' . $this->data->id();
	}
}