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
		content: "Listed here is the learning style the student prefers the most."
	});
	studentTour.addStep({
		element: ".learningstyles",
		title: "Learning Styles",
		content: "This section shows a student's comfort level with all four learning styles."
	});
	studentTour.addStep({
		element: ".learningtools",
		title: "Learning Tools",
		content: "This section lists the tools the student is most comfortable working with for each learning style."
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
		content: "In this section, you can adjust your comfort level for working with all four learning styles by moving these sliders."
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
});