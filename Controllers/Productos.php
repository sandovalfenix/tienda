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

	/* Agregar Categoria */
	public function addCategoria($params)
	{
		// GET: ./tienda/productos/addCategoria?nombre=<<nombre>>
		$Categorias = new Tables('Categorias');
		$id = $Categorias->create($params);
		$alert = array(
			'id' => $id,
			'type' => ($id) ? 'success' : 'warning',
			'msg' => ($id) ? 'El Categoria fue registrado con éxito. Codigo de registro: ' . md5($id)
				: 'El Categoria no pudo ser registrado'
		);

		$this->render(array('alert' => $alert));
	}

	/* Actualizar un Categoria */
	public function updateCategoria($params)
	{
		// GET: ./tienda/productos/updateCategoria?idCategoria=<<idCategoria>>&nombre=<<nombre>>
		extract($params);
		$Categorias = new Tables('Categorias');
		$row = $Categorias->read(array('idCategoria' => $idCategoria), true, 'idCategoria');
		$update = ($row) ? $Categorias->update($params, array('idCategoria' => $idCategoria)) : false;

		$alert = array(
			'type' => ($update) ? 'success' : 'warning',
			'msg' => ($update) ? 'El Categoria fue actualizado con éxito. Codigo de registro: ' . md5($idCategoria)
				: 'El Categoria no pudo ser actualizado.'
		);

		$this->render(array('alert' => $alert));
	}

	/* Eliminar un Categoria */
	public function deleteCategoria($params)
	{
		// GET: ./tienda/productos/deleteCategoria?idCategoria=<<idCategoria>>
		$Categorias = new Tables('Categorias');
		$row = $Categorias->read($params, true, 'idCategoria');
		$delete = ($row) ? $Categorias->delete($params) : false;

		$alert = array(
			'type' => ($delete) ? 'success' : 'warning',
			'msg' => ($delete) ? 'El Categoria fue borrado con éxito. Codigo de registro: ' . md5($row['idCategoria'])
				: 'El Categoria no pudo ser borrado.'
		);

		$this->render(array('alert' => $alert));
	}
}
