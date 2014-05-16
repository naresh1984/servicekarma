<?php 
class Model
{
	protected $_db;
	protected $_sql;
	
	public function __construct()
	{
		$this->_db = DB::init();
	}
	
	protected function _setSql($sql)
	{
		$this->_sql = $sql;
	}
	
	public function getAll($data = null)
	{
		if(!$this->_sql)
		{
			throw new Exception("No SQL query!");
		}

		$sth = $this->_db->prepare($this->_sql);
		$sth->execute($data);
		$result = $sth->fetchAll();
		return $result;
	}
	
	public function getRow($data = null)
	{
		if (!$this->_sql)
		{
			throw new Exception("No SQL query!");
		}
		
		$sth = $this->_db->prepare($this->_sql);
		$sth->execute($data);
		$result = $sth->fetch();
		return $result;	
	}
	public function insertRow($data = null)
	{
	
	  
		if (!$this->_sql)
		{
			throw new Exception("No SQL query!");
		}
	
		$sth = $this->_db->prepare($this->_sql);
	   	$sth->execute($data);
		return $this->_db->lastInsertId();
	}
	public function updateRow($data = null)
	{
	
	  
		if (!$this->_sql)
		{
			throw new Exception("No SQL query!");
		}
	
		$sth = $this->_db->prepare($this->_sql);
	   	$sth->execute($data);
		//return $this->_db->lastInsertId();
	}
}