<?php
/**
 * 操作player表的模型
 */
require_once './framework/Model.class.php';
class PlayerModel extends Model {
	/**
	 * 获得某个球队的球员数量
	 *
	 * @param $t_id 球队ID
	 */
	public function getNumByTeam($t_id) {
		$sql = "select count(*) from player WHERE t_id='$t_id'";
		return $this->_db->fetchColumn($sql);
	}

	/**
	 * 获得球队的队员列表
	 *
	 * @param $t_id 
	 */
	public function getPlayersByTeam($t_id) {
		$sql = "select * from player where t_id='$t_id'";
		return $this->_db->fetchAll($sql);
	}

}