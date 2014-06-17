<?php
class Message extends Elegant {
  protected $rules = array(
  );
  public function from(){
    return $this->belongsTo('User');
  }
  public function to(){
    return $this->belongsToMany('Users')->withPivot('is_read')->withTimestamps();
  }
}
?>
