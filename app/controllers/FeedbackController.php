<?php
class FeedbackController extends PermsController {
    
    public function FeedbackFormAction($classId) {
		$class = InstructorClasses::getByKey($classId);
       
		$errors = [];
		

        if ($this->request->isPost()) {
			$fields = [
				  
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
                    $errors[] = "{$postField} is required"; 
                }
                else {
					$feedbackData[$prop] = $_POST[$postField]; 
                }
            }
            
            if(!count($errors)) {
				$feedbackData['start'] = date('Y-m-d ') . $feedbackData['start'] . ':00';
				$feedbackData['end'] = date('Y-m-d ') . $feedbackData['end'] . ':00';
                $publishedFeedback = new FeedbackModel();
				foreach ($feedbackData as $key => $val) {
					$publishedFeedback->$key = $val;
				} 

				
				if($feedbackData['feedbacktype'] == 'text') {  
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

        

        return $this->json(['errors' => $errors]); 
    }
    
    public function PublishedFeedbackAction($classid) { 
		/** @var Db */


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
	
	public function ResponseAction($feedbackid) { 
		
		$errors = [];

		$student = User::getCurrentUser();

		if($this->request->isPost()) {
			$fields = [
			  'response' => 'response'
		  ];


		  $responseData = [
				'feedbackid' => $feedbackid,
				'studentid' => $student->id
			];

			foreach ($fields as $prop => $postField) {
                if (empty($_POST[$postField])) {
                    $errors[] = "{$postField} is required"; 
                }
                else {
					$responseData[$prop] = $_POST[$postField]; 
                }
			}
			
			if(!count($errors)) {
                $publishedResponse = new ResponseModel();
				foreach ($responseData as $key => $val) {
					$publishedResponse->$key = $val;
				}


				if($publishedResponse->save()) {
					return $this->redirect($this->viewHelpers->baseUrl("/Student/Dashboard")); 
				} 

				else {
					$errors[] = 'Failed to save the feedback';

				}
				
			}

		} 


		return $this->view(['errors' => $errors]);
		
	}
	
   public function InstructorResultAction($feedbackid) {

		/** @var Db */
		

		$db = $this->get('Db');
		/** @var array[] */
		$feedbackresult = $db->query( 
			"
			SELECT * FROM studentresponses INNER JOIN feedbacksessions ON studentresponses.feedback_id = feedbacksessions.id WHERE studentresponses.feedback_id = :feedbackid:
			
			", ['feedbackid' => $feedbackid]
		);

		
		if ($feedbackresult === false) {
			die($db->getLastError());
		}
		/** @var ResponseModel[] */
		$feedbackresult = array_map(['ResponseModel', 'fromArray'], $feedbackresult);
		
		return $this->view(['feedbackresult' => $feedbackresult]); 

	   
   }


   public function RatingResponseAction($feedbackid) { 
		
	$errors = [];

	$student = User::getCurrentUser();

	if($this->request->isPost()) {
		$fields = [
		  'response' => 'rating'
	  ];


	  $ratingData = [
			'feedbackid' => $feedbackid,
			'studentid' => $student->id
		];

		foreach ($fields as $prop => $postField) {
			if (empty($_POST[$postField])) {
				$errors[] = "{$postField} is required"; 
			}
			else {
				$ratingData[$prop] = $_POST[$postField]; 
			}
		}
		
		if(!count($errors)) {
			$ratingResponse = new ResponseModel();
			foreach ($ratingData as $key => $val) {
				$ratingResponse->$key = $val;
			}


			if($ratingResponse->save()) {
				return $this->redirect($this->viewHelpers->baseUrl("/Student/Dashboard")); 
			} 

			else {
				$errors[] = 'Failed to save the feedback';

			}
			
		}

	} 


	return $this->view(['errors' => $errors]);
	
}

}

?>