<?php


class Better_Social_Counter_Pinterest_API implements Better_Social_Counter_Service_Interface {

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

		if ( ! class_exists( 'DOMDocument' ) ) {
			return FALSE;
		}

		$url  = 'http://www.pinterest.com/' . $this->data->id();
		$html = Better_Social_Counter_Utilities::request( $url, array( 'sslverify' => FALSE ), TRUE );

		if ( ! $html ) {
			return FALSE;
		}

		try {

			$prev = libxml_use_internal_errors( TRUE );
			$doc  = new DOMDocument();

			@$doc->loadHTML( $html );

			libxml_use_internal_errors( $prev );

			$metas = $doc->getElementsByTagName( 'meta' );

			for ( $i = 0; $i < $metas->length; $i ++ ) {

				$meta = $metas->item( $i );

				if ( $meta->getAttribute( 'name' ) == 'pinterestapp:followers' ) {

					return $meta->getAttribute( 'content' );
				}

			}
		} catch( Exception $e ) {

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

		return 'http://www.pinterest.com/' . $this->data->id();
	}
}