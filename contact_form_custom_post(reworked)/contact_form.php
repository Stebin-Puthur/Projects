<?php
/*
 * Plugin Name: Contact Form
 * Description: Contact Form using Custom Post (reworked)
 * Author: Stebin Puthur
 * Version: 1.0
 * */

defined("ABSPATH") || exit();

if (!defined('CONTACTFORM_PLUGIN_DIR')){
    define('CONTACTFORM_PLUGIN_DIR',untrailingslashit(plugin_dir_path(__FILE__)));
    define('CONTACTFORM_INCLUDES_DIR',untrailingslashit(plugin_dir_path(__FILE__)) . '/includes/');
    define('CONTACTFORM_TEMPLATES_DIR',untrailingslashit(plugin_dir_path(__FILE__)) . '/Templates/');
}

if (!class_exists('ContactForm')){
    include_once CONTACTFORM_INCLUDES_DIR . 'class-cf.php';
}

function cfpost_init(){
    return ContactForm::getInstance();
}
cfpost_init();