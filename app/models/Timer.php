<?php

    /**
     * Class Timers
     *
     * @property string  $name
     * @property int     $id
     * @property int     $user_id
     * @property int     $project_id
     * @property int     $start
     * @property int     $end
     * @property Project $project
     */
    class Timer extends Eloquent
    {
        protected $fillable = [ 'name', 'start', 'end', 'project_id', 'user_id' ];

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
            return $this->belongsTo( 'Project' );
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

        public function getTime()
        {
            $diff = $this->end - $this->start;

            return Timer::toTimer($diff);
        }

        public function getStartTimer()
        {
            return date( 'd M Y H:i:s', $this->start );
        }

        public function getEndTimer()
        {
            return is_null( $this->end ) ? 'running' : date( 'd M Y H:i:s', $this->end );
        }

        public static function allTimes()
        {
            $rows = DB::select('SELECT * FROM timers WHERE user_id = ?', [Auth::user()->id]);
            $totalTime = 0;

            for( $i = 0, $c = count($rows); $i < $c; $i++ ) {
                $totalTime += ($rows[$i]->end - $rows[$i]->start);
            }

            return self::toTimer($totalTime);
        }

        private static function toTimer( $secs )
        {
            $units = [
                "week"   => 7 * 24 * 3600,
                "day"    => 24 * 3600,
                "hour"   => 3600,
                "minute" => 60,
                "second" => 1,
            ];

            // specifically handle zero
            if ($secs == 0) {
                return "0 seconds";
            }

            $s = "";

            foreach ($units as $name => $divisor) {
                if ($quot = intval( $secs / $divisor )) {
                    $s .= "$quot $name";
                    $s .= ( abs( $quot ) > 1 ? "s" : "" ) . ", ";
                    $secs -= $quot * $divisor;
                }
            }

            return substr( $s, 0, -2 );
        }
    }