<?php


class Better_Social_Counter_Comments_API implements Better_Social_Counter_Service_Interface {

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

		$comments_count = wp_count_comments();

		if ( isset( $comments_count->approved ) ) {

			return $comments_count->approved;
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

		return '';
	}
}