<?php
class Disk extends Elegant {
  protected $rules = array(
  );
  public function drives(){
    return $this->hasMany('Drive');
  }
}
?>
