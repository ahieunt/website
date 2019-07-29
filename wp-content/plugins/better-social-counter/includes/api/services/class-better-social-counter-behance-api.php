<?php


class Better_Social_Counter_Behance_API implements Better_Social_Counter_Service_Interface {

	protected $key = 'INekEPLWGFlXlfmWjjOZD79vWNaD1Nxj';

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
			'https://www.behance.net/v2/users/%s?api_key=%s',
			$this->data->id(),
			$this->key
		);

		$results = Better_Social_Counter_Utilities::request( $url, array( 'sslverify' => FALSE ) );

		if ( isset( $results['user']['stats']['followers'] ) ) {

			return intval( $results['user']['stats']['followers'] );
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

		return 'https://www.behance.net/' . $this->data->id();
	}
}