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
add_action( 'wp_head', 'rikkermediahub_divi_child_add_bestellingen_meta' );
add_action( 'send_headers', 'rikkermediahub_divi_child_add_bestellingen_header' );

/**
 * Enqueue parent and child theme stylesheets.
 */
function rikkermediahub_divi_child_enqueue_styles() {
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
function rikkermediahub_divi_child_enqueue_form_styles() {
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
function rikkermediahub_divi_child_enqueue_login_styles() {
    $handle = 'rikkermediahub-divi-login';

    wp_enqueue_style(
        $handle,
        get_stylesheet_directory_uri() . '/login/login_styles.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

    $logo_url = esc_url_raw( get_stylesheet_directory_uri() . '/images/custom-icon.png' );
    $inline_css = ".login h1 a {\n";
    $inline_css .= "    background-image: url('" . $logo_url . "');\n";
    $inline_css .= "    background-size: contain;\n";
    $inline_css .= "    background-repeat: no-repeat;\n";
    $inline_css .= "    width: 120px;\n";
    $inline_css .= "    height: 120px;\n";
    $inline_css .= "}\n";
    $inline_css .= ".login h1 a:focus {\n";
    $inline_css .= "    box-shadow: none;\n";
    $inline_css .= "}";

    wp_add_inline_style( $handle, $inline_css );
}

/**
 * Enqueue admin styles to swap the WordPress logo in the toolbar.
 */
function rikkermediahub_divi_child_enqueue_admin_styles() {
    $handle = 'rikkermediahub-divi-admin';

    wp_enqueue_style(
        $handle,
        get_stylesheet_directory_uri() . '/assets/css/admin.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

    $logo_url = esc_url_raw( get_stylesheet_directory_uri() . '/images/custom-icon.png' );
    $inline_css = "#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {\n";
    $inline_css .= "    background-image: url('" . $logo_url . "');\n";
    $inline_css .= "}";

    wp_add_inline_style( $handle, $inline_css );
}

require_once __DIR__ . '/inc/setup.php';

/**
 * Determine if the current request targets a /bestellingen/ URL.
 *
 * @return bool
 */
function rikkermediahub_divi_child_is_bestellingen_request() {
    if ( empty( $_SERVER['REQUEST_URI'] ) ) {
        return false;
    }

    return false !== strpos( $_SERVER['REQUEST_URI'], '/bestellingen/' );
}

/**
 * Output a robots meta tag for /bestellingen/ pages.
 */
function rikkermediahub_divi_child_add_bestellingen_meta() {
    if ( ! rikkermediahub_divi_child_is_bestellingen_request() ) {
        return;
    }

    echo "<meta name=\"robots\" content=\"noindex, nofollow\">\n";
}

/**
 * Send the X-Robots-Tag header for /bestellingen/ pages.
 */
function rikkermediahub_divi_child_add_bestellingen_header() {
    if ( ! rikkermediahub_divi_child_is_bestellingen_request() ) {
        return;
    }

    if ( ! headers_sent() ) {
        header( 'X-Robots-Tag: noindex, nofollow', true );
    }
}
