<?php

/**
 * 数据库操作类
 */
class MySQLDB {
	private $_host;//主机
	private $_port;//端口
	private $_user;//用户
	private $_pass;//密码
	private $_charset;//字符集
	private $_dbname;//默认数据库


	private $_link;//保存连接资源
	private $_sql = array();//执行的所有SQL

	private static $_instance;//保存单例实例

	/**
	 * 构造方法
	 * 
	 * @param $options array 选项数组
	 */
	private function __construct($options) {
		//初始化属性
		$this->_host = isset($options['host']) ? $options['host'] : 'localhost';
		$this->_port = isset($options['port']) ? $options['port'] : '3306';
		$this->_user = isset($options['user']) ? $options['user'] : '';//默认：匿名用户
		$this->_pass = isset($options['pass']) ? $options['pass'] : '';
		$this->_charset = isset($options['charset']) ? $options['charset'] : 'utf8';
		$this->_dbname = isset($options['dbname']) ? $options['dbname'] : '';//默认：不选择默认数据库

		echo $this->_host.':'.$this->_port, $this->_user, $this->_pass;
		//连接MySQL服务器
		if ($link = mysql_connect($this->_host.':'.$this->_port, $this->_user, $this->_pass)) {
			//连接成功
			$this->_link = $link;
		} else {
			//失败
			echo '数据库连接失败，请确定数据库服务器参数';
			die;
//			return false;
		}

		//设定连接字符集
		$sql = "set names $this->_charset";
		$this->query($sql);

		//选择默认数据库
		if ($this->_dbname !== '') {//设定了某个默认库
			$sql = "use `$this->_dbname`";//在库名增加反引号
			$this->query($sql);
		}
	}

	/**
	 */
	private function __clone() {
	}

	/**
	 * 得到单例对象的方法
	 */
	public static function getInstance($options=array()) {
		if (! self::$_instance instanceof self) {
			self::$_instance = new self($options);
		}
		return self::$_instance;
	}

	/**
	 * 执行SQL的方法
	 *
	 * @param $sql string 待执行的SQL
	 *
	 * @return mixed 执行结果 失败 false；成功：查询类（select，show，desc），结果集，非查询类，true。
	 */
	public function query($sql) {//execute
		//记录一下
		$this->_sql[] = $sql;
		//执行
		if (!$result = mysql_query($sql, $this->_link)) {
				echo 'SQL执行失败<br>';
				echo '错误的代码为: ', mysql_errno($this->_link), '<br>';
				echo '错误的消息为: ', mysql_error($this->_link), '<br>';
				echo '错误的SQL为: ', $sql , '<br>';
				die;
//				return false;
		} else {
			return $result;
		}
	}

	/**
	 * 获得多行数据
	 * @param $sql string 待执行的查询的SQL
	 * @return array 二维数组，每个元素表示一条记录，记录的集合。
	 */
	public function fetchAll($sql) {
		//执行
		if ($result = $this->query($sql)) {
			//执行成功，处理结果集
			$rows = array();//所有的记录集合
			//遍历结果集
			while($row = mysql_fetch_assoc($result)) {
				$rows[] = $row;
			}
			//释放结果集资源
			mysql_free_result($result);
			return $rows;
		} else {
			//执行失败
			return false;
		}
	}
	/**
	 * @return array 一维数组
	 */
	public function fetchRow($sql) {
		//执行
		if ($result = $this->query($sql)) {
			//获得一条记录即可
			$row = mysql_fetch_assoc($result);
			mysql_free_result($result);
			return $row;
		} else {
			return false;
		}
	}
	
	/**
	 * @return string 
	 */
	public function fetchColumn($sql) {
		//执行
		if ($result = $this->query($sql)) {
			//获得一条记录即可
			//判断下，fetch函数可能返回false，
			if ($row = mysql_fetch_row($result)) {//索引型数组
				$return = $row[0];
			} else {
				$return = false;
			}
			mysql_free_result($result);
			return $return;
		} else {
			return false;
		}
	}
}