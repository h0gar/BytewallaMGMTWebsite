<?php
class Database {
	public function __construct($host, $user, $pwd, $db) {
		mysql_connect($host, $user, $pwd);
		mysql_select_db($db);
	}
	
	public function query($sql) {
		$q = mysql_query($sql);
		if(!$q)
			$this->error(mysql_error(), $sql);
		
		return $q;
	}
	
	public function fetch($sql) {
		$q = $this->query($sql);
		return mysql_fetch_assoc($q);
	}
	
	public function result($sql) {
		$c = $this->fetch($sql);
		return $c['result'];
	}
	
	public function error($error, $sql) {
		die('SQL: '.$sql.'<br/>
		Error: '.$error);
	}
	
	public function close() {
		mysql_close();
	}
}