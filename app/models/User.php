<?php
class User extends Elegant {
  protected $table = 'users';//default:users
  protected $rules = array(
  );
  public function configurations(){
    return $this->hasMany('Configurations');
  }
  public function experiments(){
    return $this->hasMany('Experiments');
  }
  public function messages(){
    return $this->hasMany('Messages');
  }
  public function projects(){
    return $this->hasMany('Projects');
  }
  public function scenarios(){
    return $this->hasMany('Scenarios');
  }
  public function tasks(){
    return $this->hasMany('Tasks');
  }
  public function workgroups(){
    return $this->hasMany('Workgroups');
  }
  public function workloads(){
    return $this->hasMany('Workloads');
  }
}
?>
