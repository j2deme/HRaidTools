<?php
class Task extends Elegant {
  protected $rules = array(
  );
  public function owner(){
    return $this->belongsTo('User');
  }
  public function project(){
    return $this->belongsTo('Project');
  }
  public function parent(){
    return $this->belongsTo('Task','parent');
  }
  public function finished_by(){
    return $this->belongsTo('User','finished_by');
  }
  public function users(){
    return $this->belongsToMany('User')->withTimestamps();
  }
}
?>
