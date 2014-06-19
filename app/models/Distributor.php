<?php
class Distributor extends Elegant {
  protected $rules = array(
  );
  public function distribution(){
    return $this->belongsTo('Distribution');
  }
}
?>
