<?php 

class PluginDeactivate
{
    public static function deactivate()
    {
        //// DELETING the table after we installed the plugin
        global $wpdb; 

        $dropTable = $wpdb->prepare("DROP TABLE IF EXISTS wp_Custom_SaleData"); 
        $wpdb->query($dropTable); 

        flush_rewrite_rules( );

    }// end function deactivate()

    
}// end class PluginDeactivate

?>