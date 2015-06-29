<?php 
class Mails_model extends My_Model {
		
	protected $_tablename	= 'mails';
	protected $_id_table	= 'id_mail';
	protected $_order		= 'mail';
	protected $_subject		= 'mail';
	
	
	function __construct()
	{
		parent::__construct(
				$tablename		= $this->_tablename, 
				$id_table		= $this->_id_table, 
				$order			= $this->_order,
				$subject		= $this->_subject,
				$_array_cruze	= $this->_array_cruze
		);
	}
	
} 
?>
