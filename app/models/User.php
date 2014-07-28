<?php
class User extends Elegant {
  //protected $table = 'users';//default:users
  protected $rules = array(
  );
  protected $hidden = array('password');

  public function outbox(){
    return $this->hasMany('Message');
  }
  public function inbox(){
    return $this->belongsToMany('Message')->withPivot('is_read')->withTimestamps();
  }

  public function tasks(){
    return $this->hasMany('Task');
  }
  public function todo(){
    return $this->belongsToMany('Task')->withTimestamps();
  }

  public function workgroups(){
    return $this->hasMany('Workgroup');
  }
  public function memberships(){
    return $this->belongsToMany('Workgroup')->withPivot('authorized','authorized_at')->withTimestamps();
  }
  public function configurations(){
    return $this->hasMany('Configuration');
  }
  public function experiments(){
    return $this->hasMany('Experiment');
  }
  public function projects(){
    return $this->hasMany('Project');
  }
  public function scenarios(){
    return $this->hasMany('Scenario');
  }
  public function workloads(){
    return $this->hasMany('Workload');
  }
  public function organization(){
    return $this->belongsTo('Organization');
  }
}
?>
