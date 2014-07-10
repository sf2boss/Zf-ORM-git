<?php


class Core_ArticleController extends Zend_Controller_Action 
{
	private $blogSvc;
	
	public function init() 
	{
		$this->blogSvc = new Core_Service_Blog();	
	}
	
	public function indexAction()
	{
		$this->view->articles = $this->blogSvc->fetchLastArticles();
	}
	public function viewAction()
	{

		$id = (int)$this->_request->getParam('id');
		if (0===$id) {
			throw new Zend_Controller_Action_Exception('Id article doit etre un entier > 0',404);
		}	
		$this->view->article = $this->blogSvc->fetchArticleById($id);
		
	}
	public function viewcategAction()
	{
		$idCateg = (int)$this->_request->getParam('id');
		if (0===$idCateg) {
			throw new Zend_Controller_Action_Exception('Id Categorie doit etre un entier > 0',404);
		}
		$this->view->articles = $this->blogSvc->fetchArticleByCategorieId($idCateg);		
		
	}
}