<?php 
$currentUser = User::getCurrentUser();
if($currentUser->type == "instructor"): ?>
<a class = 'btn btn-secondary float-md-right text-white' data-reset-tour='Instructor Tour' href = '<?php echo($this->baseUrl("/Instructor/Profile/{$currentUser->id}")) ?>'>Help</a><br><br>
<?php else: ?>
    <a class = 'btn btn-secondary float-md-right text-white' data-reset-tour='Instructor Tour' href = '<?php echo($this->baseUrl("/Instructor/Profile/1443")) ?>'>Help</a><br><br>
<?php endif; ?>
