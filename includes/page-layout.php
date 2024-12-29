<?php
// Page layout override
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Some codes for this feature are in customizer_settings.php
// Hook into the `admin_init` action to trigger the update when editing a post or a revision.
add_action('admin_init', function() {
    // Check if we are in the admin area and editing a post or page.
    if (!is_admin() || !isset($_GET['post'])) {
        return;
    }

    $post_id = intval($_GET['post']);

    // Verify post type, including revisions.
    $post = get_post($post_id);
    $post_type = $post ? get_post_type($post->post_parent ? $post->post_parent : $post_id) : null;

    // Proceed for any post type.
    if (!$post_type) {
        return;
    }

    // Get the current value of the `_wp_page_template` meta.
    $target_id = $post->post_parent ? $post->post_parent : $post_id;
    $current_template = get_post_meta($target_id, '_wp_page_template', true);

    $enable_page_layout_override = get_theme_mod( 'htc_gen_setting_playout_enable' );

    if( $enable_page_layout_override != "no" ) {
        // Update the meta value if it's 'default'.
        if ($current_template === 'default' || empty($current_template)) {
            update_post_meta($target_id, '_wp_page_template', 'elementor_header_footer');
        }
    }
    else {
        // Reset value for all pages that were previously set to Full Width
        if( $current_template === 'elementor_header_footer' ) {
            update_post_meta($target_id, '_wp_page_template', 'default');
        }
    }
});