<?php

class Wp_Simple_Feedback {
    
    /** Creates target and feedback tables in WP database. 
        wp_wsf_target (palautteen kohde, isätaulu)
        wp_wsf_feedback (palautteet, lapsitaulu)
    */
    
    public static function activate() {
        global $wpdb;
        $table_name1=$wpdb->prefix . "wsf_target";
        
       $sql = "CREATE TABLE IF NOT EXISTS $table_name1 (
            id int(11) PRIMARY KEY AUTO_INCREMENT,
            name varchar(50) NOT NULL,
            description text,
            active tinyint(1)
        );";
        
        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta($sql);
        
        $table_name2=$wpdb->prefix . "wsf_feedback";
        $sql = "CREATE TABLE IF NOT EXISTS " . $table_name2 . "( ";
        $sql .= "id int(11) PRIMARY KEY AUTO_INCREMENT,";
        $sql .= "time timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,";
        $sql .= "feedback_value int(11) NOT NULL,";
        $sql .= "feedback_text text NOT NULL,";
        $sql .= $table_name1 . "_id int(11) NOT NULL,";
        $sql .= "INDEX par_ind (" . $table_name1 . "_id),";
        $sql .= "FOREIGN KEY (" . $table_name1. "_id) REFERENCES " . $table_name1 . "(id) ";
        $sql .= "ON DELETE RESTRICT);";
        
        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta($sql);
        
        add_option("simple-feedback-db-version","0.1");
    }
    
    /**
    Drops target and feedback tables when user deletes this plugin.
     */
     
     public static function uninstall() {
      global $wpdb;
      $table_name = $wpdb -> prefix . "wsf_feedback";
      $sql = "DROP TABLE IF EXISTS $table_name;";
      $wpdb->query($sql);
      $table_name = $wpdb -> prefix . "wsf_target";
      $sql = "DROP TABLE IF EXISTS $table_name;";
      $wpdb->query($sql);
      delete_option("wpportfolio_browser_db_version");
     }
    
}