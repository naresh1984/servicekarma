<?php
class CategoriesController extends Controller
{
	public function __construct($model, $action)
	{
		parent::__construct($model, $action);
		$this->_setModel($model);
		
		if(!isset($_SESSION['user_details'][0]['id']) && $_SESSION['user_details'][0]['id']!=1)
		{
			header("Location:".BASE_FRONTEND_URL."assignments/index/redirect=".$_REQUEST['load']);
		}		
	}
		
	public function index()
	{
		$this->_setView("index");	
		$establishment_id = $_SESSION['user_details'][0]['establishment_id'];	
		$allCategories = array();
		$allCategories = $this->_model->getAllCategories($establishment_id);
		$this->_view->set('allCategories', $allCategories);		
        return $this->_view->output();
	}	

	public function add()
	{
		if(@$_REQUEST['ajaxcheck']==1)
		{
			$ajax_error = '';
			$category_name = $_REQUEST['category_name'];
		    $category_check = $this->_model->checkCategory($category_name);			
			if(count($category_check) > 0)
			 $ajax_error = 1; 
		    if($ajax_error == 1)
			 echo $ajax_error;

		
		}else if(!isset($_REQUEST['ajaxcheck']) && trim(@$_REQUEST['category_name'])!='')
		{			
		/*	echo "<pre>";
			print_r($_REQUEST);
			exit();*/
			
/*			echo "<pre>";
			print_r($_SESSION);
			exit();*/
			 
			$category_name = @$_REQUEST['category_name'];
			$status = @$_REQUEST['status'];	
			$user_id = $_SESSION['user_details'][0]['id'];
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];
			$category_insert = $this->_model->insertCategory($category_name,$status,$user_id,$establishment_id);			
			header("Location:".BASE_FRONTEND_URL."categories/");			
		}else{			
			$this->_setView("add_category");		
			return $this->_view->output();
		}
	}
	
	public function editCategory()
	{
		@$string = explode('/', $_GET['load']);		
	    @$id = @$string[2];		
		
		if(@$_REQUEST['ajaxcheck']==1)
		{
			$ajax_error = '';
			$category_name = $_REQUEST['category_name'];
			$id = $_REQUEST['id'];	
			$category_check = $this->_model->EditcheckCategory($category_name,$id);		
			if(count($category_check) > 0)
			 $ajax_error = 1; 
		    if($ajax_error == 1)
			 echo $ajax_error;		
		}else if(!isset($_REQUEST['ajaxcheck']) && trim(@$_REQUEST['category_name'])!='')
		{		
/*			echo "<pre>";
			print_r($_REQUEST);
			exit();*/		
			$category_name = @$_REQUEST['category_name'];
			$id = @$_REQUEST['id'];
			$user_id = $_SESSION['user_details'][0]['id'];
			$status = @$_REQUEST['status'];	
			$category_edit = $this->_model->editCategory($category_name,$user_id,$id,$status);			
			header("Location:".BASE_FRONTEND_URL."categories/");			
		}else{			
			$this->_setView("add_category");		
			$categoryDetails = $this->_model->getRowCategory($id);	
			$this->_view->set('categoryDetails', $categoryDetails);		
			return $this->_view->output();
		}
	}
		
	public function comingsoon()
	{
       $this->_setView("coming_soon");
	   return $this->_view->output();		
	}

}