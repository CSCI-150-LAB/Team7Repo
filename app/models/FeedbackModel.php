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
         * @Key
         * @Column('class_id')
         */
        public $classid;

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
