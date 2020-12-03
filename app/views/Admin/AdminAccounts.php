<div class="container">
    <h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">Admin Accounts</h1>
        
        <a class = "btn btn-secondary float-right" style="color: #ffffff;" href ='<?php echo $this->baseUrl("/Admin/AddUser") ?>'>Add an Admin</a><br><br>
        <a class = "btn btn-secondary float-right" style="color: #ffffff;" href ='<?php echo $this->baseUrl("/Admin/AddUser") ?>'>Add Admin by CSV</a><br><br>
    
    <table class="table table-bordered"> 
        <thead>
            <tr>
                <th scope="col"> Full Name </th>
                <th scope="col"> Email </th>
            </tr>
        </thead> 
        <tbody>  
        <?php foreach($adminaccounts as $account):?>    
            <tr>   
            <?php if ($account->type == "admin") {?>                                                          
                <td> <a href='<?php echo $this->baseUrl("/Admin/Profile/{$account->id}") ?>'><?php echo $account->getFullName()?></a></td>
                <td> <?php echo $account->email ?> </td>  
            </tr>
            <?php } ?>
        <?php endforeach; ?>
        </tbody>
    </table>      
</div>
