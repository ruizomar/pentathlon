<?php
 
class UserLogin extends BaseController {
 
    public function user()
    {
        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
 
        if(Auth::attempt($userdata))
        {
            return Redirect::to('/');
        }
        else{
			return Redirect::to('login')->with('mensaje_error','El nombre de usuario o la contraseña son incorrectos.');
        }
    }
    public function logOut()
    {
        Auth::logout();
        return Redirect::to('login')
                    ->with('mensaje_error', 'Tu sesión ha sido cerrada.');
    }
    public function getForgotpassword(){
        return View::make('login/forgotpassword');
    }
    public function postForgotpassword(){
        $rules = array(
            'username'    => 'required|exists:usuarios,username',
            );

        $validation = Validator::make(Input::all(), $rules);
        if($validation->fails()){
            $dato = array('success'=>false,
                    'errormessage'=>'Ocurrio un error');
            return Redirect::to('forgot')->with('mensaje_error','El usuario es incorrecto.');
        }
        $user = User::where('username','=',Input::get('username'))->first();
        if(!is_null($user)){
            $token      = str_random(60);
            $password   = str_random(10);
            $user->token = $token;
            $user->password_temp = Hash::make($password);
            $user->save();
            
            /*Mail::send('emails.auth.reminder', array('token' => $token,'password' => $password), function($message){
                $message->to('omar.ruiz.mz@gmail.com','omar ruiz')->subject('Nueva contraseña');
            });*/
            return View::make('login.reminder')
            ->with('email',str_limit( $user->elemento->persona->email->email ,  3)."@...");
            return View::make('emails.auth.reminder')
            ->with('nombre',$user->elemento->persona->nombre)
            ->with('token',$token)
            ->with('password',$password);
        }
    }
    public function getRecover($token = null){
        if(is_null($token)){
            return Redirect::to('login');
        }
        $user = User::where('token','=',$token,'and')
        ->where('password_temp','!=','')->first();
        if(!is_null($user)){
            $user->password     = $user->password_temp;
            $user->password_temp    = '';
            $user->token    = '';
            $user->save();
            return Redirect::to('login')
                    ->with('mensaje_error', 'Contraseña restablecida.');

        }
    }
}

?>