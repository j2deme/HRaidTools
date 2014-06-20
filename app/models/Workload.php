<?php
class Workload extends Elegant {
  protected $rules = array(
  );
  public function scenarios(){
    return $this->hasMany('Scenario');
  }
  public function status(){
    return $this->belongsTo('Status');
  }
  public function owner(){
    return $this->belongsTo('User');
  }
  public function project(){
    return $this->belongsTo('Project');
  }
}
?>
