<?php
class NotfoundController extends Controller
{
	public function index()
	{
		$this->_view->set('title', 'Admin - Login');
		return $this->_view->output();
	}
}