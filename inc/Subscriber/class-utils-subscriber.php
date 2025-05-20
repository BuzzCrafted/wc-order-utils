<?php
/**
 * This file is part of the Woocommerce Order Utils plugin.
 *
 * (c) Walger Marketing
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author     Walger Marketing
 * @package    OU
 * @subpackage Ыubscriber
 */

namespace DKO\OU\Subscriber;

use DKO\OU\EventManagement\Subscriber_Interface;

/**
 * Event subscriber that registers custom order number.
 *
 * @author Walger Marketing
 */
class Utils_Subscriber implements Subscriber_Interface {

	/**
	 * {@inheritdoc}
	 */
	public static function get_subscribed_events() {
		return array(
			'init'                => 'remove_autodraft_cron_delete',
			'wp_insert_post_data' => array( 'set_published_for_new_order', 10, 2 ),
		);
	}



	/**
	 * Removes the scheduled action that deletes auto-draft posts.
	 *
	 * @param int $order_id The order ID.
	 */
	public function emove_autodraft_cron_delete( int $order_id ): void {
		remove_action( 'wp_scheduled_delete', 'wp_delete_auto_drafts' );
	}


	/**
	 * Sets the post status to 'publish' for new shop orders that are auto-drafts.
	 *
	 * @param array $post_data The post data.
	 * @param array $post_attr The post attributes.
	 * @return array The modified post data.
	 */
	public function set_published_for_new_order( $post_data, $post_attr ): array {
		if ( isset( $post_attr['post_type'] )
		&& 'shop_order' === $post_attr['post_type']
		&& 'auto-draft' === $post_data['post_status']
		) {
			$post_data['post_status'] = 'publish';
		}
		return $post_data;
	}
}
