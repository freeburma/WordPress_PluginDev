<?php 

class PluginDeactivate
{
    public static function deactivate()
    {
        flush_rewrite_rules( );

    }// end function deactivate()

    
}// end class PluginDeactivate

?>