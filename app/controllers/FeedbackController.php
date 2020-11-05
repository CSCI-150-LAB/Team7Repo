<?php
class FeedbackController extends PermsController {
    
    public function FeedbackFormAction($classId) {
		$class = InstructorClasses::getByKey($classId);
       
		$errors = [];
		

        if ($this->request->isPost()) {
			$fields = [
				  //key => value 
				'feedbacktitle' => 'feedbacktitle',
				'start' => 'feedbackstart',
				'end' => 'feedbackend',
				'feedbackdescription' => 'feedbackdescription',
				'feedbacktype' => 'type'
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

				
				if($feedbackData['feedbacktype'] == 'text') { //TODO Why is it not matching? 
					$publishedFeedback->feedbacktype = 1;
				}
				else { //Rating feedback
					$publishedFeedback->feedbacktype = 2;
				}

				if($publishedFeedback->save()) {
					return $this->json(['result' => 'success']); //TODO Tell user success 
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

        

        return $this->json(['errors' => $errors]); //TODO Let user know the errors 
    }
    
    public function PublishedFeedbackAction($classid) { 
		/** @var Db */

		/* $currentclass = InstructorClasses::getByKey($classid);
		if($currentclass == 0) {
			return $this->redirect($this->viewHelpers->baseUrl("/Instructor/Dashboard"));
		} */




		$db = $this->get('Db');
		/** @var array[] */
		$feedBackSessions = $db->query( 
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
	
	public function ResponseAction($feedbackid) { //Will have to pass feedback id 
		$response = ResponseModel::getByKey($feedbackid);
		$student = User::get_current_user(); //Need to get user id 
		$errors = [];
		

		if($this->request->isPost()) {
			$fields = [
			  'response' => 'response'
		  ];


		  $responseData = [
				'feedbackid' => $response->feedbackid,
				//'studentid' => $student
			];

		}


		return $this->view();
	}
	
   

}

?>