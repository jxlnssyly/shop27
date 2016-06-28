<?php

/**
 * 返回配置信息即可
 */
return array(
	'db' => array(
		'host' => '127.0.0.1',//数据库主机地址
		'port' => '3306',//端口
		'user' => 'root',//用户
		'pass' => '',//密码
		'charset' => 'utf8',//连接字符集
		'dbname' => 'test',//数据库名
	),//数据库信息组
	'app' => array(
		'default_platform' => 'back',//默认的平台
	),//应用程序配置组
	'back' => array(
		'default_controller' => 'admin',//默认控制器
		'default_action' => 'login',//默认动作
	),//后台配置组
	'front' => array(),//前台配置组
);

//$c = require './application.config.php';