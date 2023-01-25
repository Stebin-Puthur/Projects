<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists("CrCookie")){
    class CrCookie {
        protected static $instance;

        public function __construct()
        {
            add_action('init', [$this, 'set_cookie_and_redirect'] );
            add_action('wp_enqueue_scripts', [$this, 'addScript']);
        }

        public function addScript()
        {
            wp_enqueue_script( 'cookie_redirect', CR_JS_PATH . 'cookie_redirect.js' );
            wp_localize_script('cookie_redirect', 'cookie_object', array(
                'redirect_page' => get_option('redirect_page_option'),
                'interval_timeout' => get_option('interval_timeout_option')
            ));
        }

        public static function getInstance()
        {
            if ( self::$instance === null ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function set_cookie_and_redirect(){
            $url = wp_get_raw_referer();
            $cookie_expiry_time = get_option('cookie_expiry_option');
            $access_page_url = get_option('access_page_option');
            $redirect_page_url = get_option('redirect_page_option');
            if ($url == $access_page_url) {
                $cookie_name = "url";
                $cookie_value = "actual url";
                if (!isset($_COOKIE[$cookie_name])) {
                    setcookie($cookie_name, $cookie_value, time() + $cookie_expiry_time); // 86400 = 1 day
                }
            }
            else{
                wp_safe_redirect($redirect_page_url);
            }
        }
    }
}