<?php

/**
 * 欧冠相关操作
 */
class OuguanController {

	/**
	 * 比赛列表
	 */
	public function match() {
		//逻辑代码部分
		header('Content-Type: text/html; charset=utf-8');

		//得到数据
		require './application/model/MatchModel.class.php';//载入模型类
		$model_match = new MatchModel;//matchModel对象
		$list = $model_match->getList();//调用方法获得数据

		//载入模板
		include './application/view/front/list_xianshi.html';
	}
	

	/**
	 * 球队信息
	 */
	public function team() {
		header('Content-Type: text/html; charset=utf-8');
		//调用模型实现业务逻辑
		require './application/model/TeamModel.class.php';
		$model_team = new TeamModel;
		$team = $model_team->getByID($_GET['t_id']);

		//球员数量
		require './application/model/PlayerModel.class.php';
		$model_player = new PlayerModel;
		$count = $model_player->getNumByTeam($_GET['t_id']);

		//球员列表
		$players = $model_player->getPlayersByTeam($_GET['t_id']);


		//载入视图层模板
		include './application/view/front/team.html';
	}
}