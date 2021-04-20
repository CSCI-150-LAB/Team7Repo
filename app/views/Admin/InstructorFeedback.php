<div class="container">
    <h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">Instructor Feedback</h1>
    <table class="table table-bordered table-sm table-striped
     pl-5 tbl-background"> 
        <thead>
            <tr>
                <th scope="col"> Full Name </th>
                <th scope="col"> Average Rating </th>
            </tr>
        </thead> 
        <tbody>  
        <?php foreach($useraccounts as $account):
            $instructor = User::findOne("id =:0:", $account->instructorid); ?>
            <tr>
                <td> <a href='<?php echo $this->baseUrl("/Instructor/ViewReviews/{$account->instructorid}") ?>'><?php echo $instructor->getFullName()?></a></td>
                <td> <?php echo PrintHelpers::printStarRating($account->rating) ?></td> 
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>      
</div>