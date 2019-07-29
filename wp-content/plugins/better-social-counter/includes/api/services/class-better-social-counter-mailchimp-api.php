<?php


class Better_Social_Counter_Mailchimp_API implements Better_Social_Counter_Service_Interface {

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

		try {

			$mc_api     = $this->mailchimp_instance();
			$lists      = $mc_api->lists();
			$mc_list_id = $this->data->get( 'list_id' );


			if ( ! isset( $lists['data'] ) ) {
				return FALSE;
			}

			foreach ( (array) $lists['data'] as $list ) {

				if ( $list['id'] == $mc_list_id && isset( $list['stats']['member_count'] ) ) {

					return intval( $list['stats']['member_count'] );
				}
			}

		} catch( Exception $e ) {
		}

		return FALSE;
	}


	/**
	 * @return MCAPI
	 */
	public function mailchimp_instance() {

		// Mail chimp API wrapper
		if ( ! class_exists( 'MCAPI' ) ) {

			require_once Better_Social_Counter()->dir_path() . 'includes/libs/mailchimp/class-mcapi.php';
		}

		return new MCAPI( $this->data->get( 'api_key' ) );
	}

	/**
	 * Get page link
	 *
	 * @return string
	 */
	public function link() {

		return $this->data->get( 'list_url' );
	}
}