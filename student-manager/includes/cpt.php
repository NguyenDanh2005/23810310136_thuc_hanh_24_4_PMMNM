<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Đăng ký Custom Post Type: Sinh viên
 */
function sm_register_cpt() {
    $labels = array(
        'name'               => 'Sinh viên',
        'singular_name'      => 'Sinh viên',
        'add_new'            => 'Thêm mới',
        'add_new_item'       => 'Thêm sinh viên mới',
        'edit_item'          => 'Chỉnh sửa sinh viên',
        'new_item'           => 'Sinh viên mới',
        'view_item'          => 'Xem sinh viên',
        'search_items'       => 'Tìm kiếm sinh viên',
        'not_found'          => 'Không tìm thấy sinh viên',
        'not_found_in_trash' => 'Không có sinh viên trong thùng rác',
        'menu_name'          => 'Sinh viên',
    );

    $args = array(
        'labels'      => $labels,
        'public'      => true,
        'has_archive' => true,
        'supports'    => array( 'title', 'editor' ),
        'menu_icon'   => 'dashicons-welcome-learn-more',
        'rewrite'     => array( 'slug' => 'sinh-vien' ),
        'show_in_rest'=> true,
    );

    register_post_type( 'sinh_vien', $args );
}
add_action( 'init', 'sm_register_cpt' );
