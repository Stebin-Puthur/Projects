<?php
defined('ABSPATH') || exit();

if (!class_exists('ContactForm')){
    class ContactForm{
        protected static $instances;
        public $cfCustomPost;
        public $cfShortCode;

        public function __construct(){
            add_action('plugin_loaded', array($this, 'initialize'), 20);
        }

        public static function getInstance(){
            if (self::$instances === null){
                self::$instances = new self();
            }
            return self::$instances;
        }

        public function initialize(){
            $this->includes();
            $this->init();
        }

        public function includes(){
            include_once CONTACTFORM_INCLUDES_DIR . 'class-custompost.php';
            include_once CONTACTFORM_INCLUDES_DIR . 'class-shortcodes.php';
        }

        public function init(){
            $this->cfCustomPost = CfCustomPost::getInstance();
            $this->cfShortCode = CfShortCodes::getInstance();
        }
    }
}
?>