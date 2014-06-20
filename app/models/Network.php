<?php
class Network extends Elegant {
  protected $rules = array(
  );
  public function configurations(){
    return $this->hasMany('Configuration');
  }
}
?>
