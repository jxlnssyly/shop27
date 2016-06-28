<?php
/**
 * 管理员管理控制器类
 */
class AdminController extends Controller {

	/**
	 * 登录表单的展示
	 */
	public function login() {
		//不需要数据

		//展示登录表单模板即可
		include CURRENT_VIEW_PATH . 'login.html';
	}

	/**
	 * 验证管理员信息是否正确
	 */
	public function signin() {
		header('Content-Type: text/html; charset=utf-8');
		//收集表单数据
		$admin_name = $_POST['username'];
		$admin_pass = $_POST['password'];

		//调用模型，完成数据的验证
		$model_admin = new AdminModel;
		if ($model_admin->check($admin_name, $admin_pass)) {
			//合法
			//设置登录凭证
			//$is_login = 'yes';
			setCookie('is_login', 'yes', time()+3600);
//			echo '管理员合法';
			$this->_jump('index.php?p=back&c=index&a=index');
		} else {
			//非法
			$this->_jump('index.php?p=back&c=admin&a=login', '管理员用户名或密码错误', 3);
		}
	}
}