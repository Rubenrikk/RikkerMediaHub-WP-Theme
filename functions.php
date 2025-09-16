<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */  

add_action( 'wp_enqueue_scripts', 'rikkerdesign_style' );
				function rikkerdesign_style() {
					wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
					wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
				}

/**
 * Your code goes below.
 */

//Rikkerdesign Support line
function add_support_to_admin_bar( $wp_admin_bar ) {
  if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
    $support_text = 'Komt u er niet helemaal uit? Mail ons gerust!';
    $args = array(
      'id' => 'custom-support',
      'title' => $support_text,
      'parent' => 'top-secondary',
      'meta' => array(
        'class' => 'custom-support-menu-item'
      )
    );
    $wp_admin_bar->add_node( $args );
  }
}
add_action( 'admin_bar_menu', 'add_support_to_admin_bar', 999 );

//Rikkerdesign login page
function wpb_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(https://cloud.rikkermediahub.com/apps/files_sharing/publicpreview/xspyNWyYSi6LnbG?file=/&fileId=1349339&x=3440&y=1440&a=true&etag=021326f3fd8d6781ac20ed7b7ce125d8);
        height:140px;
        width:294px;
        background-size: 294px 140px;
        background-repeat: no-repeat;
        padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'wpb_login_logo' );

function my_login_page_custom_bg_image() { ?>
<style type="text/css">
  body{
    background-image:url(https://cloud.rikkermediahub.com/apps/files_sharing/publicpreview/7RCNixzZeRSFALy?file=/&fileId=686290&x=3420&y=2224&a=true&etag=1e7566ab4fd2298aaa29fd9499ab21fe) !important;
    background-size:cover !important;
    background-position:center center !important;
  }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_page_custom_bg_image' );

function my_loginURL() {
    return 'https://www.rikkermediahub.com';
}
add_filter('login_headerurl', 'my_loginURL');

function my_loginURLtext() {
    return 'RikkerMediaHub';
}
add_filter('login_headertitle', 'my_loginURLtext');

add_filter( 'login_display_language_dropdown', '__return_false' );

function custom_login_styles() {
  wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/login/login_styles.css' );
}
add_action( 'login_enqueue_scripts', 'custom_login_styles' );


//Rikkerdesign Admin panel
function custom_admin_bar_logo( $wp_admin_bar ) {
    $wp_admin_bar->add_node(
        array(
            'id'    => 'wp-logo',
            'title' => '<img src="' . get_stylesheet_directory_uri() . '/images/custom-icon.png" style="height: 30px; width: 30px;"/>',
            'href'  => home_url(),
            'meta'  => array(
                'class' => 'wp-logo',
                'title' => __('Home'),
            ),
        )
    );
}
add_action( 'admin_bar_menu', 'custom_admin_bar_logo', 11 );
