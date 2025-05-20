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
 * @subpackage OU/templates
 */

namespace DKO\OU\TemplateManagement\Controller;

/**
 * Define Default Template Controller
 *
 * Adds template support for plugin.
 *
 * @author Walger Marketing
 */
class Default_Controller {

	/**
	 * Render template file
	 *
	 * @param string $template the template file.
	 * @param array  $params   template parameters.
	 *
	 * @return void
	 */
	public function render( string $template, array $params ) {

		if ( is_array( $params ) && isset( $params ) ) :
			extract( $params );
		endif;

		include $template;
	}
}
