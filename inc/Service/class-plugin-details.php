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
 * @subpackage OU/updater
 */

namespace DKO\OU\Service;

/**
 * Plugin updater
 *
 * @author Walger Marketing
 */
class Plugin_Details {

	/**
	 * Add a "details" link to open a thickbox popup with information about
	 * the plugin from the public directory.
	 *
	 * @since 1.1.1
	 *
	 * @param array  $links List of links.
	 * @param string $plugin_file Relative path to the main plugin file from the plugins directory.
	 * @param array  $plugin_data Data from the plugin headers.
	 * @return array
	 */
	public function plugin_links( array $links, string $plugin_file, array $plugin_data ): array {
		if ( false !== strpos( $plugin_data['PluginURI'], 'wc-order-utils' ) ) {
			foreach ( array_values( $links ) as $link ) {
				if ( false !== strpos( $link, 'plugin-information' ) ) {
					return $links;
				}
			}

			$slug = basename( $plugin_data['PluginURI'] );

			$links[] = sprintf(
				'<a href="%s" class="thickbox" title="%s">%s</a>',
				self_admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=' . $slug . '&amp;TB_iframe=true&amp;width=600&amp;height=550' ),
				// translators: %s: plugin slug.
				esc_attr( sprintf( __( 'More information about %s' ), 'wc-order-utils' ) ),
				__( 'Details', 'wc-order-utils' )
			);
		}

		return $links;
	}
}
