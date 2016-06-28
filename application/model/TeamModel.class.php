<?php

/**
 * team表的操作模型类
 */
require_once './framework/Model.class.php';
class TeamModel extends Model {

	/**
	 * 利用ID获得球队详细信息数据
	 *
	 * @param $t_id 需要的ID
	 */
	public function getByID($t_id) {
		$sql = "select * from team where t_id='$t_id'";
		$team = $this->_db->fetchRow($sql);
		return $team;
	}
}