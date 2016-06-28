<?php

/**
 * 框架核心类
 */
class Framework {
	/**
	 * 运行初始化架构操作的方法
	 */
	public function run() {
		//初始化路径常量
		$this->_initPath();
		//初始化配置
		$this->_initConfig();
		//初始化分发参数
		$this->_initDispatchParam();
		//初始化类文件映射数组
		$this->_initClasses();
		//注册自动加载
		spl_autoload_register(array($this, 'userAutoload'));
		//请求分发
		$this->_dispatch();
	}

	/**
	 * 请求分发
	 */
	private function _dispatch() {
		//载入控制器类文件
		$c = ucfirst(CONTROLLER);
		//$c_file = './application/controller/'. PLATFORM . '/' . $c . 'Controller.class.php';
		//require $c_file;
		$c_name = $c . 'Controller';
		$controller = new $c_name;//可变类
		$a = ACTION;
		$controller->$a();//如何调用其他方法？
	}

	private $classes;//类，文件映射数组
	/**
	 * 初始化
	 */
	private function _initClasses() {
		$this->classes = array(
			'MySQLDB' => FRAMEWORK_PATH . 'MySQLDB.class.php',
			'Model' => FRAMEWORK_PATH . 'Model.class.php',
			'Framework'=> FRAMEWORK_PATH . 'Framework.class.php',
			'Controller' => FRAMEWORK_PATH . 'Controller.class.php',
	//		'类名' => '所在地址'
		);
	}
	/**
	 * 自定义的项目自动加载
	 * @param $class_name string 所需要的类名
	 */
	public function userAutoload($class_name) {
//		echo $class_name,'&nbsp;';
		//判断映射数组中是否存在
		if (isset($this->classes[$class_name])) {
			//直接载入
			require $this->classes[$class_name];
		}

		//判断模型类
		elseif (substr($class_name, -5) == 'Model') {
//			require './application/model/' . $class_name . '.class.php';
			require MODEL_PATH . $class_name . '.class.php';
		}

		//判断控制器类
		elseif (substr($class_name, -10) == 'Controller') {
			//注意 平台的获得
//			require './application/controller/' . PLATFORM . '/' . $class_name . '.class.php';
			require CURRENT_CONTROLLER_PATH . $class_name . '.class.php';
		}
	
	}
	
	/**
	 * 初始化分发参数p,c,a
	 */
	private function _initDispatchParam() {
		//确定需要执行的操作名
		$default_platform = $GLOBALS['config']['app']['default_platform'];
		define('PLATFORM', isset($_GET['p']) ? $_GET['p'] : $default_platform);
		//注意：是当前平台的默认控制器与动作，应该是有PLATFORM常量来确定当前平台
		$default_controller = $GLOBALS['config'][PLATFORM]['default_controller'];//得到当前平台的默认控制器
		define('CONTROLLER', isset($_GET['c']) ? $_GET['c'] : $default_controller);
		$default_action = $GLOBALS['config'][PLATFORM]['default_action'];//当前平台的默认动作
		define('ACTION', isset($_GET['a']) ? $_GET['a'] : $default_action);

		//与当前平台相关的路径
		define('CURRENT_CONTROLLER_PATH', CONTROLLER_PATH . PLATFORM . '/');
		define('CURRENT_VIEW_PATH', VIEW_PATH . PLATFORM . '/');
	}
	
	/**
	 * 初始化路径
	 */
	private function _initPath() {
		define('ROOT_PATH', getCWD() . '/');//根目录
		define('FRAMEWORK_PATH', ROOT_PATH . 'framework/');

		define('APPLICATION_PATH', ROOT_PATH . 'application/');
		define('CONTROLLER_PATH', APPLICATION_PATH . 'controller/');
		define('MODEL_PATH', APPLICATION_PATH . 'model/');
		define('VIEW_PATH', APPLICATION_PATH . 'view/');
		define('CONFIG_PATH', APPLICATION_PATH . 'config/');//配置常量

		define('WEB_PATH', ROOT_PATH . 'web/');
	}

	/**
	 * 初始化配置
	 */
	private function _initConfig() {
		//载入配置文件
		//将载入的配置信息，保存到一个全局变量中，为了以后再其他地方可以使用
		$GLOBALS['config'] = require CONFIG_PATH . 'application.config.php';
	}
}