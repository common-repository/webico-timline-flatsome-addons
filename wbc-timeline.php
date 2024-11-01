<?php
/*
Plugin Name: Webico Timeline Flatsome Addons
Plugin URI: https://www.webico.vn
Description: Plugin được chia sẻ bởi Webico teams. Plugin tạo timeline cho flatsome hoặc theme bất kỳ
Contributors: Tran Binh, Webico
Installation:From your WordPress dashboard=1. Visit 'Plugins > Add New'=2. Search for WBC Timeline.=3. Activate WBC Timeline from your Plugins page.Cài đặt plugin -> Vào đăng post timeline -> Vào flatsome UX Builder chọn element WBC Timline và cấu hình tương ứngSử dụng shortcode [wbc-timline cat='']== Changelog === 1.0.0 =*  Khởi tạo plugin
Version: 1.0.0
Author: Webico Teams
Text Domain: webico
Domain Path: /languages
Tags: Webico.vn, Tran Binh, Flatsome Addons
Tested up to: 3.9.4
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate link: https://www.webico.vn

 Plugin được chia sẻ bởi Webico teams.

*/
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
define('WBC_FL_Timline_Addons_DIR', plugin_dir_path(__FILE__));
define('WBC_FL_Timeline_Addons_URL', plugins_url('/', __FILE__));
class WBC_FL_Timeline_Addons
{
    /**
     * WBC_FL_Timeline_Addons constructor.
     */
    public function __construct()
    {
        add_action('ux_builder_setup', array($this, 'ux_builder_element'));
        $this->includes();
    }
    public function includes()
    {

    }
    public function ux_builder_element()
    {
        include(WBC_FL_Timline_Addons_DIR . '/builder/wbc-timeline.php' );
    }
}
function wbc_fl_timeline_addons_run()
{
    new WBC_FL_Timeline_Addons();
}
add_action('after_setup_theme', 'wbc_fl_timeline_addons_run');


require_once (WBC_FL_Timline_Addons_DIR. '/shortcodes/wbc-timeline.php');





function wbc_timeline_register_post() {

	/**
	 * Post Type: Timelines.
	 */

	$labels = array(
		"name" => __( "Timelines", "" ),
		"singular_name" => __( "Timeline", "" ),
	);

	$args = array(
		"label" => __( "Timelines", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "timeline", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "timeline", $args );
}

add_action( 'init', 'wbc_timeline_register_post' );

function wbc_timeline_register_taxes() {

	/**
	 * Taxonomy: Categories.
	 */

	$labels = array(
		"name" => __( "Categories", "" ),
		"singular_name" => __( "Category", "" ),
	);

	$args = array(
		"label" => __( "Categories", "" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => false,
		"label" => "Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'timeline_cat', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "timeline_cat",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "timeline_cat", array( "timeline" ), $args );
}

add_action( 'init', 'wbc_timeline_register_taxes' );
