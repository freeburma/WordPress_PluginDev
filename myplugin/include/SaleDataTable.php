<?php 

//// Got a clue from following list. Have a look. 
//// **** Ref: https://github.com/Veraxus/wp-list-table-example.git 


class SaleDataTable extends WP_List_Table
{
    public function __construct()
    {

    }// end __construct()

    public function get_columns()
    {

    }// end get_columns()

    public function get_sortable_columns()
    {

    }// end get_sortable_columns()

    /*
        Must use the same name as "get_columns()" function/method (case sensitive). 
        *** Important to add if you are not using the default property
    */
    protected function column_default($item, $column_name) 
    {

    }// end column_default()

    /*
        Input Checkbox
    */
    protected function column_cb( $item ) 
    {

    }

    /** 
     * Note: Important =>function column_{<your_defined_column_name>} ()
     * Example: "column_Id" => is applied to ID column in the list 
     * If you want to apply in "Min_Km" col, the column name must be "column_Min_Km"
    */
    protected function column_Id($item)
    {

    }

    protected function get_bulk_actions() 
    {
        $actions = array(); 
        // $actions = array(
        //     'delete' => _x( 'Delete', 'List table bulk action', 'delivery-fee' ),
        // );

        return $actions;
    }


    /* 
        Bulk Action Delete
        TODO: Still hasn't implemented yet. 
    */
    protected function process_bulk_action()
    {
       
    }// end process_bulk_action()

    protected function usort_reorder($a, $b)
    {
        // If no sort, default to Id.
        $orderby = ! empty( $_REQUEST['orderby'] ) ? wp_unslash( $_REQUEST['orderby'] ) : 'Id'; // WPCS: Input var ok.

        // If no order, default to asc.
        $order = ! empty( $_REQUEST['order'] ) ? wp_unslash( $_REQUEST['order'] ) : 'dsc'; // WPCS: Input var ok.

        // Determine sort order.
        $result = strcmp( $a[ $orderby ], $b[ $orderby ] );

        return ( 'asc' === $order ) ? $result : - $result;
    }



    function prepare_items() 
    {
        

    }// end prepare_items()

   

}// end SaleDataTable

?>
