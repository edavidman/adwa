<?php
/**
 * Theme functions and definitions.
 *
 * @package Adwa
 * @author E David Man
 * @license GPL-2.0-or-later
 * @link https://github.com/edavidman/adwa
 */

if ( ! function_exists( 'adwa_setup' ) ) {
    /**
     * Sets up theme defaults and registers support for WordPress features.
     *
     * @since 1.0.0
     * @return void
     */
    function adwa_setup() {

        // Make theme available for translation.
        load_theme_textdomain(
            'adwa',
            get_template_directory() . '/languages'
        );

        // Core WordPress features.
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'wp-block-styles' );

        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Custom logo support.
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 100,
                'width'       => 400,
                'flex-height' => true,
                'flex-width'  => true,
            )
        );

        // Disable bundled core patterns.
        remove_theme_support( 'core-block-patterns' );

        // WooCommerce compatibility.
        if ( class_exists( 'WooCommerce' ) ) {
            add_theme_support( 'woocommerce' );
            add_theme_support( 'wc-product-gallery-zoom' );
            add_theme_support( 'wc-product-gallery-lightbox' );
            add_theme_support( 'wc-product-gallery-slider' );
        }
    }
}
add_action( 'after_setup_theme', 'adwa_setup' );

/**
 * Enqueue the theme stylesheet.
 *
 * @since 1.0.0
 * @return void
 */
function adwa_enqueue_styles() {
    wp_enqueue_style(
        'adwa-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'adwa_enqueue_styles' );

/**
 * Register custom block styles.
 *
 * @since 1.0.0
 * @return void
 */
function adwa_register_block_styles() {
    $block_styles = array(
        'core/columns' => array(
            'columns-reverse' => __( 'Reverse', 'adwa' ),
        ),
        'core/group' => array(
            'shadow-light' => __( 'Shadow', 'adwa' ),
            'shadow-solid' => __( 'Solid', 'adwa' ),
        ),
        'core/list' => array(
            'no-disc' => __( 'No Disc', 'adwa' ),
        ),
        'core/quote' => array(
            'shadow-light' => __( 'Shadow', 'adwa' ),
            'shadow-solid' => __( 'Solid', 'adwa' ),
        ),
        'core/social-links' => array(
            'outline' => __( 'Outline', 'adwa' ),
        ),
    );

    foreach ( $block_styles as $block => $styles ) {
        foreach ( $styles as $name => $label ) {
            register_block_style(
                $block,
                array(
                    'name'  => $name,
                    'label' => $label,
                )
            );
        }
    }
}
add_action( 'init', 'adwa_register_block_styles' );

/**
 * Register custom block pattern categories.
 *
 * @since 1.0.0
 * @return void
 */
function adwa_register_block_pattern_categories() {
    if ( ! function_exists( 'register_block_pattern_category' ) ) {
        return;
    }
	
    register_block_pattern_category(
        'adwa-page',
        array(
            'label'       => __( 'Page', 'adwa' ),
            'description' => __( 'Create a full page with grouped page-building patterns.', 'adwa' ),
        )
    );
	
    register_block_pattern_category(
        'adwa-section',
        array(
            'label'       => __( 'Section', 'adwa' ),
            'description' => __( 'Section block layout patterns.', 'adwa' ),
        )
    );
}
add_action( 'init', 'adwa_register_block_pattern_categories' );