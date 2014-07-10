<?php
class Core_Service_Blog
{

	private $dbAdapter;
	/**
	 * 
	 */
	
	public function __construct()
	{
			$this->dbAdapter = 	Zend_Controller_Front::getInstance()
											->getParam('bootstrap')
											->getResource('multidb')
											->getDb('db1');		
	}
	
	
	public function fetchLastArticles($count =5)
	{		
		// parametre count invalide
		if (0==(int) $count) {
			throw new InvalidArgumentException("count doit etre un entier supérieur à 1");
		}
		$sql = $this->dbAdapter->select()
								->from('article')
								->order('article_id DESC')
								->limit($count);
		$results = $this->dbAdapter->fetchAll($sql);
		//Si pas de resultats		
		if (0===count($results))
		{
			return false;
		}
		$articles = array();
		foreach ($results as $result) {
			$article = new Core_Model_Article();
			$article->setId($result['article_id'])->setTitle($result['article_title'])->setContent($result['article_content']);
			$articles[] = $article;	
		}		
		return array_reverse($articles);
	}
	public function fetchArticleById($articleId)
	{
		if (0==(int) $articleId) {
			throw new InvalidArgumentException("articleId doit etre un entier supérieur à 1");
		}
		$dbAdapter = Zend_Controller_Front::getInstance()
										->getParam('bootstrap')
										->getResource('multidb')
										->getDb('db1');
		
		$sql = "Select * from article where article_id= ?";
		$result = $this->dbAdapter->fetchAll($sql,$articleId);
		if (0===count($result)) 
		{
			throw new Zend_Controller_Action_Exception('Cet article est introuvable!',404);
			return false;
		}		
		$article = new Core_Model_Article();
		$article->setId($result[0]['article_id'])->setTitle($result[0]['article_title'])->setContent($result[0]['article_content']);
		$categorie = $this->fetchCategorieById($result[0]['article_categorie_id']);	
		$article->setCategorie($categorie);		
		return $article;
	}
	
	
	public function fetchArticleByCategorieId($categorieId)
	{
		if (0==(int) $categorieId) {
			throw new InvalidArgumentException("categorieId doit etre un entier supérieur à 1");
		}
		$dbAdapter = Zend_Controller_Front::getInstance()
											->getParam('bootstrap')
											->getResource('multidb')
											->getDb('db1');
	
		$sql = "Select * from article where article_categorie_id= ?";
		$result = $this->dbAdapter->fetchAll($sql,$categorieId);
		if (0===count($result))
		{
			throw new Zend_Controller_Action_Exception('Aucun article dans cette categorie!',404);
			return false;
		}
		$articles = array();
		foreach ($result as $row) {		
			$article = new Core_Model_Article();
			$article->setId($result[0]['article_id'])->setTitle($result[0]['article_title'])->setContent($result[0]['article_content']);
			$categorie = $this->fetchCategorieById($result[0]['article_categorie_id']);
			$article->setCategorie($categorie);
			$articles[] = $article;
		}
		
		
		return $articles;
	}
	
	public function fetchCategorieById($categorieId)
	{
		if (0==(int) $categorieId) {
			throw new InvalidArgumentException("categorieId doit etre un entier supérieur à 1");
		}
		$sql = "Select * from categorie where categorie_id= ?";
		$result = $this->dbAdapter->fetchAll($sql,$categorieId);
		if (0===count($result))
		{
			throw new Zend_Controller_Action_Exception('Cet Categorie est introuvable!',404);
			return false;
		}
		$categorie = new Core_Model_Categorie();
		$categorie->setId($result[0]['categorie_id'])->setNom($result[0]['categorie_nom']);
		return $categorie;		
	}
	
	
}