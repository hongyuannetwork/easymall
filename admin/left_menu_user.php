<?php require(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧菜单</title>
<link href="templates/style/menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/tinyscrollbar.js"></script>
<script type="text/javascript" src="templates/js/leftmenu.js"></script>
</head>
<body>
<div class="quickbtn"> <span class="quickbtn_left"><a href="infolist_add.php" target="main">添列表</a></span> <span class="quickbtn_right"><a href="infoimg_add.php" target="main">添图片</a></span> </div>
<div class="tGradient"></div>
<div id="scrollmenu">
	<div class="scrollbar">
		<div class="track">
			<div class="thumb">
				<div class="end"></div>
			</div>
		</div>
	</div>
	<div class="viewport">
		<div class="overview">
			<!--scrollbar start-->
			<?php
			if($_SESSION['adminlevel'] != '2')
			{
			?>
			<div class="menubox">
				<div class="title ton" onclick="DisplayMenu('leftmenu1');" title="点击切换显示或隐藏">网站系统管理</div>
				<div id="leftmenu1"><a href="admin.php" target="main">管理员管理</a> <a href="web_config.php" target="main">网站信息配置</a> <a href="upload_filemgr_sql.php" target="main">上传文件管理</a></div>
			</div>
			<div class="hr_5"></div>
			<?php
			}
			
			$dosql->Execute("SELECT * FROM `#@__infoclass` WHERE siteid='$cfg_siteid' AND parentid=0 AND adminmenu='true' ORDER BY orderid ASC");
			$i = 10;
			while($row = $dosql->GetArray())
			{
			?>
			<div class="menubox">
				<div class="title" onclick="DisplayMenu('leftmenu<?php echo $i; ?>');" title="点击切换显示或隐藏"><?php echo $row['classname']; ?></div>
				<div id="leftmenu<?php echo $i; ?>" style="display:none">
				<?php

				//检查类型管理是否开启
				if($row['menulevel'] >= 1)
				{
					echo "<a href='infoclass_user.php?cid=$row[id]' target='main'>类型管理</a>";
				}

				$dosql->Execute("SELECT * FROM `#@__infoclass` WHERE (id=".$row['id']." OR parentstr LIKE '0,".$row['id'].",%') ORDER BY orderid ASC",$i);
				while($row2 = $dosql->GetArray($i))
				{
					switch($row2['infotype'])
					{
						case 0:
							echo '<a href="info_update.php?id='.$row2['id'].'" target="main">'.$row2['classname'].'</a>';
						break;
						case 1:
							echo '<div class="hr_1"></div>';
							echo '<a href="infolist.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
							echo '<a href="infolist_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
						break;
						case 2:
							echo '<div class="hr_1"></div>';
							echo '<a href="infoimg.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
							echo '<a href="infoimg_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
						break;
						case 3:
							echo '<div class="hr_1"></div>';
							echo '<a href="soft.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
							echo '<a href="soft_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
						break;
						case 4:
							echo '<div class="hr_1"></div>';
							echo '<a href="goods.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'管理</a>';
							echo '<a href="goods_add.php?cid='.$row2['id'].'" target="main">'.$row2['classname'].'添加</a>';
						break;
						default:
					}

				}
				?>
				</div>
			</div>
			<div class="hr_5"></div>
			<?php
				$i++;
			}

			$dosql->Execute("SELECT * FROM `#@__diymenu` WHERE siteid='$cfg_siteid' AND checkinfo='true' AND parentid=0 ORDER BY orderid ASC");
			$i = 100;
			while($row = $dosql->GetArray())
			{
			?>
			<div class="menubox">
				<div class="title" onclick="DisplayMenu('leftmenu<?php echo $i; ?>');" title="点击切换显示或隐藏"><?php echo $row['classname']; ?></div>
				<div id="leftmenu<?php echo $i; ?>" style="display:none">
				<?php
				$dosql->Execute("SELECT * FROM `#@__diymenu` WHERE checkinfo='true' and parentid=".$row['id']." ORDER BY orderid ASC",$i);
				while($row2 = $dosql->GetArray($i))
				{
					echo '<a href="'.$row2['linkurl'].'" target="main">'.$row2['classname'].'</a>';
				}
				?>
				</div>
			</div>
			<div class="hr_5"></div>
			<?php
				$i++;
			}
			
			if($dosql->GetTableRow('#@__fragment') > 0)
			{
			?>
			<div class="menubox">
				<div class="title" onclick="DisplayMenu('leftmenu99');" title="点击切换显示或隐藏">碎片数据</div>
				<div id="leftmenu99" style="display:none">
					<a href="fragment.php" target="main">碎片数据</a>
				</div>
			</div>
			<?php
			}
			?>
			<div class="hr_5"></div>
			<!--scrollbar end-->
		</div>
	</div>
</div>
<div class="bGradient"></div>
<div class="copyright">
	© 2013 <a href="http://phpMyWind.com/" target="_blank">phpMyWind.com</a><br />All Rights Reserved.
</div>
</body>
</html>