<?php
/*
 * Plugin Name: Contact Form
 * Description: Contact Form using Custom Post
 * Author: Stebin Puthur
 * Version: 1.0
 * */

//include 'Templates/ContactForm.php';

if (!(defined("ABSPATH"))) {
    die();
}

function form_post_type()
{
    register_post_type('form',
        array(
            'labels' => array(
                'name' => __('Contact Form'),
                'singular_name' => __('Contact Form')
            ),
            'public' => true,
            'show_in_rest' => true,
            'supports' => array('title'),
            'has_archive' => true,
            'rewrite' => array('slug' => 'my-contact-form'),
            'menu_position' => 5,
        )
    );
}

add_action('init', 'form_post_type');

//function create_form_taxonomy()
//{
//    register_taxonomy('full_name', 'form', array(
//        'hierarchical' => false,
//        'labels' => array(
//            'name' => _x('Name', 'taxonomy general name'),
//            'singular_name' => _x('Name', 'taxonomy singular name'),
//        ),
//        'show_ui' => true,
//        'show_in_rest' => true,
//        'show_admin_column' => true,
//    ));
//    register_taxonomy('address', 'form', array(
//        'hierarchical' => false,
//        'labels' => array(
//            'name' => _x('Address', 'taxonomy general name'),
//            'singular_name' => _x('Address', 'taxonomy singular name'),
//        ),
//        'show_ui' => true,
//        'show_in_rest' => true,
//        'show_admin_column' => true,
//    ));
//    register_taxonomy('email', 'form', array(
//        'hierarchical' => false,
//        'labels' => array(
//            'name' => _x('Email', 'taxonomy general name'),
//            'singular_name' => _x('Email', 'taxonomy singular name'),
//        ),
//        'show_ui' => true,
//        'show_in_rest' => true,
//        'show_admin_column' => true,
//    ));
//    register_taxonomy('phone', 'form', array(
//        'hierarchical' => false,
//        'labels' => array(
//            'name' => _x('Phone', 'taxonomy general name'),
//            'singular_name' => _x('Phone', 'taxonomy singular name'),
//        ),
//        'show_ui' => true,
//        'show_in_rest' => true,
//        'show_admin_column' => true,
//    ));
//}
//
//add_action('init', 'create_form_taxonomy', 0);

add_filter( 'manage_form_posts_columns', 'set_custom_edit_form_columns' );
function set_custom_edit_form_columns($columns) {
    unset( $columns['author'], $columns['date'] );
    $columns['full_name'] = __( 'Name', 'your_text_domain' );
    $columns['address'] = __( 'Address', 'your_text_domain' );
    $columns['email']  = __( 'Email', 'your_text_domain' );
    $columns['phone']  = __( 'Phone', 'your_text_domain' );
    return $columns;
}

add_action( 'manage_form_posts_custom_column' , 'custom_form_column', 10, 2 );

function custom_form_column($column, $post_id) {
    switch ($column) {

        case 'full_name' :
            $postmeta = get_post_meta($post_id, 'name_meta_key', true);
            echo $postmeta;
            break;

        case 'address' :
            $postmeta = get_post_meta($post_id, 'address_meta_key', true);
            echo $postmeta;
            break;

        case 'email' :
            $postmeta = get_post_meta($post_id, 'email_meta_key', true);
            echo $postmeta;
            break;

        case 'phone' :
            $postmeta = get_post_meta($post_id, 'phone_meta_key', true);
            echo $postmeta;
            break;
    }
}

add_shortcode('form', 'Cf');

function loadStyle()
{
    wp_enqueue_style('Style', '//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css');
    wp_enqueue_script('Script', '//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js');
}

function Cf()
{
    add_action('wp_enqueue_scripts', 'loadStyle');
    load_template(dirname(__FILE__) . '/Templates/ContactForm.php');
}

add_shortcode('view', 'Vd');

function Vd()
{
    add_action('wp_enqueue_scripts', 'loadStyle');
    load_template(dirname(__FILE__) . '/Templates/ViewDetails.php');
}