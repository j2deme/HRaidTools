<?php
class Configuration extends Elegant {
  protected $rules = array(
  );
  public function owner(){
    return $this->belongsTo('User');
  }
  public function network(){
    return $this->belongsTo('Network');
  }
  public function distributor(){
    return $this->belongsTo('Distributor');
  }
  public function drives(){
    return $this->belongsToMany('Drive')->withPivot('quantity')->withTimestamps();
  }
  public function scenarios(){
    return $this->hasMany('Scenario');
  }
}
?>
