<?php
class ZFExt_Model_EntryMapper {
	protected $_tableGateway = null;
	protected $_tableName = 'article';
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
			$entry->id = $this->getGateway ()->insert ( $data );
		} else {
			$data = array (
					'id' => $entry->id,
					'title' => $entry->title,
					'content' => $entry->content,
					'published_date' => $entry->published_date,
					'author_id' => $entry->author->id 
			);
			$where = $this->getGateway ()->getAdapter ()->quoteInto ( 'entry_id = ?', $entry->id );
			$this->getGateway ()->update ( $data, $where );
		}
	}
}