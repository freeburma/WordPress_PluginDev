<?php 
/*
    Plugin Name: Google Chart Custom Table 
    Description: Google Chart with Custom Table. We will be developing a wordpress plugin 
    with Google Line Chart. 
    Version: 1.0
    Author: Your Name 
    License: GPLv2 or Later
    
    Text Domain: https://stackoverflow.com/questions/40867316/call-to-undefined-function-convert-to-screen

    **** Coding Ref: https://github.com/Veraxus/wp-list-table-example.git 

*/

    if (! defined('ABSPATH'))
    {
        exit; 
    }

    function myplugin_render()
    {
        add_menu_page( 
                        __('Google Line Chart', 'myplugin'), // Page Title
                        __('Google Line Chart', 'myplugin'), // Menu Title
                        'activate_plugins',                  // Capability
                        'my_plugin',                         // Menu slug
                        'myplugin_google_line_chart_page',   // Callback function 
                        'dashicons-chart-bar' // choose your icon:  https://developer.wordpress.org/resource/dashicons/#admin-site
                    ); 
    }//  end myplugin_render()

    function myplugin_google_line_chart_page()
    {
        //// Displaying the view 
        include (dirname(__FILE__) . '/views/GoogleChart.php'); 

    }// end myplugin_google_line_chart_page()


    //// *** Showing our plugin on WordPress Admin Menu
    add_action( 'admin_menu', 'myplugin_render'); 

    //// Activating Plugin 
    require ( dirname(__FILE__) . '/include/PluginActivate.php');
    register_activation_hook( __FILE__, array('PluginActivate', 'activate')); 

    //// Deactivating Plugin 
    require ( dirname(__FILE__) . '/include/PluginDeactivate.php');
    register_deactivation_hook( __FILE__, array('PluginDeactivate', 'deactivate')); 

    


?>