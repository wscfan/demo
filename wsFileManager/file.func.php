<?php

// Byte / KB / MB / GB / TB / EB
/**
 * 转换字节大小
 * @param  number $size
 * @return number
 */
function transByte($size) {
	$arr = ['B', 'KB', 'MB', 'GB', 'TB', 'EB'];
	$i = 0;
	while ($size > 1024) {
		$size /= 1024;
		$i++;
	}
	return round($size, 2) . $arr[$i];
}
// echo transByte(12325);

/**
 * 创建文件
 * @param  string $filename
 * @return string
 */
function createFile($filename) {
	//file/1.txt
	//验证文件名的合法性,是否包含/,*,<>,?,|
	$pattern = "/[\/,\*,<>,\?\|]/";
	if (! preg_match ( $pattern, basename ( $filename ) )) {
		//检测当前目录下是否存在同名文件
		if (! file_exists ( $filename )) {
			//通过touch($filename)来创建
			if (touch ( $filename )) {
				return "文件创建成功";
			} else {
				return "文件创建失败";
			}
		} else {
			return "文件已存在，请重命名后创建";
		}
	} else {
		return "非法文件名";
	}
}

/**
 * 重命名文件
 * @param  string $oldname
 * @param  string $newname
 * @return string
 */
function renameFile($oldname, $newname) {
	// echo $oldname . $newname;
	// 验证文件名是否合法
	if (checkFilename($newname)) {
		// 检测当前目录下是否存在同名文件
		$path = dirname($oldname);
		if (!file_exists($path.'/'.$newname)) {
			// 进行重命名
			if (rename($oldname, $path.'/'.$newname)) {
				return '重命名成功';
			} else {
				return '重命名失败';
			}
		} else {
			return '存在重名文件，请重新命名';
		}
	} else {
		return '非法文件名';
	}
}

/**
 * 检验文件名是否合法
 * @param  string $filename
 * @return boolean
 */
function checkFilename($filename) {
	$pattern = "/[\/,\*,<>,\?\|]/";
	if (preg_match( $pattern, $filename)) {
		return false;
	} else {
		return true;
	}
}

/**
 * 删除文件
 * @param  string $filename
 * @return string
 */
function delFile($filename) {
	if (unlink($filename)) {
		$mes = '文件删除成功';
	} else {
		$mes = '文件删除失败';
	}
	return $mes;
}

/**
 * 下载文件
 * @param  string $filename
 * @return
 */
function downFile($filename) {
	header("content-disposition:attachment;filename=".basename($filename));
	header("content-length:".filesize($filename));
	readfile($filename);
}

/**
 * 复制文件
 * @param  string $src
 * @param  string $dst
 * @return string
 */
function copyFile($filename, $dstname) {
	if (file_exists($dstname)) {
		if (!file_exists($dstname . '/' . basename($filename))) {
			if (copy($filename, $dstname . '/' . basename($filename))) {
				$mes = '文件复制成功';
			} else {
				$mes = '文件复制失败';
			}
		} else {
			$mes = '存在同名文件';
		}
	} else {
		$mes = '不存在目标目录';
	}
	return $mes;
}

/**
 * 剪切文件
 * @param  string $src
 * @param  string $dst
 * @return string
 */
function cutFile($filename, $dstname) {
	if (file_exists($dstname)) {
		if (!file_exists($dstname . '/' . basename($filename))) {
			if (rename($filename, $dstname . '/' . basename($filename))) {
				$mes = '文件剪切成功';
			} else {
				$mes = '文件剪切失败';
			}
		} else {
			$mes = '存在同名文件';
		}
	} else {
		$mes = '不存在目标目录';
	}
	return $mes;
}