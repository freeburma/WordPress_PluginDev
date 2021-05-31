<?php
class PluginActivate
{
    public static function activate()
    {
        //// CREATING the table after we installed the plugin
        global $wpdb; 

        $createTable = $wpdb->prepare("CREATE TABLE IF NOT EXISTS wp_Custom_SaleData(
                                        Id INT NOT NULL AUTO_INCREMENT, 
                                        Month VARCHAR(30), 
                                        SaleAmount DECIMAL(16, 2),
                                        PRIMARY KEY (ID) 
                                    )"); 
        $wpdb->query($createTable); 

        $addData = $wpdb->prepare("INSERT INTO wp_Custom_SaleData
                                                    (Month, SaleAmount) 
                                                    VALUES 
                                                    ('Jan', 3000), 
                                                    ('Feb', 3134),  
                                                    ('Mar', 4199), 
                                                    ('Apl', 1999), 
                                                    ('May', 700), 
                                                    ('Jun', 300), 
                                                    ('Jul', 450), 
                                                    ('Aug', 1024), 
                                                    ('Sep', 2456),
                                                    ('Oct', 4579), 
                                                    ('Nov', 5104), 
                                                    ('Dec', 5456)
                                        "); 

        $wpdb->query($addData); 

        flush_rewrite_rules( );

    }// end function deactivate()

    
}// end class PluginActivate
?>
