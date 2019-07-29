<?php


class Better_Social_Counter_Vine_API implements Better_Social_Counter_Service_Interface {

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

		if ( ! class_exists( 'BSC_Vine' ) ) {
			require_once Better_Social_Counter()->dir_path() . 'includes/libs/class-bsc-vine.php';
		}

		$vine   = new BSC_Vine( $this->data->get( 'email' ), $this->data->get( 'pass' ) );
		$result = $vine->me();

		if ( isset( $result['followerCount'] ) ) {

			return intval( $result['followerCount'] );
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

		if ( ! $id = $this->data->id() ) {
			return '';
		}

		return 'https://vine.co/' . $id;
	}
}