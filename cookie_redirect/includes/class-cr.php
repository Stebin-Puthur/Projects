<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists("cookieRedirect")){
    class cookieRedirect{
        protected static $instance;
        public $CrAdminMenu;
        public $CrCookie;
        public function __construct()
        {
            if ( get_option('cookie_expiry_option') == false ){
                update_option( 'cookie_expiry_option', 20 );
            }
            if ( get_option('interval_timeout_option') == false ){
                update_option( 'interval_timeout_option', 1 );
            }
            if ( get_option('access_page_option') == false ){
                update_option( 'access_page_option', 'http://local.sdstone2.com/' );
            }
            if ( get_option('redirect_page_option') == false ){
                update_option( 'redirect_page_option', 'https://wordpress.org/' );
            }
            if ( get_option('redirect_method_option') == false ){
                update_option('redirect_method_option', 'unauthorised_access_message');
                update_option('unauthorised_access_message_option', 'You have no permission to access this page <a href="https://www.google.com/"><b>Exit</b></a>');
            }
            if ( get_option('unauthorised_access_message_option') == false ){
                update_option('unauthorised_access_message_option', 'You have no permission to access this page <a href="https://www.google.com/"><b>Exit</b></a>');
            }
            if ( get_option('unauthorised_access_url_option') == false ){
                update_option('unauthorised_access_url_option', 'https://www.google.com/');
            }
            add_action( 'plugins_loaded', array( $this, 'initialize' ),20);
        }

        public static function getInstance()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function initialize(){
            $this->includes();
            $this->init();
        }

        public function includes(){
            include_once CR_INCLUDES_PATH . 'class-cr-admin-menu.php';
	        if(!is_admin()){
		        include_once CR_INCLUDES_PATH . 'class-cr-cookie.php';
	        }

        }

        public function init(){
         $this->CrAdminMenu = CrAdminMenu::getInstance();
         if(!is_admin()){
             $this->CrCookie = CrCookie::getInstance();
         }
        }
    }
}