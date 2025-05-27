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
			'init'                                 => 'remove_autodraft_cron_delete',
			'woocommerce_before_order_object_save' => array( 'hpos_force_publish_new_order', 20, 2 ),
		);
	}



	/**
	 * Removes the scheduled action that deletes auto-draft posts.
	 */
	public function remove_autodraft_cron_delete(): void {
		remove_action( 'wp_scheduled_delete', 'wp_delete_auto_drafts' );
	}


	/**
	 * Change post_status from auto-draft to publish before inserting into the database.
	 *
	 * @param WC_Data          $order      The object being saved.
	 * @param WC_Data_Store_WP $data_store THe data store persisting the data.
	 */
	public function hpos_force_publish_new_order( $order, $data_store ) {
		$is_admin = is_admin();
		if ( $order->get_status() === 'auto-draft' && $is_admin ) {
			$order->set_status( 'wc-processing' );
		}
	}
}
