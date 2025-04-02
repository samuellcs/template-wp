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
    
    // Suporte ao Elementor
    add_theme_support('elementor');
    add_theme_support('elementor-pro');
}
add_action('after_setup_theme', 'wp_react_products_setup');

// Registrar scripts e estilos
function wp_react_products_scripts() {
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    
    // Google Fonts - Roboto
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
    
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
        'menu_icon' => 'dashicons-products',
        'show_in_rest' => true, // Habilita suporte ao editor Gutenberg
        'elementor' => true, // Habilita suporte ao Elementor
    ));
}
add_action('init', 'wp_react_products_register_post_types');

// Adicionar suporte ao Elementor para o Custom Post Type
function wp_react_products_elementor_support() {
    add_post_type_support('produto', 'elementor');
}
add_action('init', 'wp_react_products_elementor_support');

// Registrar áreas de widgets para o Elementor
function wp_react_products_register_elementor_locations($elementor_theme_manager) {
    $elementor_theme_manager->register_location('header');
    $elementor_theme_manager->register_location('footer');
}
add_action('elementor/theme/register_locations', 'wp_react_products_register_elementor_locations'); 