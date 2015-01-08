<?php
 
class settingsController extends BaseController {
 
    public function getIndex(){
       return View::make('settings.settings');
    }
    public function postUpdate(){
    	$rules = array(
			'email' 				=> 'required|email',
			'password' 				=> 'confirmed',
			'password_confirmation' => 'same:password'
			);

		$validation = Validator::make(Input::all(), $rules);
		if($validation -> fails()){
			return Redirect::back()->with('mensaje_error', 'Ocurrio un error intente de nuevo');
		}

		if (Input::get('email') != Auth::user()->elemento->persona->email->email)
			$email = Auth::user()->elemento->persona->email->update(array('email' => Input::get('email')));
		if (!is_null(Input::get('password'))){
			$user = Auth::user();
            $user->password = Hash::make(Input::get('password'));
            $user->save();
        }
		return Redirect::back()->with('mensaje_error', 'Cambios guardados correctamente');
    }

}

?>