<?php

namespace Models;

class Actions
{
    protected function cf_plugin_create_table(){
        global $wpdb, $table_prefix;
        $table_name = $table_prefix . "contact";
        $sql = $wpdb->prepare("CREATE TABLE IF NOT EXISTS `$table_name`
                                (`id` INT NOT NULL AUTO_INCREMENT , 
                                `name` VARCHAR(255) NOT NULL , 
                                `address` TEXT NOT NULL , 
                                `email` VARCHAR(255) NOT NULL , 
                                `phone` VARCHAR(20) NOT NULL , 
                                PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        $wpdb->query($sql);
    }

    protected function cf_plugin_clear_db(){
        global $wpdb, $table_prefix;
        $table_name = $table_prefix . "contact";
        $sql = $wpdb->prepare("TRUNCATE `$table_name`");
        $wpdb->query($sql);
    }

    public function add_details($name, $address, $email, $phone){
        global $wpdb, $table_prefix;
        $table_name = $table_prefix . "contact";
        $wpdb->query($wpdb->prepare(
            "INSERT INTO `$table_name`(name, address, email, phone) 
                   VALUES (%s,%s,%s,%s)",
                   $name,
                   $address,
            $email,
            $phone
        ));
    }

    public function view_contact_form(){
        global $wpdb, $table_prefix;
        $table_name = $table_prefix . "contact";
        $sql = "SELECT * FROM `$table_name`";
        return $wpdb->get_results($sql);
    }

    public function update_details(int $id, $name, $address, $email, $phone){
        global $wpdb, $table_prefix;
        $table_name = $table_prefix . "contact";
        $wpdb->query($wpdb->prepare(
            "UPDATE `$table_name` SET name = %s, address = %s, email = %s, phone = %s WHERE id = %d",
            $name,
            $address,
            $email,
            $phone,
            $id
        ));
    }

    public function delete_details(int $id){
        global $wpdb, $table_prefix;
        $table_name = $table_prefix . "contact";
        $wpdb->query($wpdb->prepare(
            "DELETE FROM `$table_name`WHERE id = %d",
            $id
        ));
    }
}