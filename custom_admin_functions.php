<?php
// Custom WP Admin functions
if ( ! defined( 'ABSPATH' ) ) { exit; }

// 23-04-2023 code - Duplicate post
include_once( 'includes/post-duplicator.php' );

// 04-12-2023 code - Media library file size column
include_once( 'includes/media-library-filesize.php' );

// 10-12-2023 code - Email updates notification
include_once( 'includes/email-updates-notification.php' );

// 27-11-2024 code - Theme usage tracker
include_once( 'includes/theme-usage-tracker.php' );

// 30-11-2024 code - Elementor AI, notices, etc
include_once( 'includes/elementor-helpers.php' );

// Disable comments functionality via customizer settings
$disable_comments = get_theme_mod( 'htc_comments_setting' );
$disable_comments_default = true;

if( "no" == $disable_comments ){
  $disable_comments_default = false;
}

if( true == $disable_comments_default ){
  include_once( 'includes/disable-comments.php' );
}

// Custom WP Login logo
add_action( 'login_enqueue_scripts', 'custom_jw_login_logo' );
function custom_jw_login_logo() {
  $loginsc_bg = get_theme_mod( 'htc_loginsc_bg_setting', '#F1F1F1' );
  $site_logo_enable = get_theme_mod( 'htc_logo_enable_setting', 'yes' );
  $site_logo_height = !empty( get_theme_mod( 'htc_logo_height_setting' ) ) ? get_theme_mod( 'htc_logo_height_setting' ) : '100';
  $site_logo_width = !empty( get_theme_mod( 'htc_logo_width_setting' ) ) ? get_theme_mod( 'htc_logo_width_setting' ) : '320';
  $site_logo_bg = !empty( get_theme_mod( 'htc_logo_bg_setting' ) ) ? get_theme_mod( 'htc_logo_bg_setting' ) : 'transparent';
  $default_logo = get_template_directory_uri() . '/images/favicon.png';
  $site_logo = get_theme_mod('custom_logo');
  $site_logo_array = wp_get_attachment_image_src($site_logo, 'login-logo');
  $custom_logo = !empty($site_logo) ? $site_logo_array[0] : $default_logo;
  echo '<style type="text/css">body.login{background: '. $loginsc_bg .'}';
  echo ( $site_logo_enable == 'yes' ) ? '#login h1 a, .login h1 a {background-image: url('. $custom_logo .');height: '. $site_logo_height .'px;width: '. $site_logo_width .'px;background-repeat: no-repeat;background-size: contain;background-position: center;background-color: '. $site_logo_bg .'}' : '';
  echo '</style>';
}

add_filter( 'login_headerurl', 'custom_jw_login_logo_url' );
function custom_jw_login_logo_url() {
  return home_url();
}

add_filter( 'login_headertext', 'custom_jw_login_logo_title' );
function custom_jw_login_logo_title() {
  return get_bloginfo('name');
}

// Disable Wordpress admin dashboard boxes generated by theme or plugin via customizer settings
$disable_wpdashboard_box = get_theme_mod( 'htc_dashboard_cleanup_setting' );
$disable_wpdashboard_box_default = true;

if( "no" == $disable_wpdashboard_box ){
  $disable_wpdashboard_box_default = false;
  remove_action( 'wp_dashboard_setup', 'custom_jw_disable_db_widgets' );
}

if( true == $disable_wpdashboard_box_default ){
	add_action( 'wp_dashboard_setup', 'custom_jw_disable_db_widgets', 999 );	
}

function custom_jw_disable_db_widgets() {
   // Welcome panel
  remove_action( 'welcome_panel', 'wp_welcome_panel' );
  // Gutenberg box
  remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );
  global $wp_meta_boxes;
  // Activity
  unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
  // At a Glance
  unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
  // Recent comments
  unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
  // Links
  unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
  // Plugins
  unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
  // Wordfence
  unset( $wp_meta_boxes['dashboard']['normal']['core']['wordfence_activity_report_widget'] );
  // WPMUdev
  unset( $wp_meta_boxes['dashboard']['normal']['core']['wpmudev_widget'] );
  unset( $wp_meta_boxes['dashboard']['normal']['core']['wpmudev_news_widget'] );
  // Elementor Overview
  unset( $wp_meta_boxes['dashboard']['normal']['core']['e-dashboard-overview'] );
  unset( $wp_meta_boxes['dashboard']['side']['core']['e-dashboard-overview'] );
  // bbpress
  unset( $wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now'] );
  // Yoast seo
  unset( $wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget'] );
  // Smartcrawl
  unset( $wp_meta_boxes['dashboard']['side']['core']['wds_sitemaps_dashboard_widget'] );
  // Gravity Forms
  // unset( $wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard'] );
  unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
  unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
  // Quick draft
  unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
  // Recent drafts
  unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );
  // Rank math widget
  unset( $wp_meta_boxes['dashboard']['normal']['core']['rank_math_dashboard_widget'] );
  // Yith Blog and Update Overview
  unset( $wp_meta_boxes['dashboard']['normal']['core']['yith_dashboard_blog_news'] );
  unset( $wp_meta_boxes['dashboard']['side']['core']['yith_dashboard_blog_news'] );
  unset( $wp_meta_boxes['dashboard']['normal']['core']['yith_dashboard_products_news'] );
  unset( $wp_meta_boxes['dashboard']['side']['core']['yith_dashboard_products_news'] );
}

// Remove admin bar menu items
add_action( 'admin_bar_menu', 'custom_jw_remove_admin_menu_items', 999 );
function custom_jw_remove_admin_menu_items( $wp_admin_bar ) {
  if( current_user_can('administrator') ) {
    if( ! is_admin() ) {
      $wp_admin_bar->remove_node( 'site-name' );
      $wp_admin_bar->add_node(
        array(
          'id' => 'dashboard',
          'title' => 'Dashboard',
          'href' => admin_url(),
          'parent' => false,
          'meta' => array( 'class' => 'dashicons-before dashicons-admin-generic' )
        )
      );
      $wp_admin_bar->add_node(
        array(
          'id' => 'menus',
          'title' => 'Menus',
          'href' => admin_url( 'nav-menus.php' ),
          'parent' => false
        )
      );
    }

    if( is_page() ) {
      $getpageedit = $wp_admin_bar->get_node( 'edit' );

      if( isset( $getpageedit->title ) ) {
        $pageedit_title = str_replace( 'Edit Page', 'Page Settings', $getpageedit->title );
        $wp_admin_bar->add_node( array( 'id' => 'edit', 'title' => $pageedit_title ) );
      }

      $getelemeditpage = $wp_admin_bar->get_node( 'elementor_edit_page' );

      if( isset( $getelemeditpage->title ) ) {
        $elemeditpage_title = str_replace( 'Edit', 'Edit Page', $getelemeditpage->title );
        $wp_admin_bar->add_node( array( 'id' => 'elementor_edit_page', 'title' => $elemeditpage_title ) );
      }
    }
  }

  $wp_admin_bar->remove_node( 'wp-logo' );
  $wp_admin_bar->remove_node( 'updates' );
  $wp_admin_bar->remove_node( 'comments' );
  $wp_admin_bar->remove_node( 'customize' );
  $wp_admin_bar->remove_node( 'new-content' );
  $wp_admin_bar->remove_node( 'gform-forms' );
  $wp_admin_bar->remove_node( 'search' );

  $getgreetings = $wp_admin_bar->get_node( 'my-account' );
  $getgreetings_title = isset( $getgreetings->title ) ? $getgreetings->title : '';
  $rpctitle = str_replace( 'Howdy,', '', $getgreetings_title );
  $wp_admin_bar->add_node( array( 'id' => 'my-account', 'title' => $rpctitle ) );
}

// Remove admin bar menu item - Imagify plugin
$max_php_int = PHP_INT_MAX - 20; 
add_action( 'admin_bar_menu', 'custom_jw_remove_admin_menu_imagify', $max_php_int );
function custom_jw_remove_admin_menu_imagify( $wp_admin_bar ) {
  $wp_admin_bar->remove_node( 'imagify' );
}

// Remove admin sidebar menu
add_action( 'admin_menu', 'custom_jw_remove_admin_menu' );
function custom_jw_remove_admin_menu(){
  remove_menu_page( 'link-manager.php' );
}

// Disable Gravity Form toolbar menu
if ( get_option( 'gform_enable_toolbar_menu' ) ) {
  update_option( 'gform_enable_toolbar_menu', 0 );
}

// Admin page css
add_action( 'admin_head', 'custom_jw_admin_head_scripts' );
function custom_jw_admin_head_scripts(){
  echo '<style type="text/css">
  #pageparentdiv label.post-attributes-label[for="page_template"], #pageparentdiv label.post-attributes-label[for="menu_order"], #pageparentdiv select#page_template,  #pageparentdiv #menu_order {display: none;}
  .wp-admin .notice.elementor-message{display: none !important;}
  #adminmenu li#menu-settings ul.wp-submenu li a[href="plugin-install.php"], #adminmenu li#menu-settings ul.wp-submenu li a[href="plugin-editor.php"],
  #adminmenu li#menu-settings ul.wp-submenu li a[href="import.php"], #adminmenu li#menu-settings ul.wp-submenu li a[href="export.php"],
  #adminmenu li#menu-settings ul.wp-submenu li a[href*="export_personal_data"], #adminmenu li#menu-settings ul.wp-submenu li a[href*="remove_personal_data"] {padding-left: 24px;}
  .wp-admin #sgpb-popup-dialog-main-div-wrapper {display: none;}
  .wp-admin #sgpb-popup-dialog-main-div-wrapper + .sgpb-popup-overlay {display: none;}
  .wp-admin #sg-backup-review-wrapper {display: none;}
  body.elementor-editor-active #elementor-switch-mode-button {display: none;}
  .notice.wcs-nux__notice{display: none !important;}
  </style>
  <script type="text/javascript">
  jQuery(document).ready(function(){
    var currentItem = jQuery("li#menu-settings").find("li.current");
    if( currentItem.length > 0 ){
      jQuery("li#menu-settings, li#menu-settings > a").addClass("wp-has-current-submenu wp-menu-open");
    }
  });
  </script>';
}

// Remove thumbnail attr in page type
add_action( 'init', 'custom_jw_remove_posttype_support' );
function custom_jw_remove_posttype_support() {
    remove_post_type_support( 'page', 'thumbnail' );
}

// Admin footer text modification
add_filter( 'admin_footer_text', 'custom_jw_footer_text_admin' );
function custom_jw_footer_text_admin() {
  echo '';
}

// Enable svg file upload
add_filter( 'upload_mimes', 'custom_jw_svg_file_upload' );
function custom_jw_svg_file_upload($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['webp'] = 'image/webp';
  return $mimes;
}

// Enable shortcodes in text widgets
add_filter( 'widget_text', 'do_shortcode' );

// Attachment page redirect
add_action( 'template_redirect', 'custom_hello_theme_attachment_redirect', 1 );
function custom_hello_theme_attachment_redirect() {
  global $post;
  if ( is_attachment() && isset($post->post_parent) && is_numeric($post->post_parent) && ($post->post_parent != 0) ) {
    wp_redirect(get_permalink($post->post_parent), 301); // permanent redirect to post/page where image or document was uploaded
    exit;
  } elseif ( is_attachment() && isset($post->post_parent) && is_numeric($post->post_parent) && ($post->post_parent < 1) ) { // for some reason it doesnt works checking for 0, so checking lower than 1 instead...
    wp_redirect(get_bloginfo('wpurl'), 302); // temp redirect to home for image or document not associated to any post/page
    exit;
  }
}

// Disable html comment promoting math rank
add_filter( 'rank_math/frontend/remove_credit_notice', '__return_true' );

// Gutenberg toggle functionality for post
function custom_disable_gutenberg_post(){
  return false;
}

$gbg_post_setting = get_theme_mod( 'htc_gbg_post_setting' );

if ( $gbg_post_setting == true ){
  add_filter( 'use_block_editor_for_post', 'custom_disable_gutenberg_post' );
}

// Disable Gutenberg fullscreen view for all users
add_action( 'enqueue_block_editor_assets', 'custom_disable_gutenberg_fullscreen_all' );
function custom_disable_gutenberg_fullscreen_all() {
  $script = "window.onload = function() { const isFullscreenMode = wp.data.select( 'core/edit-post' )?.isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } }";
  wp_add_inline_script( 'wp-blocks', $script );
}

// Woocommerce overrides
// Woocommerce sorting options by alphabetical
add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_woo_get_catalog_order_args' );
function custom_woo_get_catalog_order_args( $args ) {
  $orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
  if ( 'alphabetical' == $orderby_value ) {
    $args['orderby'] = 'title';
    $args['order'] = 'ASC';
  }
  return $args;
}

add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woo_catalog_order_option' );
add_filter( 'woocommerce_catalog_orderby', 'custom_woo_catalog_order_option' );
function custom_woo_catalog_order_option( $sortby ) {
  $sortby['alphabetical'] = __( 'Sort by alphabetical' );
  return $sortby;
}

// 23-04-2023 Code - Login error message
add_filter( 'login_errors', function(){
  return 'Something is wrong!';
});