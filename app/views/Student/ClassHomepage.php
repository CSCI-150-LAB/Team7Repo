<?php
	$this->pageTitle('View Class');

?>
<div class="mb-3 p-5 text-white bg-blue"> 
	<div class = "row">
		<h1 class="mb-0 text-white"> Welcome to <?php echo $class->class ?>'s Homepage</h1> <br> </br>
        <!-- <h1 class="mb-3 text-white">  </h1> -->
	</div>
	<div class = "row">
		 <h5 class="mb-0"> Day and Time: <?php echo  $class->getClassTimeString(); ?></h5> 
	</div>
</div>
<div class="row">
<!--Student Menu-->
    <div class = "col-sm-3">
        <div class="accordion">
            <div class="card">
            <!-- View Feedback Sessions -->
                <div class="card-header"> Feedback Sessions <button class="btn btn-secondary float-right" type="button"> <a href="<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>" class="text-light"> <i class="fas fa-chevron-right"></i></a> </button> </div>
            </div>
            <!-- Course Materials -->
            <div class = "card">
                <div class="card-header"> Course Materials <button class="btn btn-secondary float-right" type="button"> <a href="<?php echo $this->baseUrl("/Instructor/CourseMaterials/{$class->classid}") ?>" class="text-light"> <i class="fas fa-chevron-right"></i></a> </button> </div>
            </div>
            <!-- Class Quizzes -->
            <div class="card">
                <div class="card-header"> Quizzes <button class="btn btn-secondary float-right" type="button"> <a href="<?= $this->baseUrl("/Feedback/PublishedQuizzes/{$class->classid}") ?>" class="text-light"> <i class="fas fa-chevron-right"></i></a> </button> </div>
            </div>
            <!-- Class  Whiteboard
            <div class = "card">
                <div class="card-header"> View Whitebaord <button class="btn btn-secondary float-right" type="button"> <a href="#" class="text-light"> <i class="fas fa-chevron-right"></i></a> </button> </div>
            </div> -->
    </div>
    </div>
    <div class = "col">
        <div class="card">
            <div class="card-body">

				<div class="course-info">
					<span class="loading">Loading <i class="fas fa-spinner fa-spin"></i></span>
					<a href="https://www.fresnostate.edu/catalog/search/index.html?search=<?= urlencode($class->class) ?>" target="_blank" class="btn btn-danger">Go to Course Catalog</a>
				</div>

				<script>
					docReady(function() {
						let classTitle = <?= json_encode($class->class) ?>,
							classId = classTitle.toLowerCase().replace(/\s/g, '');

						$.get(`${BASEURL}Class/CourseCatalog/${classTitle}`, function(html) {
							let node = $(html).find(`#${classId}`);
							let contentNodes = $();
							if (node.length) {
								contentNodes = contentNodes.add(node);
							}

							for (node = node.next(); node.length && !node.is('h6'); node = node.next()) {
								contentNodes = contentNodes.add(node);
							}

							if (contentNodes.length) {
								$('.course-info').prepend(contentNodes);
								let title = $('.course-info h6');
								title.replaceWith(`<h4 class="card-title">${title.text()}</h4>`);
								$('.course-info .loading').remove();
							}
						});
					});
				</script>
            </div>
        </div>
    </div>
</div>