<?php
class Experiment extends Elegant {
  protected $rules = array(
  );
  public function user(){
    return $this->belongsTo('User');
  }
  public function scenario(){
    return $this->belongsTo('scenario');
  }
  public function project(){
    return $this->belongsTo('Project');
  }
  public function status(){
    return $this->hasOne('Status','statuses');
  }
}
?>
