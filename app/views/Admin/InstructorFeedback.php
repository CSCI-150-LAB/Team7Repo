<div class="container">
    <h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">Instructor Feedback</h1>

    <table class="table table-bordered table-sm table-striped
     pl-5 tbl-background"> 
        <thead>
            <tr>
                <th scope="col"> Account Type </th>
                <th scope="col"> Full Name </th>
                <th scope="col"> Average Rating </th>
            </tr>
        </thead> 
        <tbody>  
        <?php foreach($useraccounts as $account):?>    
            <tr>   
            <?php if ($account->type == "instructor") {?>                                                          
                <td> <?php echo $account->type ?></td>
                <td> <a href='<?php echo $this->baseUrl("/Instructor/ViewReviews/{$account->id}") ?>'><?php echo $account->getFullName()?></a></td>
                <td> </td> 
            </tr>
            <?php } ?>
        <?php endforeach; ?>
        </tbody>
    </table>      
</div>