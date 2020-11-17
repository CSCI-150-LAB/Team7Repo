<?php
    $numofresponses = count($feedbackresult);
    
?>

<h2 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;"><?php echo $numofresponses ?> student responses</h2>




<?php foreach($feedbackresult as $result):?
>
    
    <table class="table table-bordered"> 
        <thead>
            <tr>
                <th scope="col"> Student ID </th>
                <th scope="col"> Response </th>
            </tr>
        </thead>
        <tbody>  
            <tr>                                                             
                <td> <?php echo $result->studentid ?></td> 
                <td> <?php echo $result->response ?> </td>
                
                
            </tr>
        </tbody>
    </table>
<?php endforeach;?>