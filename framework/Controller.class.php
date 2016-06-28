<?php

/**
 * 基础控制器
 */
class Controller {

	/**
	 * 跳转
	 *
	 * @param $url string 目标URL
	 * @param $info string 提示信息
	 * @param $wait int 等待时间
	 */
	protected function _jump($url, $info='', $wait=2) {
		//判断是否存在提示信息
		if ($info === '') {
			//立即跳转
			header('Location: ' . $url);
		} else {
			//提示跳转
			echo <<<HTML
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> 跳转 - $info </TITLE>
  <META HTTP-EQUIV="Refresh" CONTENT="$wait;URL=$url">
 </HEAD>
 <BODY>
				$info;
 </BODY>
</HTML>
HTML;
		}
		die;//当前脚本强制结束
	}
}