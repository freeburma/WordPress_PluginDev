
<div class="container">
	<h1>Add/Edit Sale Data</h1>

    <h2>BootStrap 4 - Form Validation</h2>
    <p>Sample from https://www.w3schools.com</p>

    <p>In this example, we use <code>.was-validated</code> to indicate what's missing before submitting the form:</p>
    <form action="/action_page.php" class="was-validated">
        <div class="form-group">
            <label for="uname">Username:</label>
            <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>

            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
            
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

       
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
