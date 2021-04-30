<div class="container">
    <h1 class="mb-3 adminfeedbacksession" style= "background-color: #13284c; padding:60px; color: #ffffff;"> Start Feedback Session</h1>
    <!--Select Class-->
    <button class = 'btn btn-secondary float-md-right text-white' data-start-tour="Admin Start Feedback Tour">Help</button><br><br>
    <?php $classes = InstructorClasses::find(); ?>
    <div class="table-responsive classes classestable">
        <table class="table table-bordered tbl-background">
            <thead>
                <tr>
                    <th scope="col" class="classtitle"> Class </th>
                    <th scope="col" class="classdescription"> Description </th>
                    <th scope="col" class="classmeetings"> Days/Times</th>
                    <th scope="col" class="classstudents"> Instructor</th>
					<th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($classes as $class):?>
                    <tr>
                        <td class="classpage"><a href = '<?php echo $this->baseUrl("/Instructor/ViewClass/{$class->classid}") ?>'><?php echo $class->class ?></a></td>
                        <td class="classdescr"><?php echo $class->description ?></td>
                        <td class="classdatetime"><?php echo $class->getClassTimeString() ?></td>
                        <td class="classinstructor"><?php $instructor = User::findOne("id =:0:", $class->instructorid); echo $instructor->getFullName(); ?></td>
						<td>
							<button type="button" class="btn btn-primary create-feedback-form classstartfeedback" data-toggle="modal" data-target="#feedback-app" data-class-id="<?= $class->classid ?>" data-class-title="<?= $class->class ?>">
								<i class="fas fa-plus"></i> Create Session
							</button>
						</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php echo $this->partial('_Partials/FeedbackForm') ?>

<script>
	docReady(function() {
		$(document).on('click', '.create-feedback-form', function() {
			let data = $(this).data();
			feedbackFormApp.setClass(data.classId, data.classTitle);
		});
	});
</script>