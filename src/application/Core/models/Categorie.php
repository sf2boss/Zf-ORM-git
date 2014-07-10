<?php
class Core_Model_Categorie {
	
	private $id;
	private $nom;
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $nom
	 */
	public function getNom() {
		return $this->nom;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @param field_type $nom
	 */
	public function setNom($nom) {
		$this->nom = $nom;
		return $this;
	}
	
	
}