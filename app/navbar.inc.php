<?php
include_once 'models/navbar.class.php';
$navbar = array();
$langSel = new Opt();
$langSel->icon('fa fa-globe');
foreach ($lang->langs as $lg) {
  $langSel->addSub(Opt::nw()->init($lg['name'],$resourceUri)->addData('lang',$lg['suffix']));
}

/***
* Edit from here
* See: README > Navbar configuration
***/
$navbar['public'] = array(
  'left' => array(
    Opt::nw()->init($lang->link1,'#1'),
    Opt::nw()->init($lang->link2,'#2'),
    Opt::nw()->init($lang->link3,'#3'),
    Opt::nw()->init($lang->dropdown)
      ->addSub(Opt::nw()->init($lang->google,'http://google.com'))
      ->addSub(Opt::nw()->isDiv())
      ->addSub(Opt::nw()->isHeader($lang->navHeader))
      ->addSub(Opt::nw()->init($lang->facebook,'http://facebook.com')),
  ),
  'right' => array(
  ),
);

$navbar['user'] = array(
  'left' => array(
    Opt::nw()->init($lang->link1,'#1'),
    Opt::nw()->init($lang->link2,'#2'),
    Opt::nw()->init($lang->link3,'#3'),
    Opt::nw()->init($lang->dropdown)
      ->addSub(Opt::nw()->isHeader($lang->navHeader))
      ->addSub(Opt::nw()->init($lang->facebook,'http://facebook.com'))
  ),
  'right' => array(
    Opt::nw()->init()->icon('fa fa-user')
      ->addSub(Opt::nw()->init($lang->user,$app->urlFor('root')))
      ->addSub(Opt::nw()->init($lang->logout,$app->urlFor('logout')))
  ),
);
/***
* DO NOT MODIFY
* Otherwise language selector won't be loaded on the UI
***/
foreach ($navbar as $key => $value) {
  $navbar[$key]['right'][] = $langSel;
}
?>
