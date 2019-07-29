<?php


class Better_Social_Counter_VK_API implements Better_Social_Counter_Service_Interface {

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

		$url     = 'http://api.vk.com/method/groups.getById?gid=' . $this->data->id() . '&fields=members_count';
		$results = Better_Social_Counter_Utilities::request( $url, array( 'sslverify' => FALSE ) );

		if ( isset( $results['response'][0]['members_count'] ) ) {

			return intval( $results['response'][0]['members_count'] );
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

		return 'https://vk.com/' . $this->data->id();
	}
}