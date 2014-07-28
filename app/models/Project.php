<?php
class Project extends Elegant {
  protected $rules = array(
  );
  public function created_by(){
    return $this->belongsTo('User');
  }
  public function users(){
    return $this->belongsToMany('User')->withTimestamps();
  }
  public function workgroups(){
    return $this->belongsToMany('Workgroup')->withTimestamps();
  }
  public function organizations(){
    return $this->belongsToMany('Organization')->withTimestamps();
  }
  public function configurations(){
    return $this->hasManyThrough('Configuration','User');
  }
  public function experiments(){
    return $this->hasManyThrough('Experiment','User');
  }
  public function tasks(){
    return $this->hasMany('Task');
  }
  public function status(){
    return $this->belongsTo('Status');
  }
}
?>
