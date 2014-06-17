<?php
class Drive extends Elegant {
  protected $rules = array(
  );
  public function controller(){
    return $this->belongsTo('Controller');
  }
  public function disk(){
    return $this->belongsTo('Disk');
  }
  public function configurations(){
    return $this->belongsToMany('Configuration')->withPivot('quantity')->withTimestamps();
  }
}
?>
