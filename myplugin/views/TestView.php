<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<div style="background:#ececec;border:1px solid #ccc;padding:0 10px;margin-top:5px;border-radius:5px;">
		<p>This page demonstrates the use of the <code>WP_List_Table</code> class in plugins.</p>
		<p>For a detailed explanation of using the <code>WP_List_Table</code> class in your own plugins, simply open <code>class-tt-example-list-table.php</code> in the PHP editor of your choice.</p>
		<p>Additional class details are available on the <a href="http://codex.wordpress.org/Class_Reference/WP_List_Table" target="_blank">WordPress Codex</a> or <a href="https://developer.wordpress.org/reference/classes/WP_List_Table/" target="_blank">Developer Code Reference</a>.</p>
	</div>

	<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
	<form id="movies-filter" method="get">
		<!-- For plugins, we also need to ensure that the form posts back to our current page -->
		<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
		<!-- Now we can render the completed list table -->
		<?php $test->display() ?>
	</form>

</div>
