<?php	require(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2013 phpMyWind.com
update: 2012-10-8 17:32:29
person: Feng
**************************
*/


//初始化参数
$tbname = '#@__usergroup';
$gourl  = 'usergroup.php';
$action = isset($action) ? $action : '';


//引入操作类
require(ADMIN_INC.'/action.class.php');


//保存操作
if($action == 'save')
{
	if($groupname_add != '')
	{
		$dosql->ExecNoneQuery("INSERT INTO `$tbname` (groupname, expvala, expvalb, stars, color) VALUES ('$groupname_add', '$expvala_add', '$expvalb_add', '$stars_add', '$color_add')");
	}

	if(isset($id))
	{
		$ids = count($id);
		for($i=0; $i<$ids; $i++)
		{
			$dosql->ExecNoneQuery("UPDATE `$tbname` SET groupname='$groupname[$i]', expvala='$expvala[$i]', expvalb='$expvalb[$i]', stars='$stars[$i]', color='$color[$i]' WHERE id=$id[$i]");
		}
	}

    header("location:$gourl");
	exit();
}


//无条件返回
else
{
    header("location:$gourl");
	exit();
}
?>