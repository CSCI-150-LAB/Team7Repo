<div style= "padding-top: 150px; "> 
  <div class="card container" style="width: 18rem;">
    <div class="card-body">
      <?php if (count($errors)) : ?>
      <ul class="error-list">
        <?php foreach ($errors as $errorMsg) : ?>
          <li><?php echo $errorMsg ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
      <h4 class="card-title" style="text-align: center;">Login</h4>
      <form method="POST">
          <label for="email">Email:</label>
          <br>
          <input class="mb-3" type="text" name="email" id="email">
          <br> 
          <label for="password">Password:</label>
          <br>
          <input class="mb-3" type="password" name="password" id="password">
          <br> 
          <input type="submit" name="submit" value="Submit">
      </form>
      <p> No account? <a href ='<?php echo $this->baseUrl('/User/Register') ?>'> Register here. </a> </p>
    </div>
  </div>
</div> 