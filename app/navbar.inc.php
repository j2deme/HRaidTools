<?php
$langSel = array();
$langSel['icon'] = 'fa fa-globe';
$langSel['isDrop'] = true;
$langSel['sub'] = array();
foreach ($lang['langs'] as $lg) {
  $langSel['sub'][] = array(
    'text' => $lg['name'],
    'url' => $resourceUri,
    'data' => array('lang' => $lg['suffix'])
  );
}

foreach ($lang['navbar'] as $key => $value) {
  $lang['navbar'][$key]['right'][] = $langSel;
}
?>
