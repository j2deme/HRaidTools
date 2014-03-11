<?php
/**
* User
*/
class User extends Elegant {
  private $rules = array(
    'name' => 'required',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:5'
  );
}
?>
