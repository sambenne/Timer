<?php

    /**
     * Class Timers
     *
     * @property string $name
     * @property int    $id
     * @property int    $user_id
     * @property int    $project_id
     * @property int    $start
     * @property int    $end
     * @property Project $project
     */
    class Timer extends Eloquent
    {
        protected $fillable = ['name', 'start', 'end', 'project_id', 'user_id'];

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'timers';

        /**
         * project
         * @return Project
         */
        public function project()
        {
            return $this->belongsTo('Project');
        }

        /**
         * End Timer
         *
         * This will set an end time.
         *
         * @return int
         */
        public function endTimer()
        {
            $time = time();

            $this->end = $time;
            $this->save();

            return $time;
        }

        public function getStartTimer()
        {
            return date('d M Y H:i:s', $this->start);
        }

        public function getEndTimer()
        {
            return is_null($this->end) ? 'running' : date('d M Y H:i:s', $this->end);
        }
    }