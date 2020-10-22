<?php
class FeedbackController extends PermsController {
    
    public function InitiateFeedbackAction($classId) {
		$class = InstructorClasses::getByKey($classId);
       
        $errors = [];

        if ($this->request->isPost()) {
			$fields = [
				  //key => value 
				'start' => 'feedbackstart',
				'end' => 'feedbackend',
				'feedbackdescription' => 'feedbackdescription'
            ];

            $feedbackData = [
				'classid' => $class->classid
			];
            foreach ($fields as $prop => $postField) {
                if (empty($_POST[$postField])) {
                    $errors[] = "{$postField} is required"; //left an input blank
                }
                else {
                    $feedbackData[$prop] = $_POST[$postField]; //Publish feedback session
                }
            }
            
            if(!count($errors)) {
				$feedbackData['start'] = date('Y-m-d ') . $feedbackData['start'] . ':00';
				$feedbackData['end'] = date('Y-m-d ') . $feedbackData['end'] . ':00';
                $publishedFeedback = new FeedbackModel();
				foreach ($feedbackData as $key => $val) {
					$publishedFeedback->$key = $val;
				} //Sets profile values for user

				if($publishedFeedback->save()) {
					return $this->redirect($this->viewHelpers->baseUrl("/Feedback/PublishedFeedback"));
				} //Redirects user to profile page
				else {
					$errors[] = 'Failed to save the feedback';
					/** @var Db */
					$db = $this->get('Db');
					var_dump($db->getLastError());
					exit;

				} //If errors, save error
			}
        }

        

        return $this->view(['class' => $class, 'errors' => $errors]);
    }
    
    public function PublishedFeedbackAction($classid) { //parameter 
		/** @var Db */

		
		$db = $this->get('Db');
		/** @var array[] */
		$feedBackSessions = $db->query( //Create a query where the class id in classes table matches the class id in the feedbacksessions
			"
			SELECT * FROM feedbacksessions INNER JOIN instructorclasses ON feedbacksessions.class_id = instructorclasses.class_id WHERE feedbacksessions.class_id = :classid:
			
			", ['classid' => $classid]
		);

		
		if ($feedBackSessions === false) {
			die($db->getLastError());
		}
		/** @var FeedbackModel[] */
		$feedBackSessions = array_map(['FeedbackModel', 'fromArray'], $feedBackSessions);
		
		return $this->view(['feedbackSessions' => $feedBackSessions]);
    }
    
   

}

?>