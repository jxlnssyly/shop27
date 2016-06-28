<?php

/**
 * 操作match表的模型类
 */
require_once './framework/Model.class.php';
class MatchModel extends Model {

	/**
	 * 获得比赛列表
	 */
	public function getList() {
		
		$sql = "select m.h_id, m.g_id, ht.t_name as ht_name, m.h_score, m.g_score, gt.t_name as gt_name, m.m_time from `match` as m left join team as ht ON ht.t_id=m.h_id LEFT JOIN team as gt ON gt.t_id=m.g_id where 1";
		return $this->_db->fetchAll($sql);
	}

	//其他的match表的操作
	//...
	 
}