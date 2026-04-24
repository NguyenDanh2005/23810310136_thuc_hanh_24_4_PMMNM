<?php
/**
 * Plugin Name: Student Manager
 * Plugin URI:  https://example.com/student-manager
 * Description: Plugin quản lý sinh viên với Custom Post Type, Meta Boxes và Shortcode.
 * Version:     1.0.0
 * Author:      Student
 * License:     GPL2
 * Text Domain: student-manager
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'SM_PATH', plugin_dir_path( __FILE__ ) );
define( 'SM_URL',  plugin_dir_url( __FILE__ ) );

require_once SM_PATH . 'includes/cpt.php';
require_once SM_PATH . 'includes/meta-box.php';
require_once SM_PATH . 'includes/shortcode.php';
