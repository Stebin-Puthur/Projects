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
            include_once CR_INCLUDES_PATH . 'class-cr-cookie.php';

        }

        public function init(){
         $this->CrAdminMenu = CrAdminMenu::getInstance();
         if(!is_admin()){
             $this->CrCookie = CrCookie::getInstance();
         }
        }
    }
}