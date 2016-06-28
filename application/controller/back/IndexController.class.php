<?php

/**
 * 后台首页相关控制器类
 */
class IndexController extends Controller {

	public function index() {
		//判断当前是否登录
		if (!isset($_COOKIE['is_login']) || $_COOKIE['is_login']!='yes') {
			//没有登录
			$this->_jump('index.php?p=back&c=admin&a=login');
		}

		echo 'back index page';
	}
}