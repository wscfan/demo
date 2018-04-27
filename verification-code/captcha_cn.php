<?php
	session_start();

	$image = imagecreatetruecolor(200, 60);
	$bgcolor = imagecolorallocate($image, 255, 255, 255);
	imagefill($image, 0, 0, $bgcolor);

	$fontface = 'fonts/STKAITI.TTF';
	$str = '乾坤有序宇宙无疆星辰密布斗柄指航昼白夜黑日明月亮风驰雪舞电闪雷响云腾致雨露结晨霜虹霓霞辉雾沉雹降春生夏长秋收冬藏时令应候寒来暑往远古洪荒海田沧桑陆地漂移板块碰撞山岳巍峨湖泊荡漾植被旷野岛撒汪洋冰川冻土沙漠沃壤木丰树森岩多滩广鸟飞兽走鳞潜羽翔境态和谐物种安详形分上下道合阴阳幽冥杳渺天体著彰凝气为精聚能以场缩浓而质积微显量化巨幻虚恍惚成象强固凌弱柔亦制刚终极必反存兴趋亡色空轮回动静恒常唯实众名一理万方父母爹娘没齿难忘兄弟姐妹危困助帮姑姨叔舅亲戚互访侄男闺少哺育茁壮夫妻相敬梦忆糟糠隔屋邻舍遇事谦谅伯公妪婆慈孝赡养尊朋礼友仁义君郎炎黄二帝尧舜禅让禹启世袭灭桀商汤周武伐纣侯列各邦秦皇集权汉刘楚项鼎立割据乱晋八王南北对峙腐朽隋炀贞观政要五代续唐陈桥兵变耻辱靖康耶律完颜元建宋僵';
	$strdb = str_split($str, 12);
	$strdb_use = $strdb[rand(0, count($strdb)-1)];
	$str_use = str_split($strdb_use, 3);

	$captch_code = '';
	for ($i=0; $i<4; $i++) {
		$fontcolor = imagecolorallocate($image, rand(0, 150), rand(0, 150), rand(0, 150));

		$cn = $str_use[$i];
		$captch_code .= $cn;

		imagettftext($image, mt_rand(20, 24), mt_rand(-60, 60), 40 * $i + 20, mt_rand(30, 35), $fontcolor, $fontface, $cn);

	}
	$_SESSION['authcode'] = $captch_code;

	for ($i=0; $i<200; $i++) {
		$pointcolor = imagecolorallocate($image, rand(100, 250), rand(100, 250), rand(100, 250));
		imagesetpixel($image, rand(1, 199), rand(1, 59), $pointcolor);
	}

	for ($i=0; $i<3; $i++) {
		$linecolor = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));
		imageline($image, rand(1, 199), rand(1, 59), rand(1, 100), rand(1, 30), $linecolor);
	}
	header('content-type: image/png');
	imagepng($image);

	imagedestory($image); 