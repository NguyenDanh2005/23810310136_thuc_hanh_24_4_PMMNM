<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Shortcode [danh_sach_sinh_vien]
 */
function sm_danh_sach_sinh_vien_shortcode() {
    $query = new WP_Query( array(
        'post_type'      => 'sinh_vien',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ) );

    if ( ! $query->have_posts() ) {
        return '<p style="text-align:center;color:#888;">Chưa có sinh viên nào.</p>';
    }

    wp_enqueue_style( 'sm-style', SM_URL . 'assets/style.css', array(), '1.0.1' );

    $badge_class = array(
        'CNTT'      => 'cntt',
        'Kinh tế'   => 'kinhte',
        'Marketing' => 'marketing',
    );

    $html  = '<div class="sm-wrapper">';
    $html .= '<table class="sm-table">';
    $html .= '<thead><tr>';
    $html .= '<th>STT</th><th>MSSV</th><th>Họ tên</th><th>Lớp / Chuyên ngành</th><th>Ngày sinh</th>';
    $html .= '</tr></thead><tbody>';

    $stt = 1;
    while ( $query->have_posts() ) {
        $query->the_post();
        $post_id  = get_the_ID();
        $mssv     = get_post_meta( $post_id, '_sm_mssv',     true );
        $lop      = get_post_meta( $post_id, '_sm_lop',      true );
        $ngaysinh = get_post_meta( $post_id, '_sm_ngaysinh', true );

        $ngaysinh_display = '';
        if ( $ngaysinh ) {
            $date = DateTime::createFromFormat( 'Y-m-d', $ngaysinh );
            $ngaysinh_display = $date ? $date->format( 'd/m/Y' ) : esc_html( $ngaysinh );
        }

        $cls   = isset( $badge_class[ $lop ] ) ? $badge_class[ $lop ] : '';
        $badge = '<span class="sm-badge ' . esc_attr( $cls ) . '">' . esc_html( $lop ) . '</span>';

        $html .= '<tr>';
        $html .= '<td>' . $stt . '</td>';
        $html .= '<td>' . esc_html( $mssv ) . '</td>';
        $html .= '<td>' . esc_html( get_the_title() ) . '</td>';
        $html .= '<td>' . $badge . '</td>';
        $html .= '<td>' . esc_html( $ngaysinh_display ) . '</td>';
        $html .= '</tr>';
        $stt++;
    }
    wp_reset_postdata();

    $html .= '</tbody></table>';
    $html .= '<div class="sm-footer">Tổng số: ' . ( $stt - 1 ) . ' sinh viên</div>';
    $html .= '</div>';

    return $html;
}
add_shortcode( 'danh_sach_sinh_vien', 'sm_danh_sach_sinh_vien_shortcode' );
