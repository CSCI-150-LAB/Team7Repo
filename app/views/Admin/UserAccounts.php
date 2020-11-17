<div class="container">
    <h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">
        User Accounts</h1>

    <?php foreach($useraccounts as $account):?>    

            <table class="table table-bordered"> 
                    <thead>
                        <tr>
                            <th scope="col"> Account Type </th>
                            <th scope="col"> Full Name </th>
                            <th scope="col"> Email </th>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>                                                             
                            <td> <?php echo $account->type ?></td> 
                            <td> <?php echo $account->getFullName() ?> </td>
                            <td> <?php echo $account->email ?> </td>  
                        </tr>
                    </tbody>
            </table>
            
    <?php endforeach;?>
</div>
