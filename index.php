<?php

require dirname(__DIR__, 2) . '/mainfile.php';
$uname = !empty($xoopsUser) ? $xoopsUser->GetVar('uname', 'E') : 'Guest';
$GLOBALS['xoopsOption']['template_main'] = 'ssiframe_index.html';
require XOOPS_ROOT_PATH . '/header.php';

require XOOPS_ROOT_PATH . '/footer.php';
