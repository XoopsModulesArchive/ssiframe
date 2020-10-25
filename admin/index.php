<?php

require dirname(__DIR__, 3) . '/include/cp_header.php';
xoops_cp_header();
require dirname(__DIR__) . '/ssiframe_common.inc';

// chack input param
$update = empty($_POST['update']) ? false : $_POST['update'];
if ($update) {
    if (!empty($_POST['servername'])) {
        $setdata = [];

        $setdata['protocol'] = $_POST['protocol'];

        $setdata['servername'] = $_POST['servername'];

        if ('' != $_POST['port']) {
            $setdata['port'] = $_POST['port'];
        } else {
            $setdata['port'] = 0;
        }

        $setdata['path'] = $_POST['path'];

        $setdata['method'] = $_POST['method'];

        if (isset($_POST['basic_cb'])) {
            $setdata['basic'] = 1;
        } else {
            $setdata['basic'] = 0;
        }

        $setdata['basic_user'] = $_POST['basic_user'];

        $setdata['basic_pass'] = $_POST['basic_pass'];

        $setdata['param'] = $_POST['param'];

        ssiframe_edit_info($setdata);
    } else {
        print('Error param is Empty!!<br>');
    }
}

$URL = ssiframe_get_info();

print('<form action="index.php" method="post">');
print('<center>');

print('<table border=1>');

print('<tr><td>' . _AM_SSIFRAME_PROTOCOL . '</td>');
print('<td><select name="protocol" value=' . $URL['protocol'] . '>');
print('<option value=1 ');
if (1 == $URL['protocol']) {
    print('selected');
}
print(' >HTTP');
//    print('<option value=2 ');
//    if($URL['protocol']==2){ print ('selected');}
//    print(' >HTTPS</td></tr>');

print('<tr><td>' . _AM_SSIFRAME_SERVER . '</td>');
print('<td><input type=text name=servername value=' . $URL['servername'] . '></td></tr>');

print('<tr><td>' . _AM_SSIFRAME_PORT . '</td>');
print('<td><input type=text name=port value=');
if (0 != $URL['port']) {
    print($URL['port']);
}
print('></td></tr>');

print('<tr><td>' . _AM_SSIFRAME_PATH . '</td>');
print('<td><input type=text name=path value=' . $URL['path'] . '></td></tr>');

print('<tr><td>' . _AM_SSIFRAME_METHOD . '</td>');
print('<td><select name="method" value=' . $URL['method'] . '>');
print('<option value=1 ');
if (1 == $URL['method']) {
    print('selected');
}
print(' >GET');
print('<option value=2 ');
if (2 == $URL['method']) {
    print('selected');
}
print(' >POST</td></tr>');

print('<tr><td>' . _AM_SSIFRAME_BASIC . '</td>');
print('<td><input type=checkbox name="basic_cb" value="on" ');
if (1 == $URL['basic']) {
    print('checked');
}
print(' ></td></tr>');

print('<tr><td>' . _AM_SSIFRAME_BASICID . '</td>');
print('<td><input type=text name=basic_user value=' . $URL['basic_user'] . '></td></tr>');

print('<tr><td>' . _AM_SSIFRAME_BASICPW . '</td>');
print('<td><input type=text name=basic_pass value=' . $URL['basic_pass'] . '></td></tr>');

print('<tr><td>' . _AM_SSIFRAME_PARAM . '</td>');
print('<td><input type=text name=param value=' . $URL['param'] . '></td></tr>');
print('<tr><td colspan=2 align="center"><input type=submit name="button" value="' . _AM_SSIFRAME_SUBMIT . '"></td></tr>');
print('</table>');
print('</center>');
print('<input type=hidden name="update" value=1>');

print('</form>');

xoops_cp_footer();
