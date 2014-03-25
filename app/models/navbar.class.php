<?php
class Opt {
  public $text;
  public $url;
  public $icon;
  public $isDiv = false;
  public $isHeader = false;
  public $sub = array();
  public $data = array();

  function __construct($text = '', $url = '#'){
    $this->init($text, $url);
    return $this;
  }

  static public function nw(){
    return new self();
  }

  public function init($text = '', $url = '#'){
    $this->text = $text;
    $this->url = $url;
    return $this;
  }

  public function isDiv(){
    $this->isDiv = true;
    return $this;
  }

  public function isHeader($text){
    $this->text = $text;
    $this->isHeader = true;
    return $this;
  }

  public function icon($icon){
    $this->icon = $icon;
    return $this;
  }

  public function addSub(Opt $opt){
    $this->sub[] = $opt;
    return $this;
  }

  public function addData($attr, $value){
    $this->data[$attr] = $value;
    return $this;
  }
}
?>
