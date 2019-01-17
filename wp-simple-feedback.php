<?php

/*
Plugin Name: Simple Feedback
Plugin URI: https://foo.fi
Version: 0.1
Author: Liisa Ojala
Lisence: GPLv2 or later
Description: Enables users to give feedback.
Text Domain: simple-feedback
 */
 
define("PLUGIN_NAME", "wp-simple-feedback");

include_once('wp-simple-feedback-class.php');
include_once('wp-simple-feedback-database-creation.php');
include_once('wp-simple-feedback-widget.php');
//include_once('wp-simple-feedback-feedback.php');


register_activation_hook(__FILE__,array('Wp_Simple_Feedback','activate'));
register_uninstall_hook(__FILE__,array('Wp_Simple_Feedback','uninstall'));