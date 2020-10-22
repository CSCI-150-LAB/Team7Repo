<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">Feedback Sessions for CSCI 150 </h1>

<?php foreach($feedbackSessions as $feedback):?>
    <?php 
        $starttime = strtotime($feedback->start) > time();
        $endtime = strtotime($feedback->end) > time();

        $active = $starttime && $endtime ? "Inactive" : "Active";
    ?> <!--TODO check start time --> 
           <table class="table table-bordered">
                <thead>
                    <tr>
                        <th > Class </th>
                        <th > Description </th>
                        <th > Active/Inactive </th>
                    </tr>
                </thead>
                <tbody>  
                    <tr>
                        <td>CSCI 150</td>
                        <td><?php echo $feedback->feedbackdescription ?></td>
                        <td> <?php echo $active ?> </td>
                    </tr>
                </tbody>
            </table>
<?php endforeach;?>
