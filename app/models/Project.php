<?php

    /**
     * Class Project
     *
     * @property string $name
     * @property int    $user_id
     */
    class Project extends Eloquent
    {
        protected $fillable = ['name', 'user_id'];

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'projects';
    }