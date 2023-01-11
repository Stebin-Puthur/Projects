<?php
defined('ABSPATH') || exit();

if (!class_exists('CfCustomPost')){
    class CfCustomPost{
        protected static $instances;

        public function __construct(){
            add_action('init',[$this,'form_post_type']);
            add_filter( 'manage_form_posts_columns', [$this,'set_custom_edit_form_columns']);
            add_action( 'manage_form_posts_custom_column' , [$this,'custom_form_column'], 10, 2 );
        }

        public function form_post_type(){
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

        public function set_custom_edit_form_columns($columns) {
            unset( $columns['author'], $columns['date'] );
            $columns['full_name'] = __( 'Name', 'your_text_domain' );
            $columns['address'] = __( 'Address', 'your_text_domain' );
            $columns['email']  = __( 'Email', 'your_text_domain' );
            $columns['phone']  = __( 'Phone', 'your_text_domain' );
            return $columns;
        }

        public function custom_form_column($column, $post_id) {
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

        public static function getInstance(){
            if(self::$instances ===null){
                self::$instances = new self();
            }
            return self::$instances;
        }
    }
}
?>