<?php

$modversion['name'] = _MI_SSIFRAME_NAME;
$modversion['version'] = 0.01;
$modversion['description'] = _MI_SSIFRAME_DESC;
$modversion['credits'] = '';
$modversion['author'] = 'shin0211<shin@netlab.gr.jp>';
$modversion['help'] = '';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'images/ssiframe_slogo.png';
$modversion['dirname'] = 'ssiframe';

$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';
$modversion['hasMain'] = 1;

$modversion['templates'][1]['file'] = 'ssiframe_index.html';
$modversion['templates'][1]['description'] = '';

$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][0] = 'ssiframe';
