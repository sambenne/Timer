<?php

	class UserController extends \BaseController
	{

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function index()
		{
			//
		}


		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function register()
		{
			$email    = Input::get( 'email' );
			$name     = Input::get( 'name' );
			$password = Hash::make( Input::get( 'password' ) );

			$user = new User;

			$user->name     = $name;
			$user->email    = $email;
			$user->password = $password;
			$user->save();

			Auth::login( $user );

			return Redirect::to( '/dashboard' )
				->with( 'success', 'Thank you for registering with Timers!' );
		}

		public function doLogin()
		{
			$rules = [
				'email'    => 'required|email',
				// make sure the email is an actual email
				'password' => 'required|min:8'
				// password can only be alphanumeric and has to be greater than 3 characters
			];

			// run the validation rules on the inputs from the form
			$validator = Validator::make( Input::all(), $rules );

			// if the validator fails, redirect back to the form
			if ($validator->fails()) {
				return Redirect::to( 'login' )
					->withErrors( $validator )// send back all errors to the login form
					->withInput( Input::except( 'password' ) ); // send back the input (not the password) so that we can repopulate the form
			} else {

				// create our user data for the authentication
				$userData = [
					'email'    => Input::get( 'email' ),
					'password' => Input::get( 'password' )
				];
				// attempt to do the login
				if (Auth::attempt( $userData )) {

					return Redirect::to('dashboard');

				} else {
					// validation not successful, send back to form
					return Redirect::to( 'login' );

				}

			}
		}

		public function doLogout()
		{
			Auth::logout(); // log the user out of our application
			return Redirect::to('login'); // redirect the user to the login screen
		}

	}
