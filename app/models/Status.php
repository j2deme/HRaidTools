<?php
class Status extends Elegant {
  protected $table = 'statuses';
  protected $rules = array(
  );
  public function workloads(){
    return $this->hasMany('Workload');
  }
  public function projects(){
    return $this->hasMany('Project');
  }
  public function experiments(){
    return $this->hasMany('Experiment');
  }
}
?>
