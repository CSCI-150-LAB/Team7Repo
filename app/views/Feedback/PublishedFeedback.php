

<?php

$user = User::getCurrentUser();


?>

<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">Feedback Sessions <?php echo $class->class ?></h1>

<?php
    if($user->type == "student") {
        echo "<a class = 'btn btn-secondary float-left' style = 'color: #ffffff;' href = '" . $this->baseUrl('/Student/AllResponses') . "' > My Responses</a>";
    }

   
?>

<?php foreach($feedbackSessions as $feedback):?>
    <?php 
        
        //$exists = ResponseModel::getByKey($feedback->feedbackid);
        $exists = ResponseModel::findOne("student_id =:0: AND feedback_id =:1:", $user->id, $feedback->feedbackid);
        

        if($user->type == "instructor") {
            $url = "Feedback/InstructorResult/{$feedback->feedbackid}";

        }

        if($exists) {
            $url = "Student/AllResponses";
        }

        else {

            if($feedback->feedbacktype == "1") {
            
                $url = "Feedback/Response/{$feedback->feedbackid}"; //Go to text feedback page
            }

            else  { 
                $url = "Feedback/RatingResponse/{$feedback->feedbackid}"; //Go to rating page
            }
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

