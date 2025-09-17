<?php
/**
 * Theme functions.
 *
 * @package RikkerMediaHub_Divi_Child
 */

add_action( 'wp_enqueue_scripts', 'rikkermediahub_divi_child_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'rikkermediahub_divi_child_enqueue_form_styles', 20 );

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

require_once __DIR__ . '/inc/setup.php';
