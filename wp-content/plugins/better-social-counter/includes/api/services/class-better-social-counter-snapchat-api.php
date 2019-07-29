<?php


class Better_Social_Counter_SnapChat_API implements Better_Social_Counter_Service_Interface {

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

		if ( $title = $this->data->get( 'title' ) ) {
			return $title;
		}

		return '';
	}


	/**
	 * Get page link
	 *
	 *
	 * @return string
	 */
	public function link() {

		return $this->data->id();
	}
}