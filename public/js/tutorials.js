$(function() {

	//#region Instructor Tour
	let instructorTour = new TourInstance('Instructor Tour');
	instructorTour.addPageLoadTrigger(/^\/Instructor\/Profile\/\d+$/);
	instructorTour.addStep({
		element: ".instructorinfo",
		title: "Instructor Profile",
		content: "This is an instructor profile, here is basic information about you."
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

});