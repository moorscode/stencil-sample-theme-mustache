<?php
/**
 * Engine code
 *
 * @package Stencil
 * @subpackage Mustache
 */

if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if ( class_exists( 'Stencil_Container_Implementation' ) ) :

	add_action( 'init', create_function( '', 'new Stencil_Mustache();' ) );

	/**
	 * Class StencilMustache
	 *
	 * Implementation of the "Mustache" templating engine
	 */
	class Stencil_Mustache extends Stencil_Container_Implementation {

		/**
		 * Initialize Mustache and set defaults
		 */
		public function __construct() {
			parent::__construct();

			$this->template_extension = 'mustache';

			require_once( 'lib/Mustache/Autoloader.php' );

			Mustache_Autoloader::register();

			// Init template engine.
			$options = array(
				'loader' => new Mustache_Loader_FilesystemLoader( $this->template_path ),
			);

			if ( is_dir( $this->template_path . 'partials/' ) ) {
				$options['partials_loader'] = new Mustache_Loader_FilesystemLoader( $this->template_path . 'partials/' );
			}

			$this->engine = new Mustache_Engine( $options );
		}

		/**
		 * Fetches the Smarty compiled template
		 *
		 * @param string $template Template file to get.
		 *
		 * @return string
		 */
		public function fetch( $template ) {
			// @todo test for extension
			return $this->engine->render( $template, $this->variables );
		}
	}

endif;
