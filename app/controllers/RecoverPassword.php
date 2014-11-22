<?php
 
class RecoverPassword extends BaseController {

    public function getForgotpassword(){
        return View::make('login/forgotpassword');
    }
    public function postForgotpassword(){
        $rules = array(
            'username'    => 'required|exists:usuarios,username',
            );

        $validation = Validator::make(Input::all(), $rules);
        if($validation->fails()){
            return Redirect::to('forgot')->with('mensaje_error','El usuario es incorrecto.');
        }
        $user = User::where('username','=',Input::get('username'))->first();
        if(!is_null($user)){
            $token      = str_random(60);
            $user->token = $token;
            $user->token_live = date('Y-m-d H:i:s', strtotime('+ 1 hours'));
            $user->save();
            $email = $user->elemento->persona->email->email;
            /*Mail::send('emails.auth.reminder', array('token' => $token,'nombre'=>$user->elemento->persona->nombre), function($message){
                $message->to($email,'PDMU')->subject('Recuperar contraseña');
            });*/
            return View::make('emails.auth.reminder')
            ->with('token',$token)
            ->with('nombre',$user->elemento->persona->nombre);
            return View::make('login.reminder')
            ->with('email',str_limit( $email ,  3)."@...");
        }
    }
    public function getRecover($token = null){
        if(is_null($token)){
            return Redirect::to('login');
        }
        $user = User::where('token','=',$token,'and')
        ->where('token_live','>',date('Y-m-d H:i:s'))->first();
        if(!is_null($user)){
           return View::make('login/recover')
           ->with('token',$token);
        }
        return View::make('login/errorrecover');
    }
    public function postRecover(){
        $rules = array(
            'token'    => 'required|exists:usuarios,token',
            'password'    => 'required',
            'passwordd'    => 'required|same:password',
            );

        $validation = Validator::make(Input::all(), $rules);
        if($validation->fails()){
            return Redirect::back()->with('mensaje_error','campos incorrectos');
        }
        
        $user = User::where('token','=',Input::get('token'))->first();
        if(!is_null($user)){
            $user->password     = Hash::make(Input::get('password'));
            $user->token    = '';
            $user->save();
            return Redirect::to('login')
                    ->with('mensaje_error', 'Contraseña restablecida.');

        }
    }
}

?>