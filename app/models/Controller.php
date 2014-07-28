<?php
class Controller extends Elegant {
  protected $rules = array(
  );
  public function drives(){
    return $this->hasMany('Drive');
  }
}
?>
