<?php

class Lookback_Plugin {

	public const DAY_RANGE = 2;

  /**
	 * Registers the initial hooks to get the plugin going
	 */
	public function initialize() {
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Callback for initialize()
	 */
	public function init() {
		$page_hook_suffix = null;

		// Add menu item
		add_action( 'admin_menu', function() use ( &$page_hook_suffix ) {
			$page_hook_suffix = add_menu_page( 'Lookback Plugin', 'Lookback Plugin', 'publish_posts', 'lookback-plugin', array( $this, 'lookback_page' ), 'lookback-plugin' );
			// add_action( "admin_footer-{$page_hook_suffix}", [ $this, 'scripts_in_footer' ] );
		} );
	}

	/**
	 * Callback for add_menu_page() -- outputs the HTML for our org chart UI
	 */
	public function lookback_page() {
		require __DIR__ . '/lookback-page-template.php';
	}

}
