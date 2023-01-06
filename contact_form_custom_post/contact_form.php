<?php
/*
 * Plugin Name: Contact Form
 * Description: Contact Form using Custom Post
 * Author: Stebin Puthur
 * Version: 1.0
 * */
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
            // 'taxonomies' => array('cuisines', 'post_tag') // this is IMPORTANT
        )
    );
}

add_action('init', 'form_post_type');

function create_form_taxonomy()
{
    register_taxonomy('full_name', 'form', array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Name', 'taxonomy general name'),
            'singular_name' => _x('Name', 'taxonomy singular name'),
//            'menu_name' => __( 'Name' ),
//            'all_items' => __( 'All Name' ),
//            'edit_item' => __( 'Edit Name' ),
//            'update_item' => __( 'Update Name' ),
//            'add_new_item' => __( 'Add Name' ),
//            'new_item_name' => __( 'New Name' ),
        ),
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
    register_taxonomy('address', 'form', array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Address', 'taxonomy general name'),
            'singular_name' => _x('Address', 'taxonomy singular name'),
//            'menu_name' => __( 'Address' ),
//            'all_items' => __( 'All Address' ),
//            'edit_item' => __( 'Edit Address' ),
//            'update_item' => __( 'Update Address' ),
//            'add_new_item' => __( 'Add Address' ),
//            'new_item_name' => __( 'New Address' ),
        ),
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
    register_taxonomy('email', 'form', array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Email', 'taxonomy general name'),
            'singular_name' => _x('Email', 'taxonomy singular name'),
//            'menu_name' => __( 'Email' ),
//            'all_items' => __( 'All Email' ),
//            'edit_item' => __( 'Edit Email' ),
//            'update_item' => __( 'Update Email' ),
//            'add_new_item' => __( 'Add Email' ),
//            'new_item_name' => __( 'New Email' ),
        ),
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
    register_taxonomy('phone', 'form', array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Phone', 'taxonomy general name'),
            'singular_name' => _x('Phone', 'taxonomy singular name'),
//            'menu_name' => __( 'Phone' ),
//            'all_items' => __( 'All Phone' ),
//            'edit_item' => __( 'Edit Phone' ),
//            'update_item' => __( 'Update Phone' ),
//            'add_new_item' => __( 'Add Phone' ),
//            'new_item_name' => __( 'New Phone' ),
        ),
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
}

add_action('init', 'create_form_taxonomy', 0);

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