<?php

namespace Controllers;

use Config\Autoload;
use Entity\Tables;

/**
 * @start "Homepage"
 */
class Productos extends Autoload
{

	/* Lista de Productos */
	public function index()
	{
		// GET: ./tienda/productos/list
		$controller = 'productos';
		include_once('Layout/template.php');
	}
	/* Lista de Productos */
	public function list($params)
	{
		// GET: ./tienda/productos/list
		$Productos = new Tables('Productos');
		$this->render($Productos->read($params));
	}

	public function row($params)
	{
		// GET: ./tienda/productos/row?idProducto=<<idProducto>>
		$Productos = new Tables('Productos');
		$this->render($Productos->read($params, true));
	}

	/* Agregar Producto */
	public function add($params)
	{
		// GET: ./tienda/productos/add?nombre=<<nombre>>&precio=<<precio>>&idCategoria=<<idCategoria>>
		$Productos = new Tables('Productos');
		$id = $Productos->create($params);
		$alert = array(
			'id' => $id,
			'type' => ($id) ? 'success' : 'warning',
			'msg' => ($id) ? 'El Producto fue registrado con éxito. Codigo de registro: ' . md5($id)
				: 'El Producto no pudo ser registrado'
		);

		$this->render(array('alert' => $alert));
	}

	/* Actualizar un Producto */
	public function update($params)
	{
		// GET: ./tienda/productos/update?idProducto=<<idProducto>>&nombre=<<nombre>>&precio=<<precio>>&idCategoria=<<idCategoria>>
		extract($params);
		$Productos = new Tables('Productos');
		$row = $Productos->read(array('idProducto' => $idProducto), true, 'idProducto');
		$update = ($row) ? $Productos->update($params, array('idProducto' => $idProducto)) : false;

		$alert = array(
			'type' => ($update) ? 'success' : 'warning',
			'msg' => ($update) ? 'El Producto fue actualizado con éxito. Codigo de registro: ' . md5($idProducto)
				: 'El Producto no pudo ser actualizado.'
		);

		$this->render(array('alert' => $alert));
	}

	/* Eliminar un Producto */
	public function delete($params)
	{
		// GET: ./tienda/productos/delete?idProducto=<<idProducto>>
		$Productos = new Tables('Productos');
		$row = $Productos->read($params, true, 'idProducto');
		$delete = ($row) ? $Productos->delete($params) : false;

		$alert = array(
			'type' => ($delete) ? 'success' : 'warning',
			'msg' => ($delete) ? 'El Producto fue borrado con éxito. Codigo de registro: ' . md5($row['idProducto'])
				: 'El Producto no pudo ser borrado.'
		);

		$this->render(array('alert' => $alert));
	}
}
