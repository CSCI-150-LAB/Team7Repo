<div class="container">
    <h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">User Accounts</h1>
        
        <a class = "btn btn-secondary float-right" style="color: #ffffff;" href ='<?php echo $this->baseUrl("/Admin/AddUser") ?>'>Add a User</a><br><br>
        <a class = "btn btn-secondary float-right" style="color: #ffffff;" href ='<?php echo $this->baseUrl("/Admin/AddUser") ?>'>Add Users by CSV</a><br><br>
    
    <table class="table table-bordered table-sm table-striped
     pl-5 tbl-background"> 
        <thead>
            <tr>
                <th scope="col"> Account Type </th>
                <th scope="col"> Full Name </th>
                <th scope="col"> Email </th>
            </tr>
        </thead> 
        <tbody>  
        <?php foreach($useraccounts as $account):?>    
            <tr>   
            <?php if ($account->type != "admin") {?>                                                          
                <td> <?php echo $account->type ?></td>
                <?php
                    if ($account->type == "student") { ?>
                    <td> <a href='<?php echo $this->baseUrl("/Student/Profile/{$account->id}") ?>'><?php echo $account->getFullName()?></a></td>
                   <?php } else { ?>
                    <td> <a href='<?php echo $this->baseUrl("/Instructor/Profile/{$account->id}") ?>'><?php echo $account->getFullName()?></a></td>
                  <?php  } ?>
                <td> <?php echo $account->email ?> </td>  
            </tr>
            <?php } ?>
        <?php endforeach; ?>
        </tbody>
    </table>      
</div>
