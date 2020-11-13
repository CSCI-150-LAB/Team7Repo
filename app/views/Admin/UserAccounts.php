<div class="container">
    <h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">
        User Accounts</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col"> Account Type </th>
                <th scope="col"> Name </th>
                <th scope="col"> Email </th>
            </tr>
        </thead>
        <tbody>
            <?php /*foreach($classes as $class):?>
                <tr>
                    <td><a href = '<?php echo $this->baseUrl("/Admin/UserAccounts/{$class->classid}") ?>'><?php echo $class->class ?></a></td>
                    <td><?php echo $class->description ?></td>
                    <td><?php echo $class->getClassTimeString() ?></td>
                    <td></td>
                </tr>
            <?php endforeach; */?> 
        </tbody>
    </table>
</div>