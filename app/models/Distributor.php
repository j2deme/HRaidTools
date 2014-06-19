<?php
class Distributor extends Elegant {
  protected $rules = array(
  );
  public function distributor(){
    return $this->belongsTo('Distribution');
  }
}
?>
