<?php
/**
 * Theme functions.
 *
 * @package RikkerMediaHub_Divi_Child
 */

add_action( 'wp_enqueue_scripts', 'rikkermediahub_divi_child_enqueue_styles' );

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

require_once __DIR__ . '/inc/setup.php';
