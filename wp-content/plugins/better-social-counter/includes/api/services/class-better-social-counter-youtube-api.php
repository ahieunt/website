<?php


class Better_Social_Counter_YouTube_API implements Better_Social_Counter_Service_Interface {

	/**
	 * @var string
	 */
	public $key = 'AIzaSyBAwpfyAadivJ6EimaAOLh-F1gBeuwyVoY';

	/**
	 * @var Better_Social_Counter_Data
	 */
	protected $data;


	/**
	 * @var string
	 */
	protected $type;


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

		$page_id = $this->data->id();

		if ( strlen( $page_id ) === 24 ) {

			$this->type = 'channel';

			if ( ! ( $results = $this->_get_youtube_channel_info( $page_id ) ) ) {

				$results    = $this->_get_youtube_account_info( $page_id );
				$this->type = 'user';
			}
		} else {

			$this->type = 'user';

			if ( ! ( $results = $this->_get_youtube_account_info( $page_id ) ) ) {

				$results    = $this->_get_youtube_channel_info( $page_id );
				$this->type = 'channel';
			}
		}

		if ( isset( $results['items'][0]['statistics']['subscriberCount'] ) ) {

			return intval( $results['items'][0]['statistics']['subscriberCount'] );
		}

		return FALSE;
	}


	protected function _get_youtube_account_info( $username ) {

		$url = sprintf(
			"https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=%s&key=%s",
			$username,
			$this->key
		);

		$results = Better_Social_Counter_Utilities::request( $url );

		if ( ! empty( $results['items'][0] ) ) {
			return $results;
		}

		return FALSE;
	}

	protected function _get_youtube_channel_info( $channel_id ) {

		$url     = sprintf(
			"https://www.googleapis.com/youtube/v3/channels?part=statistics&id=%s&key=%s",
			$channel_id,
			$this->key
		);
		$results = Better_Social_Counter_Utilities::request( $url );

		if ( ! empty( $results['items'][0] ) ) {
			return $results;
		}

		return FALSE;
	}

	/**
	 * Get page link
	 *
	 * @return string
	 */
	public function link() {

		if ( $this->type == 'channel' ) {

			return 'https://youtube.com/channel/' . $this->data->id();

		} elseif ( $this->type == 'user' ) {

			return 'https://youtube.com/user/' . $this->data->id();
		}

		return '';
	}
}