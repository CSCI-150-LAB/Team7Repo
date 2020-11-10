<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">Feedback Sessions for CSCI 150 </h1>

<?php

$user = User::getCurrentUser();
$url;
?>




<?php foreach($feedbackSessions as $feedback):?>
    <?php 
        /* $starttime = strtotime($feedback->start) > time();
        $endtime = strtotime($feedback->end) > time();

        $active = $starttime && $endtime ? "Inactive" : "Active";  */

        if($user->type == "instructor") {
            $url = "Feedback/InstructorResult/{$feedback->feedbackid}";
        }
        else {
            $url = "Feedback/Response/{$feedback->feedbacktype}";
        }

        
    ?> 
           <table class="table table-bordered"> 
                <thead>
                    <tr>
                        <th scope="col"> Title </th>
                        <th scope="col"> Description </th>
                    </tr>
                </thead>
                <tbody>  
                    <tr>                                                             
                        <td> <a href='<?php echo $this->baseUrl($url)?>'><?php echo $feedback->feedbacktitle ?></a></td> 
                        <td> <?php echo $feedback->feedbackdescription ?> </td>
                        
                       
                    </tr>
                </tbody>
            </table>
<?php endforeach;?>
