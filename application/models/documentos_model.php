<?php 
class Documentos_model extends My_Model {
		
	protected $_tablename	= 'documentos';
	protected $_id_table	= 'id_documento';
	protected $_order		= 'documento';
	protected $_subject		= 'documento';
			
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
		
	function deleteDocumento($documento){
		
		$this->db->where($this->_id_table, $documento);
		$this->db->delete($this->_tablename);
	}
	
	function insertTipo($sin){
		
		if($this->db->field_exists('date_add', $this->_tablename))
		{
			$sin['date_add'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('date_upd', $this->_tablename))
		{
			$sin['date_upd'] = date('Y-m-d H:i:s'); 
		}
		$this->db->insert('sin_tipos_documentos', $sin);
	}
	
	function getDocumentosTipo($id){
		$sql = "SELECT 
					* 
				FROM 
					$this->_tablename
				INNER JOIN
					sin_tipos_documentos
				USING
					 ($this->_id_table)
				WHERE 
					$this->_id_table = '$id'";
					

		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return FALSE;
		}
	}
} 
?>