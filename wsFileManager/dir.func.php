<?php

// 打开指定目录
/**
 * 遍历目录函数，只读取目录中的最外层的内容
 * @param  string $path
 * @return arr
 */
function readDirectory($path) {
	$handle = opendir($path);
	while (($item = readdir($handle)) !== false) {
		// 特殊目录 . 和 ..
		if ($item != "." && $item != "..") {
			if (is_file($path . '/' . $item)) {
				$arr['file'][] = $item;
			}
			if (is_dir($path . '/' . $item)) {
				$arr['dir'][] = $item;
			}
		}
	}
	closedir($handle);
	return $arr;
}
// $path = 'file';
// print_r(readDirectory($path));

/**
 * 得到文件夹大小
 * @return string $path
 */
function dirSize($path) {
	$sum = 0;
	global $sum;
	$handle = opendir($path);
	while (($item = readdir($handle)) !== false) {
		if ($item != '.' && $item != '..') {
			if (is_file($path.'/'.$item)) {
				$sum += filesize($path.'/'.$item);
			}
			if (is_dir($path.'/'.$item)) {
				$func = __FUNCTION__;
				$func($path.'/'.$item);
			}
		}
	}
	closedir($handle);
	return $sum;
}

/**
 * 复制文件夹
 * @param  string $src
 * @param  string $dst
 * @return string
 */
function copyFolder($src, $dst) {
	if (!file_exists($dst)) {
		mkdir($dst, 0777, true);
	}
	$handle = opendir($src);
	while (($item = readdir($handle)) !== false) {
		if ($item != '.' && $item != '..') {
			if (is_file($src . '/' . $item)) {
				copy($src . '/' . $item, $dst . '/' . $item);
			}
			if(is_dir($src . '/' . $item)) {
				$func = __FUNCTION__;
				$func($src . '/' . $item, $dst . '/' . $item);
			}
		}
	}
	closedir($handle);
	return '复制成功';
}

/**
 * 重命名文件夹
 * @param  string $oldname
 * @param  string $newname
 * @return string
 */
function renameFolder($oldname, $newname) {
	echo $newname;
	if (checkFilename(basename($newname))) {
		if (!file_exists($newname)) {
			if (rename($oldname, $newname)) {
				$mes = '重命名成功';
			} else {
				$mes = '重命名失败';
			}
		} else {
			$mes = '存在同名目录';
		}
	} else {
		$mes = '格式有误';
	}
	return $mes;
}

/**
 * 剪切文件夹
 * @param  string $src
 * @param  string $dst
 * @return string
 */
function cutFolder($src, $dst) {
	if (file_exists($dst)) {
		if (is_dir($dst)) {
			if (!file_exists($dst . '/' . basename($src))) {
				if (rename($src, $dst . '/' . basename($src))) {
					$mes = '剪切成功';
				} else {
					$mes = '剪切失败';
				}
			} else {
				$mes = '存在同名文件夹';
			}
		} else {
			$mes = '不是一个文件夹';
		}
	} else {
		$mes = '目标文件夹不存在';
	}
	return $mes;
}

/**
 * 删除文件夹
 * @param  string $path
 * @return string
 */
function delFolder($path) {
	$handle = opendir($path);
	while (($item = readdir($handle)) !== false) {
		if ($item != '.' && $item != '..') {
			if (is_file($path . '/' . $item)) {
				unlink($path . '/' . $item);
			}
			if (is_dir($path . '/' .$item)) {
				$func = __FUNCTION__;
				$func($path . '/' . $item);
			}
		}
	}
	closedir($handle);
	rmdir($path);
	return '文件夹删除成功';
}