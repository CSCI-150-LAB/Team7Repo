$(function() {

	//#region Instructor Tour
	let instructorTour = new TourInstance('Instructor Tour');
	instructorTour.addPageLoadTrigger(/^\/Instructor\/Profile\/\d+$/);
	instructorTour.addStep({
		element: ".instructorinfo",
		title: "Instructor Profile",
		content: "This is an instructor profile, here is basic information about them."
	});
	instructorTour.addStep({
		element: ".editprofile",
		title: "Edit Profile",
		content: "You can update that information by pressing here, or you can continue this tour first and update your information later."
	});
	instructorTour.addStep({
		element: ".starrating",
		title: "Rating",
		content: "Here is this instructor's overall instructor rating based on all of their reviews.  You can hover your mouse over it to see the fractional value."
	});
	instructorTour.addStep({
		element: ".teachingstyles",
		title: "Selected Teaching Styles",
		content: "Here are the selected options for how frequently this instructor uses each of the four primary learning/teaching styles."
	});
	instructorTour.addStep({
		element: ".topreview",
		title: "Top Review",
		content: "This is the top review for the instructor based on the highest rating, and by a verified student if there is a review by a verified student."
	});
	instructorTour.addStep({
		element: ".studentrating:first",
		title: "Given Rating",
		content: "These stars represent the rating that student gave on a scale of 1 to 5 as seen by the stars."
	});
	instructorTour.addStep({
		element: ".optionalresponses:first",
		title: "Class Information",
		content: "Here is where students can leave optional information about the class they took with this instructor.  Options include if they would take the class again, if there was a lot of homework in the class, whether or not class attendance is required, and their self-reported grade."
	});
	instructorTour.addStep({
		element: ".reviewinfo:first",
		title: "Review Description",
		content: "This is where the student left personalized information about how they felt about the class or the instructor."
	});
	instructorTour.addStep({
		element: ".author:first",
		title: "Reviewer",
		content: "This is where the name of the student that left the review is if they decided not to be anonymous.  The green checkmark next to their name means they have been verified to have been in one of the instructor's classes."
	});
	instructorTour.addStep({
		element: ".recentfeedback",
		title: "Recent Feedback",
		content: "Here is where you will find up to the two most recent feedback for this instructor."
	});
	instructorTour.addStep({
		element: ".allreviews",
		title: "See all reviews",
		content: "You can click here to view all of the reviews this instructor has received."
	});
	instructorTour.addStep({
		element: ".takeagain",
		title: "Who would take again?",
		content: "If students have answered the optional question about whether they would take this instructor's class again, the percentage who responded yes out of those who responded will be shown here."
	});
	instructorTour.addStep({
		element: ".grades",
		title: "Grade Distribution",
		content: "Based on the students who responded to the self-reported grade option, a distribution of those student's grades will appear here."
	});
	//#endregion

	//#region Instructor Edit Profile Tour
	let instructorEditProfileTour = new TourInstance('Instructor Edit Profile Tour');
	instructorEditProfileTour.addPageLoadTrigger(/^\/Instructor\/EditProfile\/\d+$/);
	instructorEditProfileTour.addStep({
		element: ".editinstructorprofile",
        title: "Edit your profile here!",
        content: "This is where you can first create, edit, or update your instructor profile."
	});
	instructorEditProfileTour.addStep({
		element: ".department",
        title: "Change your department",
        content: "Here is where you can type in the name of the department you work for, you can use an abbreviation or type it out fully, whatever you decide."
    });
	instructorEditProfileTour.addStep({
		element: ".titlename",
        title: "Preferred Title",
        content: "Select your preferred title for how you are addressed.  You can only select one, but if you change your mind you can always come back and change it later."
    });
	instructorEditProfileTour.addStep({
		element: ".teachingstyles",
		title: "Select Teaching Styles",
		content: "Here is where you select your usage of each teaching style.  We recommend you be as accurate as possible so students have a better idea of how your class is run."
	});
	instructorEditProfileTour.addStep({
		element: ".visual",
		title: "Visual Teaching",
		content: "Visual teaching broadly refers to any teaching that uses visuals.  Commonly this includes lecture slides, videos, and other visual aids.  Select how often you believe you use these types of materials when teaching here."
	});
	instructorEditProfileTour.addStep({
		element: ".auditory",
		title: "Auditory Teaching",
		content: "Auditory teaching broadly refers to any teaching that uses sound.  Commonly this includes lectures, videos, music, and other things you listen to.  Select how often you believe you use these types of materials when teaching here."
	});
	instructorEditProfileTour.addStep({
		element: ".readwrite",
		title: "Reading and Writing Teaching",
		content: "Reading and writing teaching broadly refers to any teaching where students can read and write while learning.  Commonly this includes when students take notes, but can also refer to writing essays, responses to quizzes, assigning textbook reading, and so on.  Select how often you believe you use these types of materials when teaching here."
	});
	instructorEditProfileTour.addStep({
		element: ".kinesthetic",
		title: "Kinesthetic Teaching",
		content: "Kinesthetic teaching broadly refers to any teaching that encourages students to participate.  Commonly this includes homework assignments, quizzes, labs, and other activities where students get a hands-on experience.  Select how often you believe you use these types of materials when teaching here"
	});
	instructorEditProfileTour.addStep({
		element: ".savebutton",
		title: "Submit",
		content: "When you are done with editting your profile, you can click here to save it and it will redirect you back to your profile to view."
	});
	//#endregion

	//#region Student Tour
	let studentTour = new TourInstance('Student Tour');
	studentTour.addPageLoadTrigger(/^\/Student\/Profile\/\d+$/);
	studentTour.addStep({
		element: ".studentprofile",
		title: "Student Profile",
		content: "This is a student profile, here is some basic information."
	});
	studentTour.addStep({
		element: ".editprofile",
		title: "Edit Profile",
		content: "You can update your profile by clicking this button."
	});
	studentTour.addStep({
		element: ".studentemail",
		title: "Email Address",
		content: "The student's email address is listed here."
	});
	studentTour.addStep({
		element: ".studentsmajor",
		title: "Student Major",
		content: "You can change your displayed major by entering it in here."
	});
	studentTour.addStep({
		element: ".studentsmajor",
		title: "Student Major",
		content: "You can change your displayed major by entering it in here."
	});
	//#endregion

	//#region Student Edit Profile Tour
	let studentEditProfileTour = new TourInstance('Student Edit Profile Tour');
	studentEditProfileTour.addPageLoadTrigger(/^\/Student\/ProfileEdit\/\d+$/);
	studentEditProfileTour.addStep({
		element: ".studenteditprofile",
		title: "Edit Profile",
		content: "This page is where you can update your profile information."
	});
	studentEditProfileTour.addStep({
		element: ".studentsmajor",
		title: "Student Major",
		content: "You can change your displayed major by entering it in here."
	});
	studentEditProfileTour.addStep({
		element: ".studentlspref",
		title: "Your Preferred Learning Style",
		content: "Here you can enter in your preferred mode of learning: visual, auditory, kinesthetic, read/write."
	});
	studentEditProfileTour.addStep({
		element: ".learningstylecomfort",
		title: "Comfort With All Learning Styles",
		content: "In this section, you can adjust your comfort level for working with all four learning styles by moving these sliders.",
	});
	studentEditProfileTour.addStep({
		element: ".learningtoolspref",
		title: "Preferred Learning Tools",
		content: "This section allows you to select from a dropdown the tools you prefer to work with most for each learning style."
	});
	studentEditProfileTour.addStep({
		element: ".saveedits",
		title: "Save Edits",
		content: "To save your profile changes, click this button!"
	});
	//#endregion
	
	//#region Student Dashboard Tour
	let studentDashboardTour = new TourInstance('Student Dashboard Tour');
	studentDashboardTour.addPageLoadTrigger(/^\/Student\/Dashboard/);
	studentDashboardTour.addStep({
		element: ".dashboardheader",
		title: "Welcome!",
		content: "Welcome to your student dashboard! This page allows you to view and access your classes."
	});
	studentDashboardTour.addStep({
		element: ".classesenrolled",
		title: "Classes You're Enrolled In",
		content: "This section lists the classes you are enrolled in as a student."
	});
	studentDashboardTour.addStep({
		element: ".taclasses",
		title: "Classes You TA For",
		content: "This section shows the classes you are a teaching assistant (TA) for."
	});
	//#endregion

	//#region Instructor View Reviews Tour
	let instructorViewReviewsTour = new TourInstance('Instructor View Reviews Tour');
	instructorViewReviewsTour.addPageLoadTrigger(/^\/Instructor\/ViewReviews\/\d+$/);
	instructorViewReviewsTour.addStep({
		element: ".reviewtitle",
		title: "Instructor Reviews",
		content: "This page showcases reviews that have been left by students on this instructor's performance."
	});	
	instructorViewReviewsTour.addStep({
		element: ".addreviewbutton",
		title: "Add a Review",
		content: "By clicking this button, you may add a review on this instructor."
	});	
	instructorViewReviewsTour.addStep({
		element: ".instructorreview:first",
		title: "Review Left by Student",
		content: "Here is a review a student left about this instructor. The reviews are sorted from most recent to oldest."
	});	
	instructorViewReviewsTour.addStep({
		element: ".studentrating:first",
		title: "Star Rating",
		content: "This shows, on a scale of 1-5 stars, how the student felt about the instructor's overall performance."
	});	
	instructorViewReviewsTour.addStep({
		element: ".optionalresponses:first",
		title: "Additional Information",
		content: "This additional, optional, information gives insight into how the instructor conducts class and how the student performed."
	});	
	instructorViewReviewsTour.addStep({
		element: ".reviewinfo:first",
		title: "Textual Review",
		content: "This section details and expands on the student's experiences in the instructor's class."
	});	
	instructorViewReviewsTour.addStep({
		element: ".author:first",
		title: "Review Author",
		content: "This is where the name of the author is located; they may choose to remain anonymous."
	});	
	instructorViewReviewsTour.addStep({
		element: ".admindeletereview:first",
		title: "Delete Instructor Review",
		content: "To delete an instructor review, click here."
	});	
	//#endregion

	//#region Instructor Dashboard Tour
	let instructorDashboardTour = new TourInstance('Instructor Dashboard Tour');
	instructorDashboardTour.addPageLoadTrigger(/^\/Instructor\/Dashboard$/);
	instructorDashboardTour.addStep({
		element: ".instructordashboard",
		title: "Instructor Dashboard",
		content: "This is your instructor dashboard, here is where all of the resources are for your classes."
	});
	instructorDashboardTour.addStep({
		element: ".dashboardaddclass",
		title: "Add a new class",
		content: "You can click here and it will redirect you to a new page to add a new class."
	});
	instructorDashboardTour.addStep({
		element: ".classes",
		title: "Table of Classes",
		content: "Here is a table of all of the classes that you are instructor of."
	});
	instructorDashboardTour.addStep({
		element: ".classtitle",
		title: "Class Title",
		content: "Here is where the title of each class is listed."
	});
	instructorDashboardTour.addStep({
		element: ".classpage:first",
		title: "Class Page Link",
		content: "You can click here on the class title to take you to the class page."
	});
	instructorDashboardTour.addStep({
		element: ".classdescription",
		title: "Class Description",
		content: "Here is a description of each class in the corresponding row."
	});
	instructorDashboardTour.addStep({
		element: ".classmeetings",
		title: "Class Meeting Times",
		content: "Here are the days and times that this class is set to meet for."
	});
	instructorDashboardTour.addStep({
		element: ".classstudents",
		title: "Number of Students",
		content: "Here is the number of students currently enrolled in the class."
	});
	//#endregion

	//#region Add Class Tour
	let addClassTour = new TourInstance('Add Class Tour');
	addClassTour.addPageLoadTrigger(/^\/Instructor\/AddClass/);
	addClassTour.addStep({
		element: ".addclass",
		title: "Add a new class",
		content: "This is the page where you can add new classes that you manage.  Here is where you put in all the information from the new class."
	});
	addClassTour.addStep({
		element: ".classtitle",
		title: "Add Class Title",
		content: "Here is where you input the title of the new class you are adding.  You can put here the full class title, or the class catalog number, you can title it whatever you want really."
	});
	addClassTour.addStep({
		element: ".description",
		title: "Add Class Description",
		content: "Here is where you can add a more detailed description about the class."
	});
	addClassTour.addStep({
		element: ".classdates",
		title: "Add Class Meeting Days",
		content: "Here is where you select the days your class is supposed to meet."
	});
	addClassTour.addStep({
		element: ".classtime",
		title: "Add Class Meeting Time",
		content: "This is the section where you add the class meeting times."
	});
	addClassTour.addStep({
		element: ".timestart",
		title: "Add Class Starting Time",
		content: "Here is where you select the time of day that the class starts on the days selected above."
	});
	addClassTour.addStep({
		element: ".timefinish",
		title: "Add Class End Time",
		content: "Here is where you select the time of day that the class ends, make sure the end time is after the start time."
	});
	addClassTour.addStep({
		element: ".addclassbutton",
		title: "Add New Class",
		content: "This is the submission button for saving the new class.  Make sure all of the details are correct before pressing this button because you can not change the details later."
	});
	//#endregion

	//#region FeedbackForm Tour
	let feedbackFormTour = new TourInstance('FeedbackForm Tour', {
		template: `
			<div class="popover" role="tooltip">
				<div class="arrow"></div>
				<h3 class="popover-header"></h3>
				<div class="popover-body"></div>
				<div class="popover-navigation">
					<div class="btn-group">
						<button class="btn btn-sm btn-secondary" data-role="prev">&laquo; Prev</button>
						<button class="btn btn-sm btn-secondary" data-role="next">Next &raquo;</button>
						<button class="btn btn-sm btn-secondary" data-role="pause-resume" data-pause-text="Pause" data-resume-text="Resume">Pause</button>
					</div>
					<button class="btn btn-sm btn-secondary" data-role="end">End tour</button>
				</div>
			</div>
		`
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .form-row:first-child .form-group:first-child',
		title: 'Form Name',
		content: 'Give a nice simple name for this feedback session. Will be seen by you and students.'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .form-row:first-child .form-group:nth-child(2)',
		title: 'Start Time',
		content: 'The form will not be active until the time given.'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .form-row:first-child .form-group:last-child',
		title: 'End Time',
		content: 'The form will be active until the time given.'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .dropdown-toggle',
		title: 'Add Field',
		content: 'Use this button to add fields to the form. The current fields supported include: Short Text, Long Text, Radio Group, Checkbox Group, and Rating.',
		reflex: 'slow-click',
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .dropdown-menu .dropdown-item:nth-child(1)',
		title: 'Short Text Field',
		content: 'A short text field is represented by a simple input box. It is designed to be used with short answer, but not paragraphs, levels of content.',
		reflex: 'slow-click'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row-short-text .field-name',
		title: 'Short Text Field - Name',
		content: 'The name of the question as it will appear to the students.',
		prev: 3
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .dropdown-menu .dropdown-item:nth-child(2)',
		title: 'Long Text Field',
		content: 'A long text field is represented by a large input for potentially paragraphs of text',
		reflex: 'slow-click'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row-long-text .field-name',
		title: 'Long Text Field - Name',
		content: 'The name of the question as it will appear to the students.',
		prev: 3
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .dropdown-menu .dropdown-item:nth-child(3)',
		title: 'Radio Field',
		content: 'A multiple choice field where students may only select one answer.',
		reflex: 'slow-click'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row-radio-group .field-name',
		title: 'Radio Field - Name',
		content: 'The name of the question as it will appear to the students.',
		prev: 3
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row-radio-group .field-options .btn-add-option',
		title: 'Radio Field - Add Option',
		content: 'New options can be created by clicking this.',
		reflex: 'slow-click'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row-radio-group .field-options .input-group:last-child input',
		title: 'Radio Field - Option Values',
		content: 'Each option\'s text may be put into these text fields.'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row-radio-group .field-options .input-group:last-child .btn-delete',
		title: 'Radio Field - Deleting Options',
		content: 'If you made a mistake, extra options can be removed by clicking this.',
		reflex: 'slow-click'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .dropdown-menu .dropdown-item:nth-child(4)',
		title: 'Checkbox Field',
		content: 'A multiple choice field where students may select many or no answers.',
		reflex: 'slow-click'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row-checkbox-group .field-name',
		title: 'Checkbox Field - Name',
		content: 'The name of the question as it will appear to the students.',
		prev: 3
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row-checkbox-group .field-options .btn-add-option',
		title: 'Checkbox Field - Add Option',
		content: 'New options can be created by clicking this.',
		reflex: 'slow-click'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row-checkbox-group .field-options .input-group:last-child input',
		title: 'Checkbox Field - Option Values',
		content: 'Each option\'s text may be put into these text fields.'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row-checkbox-group .field-options .input-group:last-child .btn-delete',
		title: 'Checkbox Field - Deleting Options',
		content: 'If you made a mistake, extra options can be removed by clicking this.',
		reflex: 'slow-click'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .dropdown-menu .dropdown-item:nth-child(5)',
		title: 'Rating Field',
		content: 'A simple 5-star rating field where students can rate an experience or activity.',
		reflex: 'slow-click'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row:last-child .field-meta .form-check',
		title: 'Optional Questions',
		content: 'Questions can be marked optional here. Optional questions do not need to be completed by the students.'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .field-row:last-child .field-meta .btn-delete',
		title: 'Deleting Questions',
		content: 'If you decided you no longer want a question, you can delete it by clicking this.',
		reflex: 'slow-click'
	});
	feedbackFormTour.addStep({
		element: '#feedback-form .btn-create',
		title: 'Create Form',
		content: 'When you have everything filled out the way you like, save your changes by click this. This button will only become clickable when all required inputs have values.'
	});
	//#endregion
});