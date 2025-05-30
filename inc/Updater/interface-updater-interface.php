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

namespace DKO\OU\Updater;

/**
 * A updater interface to maintain self hosted plugin updater.
 *
 * @author Walger Marketing
 */
interface Updater_Interface {
	/**
	 * Get plugin info the response for the current WordPress.org Plugin Installation API request.
	 *
	 * @param  false|object|array $result The result object or array. Default false.
	 * @param  string             $action The type of information being requested from the Plugin Installation API.
	 * @param  object             $args Plugin API arguments.
	 *
	 * @return false|object|array
	 */
	public function info( false|object|array $result, string $action, object $args ): false|object|array;

	/**
	 * Update transient
	 *
	 * @param  mixed $transient WP transient.
	 *
	 * @return mixed
	 */
	public function update( mixed $transient ): mixed;

	/**
	 * Purge data when the upgrader process is complete
	 *
	 * @param  \WP_Upgrader $upgrader WP_Upgrader instance.
	 * @param  array        $hook_extra Array of bulk item update data.
	 *                      action string
	 *                             Type of action. Default 'update'.
	 *                      type string
	 *                             Type of update process. Accepts 'plugin', 'theme', 'translation', or 'core'.
	 *                      bulk bool
	 *                             Whether the update process is a bulk update. Default true.
	 *                      plugins array
	 *                             Array of the basename paths of the plugins’ main files.
	 *                      themes array
	 *                             The theme slugs.
	 *                      translations array
	 *                             Array of translations update data.
	 *                          language string
	 *                                The locale the translation is for.
	 *                           type string
	 *                                Type of translation. Accepts 'plugin', 'theme', or 'core'.
	 *                           slug string
	 *                                Text domain the translation is for. The slug of a theme/plugin or 'default' for core translations.
	 *                       version string
	 *                             The version of a theme, plugin, or core.
	 *
	 * @return void
	 */
	public function purge( \WP_Upgrader $upgrader, array $hook_extra );
}
