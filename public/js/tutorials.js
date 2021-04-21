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
		element: ".preferredlearningstyle",
		title: "Preferred Learning Style",
		content: "Listed here is the learning style the student is most comfortable using."
	});
	studentTour.addStep({
		element: ".learningstyles",
		title: "All Learning Styles",
		content: "This section shows how comfortable the student is with each of the four learning styles: visual, kinesthetic, auditory, read/write."
	});
	studentTour.addStep({
		element: ".learningtools",
		title: "Learning Tools",
		content: "This section shows which tools the student prefers to use for each respective learning styles."
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
		element: ".classname:first",
		title: "Class Name",
		content: "The name of your class is listed in the leftmost column. By clicking the class name, you will be redirected to your class page."
	});
	studentDashboardTour.addStep({
		element: ".classdescription:first",
		title: "Class Description",
		content: "A short description of the class is listed in this column."
	});
	studentDashboardTour.addStep({
		element: ".classtime:first",
		title: "Class Meeting Times",
		content: "The meeting days and times for the class will be in this column."
	});
	studentDashboardTour.addStep({
		element: ".classinstructor:first",
		title: "Class Instructor",
		content: "The instructor of the class is listed here. By clicking the instructor's name, you will be redirected to their profile page."
	});
	studentDashboardTour.addStep({
		element: ".taclasses",
		title: "Classes You TA For",
		content: "This section shows the classes you are a teaching assistant (TA) for. The columns for this section are organized like the columns in the 'Enrolled Classes' section."
	});
	//#endregion

	//#region Student Respond to Feedback Tour
	let feedbackResponseTour = new TourInstance('Respond to Feedback Session Tour');
	feedbackResponseTour.addPageLoadTrigger(/^\/Feedback\/Response\/\d+$/);
	feedbackResponseTour.addStep({
		element: ".feedsession",
		title: "Feedback Session",
		content: "This is a feedback session started by your instructor! Here you will be able to give your instructor feedback based on questions they have posed. Note: Questions with a red asterisk next to them indicate the question is required."
	});
	feedbackResponseTour.addStep({
		element: ".shorttext:first",
		title: "Short Answer",
		content: "This type of feedback question will ask for a brief, textual response."
	});
	feedbackResponseTour.addStep({
		element: ".longtext:first",
		title: "Long Answer",
		content: "This type of feedback question will ask for a longer, explanatory, textual response."
	});
	feedbackResponseTour.addStep({
		element: ".radiogroup:first",
		title: "Multiple Choice",
		content: "This type of feedback question will ask you to select an answer choice from the options listed."
	});
	feedbackResponseTour.addStep({
		element: ".checkboxgroup:first",
		title: "Checkbox",
		content: "This type of feedback question will allow you to select multiple options as your answer choice."
	});
	feedbackResponseTour.addStep({
		element: ".ratingquestion:first",
		title: "Rating",
		content: "This type of feedback question will ask you to rate the question statement from 1 - 5 stars."
	});
	feedbackResponseTour.addStep({
		element: ".submitfeedback",
		title: "Submit!",
		content: "Once you are done responding to each required question (and any optional question of your choosing), you may hit submit."
	});

	//#endregion

	//#region Student Add Instructor Review Tour
	let addInstructorReviewTour = new TourInstance('Add Instructor Review Tour');
	addInstructorReviewTour.addPageLoadTrigger(/^\/Instructor\/AddReview\/\d+$/);
	addInstructorReviewTour.addStep({
		element: ".addreviewtitle", 
		title: "Add a Review!",
		content: "This page allows you to submit a review on an instructor's performance."
	});
	addInstructorReviewTour.addStep({
		element: ".requiredfields", 
		title: "Required Fields",
		content: "You are required to complete these fields to submit a review."
	});
	addInstructorReviewTour.addStep({
		element: ".ratingstars", 
		title: "Rating Out of Five Stars",
		content: "You can rate your professor's performance out of five stars in this section. A rating of 1 is the lowest and signifies the professor performed poorly; a rating of 5 is the highest and signifies the professor performed well."
	});
	addInstructorReviewTour.addStep({
		element: ".instructorrecommendation", 
		title: "Detailed Recommendation",
		content: "In this section, you have the opportunity to explain with more detail how your instructor performed."
	});
	addInstructorReviewTour.addStep({
		element: ".anonrating", 
		title: "Keep Your Rating Anonymous",
		content: "By checking 'Yes,' your review will be shared anonymously."
	});
	addInstructorReviewTour.addStep({
		element: ".additionalrating", 
		title: "Additional Review Information",
		content: "The following entries are optional and may provide more depth to your review."
	});
	addInstructorReviewTour.addStep({
		element: ".takeprofagain", 
		title: "Take Another Class with This Instructor",
		content: "This entry allows you to indicate whether you would take another class with this instructor."
	});
	addInstructorReviewTour.addStep({
		element: ".hwreq", 
		title: "Homework",
		content: "This entry allows you to indicate if the professor assigned homework for the class."
	});
	addInstructorReviewTour.addStep({
		element: ".mandatoryattend", 
		title: "Attendance",
		content: "This entry allows you to indicate if the professor made attendance mandatory."
	});
	addInstructorReviewTour.addStep({
		element: ".classgrade", 
		title: "Grade",
		content: "This entry allows you to indicate the grade you received in the class."
	});
	addInstructorReviewTour.addStep({
		element: ".submitreview", 
		title: "Submit",
		content: "Once you are done, you may submit by pressing this button!"
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

	//#region Direct Messaging Tour
	let dmTour = new TourInstance('Direct Messaging Tour');
	dmTour.addPageLoadTrigger(/^\/Index\/Messaging/);
	dmTour.addStep({
		element: ".dmgeneral",
		title: "Direct Messaging",
		content: "Welcome to the Direct Messaging page! Here you can communicate with classmates, instructors, and university administrators."
	});
	dmTour.addStep({
		element: ".newconvo",
		title: "Create a Conversation",
		content: "Here you can create a new conversation. By clicking the dropdown, you may search for users you would like to add to your group."
	});
	dmTour.addStep({
		element: ".createconvo",
		title: "Confirm",
		content: "Once all members of the conversation are added, click here to create the conversation."
	});
	dmTour.addStep({
		element: ".convolist",
		title: "Existing Groups",
		content: "Here you can find conversation groups that you are a part of. To access any one of these conversations, click on the one you would like to open."
	});
	dmTour.addStep({
		element: ".convoarea",
		title: "Conversation",
		content: "This area shows the messages sent in your group by you and your group members."
	});
	dmTour.addStep({
		element: ".textbox",
		title: "Send a Message",
		content: "Type the message you would like to send to your group in this text box. Once you've completed typing your message, click the blue button to send it!"
	});

	//#endregion

	//#region Instructor Dashboard Tour
	let instructorDashboardTour = new TourInstance('Instructor Dashboard Tour');
	instructorDashboardTour.addPageLoadTrigger(/^\/Instructor\/Dashboard/);
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

	//#region Instructor View Class Tour
	let viewClassTour = new TourInstance('Instructor View Class Tour');
	viewClassTour.addPageLoadTrigger(/^\/Instructor\/ViewClass\/\d+$/);
	viewClassTour.addStep({
		element: ".openmenuadd",
		title: "Add Student/TA to Class",
		content: "This is the menu for adding a new student, new students, or a TA to this class.  Click on the dropdown to learn more about adding student(s) and a TA.",
		reflex: 'slow-click'
	});
	viewClassTour.addStep({
		element: ".addstudent",
		title: "Add Student",
		content: "This is the link where you can add an individual student by their email that is associated with an account on FeedbackLoop.  If the email is valid, it will let you know and you can try again."
	});
	viewClassTour.addStep({
		element: ".addstudents",
		title: "Add Students",
		content: "This is the link where you can add multiple students by their email that is associated with accounts on FeedbackLoop.  You must have a valid CSV of the emails in order to use this way of adding students.  If there are any invalid emails, it will let you know and only those emails will not be added, all of the other emails will be added."
	});
	viewClassTour.addStep({
		element: ".addta",
		title: "Add TA",
		content: "This is the link where you can add a TA by their email that is associated with an account on FeedbackLoop.  They will have instructor access to this class."
	});
	viewClassTour.addStep({
		element: ".classta",
		title: "This Class' TA",
		content: "This is where the TA for this class is shown.  You can click on their name to view their profile, or you can remove the TA from having instructor access to the class, and allowing you to add a new TA if you would like."
	});
	viewClassTour.addStep({
		element: ".classstudents",
		title: "This Class' Students",
		content: "Here is a table where you can find all of your enrolled students and their FeedbackLoop account emails in this class."
	});
	viewClassTour.addStep({
		element: ".openmenufeedback",
		title: "Feedback Sessions",
		content: "This is the menu for feedback sessions for the class.  Click on the dropdown if you want to learn more about the feedback sessions.",
		reflex: 'slow-click'
	});
	viewClassTour.addStep({
		element: ".addfeedbacksession",
		title: "Add a Feedback Session",
		content: "This link will bring up a page where you can create a feedback session for this class."
	});
	viewClassTour.addStep({
		element: ".viewfeedbacksession",
		title: "View Feedback Sessions",
		content: "This link will bring up a page where you can view all of the feedback sessions and their results for this class."
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

	//#region Admin Panel Tour
	let adminPanelTour = new TourInstance('Admin Panel Tour');
	adminPanelTour.addPageLoadTrigger(/^\/Admin\/Panel\/\d+$/);
	adminPanelTour.addStep({
		element: ".adminpanel",
		title: "Admin Panel",
		content: "This is the main dashboard for admins, it allows you to navigate through most of the admin tools."
	});
	adminPanelTour.addStep({
		element: ".adminusers",
		title: "User Management",
		content: "This card will take you to a page where you can manage all non-admin user accounts.  It will display a list of all users with students first, then instructors.  For each user it will show their user type, their name with links to their profiles, and their email addresses.  Finally, you can add a user by clicking the button that says \"Add a user\"."
	});
	adminPanelTour.addStep({
		element: ".adminroles",
		title: "Admin Management",
		content: "This card will take you to a page where you can view all the admin accounts.  It will display a list of admin names with links to their profiles, and their emails.  It will also display a button to add a new admin that says \"Add an Admin\"."
	});
	adminPanelTour.addStep({
		element: ".adminfeedback",
		title: "View Instructor Feedback",
		content: "This card will take you to a page where you can view all the instructor accounts.  It will list each instructor's name with a link to their overall feedback page, and each of their star ratings.  The instructors are sorted by the highest rating at the top."
	});
	adminPanelTour.addStep({
		element: ".adminstartfeedback",
		title: "Start Feedback Session",
		content: "This card will take you to a page that lists all of the classes.  It lists the class name with links to the class page, the description, days and times, instructor, and a link that will bring up a form to create a new feedback session for that class."
	});
	//#endregion

	//#region Admin Start Feedback Tour
	let adminFeedbackTour = new TourInstance('Admin Start Feedback Tour');
	adminFeedbackTour.addPageLoadTrigger(/^\/Admin\/StartSession/);
	adminFeedbackTour.addStep({
		element: ".adminfeedbacksession",
		title: "Start Feedback Sessions",
		content: "This is the page where admins can start a feedback session for any class."
	});
	adminFeedbackTour.addStep({
		element: ".classestable",
		title: "Table of Classes",
		content: "Here is a table of all of the classes on FeedbackLoop."
	});
	adminFeedbackTour.addStep({
		element: ".classpage:first",
		title: "Class Name",
		content: "This is the class name, you can click on the link to open the class page."
	});
	adminFeedbackTour.addStep({
		element: ".classdescr:first",
		title: "Class Title",
		content: "This is the class description."
	});
	adminFeedbackTour.addStep({
		element: ".classdatetime:first",
		title: "Class Date and Time",
		content: "These are the dates and times that the class is assigned to meet."
	});
	adminFeedbackTour.addStep({
		element: ".classinstructor:first",
		title: "Class Instructor",
		content: "This is the instructor assigned to the class."
	});
	adminFeedbackTour.addStep({
		element: ".classstartfeedback:first",
		title: "Class Start Feedback Session",
		content: "You can click on this link to bring up a form to start a feedback session for the given class.  A further tutorial can be found on specifically to make a feedback session."
	});
	//#endregion
});