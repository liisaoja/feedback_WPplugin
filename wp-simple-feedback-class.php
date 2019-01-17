<?php

class Wp_Simple_Feedback_Class {
    public function __construct(){
        load_plugin_textdomain('wp-simple-feedback',false, basename( dirname(__FILE__) ) . '/languages');
        
        add_action("init", array($this,"init"));
        add_action('widgets_init',array($this, 'register_widget'));
        add_action('admin_menu',array($this, "setup_admin_menu"));
        
        add_filter("the_title",array($this, "change_feedback_target_title"),10,2);
        add_filter("wp_title",array($this, "change_feedback_target_wp_title"),10,2);
        
    }
    
    public function init() {
        wp_register_style('lostyle',plugins_url("css/style.css", __FILE__));
       add_shortcode("feedback",array($this, "feedback_shortcode"));
    }
    
    public function register_widget(){
        register_widget('Wp_Simple_Feedback_Widget');
    }
    
    public function feedback_shortcode() {
        include_once(plugin_dir_path(__FILE__) . 'wp-simple-feedback-feedback.php');
    }
    
    public function setup_admin_menu(){
        add_menu_page(PLUGIN_NAME,__("Feedback",PLUGIN_NAME),"manage_options",PLUGIN_NAME,array($this, "admin_page"));
        add_submenu_page(PLUGIN_NAME,__("Target Settings", PLUGIN_NAME),__("Target Settings", PLUGIN_NAME),"manage_options",PLUGIN_NAME,array($this,"admin_page"));
        add_submenu_page(PLUGIN_NAME,__("Feedbacks", PLUGIN_NAME),__("Feedbacks", PLUGIN_NAME),"manage_options","submenu2",array($this,"admin_feedbacks"));

        
    }
    
    public function admin_page() {
        include_once(plugin_dir_path(__FILE__) . "admin/wp-settings.php");
    }
    
    public function admin_feedbacks() {
        include_once(plugin_dir_path(__FILE__) . "admin/wp-feedbacks.php");
    }
    
    public function change_feedback_target_title($title,$id){
        if ($title=="wp-simple-feedback"){
            global $wpdb;
            
            $table_name=$wpdb -> prefix . "wsf_target";
         
         $target=$wpdb -> get_row("SELECT * FROM " . $table_name);
         return $target->name;
        }
        else {
            return $title;
        }
    }
    
     public function change_feedback_target_wp_title($title,$id){
        if (substr($title,0,24)=="wp-simple-feedback"){
            global $wpdb;
            
            $table_name=$wpdb -> prefix . "wsf_target";
         
         $target=$wpdb -> get_row("SELECT * FROM " . $table_name);
         return $target->name . "|";
        }
        else {
            return $title;
        }
    }
}

add_action('plugins_loaded','wp_simple_feedback_init');


function wp_simple_feedback_init(){
    $wp_simple_feedback=new Wp_Simple_Feedback_Class();
}