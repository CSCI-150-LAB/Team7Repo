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
        $ratingString = '';
		for($i=0; $i<5; $i++) {
            if($this->rating > $i) {
                $ratingString .= '<i class="fas fa-star" style="color:#FED000;"></i>';
            }
            else {
                $ratingString .= '<i class="far fa-star"></i>';
            }
        }
        $ratingString .= '<br>';
        if ($this->takeAgain != 'N/A') {
            $ratingString .= '<b>Would take again:</b> '.$this->takeAgain.' ';
        }
        if ($this->homework != 'N/A') {
            $ratingString .= '<b>Homework:</b> '.$this->homework.' ';
        }
        if ($this->attendanceRequired != 'N/A') {
            $ratingString .= '<b>Attendance required:</b> '.$this->attendanceRequired.' ';
        }
        if ($this->grade != 'N/A') {
            $ratingString .= '<b>Grade:</b> '.$this->grade;
        }
        if (($this->takeAgain != 'N/A') || ($this->homework != 'N/A') || ($this->attendanceRequired != 'N/A') || ($this->grade != 'N/A')) {
            $ratingString .= '<br>';
        }
        $ratingString .= $this->recommendation.'<br>-';
        if ($this->authorId == 0) {
            $ratingString .= "Anonymous ";
        }
        else {
            $student = User::find("id = :0:", $this->authorId);
            $ratingString .= $student[0]->firstName.' '.$student[0]->lastName.' ';
        }
        if($this->verified) {
            $ratingString .= '<i class="fas fa-check" style="color:green;"></i>';
        }
        return $ratingString;
	}
}