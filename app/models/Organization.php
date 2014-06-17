<?php
class Organization extends Elegant {
  protected $rules = array(
  );
  public function users(){
    return $this->hasMany('User');
  }
  public function workgroups(){
    return $this->hasMany('Workgroup');
  }
  public function projects(){
    return $this->hasManyThrough('Project','User');
  }
  public function configurations(){
    return $this->hasManyThrough('Configuration','User');
  }
  public function experiments(){
    return $this->hasManyThrough('Experiment','User');
  }
}
?>
