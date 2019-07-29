<?php


class Better_Social_Counter_RSS_API implements Better_Social_Counter_Service_Interface {

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
	 * @return string
	 */
	public function count() {

		return 'RSS';
	}


	/**
	 * Get page link
	 *
	 *
	 * @return string
	 */
	public function link() {

		$type = $this->data->get( 'type' );

		if ( 'custom_link' === $type ) {

			return $this->data->get( 'link' );
		}

		if ( 'category' === $type ) {

			if ( $link = get_category_feed_link( $this->data->get( 'category' ) ) ) {

				return $link;
			}
		}

		return get_bloginfo( 'rss_url' );
	}
}