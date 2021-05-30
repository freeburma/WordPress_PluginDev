<?php 

//// Got a clue from following list. Have a look. 
//// **** Ref: https://github.com/Veraxus/wp-list-table-example.git 


class SaleDataTable extends WP_List_Table
{
    public function __construct()
    {
        //// Assing the names to super class
        parent::__construct(array(
            'singular' => 'saledata', 
            'plural'   => 'saledata', 
            'ajax'     => false,
        )); 
    }// end __construct()

    /**
     * Displaying columns 
     */
    public function get_columns()
    {
        $columns = array(
            'cb'            => '<input type="checkbox" />', // Multiple select
            'Id'            => _x('Id', 'Column label', 'sale-data'),
            'Month'         => _x('Month', 'Column label', 'sale-data'),
            'SaleAmount'    => _x('Sale Amount', 'Column label', 'sale-data'),
        ); 

        return $columns; 
    }// end get_columns()

    /**
     * Creating sortable columns 
     */
    public function get_sortable_columns()
    {
        $sortable_columns = array(
            'Id'            => array('Id', false),
            'Month'         => array('Month', false),
            'SaleAmount'    => array('Sale Amount', false),
            
        ); 

        return $sortable_columns; 

    }// end get_sortable_columns()

    /*
        Must use the same name as "get_columns()" function/method (case sensitive). 
        *** Important to add if you are not using the default property
    */
    protected function column_default($item, $column_name) 
    {
        switch ($column_name) 
        {
            case 'Id':
            case 'Month':
            case 'SaleAmount':
                return $item[$column_name]; 
            
            default: 
                return print_r($item, true); // Showing the entire array for troubleshooting. 

        }// end switch


    }// end column_default()

    /*
        Input Checkbox
    */
    protected function column_cb( $item ) 
    {
        return sprintf(
                '<input type="checkbox" name="%1$s[]" value="%2$s" />',
                $this->_args['singular'],  // Let's simply re-purpose the table's singular label ("movie").
                $item['Id']                // The value of the checkbox should be the record's Id.
            );
    }// end column_cb()

    /** 
     * Note: Important =>function column_{<your_defined_column_name>} ()
     * Example: "column_Id" => is applied to Id column in the list 
     * If you want to apply in "Month" col, the column name must be "column_Month"
    */
    protected function column_Id($item)
    {
        $page = wp_unslash($_REQUEST['page']); // WPCS: Input var ok 

        // Detail Info
        $detail_query_args = array(
            'page'  => "Test", // Must Be "PHP view file"
            'action' => 'edit', 
            'Id' => $item['Id'], // Passing as the routing parameter
        ); 

        $actions['detail'] = sprintf(
            '<a href="%1$s">%2$s</a>', 
            esc_url( wp_nonce_url( add_query_arg($detail_query_args, 'admin.php'), 'Test', "myplugin_nonce" )), 
            _x('Detail', 'List table row action', 'sale-data')
        ); 


        // Return the title contents 
        return sprintf('%1$s <span style="color:silver;">(id:%2$s)</span>%3$s', 
        $item['Id'], 
        $item['Id'], 
        $this->row_actions($actions) 
        ); 

    }// end column_Id()

    protected function get_bulk_actions() 
    {
        $actions = array(); 
        $actions = array(
            'delete' => _x( 'Delete', 'List table bulk action', 'sale-data' ),
        );

        return $actions;
    }// end get_bulk_actions()


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
    
    }// end usort_reorder()



    function prepare_items() 
    {
        /* Required: */
        $columns  = $this->get_columns(); 
        $hidden   = array(); 
        $sortable = $this->get_sortable_columns(); 

        /* Required: Column Headers */
        $this->_column_headers = array( $columns, $hidden, $sortable);

        $this->process_bulk_action(); // TODO: To be implemented

        // ========================== DATA ==============================
        // $data = $this->example_data;
        global $wpdb; 

        // $saleDataFromDb = $wpdb->get_results(
        //     $wpdb->prepare("SELECT * FROM wp_Custom_SaleData")
        // ); 

        $saleDataFromDb = $wpdb->get_results(
            "SELECT * FROM wp_Custom_SaleData"
        ); 

        $data = array( );

       

        //// Adding the data to array

        if (is_array($saleDataFromDb))
        {
            foreach ($saleDataFromDb as $saleData) 
            {
                $saleDataDetail = array(
                    'Id' =>  $saleData->Id, 
                    'Month' => $saleData->Month, 
                    'SaleAmount' => $saleData->SaleAmount, 
    
                ); 
    
                //// Adding the data to array
                array_push($data, $saleDataDetail); 
    
            }// end foreach
        }// end if 

        

        print_r($data); 
        // print_r($saleDataFromDb); 

        // ========================== DATA ==============================

        /* Dummy sorting *** might not need when we are dealing with db */
        usort($data, array($this, 'usort_reorder')); // usort_reorder: is a callback function
        // usort($saleDataFromDb, array($this, 'usort_reorder')); // usort_reorder: is a callback function

        /* Required: Pagination */
        
        $per_page = 10; // Number of items per page 
        $current_page = $this->get_pagenum(); 
        $total_items = count($data); 

        /*
        * The WP_List_Table class does not handle pagination for us, so we need
        * to ensure that the data is trimmed to only the current page. We can use
        * array_slice() to do that.
        */
        $data = array_slice($data, (($current_page - 1) * $per_page), $per_page); 

        /*
        * REQUIRED. Now we can add our *sorted* data to the items property, where
        * it can be used by the rest of the class.
        */
        $this->items = $data;
        
        /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args( array(
            'total_items'   => $total_items, 
            'per_page'      => $per_page, 
            'total_pages'   => ceil($total_items / $per_page),
        ));


    }// end prepare_items()

   

}// end SaleDataTable

?>
