<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 30/01/2015
 * Time: 01:32 AM
 */

    use Illuminate\Auth\UserInterface;
    use Illuminate\Auth\Reminders\RemindableInterface;

    /**
     * Class User
     *
     * @property int $id
     * @property string $email
     * @property string $password
     * @property string $name
     */
    class User extends Eloquent implements UserInterface, RemindableInterface {

        protected $fillable = ['email', 'password', 'name'];

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'users';

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = ['password', 'remember_token'];

        /**
         * timers
         * @return Timer
         */
        public function timers()
        {
            return $this->hasMany('Timer')->orderBy('start', 'desc');
        }

        /**
         * projects
         * @return Project
         */
        public function projects()
        {
            return $this->hasMany('Project');
        }

        public function getRunningTimer()
        {
            return Timer::whereRaw('user_id = ? AND end IS NULL', [$this->id])->first();
        }

        /**
         * Get the e-mail address where password reminders are sent.
         *
         * @return string
         */
        public function getReminderEmail()
        {
            // TODO: Implement getReminderEmail() method.
        }

        /**
         * Get the unique identifier for the user.
         *
         * @return mixed
         */
        public function getAuthIdentifier()
        {
            return $this->getKey();
        }

        /**
         * Get the password for the user.
         *
         * @return string
         */
        public function getAuthPassword()
        {
            return $this->password;
        }

        /**
         * Get the token value for the "remember me" session.
         *
         * @return string
         */
        public function getRememberToken()
        {
            // TODO: Implement getRememberToken() method.
        }

        /**
         * Set the token value for the "remember me" session.
         *
         * @param  string $value
         *
         * @return void
         */
        public function setRememberToken( $value )
        {
            // TODO: Implement setRememberToken() method.
        }

        /**
         * Get the column name for the "remember me" token.
         *
         * @return string
         */
        public function getRememberTokenName()
        {
            // TODO: Implement getRememberTokenName() method.
        }}