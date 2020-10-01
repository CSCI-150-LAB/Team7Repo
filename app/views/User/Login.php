<h1>Login</h1>
    <?php if (count($errors)) : ?>
		<ul class="error-list">
		<?php foreach ($errors as $errorMsg) : ?>
			<li><?php echo $errorMsg ?></li>
		<?php endforeach; ?>
		</ul>
    <?php endif; ?>
    
    <form method="POST">
        <label for="email">Email:</label>
        <br>
        <input type="text" name="email" id="email">
        <br>

        <label for="password">Password:</label>
        <br>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
    
