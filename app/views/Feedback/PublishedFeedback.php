<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">Feedback Sessions for CSCI 150 </h1>

<?php foreach($feedbackSessions as $feedback):?>
    <?php 
        $starttime = strtotime($feedback->start) > time();
        $endtime = strtotime($feedback->end) > time();

        $active = $starttime && $endtime ? "Inactive" : "Active"; //TODO check start time
    ?> 
           <table class="table table-bordered"> <!--TODO Need to fix layout-->
                <thead>
                    <tr>
                        <th scope="col"> Description </th>
                        <th scope="col"> Active/Inactive </th>
                        <th scope="col"> Time assigned </th>
                    </tr>
                </thead>
                <tbody>  
                    <tr>
                        <td><?php echo $feedback->feedbackdescription ?></td>
                        <td> <?php echo $active ?> </td>
                        <td> <?php echo $feedback->start . ' ' . $feedback->end?> </td> <!--TODO Fix time output-->
                       
                    </tr>
                </tbody>
            </table>
<?php endforeach;?>
