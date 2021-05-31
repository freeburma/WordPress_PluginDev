<?php 
    $id = null; 
    $saleMonth = null; 
    $saleTotal = null; 
 
    $getId = $_GET["Id"]; 
    $getAction = $_GET["action"]; 
   
    global $wpdb;  

    //// Getting data and display on textboxes
    if ( ! empty($getId)) // 
    {
        $stockDataDb = $wpdb->get_row(
            "Select `Id`, Month, SaleAmount FROM wp_Custom_SaleData WHERE Id = $getId"
        );
        
        $id = $stockDataDb->Id; 
        $saleMonth = $stockDataDb->Month; 
        $saleTotal = $stockDataDb->SaleAmount; 


        //// Updating the data to db 
        if (isset($_POST["UpdatingStockData"]))
        {
            $nounce = $_POST["myplugin_nonce"]; 
            
            if (wp_verify_nonce( $nounce, 'myplugin_nonce' ))
            {
                //// Resetting the variables
                $saleMonth = null; 
                $saleTotal = null;

                $saleMonth = sanitize_text_field( $_POST['saleMonth']); 
                $saleTotal = sanitize_text_field( $_POST['SaleTotal']); 

                

                //// Preparing data to db 
                $saleUpdateDataQuery = array(
                     'Month' => $saleMonth, 
                    'SaleAmount' => $saleTotal
                ); 

                //// Inserting data to db 
                $wpdb->update('wp_Custom_SaleData', $saleUpdateDataQuery, array('Id' => $getId)); 


            }// end if 

            //// Redirecting to this page
            print('<script>window.location.href="admin.php?page=my_plugin"</script>');
        }// end if 

        //// Updating the data to db 
        if (isset($_POST["DeletingStockData"]))
        {
            $nounce = $_POST["myplugin_nonce"]; 
            
            if (wp_verify_nonce( $nounce, 'myplugin_nonce' ))
            {
                $wpdb->delete('wp_Custom_SaleData', array('Id' => $getId)); 
            }// end if 

            //// Redirecting to this page
            print('<script>window.location.href="admin.php?page=my_plugin"</script>');

        }// end if 

    }
    else 
    {

        //// Adding the data to db 
        if (isset($_POST["AddingStockData"]))
        {
            $nounce = $_POST["myplugin_nonce"]; 
            
            if (wp_verify_nonce( $nounce, 'myplugin_nonce' ))
            {
                //// Resetting the variables
                $saleMonth = null; 
                $saleTotal = null;

                $saleMonth = sanitize_text_field( $_POST['saleMonth']); 
                $saleTotal = sanitize_text_field( $_POST['SaleTotal']); 

                //// Preparing data to db 
                $saleDataQuery = $wpdb->prepare("INSERT INTO wp_Custom_SaleData 
                    (`Month`, `SaleAmount`)
                    VALUES (%s, %d)", $saleMonth, $saleTotal
                ); 

                //// Inserting data to db 
                $wpdb->query($saleDataQuery); 


            }// end if 

            //// Redirecting to this page
            print('<script>window.location.href="admin.php?page=my_plugin"</script>');

        }// end if 
    }// end if 

    
 





?>
<div class="container">
	<h1>Add/Edit Sale Data</h1>

    <h2>BootStrap 4 - Form Validation</h2>
    <p>Sample from https://www.w3schools.com</p>

    <p>In this example, we use <code>.was-validated</code> to indicate what's missing before submitting the form:</p>

    <!-- *** We are submitting on the same page -->
    <form action="" class="was-validated" method="post">
        <?php $nounce = wp_create_nonce( 'myplugin_nonce' ) ?>
        <input type="hidden" name="myplugin_nonce" value="<?php echo $nounce ?>" />

        <div class="form-group">
            <label for="saleMonthId">Month:</label>
            <input type="text" class="form-control" id="saleMonthId" placeholder="Enter Sale Month" name="saleMonth" value="<?php echo $saleMonth; ?>" required>

            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="form-group">
            <label for="SaleTotalId">Amount:</label>
            <input type="decimal" class="form-control" id="SaleTotalId" placeholder="Enter Sale Amount" name="SaleTotal" value="<?php echo $saleTotal; ?>" required>

            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <?php 
            if ( ! empty($getId) && ($getAction == "detail" || $getAction == "edit" )) // Showing detail to update
            {
        ?>
                <button type="submit" class="btn btn-primary" name="UpdatingStockData" class="btn btn-primary">Update</button>
        <?php
            }
            else if ( ! empty($getId) && $getAction == "delete") // Deleting
            {
        ?>
                <button type="submit" class="btn btn-danger" name="DeletingStockData" class="btn btn-primary">Delete</button>

        <?php
            }
            else 
            {
        ?>
                <button type="submit" class="btn btn-info" name="AddingStockData" class="btn btn-primary">Add New</button>
        <?php
            }// end if 
        ?>
    </form>
</div>
