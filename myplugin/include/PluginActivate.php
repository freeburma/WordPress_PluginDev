<?php
class PluginActivate
{
    public static function activate()
    {
        flush_rewrite_rules( );

    }// end function deactivate()

    
}// end class PluginActivate
?>
