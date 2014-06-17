<?php
class Workgroup extends Elegant {
  protected $rules = array(
  );
  public function creator(){
    return $this->belongsTo('User');
  }
  public function users(){
    return $this->belongsToMany('User')->withPivot('authorized','authorized_at')->withTimestamps();
  }
  public function organization(){
    return $this->belongsTo('Organization');
  }
}
?>
