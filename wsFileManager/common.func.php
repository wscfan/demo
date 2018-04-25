<?php
/**
 * 提示操作信息，并且跳转
 * @param  string $mes
 * @param  string $url
 */
function alertMes($mes, $url) {
	echo "<script type='text/javascript'>alert('{$mes}'); location.href='{$url}';</script>";
}