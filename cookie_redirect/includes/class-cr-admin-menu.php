<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists("CrAdminMenu")){
    class CrAdminMenu
    {
        protected static $instance;

        public function __construct()
        {
            add_action("admin_menu",[$this , "cookie_details"]);
        }

        public static function getInstance()
        {
            if ( self::$instance === null ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function cookie_details(){
                add_menu_page(
                    "Cookie Details",
                    "Add Cookie Details",
                    "manage_options",
                    "manage_cd",
                    [$this, "cookie_detail_template"]);

                add_action('admin_init', [$this , 'register_Cd_settings']);
        }

        public function cookie_detail_template(){
                load_template(CR_TEMPLATES_PATH . 'temp-cookie-details.php');
        }

        public function sanitize_number ($number){
            return filter_var($number, FILTER_SANITIZE_NUMBER_INT);
        }

        public function register_Cd_settings(){
                $register_field_type_url = [
                    'type' => 'string',
                    'sanitize_callback' => 'sanitize_url',
                    'default' => ''
                ];

                add_settings_section(
                    __('Cd_admin_setting_section'),
                    __('Cookie Details'),
                    '',
                    'cd-setting-section'
                );

                register_setting('cd-setting-section', 'cookie_expiry_option');
                add_settings_field(
                    __('cookie_expiry_time'),
                    __('Cookie Expiry Time (in seconds)'),
                    [$this, 'cookie_expiry_callback'],
                    'cd-setting-section',
                    'Cd_admin_setting_section'
                );

                register_setting('cd-setting-section', 'interval_timeout_option');
                add_settings_field(
                    __('interval_timeout'),
                    __('Set Interval Time (in seconds)'),
                    [$this, 'interval_timeout_callback'],
                    'cd-setting-section',
                    'Cd_admin_setting_section'
                );

                register_setting('cd-setting-section', 'access_page_option', $register_field_type_url);
                add_settings_field(
                    __('access_page_url'),
                    __('Access Page URL'),
                    [$this, 'access_page_callback'],
                    'cd-setting-section',
                    'Cd_admin_setting_section'
                );

                register_setting('cd-setting-section', 'redirect_page_option', $register_field_type_url);
                add_settings_field(
                    __('redirect_page_url'),
                    __('Redirect Page URL'),
                    [$this, 'redirect_page_callback'],
                    'cd-setting-section',
                    'Cd_admin_setting_section'
                );
        }

        public function cookie_expiry_callback(){
            $cookie_expiry_time = get_option('cookie_expiry_option');
            ?>
            <input type="text" name="cookie_expiry_option" class="regular-text" value="<?php echo isset($cookie_expiry_time) ? esc_attr($cookie_expiry_time): '';?> ">
            <?php
        }

        public function interval_timeout_callback(){
            $interval_timeout = get_option('interval_timeout_option');
            ?>
            <input type="text" name="interval_timeout_option" class="regular-text" value="<?php echo isset($interval_timeout) ? esc_attr($interval_timeout): '';?> ">
            <?php
        }

        public function access_page_callback(){
            $access_page_url = get_option('access_page_option');
            ?>
            <input type="text" name="access_page_option" class="regular-text" value="<?php echo isset($access_page_url) ? esc_attr($access_page_url): '';?> ">
            <?php
        }

        public function redirect_page_callback(){
            $redirect_page_url = get_option('redirect_page_option');
            ?>
            <input type="text" name="redirect_page_option" class="regular-text" value="<?php echo isset($redirect_page_url) ? esc_attr($redirect_page_url): '';?> ">
            <?php
        }

    }
}