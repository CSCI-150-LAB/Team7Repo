<div class="container">
    <h1 class="mb-3" style= "background-color: #13284c; padding: 60px; color: #fff;">Welcome, <?php echo $user->firstName." ".$user->lastName?>. </h1>
    <div> 
        <img src="<?php echo $this->publicUrl('images/blank_avatar.png')?>" width="200px" alt="blank_avatar">
        <h3 class = 'aprofile'> <?php echo $user->email ?></h3><br>
    </div>
</div>