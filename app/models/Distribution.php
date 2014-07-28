<?php
class Distribution extends Elegant {
  protected $rules = array(
  );
  public function distributors(){
    return $this->hasMany('Distributor');
  }
}
?>
