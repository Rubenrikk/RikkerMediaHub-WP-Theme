<?php
/**
 * Theme functions.
 *
 * @package RikkerMediaHub_Divi_Child
 */

add_action( 'wp_enqueue_scripts', 'rikkermediahub_divi_child_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'rikkermediahub_divi_child_enqueue_form_styles', 20 );
add_action( 'login_enqueue_scripts', 'rikkermediahub_divi_child_enqueue_login_styles' );
add_action( 'admin_enqueue_scripts', 'rikkermediahub_divi_child_enqueue_admin_styles' );

/**
 * Enqueue parent and child theme stylesheets.
 */
function rikkermediahub_divi_child_enqueue_styles(): void {
    wp_enqueue_style( 'rikkermediahub-divi-parent', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
        'rikkermediahub-divi-child',
        get_stylesheet_uri(),
        array( 'rikkermediahub-divi-parent' ),
        wp_get_theme()->get( 'Version' )
    );
}

/**
 * Enqueue WPForms overrides after the base styles.
 */
function rikkermediahub_divi_child_enqueue_form_styles(): void {
    if ( wp_style_is( 'rmh-forms', 'enqueued' ) ) {
        return;
    }

    $dependencies = array( 'rikkermediahub-divi-child' );

    if ( wp_style_is( 'wpforms-full', 'enqueued' ) || wp_style_is( 'wpforms-full', 'registered' ) ) {
        $dependencies[] = 'wpforms-full';
    } elseif ( wp_style_is( 'wpforms-base', 'enqueued' ) || wp_style_is( 'wpforms-base', 'registered' ) ) {
        $dependencies[] = 'wpforms-base';
    }

    wp_enqueue_style(
        'rmh-forms',
        get_stylesheet_directory_uri() . '/assets/css/forms.css',
        $dependencies,
        wp_get_theme()->get( 'Version' )
    );
}

/**
 * Enqueue login screen stylesheet and replace the login logo.
 */
function rikkermediahub_divi_child_enqueue_login_styles(): void {
    $handle = 'rikkermediahub-divi-login';

    wp_enqueue_style(
        $handle,
        get_stylesheet_directory_uri() . '/login/login_styles.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

    $logo_url  = esc_url_raw( get_stylesheet_directory_uri() . '/images/custom-icon.png' );
    $inline_css = sprintf(
        ".login h1 a {\n    background-image: url('%1$s');\n    background-size: contain;\n    background-repeat: no-repeat;\n    width: 120px;\n    height: 120px;\n}\n.login h1 a:focus {\n    box-shadow: none;\n}",
        $logo_url
    );

    wp_add_inline_style( $handle, $inline_css );
}

/**
 * Enqueue admin styles to swap the WordPress logo in the toolbar.
 */
function rikkermediahub_divi_child_enqueue_admin_styles(): void {
    $handle = 'rikkermediahub-divi-admin';

    wp_enqueue_style(
        $handle,
        get_stylesheet_directory_uri() . '/assets/css/admin.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

    $logo_url  = esc_url_raw( get_stylesheet_directory_uri() . '/images/custom-icon.png' );
    $inline_css = sprintf(
        "#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {\n    background-image: url('%1$s');\n}",
        $logo_url
    );

    wp_add_inline_style( $handle, $inline_css );
}

require_once __DIR__ . '/inc/setup.php';
