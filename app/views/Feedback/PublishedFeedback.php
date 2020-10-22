<h1>Query of published feedback Page </h1>

<?php foreach($feedbackSessions as $feedback):?>
    <?php 
        $startactive = strtotime($feedback->start) > time();
        $endactive = strtotime($feedback->end) > time();
    ?> <!--TODO check start time --> 
           
           <div>
            <?php echo  $feedback->feedbackdescription?>
            <?php
                if($startactive && $endactive) {
                    echo "not active";
                }
                else {
                    echo "active";
                } 
            ?>
        </div>


<?php endforeach;?>