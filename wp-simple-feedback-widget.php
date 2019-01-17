<?php

/*
This widget displays number of feedbacks.
*/

class Wp_Simple_Feedback_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'wp_simple_feedback_widget',
            __('Feedback','wp-simple-feedback'),
            array('description' =>__('Dispalys number of feedbacks',PLUGIN_NAME),)
            );
    }
    
    public function widget($args,$instance) {
        global $wpdb;
        
        $feedback_count=$wpdb->get_var("SELECT COUNT(id) FROM " . $wpdb->prefix . "wsf_feedback" );
        
        print "<aside class='widget'>";
        print "<p>" . __('Number of feedbacks', PLUGIN_NAME) . "<br />" . $feedback_count . "</p>";
        print "</aside>";
        }
        
    public function form($instance) {
        
    }
    
    public function update($new_instance, $old_instance) {
        
    }
}

