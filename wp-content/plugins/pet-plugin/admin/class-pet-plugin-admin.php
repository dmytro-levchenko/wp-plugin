<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       devsite.com
 * @since      1.0.0
 *
 * @package    Pet_Plugin
 * @subpackage Pet_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pet_Plugin
 * @subpackage Pet_Plugin/admin
 * @author     Dev <dev@mail.com>
 */
class Pet_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
			
		//Add action for menu
		add_action("admin_menu", array($this, "options_page"));
		add_action('admin_head', array($this, "admin_load_js"));

		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action('wp_head','rel_canonical');
	}

	// Add function 
	public function options_page() {
		add_menu_page("Plugin Options", "Plugin Options", "manage_options", "plugin-options", array($this, 'render'));
		add_submenu_page("plugin-options", "Plugin Options Advanced", "Plugin Options Advanced", "manage_options", "plugin-options-advanced", array($this, 'render'));
	}

	public function render() {
		require plugin_dir_path( dirname( __FILE__ )) . 'admin/partials/pet-plugin-admin-display.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pet_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pet_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pet-plugin-admin.css', array(), $this->version, 'all' );

	}

	public function admin_load_js(){
		echo '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />';
		echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>';
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pet_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pet_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pet-plugin-admin.js', array( 'jquery' ), $this->version, false );
		
	}

	

}
