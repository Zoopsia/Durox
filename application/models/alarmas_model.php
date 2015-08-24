<?php 
class Alarmas_model extends My_Model {
		
	protected $_tablename	= 'alarmas';
	protected $_id_table	= 'id_alarma';
	protected $_order		= 'alarma';
	protected $_subject		= 'alarma';
			
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
	
	function insertCruce($cruce, $id_alarma, $id_usuario){
		
		$tabla = 'sin_alarmas_'.$cruce;
		$arreglo['id_alarma']	= $id_alarma;
		
		if($cruce == 'clientes'){
			$arreglo['id_cliente']		= $id_usuario;
		}
		else if($cruce == 'pedidos'){
			$arreglo['id_pedido']		= $id_usuario;
		}
		else if($cruce == 'presupuestos'){
			$arreglo['id_presupuesto']	= $id_usuario;
		}
		else if($cruce == 'productos'){
			$arreglo['id_producto']		= $id_usuario;
		}
		else if($cruce == 'visitas'){
			$arreglo['id_visita']		= $id_usuario;
		}
		
		$session_data = $this->session->userdata('logged_in');
		
		if($this->db->field_exists('date_add', $tabla))
		{
			$arreglo['date_add'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('date_upd', $tabla))
		{
			$arreglo['date_upd'] = date('Y-m-d H:i:s'); 
		}
		
		if($this->db->field_exists('user_add', $tabla))
		{
			$arreglo['user_add'] = $session_data['id_usuario']; 
		}
		
		if($this->db->field_exists('user_upd', $tabla))
		{
			$arreglo['user_upd'] = $session_data['id_usuario']; 
		}
			
		$this->db->insert($tabla, $arreglo);
	}
		
} 
?>
