<?php


class Better_Social_Counter_Members_API implements Better_Social_Counter_Service_Interface {

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

		$members_count = count_users();

		return $members_count['total_users'];
	}


	/**
	 * Get page link
	 *
	 *
	 * @return string
	 */
	public function link() {

		return '';
	}
}