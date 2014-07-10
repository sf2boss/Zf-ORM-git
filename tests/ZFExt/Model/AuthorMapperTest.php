<?php
class ZFExt_Model_EntryMapper {
	protected $_tableGateway = null;
	protected $_tableName = 'entries';
	protected $_entityClass = 'ZFExt_Model_Entry';
	protected $_authorMapperClass = 'ZFExt_Model_AuthorMapper';
	protected $_authorMapper = null;
	public function __construct(Zend_Db_Table_Abstract $tableGateway) {
		if (is_null ( $tableGateway )) {
			$this->_tableGateway = new Zend_Db_Table ( $this->_tableName );
		} else {
			$this->_tableGateway = $tableGateway;
		}
	}
	protected function _getGateway() {
		return $this->_tableGateway;
	}
	public function save(ZFExt_Model_Entry $entry) {
		if (! $entry->id) {
			$data = array (
					'title' => $entry->title,
					'content' => $entry->content,
					'published_date' => $entry->published_date,
					'author_id' => $entry->author->id 
			);
			$entry->id = $this->_getGateway ()->insert ( $data );
		} else {
			$data = array (
					'id' => $entry->id,
					'title' => $entry->title,
					'content' => $entry->content,
					'published_date' => $entry->published_date,
					'author_id' => $entry->author->id 
			);
			$where = $this->_getGateway ()->getAdapter ()->quoteInto ( 'id = ?', $entry->id );
			$this->_getGateway ()->update ( $data, $where );
		}
	}
	public function find($id) {
		$result = $this->_getGateway ()->find ( $id )->current ();
		if (! $this->_authorMapper) {
			$this->_authorMapper = new $this->_authorMapperClass ();
		}
		$author = $this->_authorMapper->find ( $result->author_id );
		$entry = new $this->_entityClass ( array (
				'id' => $result->id,
				'title' => $result->title,
				'content' => $result->content,
				'published_date' => $result->published_date,
				'author' => $author 
		) );
		return $entry;
	}
	public function delete($entry) {
		if ($entry instanceof ZFExt_Model_Entry) {
			$where = $this->_getGateway ()->getAdapter ()->quoteInto ( 'id = ?', $entry->id );
		} else {
			$where = $this->_getGateway ()->getAdapter ()->quoteInto ( 'id = ?', $entry );
		}
		$this->_getGateway ()->delete ( $where );
	}
	public function setAuthorMapper(ZFExt_Model_AuthorMapper $mapper) {
		$this->_authorMapper = $mapper;
	}
}