<?php

    /**
     * @Table('feedbacksessions')
     */
    class FeedbackModel extends Model {

        /**
         * @Key
         * @Column('id')
         */
        public $feedbackid;

        /**
         * @Column('class_name')
         */
        public $classfeedback;

        /**
         * @Column('start')
         */
        public $start;

        /**
         * @Column('end')
         */
        public $end;

        /**
         * @Column('feedback_description')
         */
        public $feedbackdescription;

    }
?>  
