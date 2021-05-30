<div>
    <h3>Sale Data</h3>

    <form id="saleDataID" action="" method="get">
        <!-- For plugins, we also need to ensure that the form posts back to our current page -->
		<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
		
        <!-- Now we can render the completed list table -->
		<?php $saleDataTableObj->display() ?>
    </form>
</div>
