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

    /**
     * Inheriting WP_List_Table
     */
    if ( ! class_exists( 'WP_List_Table' ) ) 
    {
        require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
    }// end if 

    require( dirname(__FILE__) . '/include/SaleDataTable.php'); 


    //// Loading CSS Style 
    wp_enqueue_style('MainCSS', plugins_url( '/assets/css/style.css', __FILE__)); 

    //// Loading JS File 
    wp_enqueue_script('MainJs', plugins_url( '/assets/js/GoogleLineChart.js', __FILE__)); 

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

        ## Sale Info 
        add_submenu_page(
            'my_plugin',              // Parent slug
            'Sale Info',       // Menu slug
            'Sale Info',       // menu title
            'manage_options',               // capability
            'sale_info',       // slug
            'sale_info_render_page'      // callback
        );

        add_submenu_page(
            'my_plugin',              // Parent slug
            'Add_Edit_SaleData',       // Menu slug
            'Add/Edit SaleData',       // menu title
            'manage_options',          // capability
            'Add_Edit_SaleData',       // slug
            'test_render_page'      // callback
        );


    }//  end myplugin_render()

    
    function myplugin_google_line_chart_page()
    {
        $saleDataTableObj = new SaleDataTable(); 
        $saleDataTableObj->prepare_items(); 


        //// Displaying the view 
        include (dirname(__FILE__) . '/views/GoogleChart.php'); 

    }// end myplugin_google_line_chart_page()

    function sale_info_render_page()
    {
        $saleDataTableObj = new SaleDataTable(); 
        $saleDataTableObj->prepare_items(); 


        include (dirname(__FILE__) . '/views/SaleData.php'); 

    }// end sale_info_render_page()


    function test_render_page()
    {
        
        include (dirname(__FILE__) . '/views/Add_Edit_SaleData.php'); 

    }// end sale_info_render_page()



    //// *** Showing our plugin on WordPress Admin Menu
    add_action( 'admin_menu', 'myplugin_render'); 

    //// Activating Plugin 
    require ( dirname(__FILE__) . '/include/PluginActivate.php');
    register_activation_hook( __FILE__, array('PluginActivate', 'activate')); 

    //// Deactivating Plugin 
    require ( dirname(__FILE__) . '/include/PluginDeactivate.php');
    register_deactivation_hook( __FILE__, array('PluginDeactivate', 'deactivate')); 

    


?>