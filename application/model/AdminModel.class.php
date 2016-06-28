<?php

/**
 * 操作admin表的模型类
 */
//require_once './framework/Model.class.php';
class AdminModel extends Model {

	/**
	 * 利用用户名与密码，验证管理员信息是否合法
	 *
	 * @param $admin_name string 名字
	 * @param $admin_pass string 密码
	 *
	 * @return bool
	 */
	public function check($admin_name, $admin_pass) {
		//利用 用字与密码做查询条件，查找记录
		//找到即合法，没找到就非法
		$admin_pass_md5 = md5($admin_pass);//将密码加密后再比较
		$sql = "SELECT * FROM `it_admin` WHERE admin_name='$admin_name' AND admin_pass='$admin_pass_md5'";
		//根据是否查询到结果，返回真或者假
		return (bool) $this->_db->fetchRow($sql);
	}


}