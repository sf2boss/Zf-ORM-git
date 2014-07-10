<?php
class Core_Model_Article {
	
	private $id;
	private $title;
	private $content;
	
	private $foreignCategorie;
	
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return the $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @param field_type $title
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	/**
	 * @param field_type $content
	 */
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}

	public function setCategorie(Core_Model_Categorie $categorie)
	{
		$this->foreignCategorie = $categorie;
		return $this;
	}
	public function getCategorie()
	{
		return $this->foreignCategorie;
	}
	
	
}