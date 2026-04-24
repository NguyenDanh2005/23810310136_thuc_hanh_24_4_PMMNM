<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Đăng ký Meta Box
 */
function sm_add_meta_box() {
    add_meta_box(
        'sm_student_info',
        'Thông tin sinh viên',
        'sm_render_meta_box',
        'sinh_vien',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'sm_add_meta_box' );

/**
 * Render nội dung Meta Box
 */
function sm_render_meta_box( $post ) {
    wp_nonce_field( 'sm_save_meta', 'sm_nonce' );

    $mssv    = get_post_meta( $post->ID, '_sm_mssv',    true );
    $lop     = get_post_meta( $post->ID, '_sm_lop',     true );
    $ngaysinh = get_post_meta( $post->ID, '_sm_ngaysinh', true );

    $lop_options = array( 'CNTT', 'Kinh tế', 'Marketing' );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="sm_mssv">Mã số sinh viên (MSSV)</label></th>
            <td>
                <input type="text"
                       id="sm_mssv"
                       name="sm_mssv"
                       value="<?php echo esc_attr( $mssv ); ?>"
                       class="regular-text"
                       placeholder="VD: SV001" />
            </td>
        </tr>
        <tr>
            <th><label for="sm_lop">Lớp / Chuyên ngành</label></th>
            <td>
                <select id="sm_lop" name="sm_lop">
                    <option value="">-- Chọn chuyên ngành --</option>
                    <?php foreach ( $lop_options as $option ) : ?>
                        <option value="<?php echo esc_attr( $option ); ?>"
                            <?php selected( $lop, $option ); ?>>
                            <?php echo esc_html( $option ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="sm_ngaysinh">Ngày sinh</label></th>
            <td>
                <input type="date"
                       id="sm_ngaysinh"
                       name="sm_ngaysinh"
                       value="<?php echo esc_attr( $ngaysinh ); ?>" />
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Lưu dữ liệu Meta Box
 */
function sm_save_meta_box( $post_id ) {
    // Kiểm tra nonce
    if ( ! isset( $_POST['sm_nonce'] ) || ! wp_verify_nonce( $_POST['sm_nonce'], 'sm_save_meta' ) ) {
        return;
    }

    // Không lưu khi autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Kiểm tra quyền
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Sanitize và lưu MSSV
    if ( isset( $_POST['sm_mssv'] ) ) {
        update_post_meta( $post_id, '_sm_mssv', sanitize_text_field( $_POST['sm_mssv'] ) );
    }

    // Sanitize và lưu Lớp
    $lop_options = array( 'CNTT', 'Kinh tế', 'Marketing' );
    if ( isset( $_POST['sm_lop'] ) && in_array( $_POST['sm_lop'], $lop_options, true ) ) {
        update_post_meta( $post_id, '_sm_lop', sanitize_text_field( $_POST['sm_lop'] ) );
    }

    // Sanitize và lưu Ngày sinh
    if ( isset( $_POST['sm_ngaysinh'] ) ) {
        $date = sanitize_text_field( $_POST['sm_ngaysinh'] );
        // Validate định dạng YYYY-MM-DD
        if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $date ) ) {
            update_post_meta( $post_id, '_sm_ngaysinh', $date );
        }
    }
}
add_action( 'save_post_sinh_vien', 'sm_save_meta_box' );
