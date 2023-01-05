<?php
/*
 * Plugin Name: Contact Form
 * Description: Contact Form Plugin
 * Author: Stebin Puthur
 * Version: 1.0
 * */
if(!(defined("ABSPATH"))){die();}

require_once "Models/Actions.php";
require_once "Controller/formHandler.php";
use Models\Actions;

class ContactForm extends Actions{
    function cf_plugin_activate(){
        $this->cf_plugin_create_table();
    }

    function cf_plugin_deactivate(){
//        $this->cf_plugin_clear_db();
    }
}

if (class_exists("ContactForm")){
    $contact_form = new ContactForm();
}

register_activation_hook(__FILE__,array($contact_form,"cf_plugin_activate"));
register_deactivation_hook(__FILE__,array($contact_form,"cf_plugin_deactivate"));

add_action("admin_menu","trial");

function trial(){
    add_menu_page("Contact Form","View Contact Form Details","manage_options","manage_cf","Vd");
}

add_action('admin_enqueue_scripts', 'loadStyle');
function Vd(){
    load_template(dirname(__FILE__) . '/Templates/ViewDetails.php');
}

add_shortcode('form', 'Cf');

function loadStyle(){
    wp_enqueue_style('Style', '//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css');
    wp_enqueue_script('Script', '//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js');
}

function Cf(){
    add_action('wp_enqueue_scripts', 'loadStyle');
    load_template(dirname(__FILE__) . '/Templates/ContactForm.php');
}