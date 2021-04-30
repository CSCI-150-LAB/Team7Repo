<?php

/**
 * @Table('instructorclasses')
 */
class InstructorClasses extends Model {

	const dayMap = [
		'Mon' => 'M',
		'Tue' => 'Tu',
		'Wed' => 'W',
		'Thur' => 'Th',
		'Fri' => 'F',
		'Sat' => 'Sa',
		'Sun' => 'Su'
	];

	/**
	 * @Key
	 * @Column('class_id')
	 */
	public $classid;

	/**
	 * @Column('instructor_id')
	 */
	public $instructorid;

	/**
	 * @Column('ta_id')
	 */
	public $TAid;

	/**
	 * @Column('class_title')
	 */
	public $class;

	/**
	 * @Column('class_description')
	 */
    public $description;

    /**
	 * @Column('start_time')
	 */
    public $starttime;

    /**
	 * @Column('end_time')
	 */
    public $endtime;

    /**
	 * @Column('monday')
	 */
	public $Mon;

    /**
	 * @Column('tuesday')
	 */
	public $Tue;

    /**
	 * @Column('wednesday')
	 */
	public $Wed;

    /**
	 * @Column('thursday')
	 */
	public $Thur;

    /**
	 * @Column('friday')
	 */
	public $Fri;

    /**
	 * @Column('saturday')
	 */
	public $Sat;

    /**
	 * @Column('sunday')
	 */
	public $Sun;

	public function getClassTimeString() {
		$classTime = '';
		foreach(self::dayMap as $prop => $day) {
			if($this->$prop) {
				$classTime .= $day;
			}
		}
		$classTime .= ' ';
		$stime = strtotime('2020-10-6 '.$this->starttime);
		$classTime .= date('g:i A' ,$stime).' - ';
		$ftime = strtotime('2020-10-6 '.$this->endtime);
		$classTime .= date('g:i A' ,$ftime);
		return $classTime;
	}

	/**
	 * Fetches the instructor user associated with this class
	 *
	 * @return User
	 */
	public function getInstructor() {
		return User::getByKey($this->instructorid);
	}

	/**
	 * Fetches any associated files as an array
	 * 
	 * @return File[] 
	 */
	public function getFiles() {
		return File::query("
			SELECT
				*
			FROM
				class_files as cf
			INNER JOIN files as f ON
				f.id = cf.file_id
			WHERE
				cf.class_id = :0:
		", $this->classid);
	}

	/**
	 * Adds a file to a class
	 * 
	 * @param File $file 
	 * @return true
	 * @throws Exception 
	 */
	public function addFile(File $file) {
		if (is_null($file->id)) {
			throw new Exception('File must be saved before it can be added');
		}

		$classFile = ClassFiles::findOne('classId = :0: AND fileId = :1:', $this->id, $file->id);
		if (!$classFile) {
			$classFile = new ClassFiles();
			$classFile->classId = $this->id;
			$classFile->fileId = $file->id;
			
			return $classFile->save();
		}

		return true;
	}

	/**
	 * De-associates a file with a class
	 * 
	 * @param File $file 
	 * @return bool 
	 * @throws Exception 
	 */
	public function removeFile(File $file) {
		if (is_null($file->id)) {
			throw new Exception('File must be saved before it can be added');
		}

		$classFile = ClassFiles::findOne('classId = :0: AND fileId = :1:', $this->id, $file->id);
		if ($classFile) {
			return $classFile->delete();
		}

		return true;
	}
}