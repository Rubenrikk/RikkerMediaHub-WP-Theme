<?php
/**
 * Theme setup hooks.
 *
 * @package RikkerMediaHub_Divi_Child
 */

add_action( 'after_setup_theme', 'rikkermediahub_divi_child_load_textdomain' );

/**
 * Load the child theme text domain.
 */
function rikkermediahub_divi_child_load_textdomain() {
    load_child_theme_textdomain( 'rikkermediahub-divi-child', get_stylesheet_directory() . '/languages' );
}
