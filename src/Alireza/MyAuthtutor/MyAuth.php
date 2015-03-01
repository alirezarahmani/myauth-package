<?php

namespace Alireza\Myauthtutor;
use Request,Session,Input,Redirect,Hash;
use App\User;
Class Myauth
{
    protected $data;

    public $redirect_login='/users/home';
    public $redirect_logout='/users/logout';

    public  function __construct()
    {  
        if (Request::isMethod('post'))
           $this->data=array('username'=>Input::get('username'),'password'=>Input::get('password'));
    }
    public function login($data=false)
    {
        $this->data=$data;

       if ($this->data && !is_array($this->data))
                return redirect($this->redirect_login)->with('message', 'sorry no array to log-in manually');

        if($this->data && !Session::has('user'))
        {
            $result= User::Where(function($query)
            {
                $query-> where('email',$this->data['username'])
                      -> where('password',Hash::make($this->data['password']));
            })->first();
                Session::put('user', $result);
            return Redirect('home')->with('message', 'Welcome log-in succeeded ');
                Session::flush();
            return redirect($this->redirect_login)->with('message', 'Login Failed, wrong username or password');
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect($this->redirect_logout)->with('message', 'logout succeeded');  
    }
}
