<?php
class Controller
{
	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_view;
	protected $_modelBaseName;
	protected $_mail;	
		
	public function __construct($model, $action)
	{		
		$this->_controller = ucwords(__CLASS__);
		$this->_action = $action;
		$this->_modelBaseName = $model;
		
		if(!isset($_SESSION['user_details'][0]['role_id']))
		{
			$action = 'assignments';
			$this->_modelBaseName = 'assignments';
		}

		$this->_view = new View(HOME . DS . 'views' . DS . strtolower($this->_modelBaseName) . DS . $action . '.php');
		
		$this->_mail = new Mailer();
		
	}
	
	protected function _setModel($modelName)
	{
		$modelName .= 'Model';
		$this->_model = new $modelName();
	}
	
	protected function _setView($viewName)
	{
		$this->_view = new View(HOME . DS . 'views' . DS . strtolower($this->_modelBaseName) . DS . $viewName . '.php');
	}
}