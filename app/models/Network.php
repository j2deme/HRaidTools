<?php
class Network extends Elegant {
  protected $rules = array(
  );
  public function configuration(){
    return $this->hasMany('Configuration');
  }
}
?>
