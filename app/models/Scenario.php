<?php
class Scenario extends Elegant {
  protected $rules = array(
  );
  public function owner(){
    return $this->belongsTo('User');
  }
  public function configuration(){
    return $this->belongsTo('Configuration');
  }
  public function workload(){
    return $this->belongsTo('Workload');
  }
  public function workgroup(){
    return $this->belongsTo('Workgroup');
  }
  public function project(){
    return $this->belongsTo('Project');
  }
}
?>
