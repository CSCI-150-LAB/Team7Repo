<div class="container">
    <h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;"> Start Feedback Session</h1>
    <!--Select Class-->
    <select data-live-search="true class="mdb-select md-form colorful-select dropdown-primary">
    <?php $count = 1;
        foreach($inclasses as $inclass):?>    
            <option value="<?php echo $count?>">Class ID: <?php echo $inclass->class_id?> Class Title: <?php echo $inclass->class_description?></option>
        <?php $count = $count + 1;
        endforeach; ?>
    </select>
</div>