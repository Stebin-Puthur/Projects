<?php
defined('ABSPATH') || exit();

if (!class_exists('CfShortCodes')){
    class CfShortCodes{
        protected static $instances;
        protected $shortcodes = array();

        public function __construct(){
            add_action('wp_enqueue_scripts',[$this,'loadStyle']);
            $this->registerShortCode();
        }

        public static function getInstance(){
            if (self::$instances === null){
                self::$instances = new self();
            }
            return self::$instances;
        }

        public function loadStyle(){
            wp_enqueue_style('Style', '//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css');
            wp_enqueue_script('Script', '//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js');
        }

        public function registerShortCode(){
            $this->shortcodes = [
                'form' => [$this, 'loadTemplate']
            ];
            foreach ($this->shortcodes as $key => $value){
                add_shortcode($key, $value);
            }
        }

        public function loadTemplate(){
            load_template(CONTACTFORM_TEMPLATES_DIR . 'ContactForm.php', true);
        }
    }
}
?>