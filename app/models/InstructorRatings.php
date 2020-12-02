<?php

/**
 * @Table('instructorratings')
 */
class InstructorRatings extends Model {

	/**
	 * @Key
	 * @Column('rating_id')
	 */
	public $ratingId;

	/**
	 * @Column('rating')
	 */
    public $rating;
    
    /**
     * @Column('recommendation')
     */
    public $recommendation;

    /**
     * @Column('anon')
     */
    public $anon;

    /**
     * @Column('author_id')
     */
    public $authorId;

    /**
     * @Column('instructor_id')
     */
    public $instructorId;

    /**
     * @Column('take_again')
     */
    public $takeAgain;

    /**
     * @Column('homework')
     */
    public $homework;

    /**
     * @Column('attendance_required')
     */
    public $attendanceRequired;

    /**
     * @Column('grade')
     */
    public $grade;

    /**
     * @Column('verified')
     */
    public $verified;

    public function printRating() {
		$ratingString = PrintHelpers::printStarRating($this->rating);
		
		$ratingString .= '<div class="d-flex my-3">';
        if ($this->takeAgain != 'N/A') {
            $ratingString .= '<div class="mr-3"><strong>Would take again:</strong>'.$this->takeAgain.'</div>';
        }
        if ($this->homework != 'N/A') {
            $ratingString .= '<div class="mr-3"><strong>Homework:</strong> '.$this->homework.'</div>';
        }
        if ($this->attendanceRequired != 'N/A') {
            $ratingString .= '<div class="mr-3"><strong>Attendance required:</strong> '.$this->attendanceRequired.'</div>';
        }
        if ($this->grade != 'N/A') {
            $ratingString .= '<div class="mr-3"><strong>Grade:</strong> '.$this->grade.'</div>';
		}
		$ratingString .= "</div>";

        $ratingString .= $this->recommendation.'<br>';
        if ($this->authorId == 0) {
            $ratingString .= "&ndash;Anonymous";
        }
        else {
            $student = User::find("id = :0:", $this->authorId);
            $ratingString .= '&ndash;'.$student[0]->firstName.' '.$student[0]->lastName;
        }
        if($this->verified) {
            $ratingString .= '<i class="fas fa-check ml-1 text-success"></i>';
        }
        return $ratingString;
	}
}