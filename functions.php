<?php
if (!defined('ABSPATH')) exit;

// Configurações do tema
function wp_react_products_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'wp_react_products_setup');

// Registrar scripts e estilos
function wp_react_products_scripts() {
    // React e ReactDOM
    wp_enqueue_script('react', 'https://unpkg.com/react@18/umd/react.production.min.js', array(), '18.0.0', true);
    wp_enqueue_script('react-dom', 'https://unpkg.com/react-dom@18/umd/react-dom.production.min.js', array('react'), '18.0.0', true);
    
    // Babel para JSX
    wp_enqueue_script('babel', 'https://unpkg.com/babel-standalone@6/babel.min.js', array(), '6.0.0', true);
    
    // Script principal do tema
    wp_enqueue_script('wp-react-products-main', get_template_directory_uri() . '/js/main.js', array('react', 'react-dom', 'babel'), '1.0.0', true);
    
    // Estilos do tema
    wp_enqueue_style('wp-react-products-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'wp_react_products_scripts');

// Registrar Custom Post Type para Produtos
function wp_react_products_register_post_types() {
    register_post_type('produto', array(
        'labels' => array(
            'name' => 'Produtos',
            'singular_name' => 'Produto'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-products'
    ));
}
add_action('init', 'wp_react_products_register_post_types'); 