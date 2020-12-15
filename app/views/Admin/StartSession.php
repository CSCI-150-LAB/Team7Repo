<div class="container">
    <h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;"> Start Feedback Session</h1>
    <!--Select Class-->
    
    <?php $d = $inclasses  ?> 
    <p> Heyy <?php echo '<pre>'; print_r($inclasses); echo '<pre>';?> </p>
    
    <select data-live-search="true" class="mdb-select md-form colorful-select dropdown-primary">
    <?php $count = 1;
        foreach($inclasses as $c):?>    
            <option value="<?php echo $count?>"> Class ID: <?php echo $c->class_id?> Class Title: <?php echo $c->class_title?> </option>
        <?php $count = $count + 1;
        endforeach; ?> 
    </select>

</div>