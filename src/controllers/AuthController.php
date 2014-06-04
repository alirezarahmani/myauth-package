<?php
use user\Model\user;

Class Myauth extends BaseController
{
    protected $data;
    public $login_redirect;
    public $logout_redirect;

    public  function __construct($data =false)
    {
        $this->data=$data;
        if($this->data)
           if(!is_array($this->data))
               return 'no array to log-in';
        if(Input::get('username'))
        $this->data=array('username'=>Input::get('username'),'password'=>Input::get('password'));
    }

    public function login()
    {
        if($this->data && !Session::has('user'))
        {
        $result=User::where('username='.$this->data['username'].' and password='.sha1($this->data['password']).'');
            if($result)
            {
                Session::put('user', $result);
                return 'log-in succeded';
            }
            else
            {
                Session::flush();
                return 'The username Or password is incorrect';
            }
        }
    }

    public function logout()
    {
        Session::flush();
        return true;
    }


}