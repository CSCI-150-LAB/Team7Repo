<div class="container">
    <h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">Instructor Feedback</h1>

    <table class="table table-bordered"> 
        <thead>
            <tr>
                <th scope="col"> Full Name </th>
                <th scope="col"> Email </th>
            </tr>
        </thead> 
        <tbody>  
        <?php foreach($feedback as $f):?>    
            <tr>                                                         
                <?php if ($f->type == "instructor") { ?>
                    <td> <a href='<?php echo $this->baseUrl("/Instructor/ViewReviews/{$f->id}") ?>'><?php echo $f->getFullName()?></a></td>
                    <td> <?php echo $f->email ?> </td>  
                   <?php } ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>      
</div>
