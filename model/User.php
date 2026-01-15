<?php

class User{
    protected $fullname;
    protected $role;
    protected $email;
    protected $password;

    public function __construct($email, $fullname, $password, $role)
    {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getFullname(){
        return $this->fullname;
    }

    public function setFullname($fullname){
        $this->fullname = $fullname;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;
    }


}