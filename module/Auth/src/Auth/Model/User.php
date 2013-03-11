<?php
namespace Auth\Model;

class User
{
	public $id;
	
	public $username;
	
	public $password;
	
	public $twitter;
	
	public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->twitter  = (isset($data['twitter'])) ? $data['twitter'] : null;
    }
}