<?php


class Better_Social_Counter_Steam_API implements Better_Social_Counter_Service_Interface {


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

		if ( ! class_exists( 'SimpleXmlElement' ) ) {

			return FALSE;
		}

		$result = FALSE;

		try {

			$prev = libxml_use_internal_errors( TRUE );

			$url  = 'http://steamcommunity.com/groups/' . $this->data->id() . '/memberslistxml';
			$data = Better_Social_Counter_Utilities::request( $url, array( 'sslverify' => FALSE ), TRUE );
			$data = @new SimpleXmlElement( $data );

				if ( isset( $data->groupDetails->memberCount ) ) {
				$result = intval( $data->groupDetails->memberCount );
			}

			libxml_use_internal_errors( $prev );
			libxml_clear_errors();

		} catch( Exception $e ) {

		}

		return $result;
	}


	/**
	 * Get page link
	 *
	 *
	 * @return string
	 */
	public function link() {

		return 'https://steamcommunity.com/groups/' . $this->data->id();
	}
}