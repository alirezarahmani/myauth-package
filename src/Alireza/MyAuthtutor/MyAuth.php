<?php

namespace Models;
namespace Alireza\MyAuthtutor;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use User;
Class MyAuth
{
    protected $data;
    public $redirect_login;
    public $redirect_logout;

    public  function __construct()
    {
        $this->redirect_login='/users/home';
        $this->redirect_logout='/users/logout';
        if (Request::isMethod('post'))
        @   $this->data=array('username'=>Input::get('username'),'password'=>Input::get('password'));
    }

    public function login($data=false)
    {
        $this->data=$data;
        if($this->data)
            if(!is_array($this->data))
                return Redirect::to($this->redirect_login)->with('message', 'sorry no array to log-in manually');

        if($this->data && !Session::has('user'))
        {
            $result= User::Where(function($query)
            {
                $query-> where('email',$this->data['username'])
                      -> where('password',sha1($this->data['password']));
            })->get();

            foreach($result as $result)
            {
                Session::put('user', $result);
                return Redirect::to('home')->with('message', 'Welcome log-in  succeeded ');
            }
                Session::flush();
            return Redirect::to($this->redirect_login)->with('message', 'Login Failed, wrong username or password');
        }

    }

    public function logout()
    {
        Session::flush();
        return Redirect::to($this->redirect_logout)->with('message', 'logout succeeded');
    }


}