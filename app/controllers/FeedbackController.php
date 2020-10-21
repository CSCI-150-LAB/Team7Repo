<?php
class FeedbackController extends PermsController {
    
    public function InitiateFeedbackAction() { //Passing the selected class id to feedback session?

       
        $errors = [];

        if ($this->request->isPost()) {
			$fields = [
				  //key => value 
				'classfeedback' => 'classfeedback', //Need to set class name in the initiate page 
				'start' => 'feedbackstart',
				'end' => 'feedbackend',
				'feedbackdescription' => 'feedbackdescription'
            ];

            $feedbackData = [];
            foreach ($fields as $prop => $postField) {
                if (empty($_POST[$postField])) {
                    $errors[] = "{$postField} is required"; //left an input blank
                }
                else {
                    $feedbackData[$prop] = $_POST[$postField]; //Publish feedback session
                }
            }
            
            if(!count($errors)) {
                $publishedFeedback = new FeedbackModel();
				foreach ($feedbackData as $key => $val) {
					$publishedFeedback->$key = $val;
				} //Sets profile values for user

				if($publishedFeedback->save()) {
					return $this->redirect($this->viewHelpers->baseUrl("/Feedback/PublishedFeedback"));
				} //Redirects user to profile page
				else {
					$errors[] = 'Failed to save the feedback';
				} //If errors, save error
			}
        }

        

        return $this->view();
    }
    
    public function PublishedFeedbackAction() {
		
		return $this->view();
    }
    
    public function ViewSessionsAction() {
		
		return $this->view();
	}

}

?>