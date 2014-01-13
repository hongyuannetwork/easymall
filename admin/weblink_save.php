<?php	require(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2013 phpMyWind.com
update: 2012-1-11 9:47:47
person: Feng
**************************
*/


//初始化参数
$tbname = '#@__weblink';
$gourl  = 'weblink.php';
$action = isset($action) ? $action : '';


//引入操作类
require(ADMIN_INC.'/action.class.php');


//添加友情链接
if($action == 'add')
{
	$r = $dosql->GetOne("SELECT parentid FROM `#@__weblinktype` WHERE id=$classid");
	$parentid  = $r['parentid'];
	$parentstr = $doaction->GetParentStr();

	$posttime = GetMkTime($posttime);

	$sql = "INSERT INTO `$tbname` (siteid, classid, parentid, parentstr, webname, linkurl, webnote, picurl, orderid, posttime, checkinfo) VALUES ('$cfg_siteid', '$classid', '$parentid', '$parentstr', '$webname', '$linkurl', '$webnote', '$picurl', '$orderid', '$posttime', '$checkinfo');";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}


//修改友情链接
else if($action == 'update')
{
	$r = $dosql->GetOne("SELECT parentid FROM `#@__weblinktype` WHERE id=$classid");
	$parentid  = $r['parentid'];
	$parentstr = $doaction->GetParentStr();

	$posttime = GetMkTime($posttime);

	$sql = "UPDATE `$tbname` SET siteid='$cfg_siteid', classid='$classid', parentid='$parentid', parentstr='$parentstr', webname='$webname', linkurl='$linkurl', webnote='$webnote', picurl='$picurl', orderid='$orderid', posttime='$posttime', checkinfo='$checkinfo' WHERE id=$id";
	if($dosql->ExecNoneQuery($sql))
	{
		header("location:$gourl");
		exit();
	}
}


//无条件返回
else
{
    header("location:$gourl");
	exit();
}
?>