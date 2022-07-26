<?php

namespace Controllers;

use Config\Autoload;
use Entity\Tables;

class Ventas extends Autoload
{

	/* Lista de Productos */
	public function index()
	{
		// GET: ./tienda/ventas/list
		$controller = 'ventas';
		include_once('Layout/template.php');
	}

	/* Lista de Ventas */
	public function list($params)
	{
		// GET: ./tienda/Ventas/list
		$Ventas = new Tables('Ventas');
		$array = array_map(function ($venta) {
			$facturas = new Tables('Facturas');
			$productos = new Tables('Productos');
			return array(
				'idVenta' => $venta['idVenta'],
				'Factura' => $facturas->read(array('idFactura' => $venta['idFactura']), true),
				'Producto' => $productos->read(array('idProducto' => $venta['idProducto']), true),
				'cantidad' => $venta['cantidad']
			);
		}, $Ventas->read($params));
		$this->render($array);
	}

	public function row($params)
	{
		// GET: ./tienda/Ventas/row?idVenta=<<idVenta>>
		$Ventas = new Tables('Ventas');
		$this->render($Ventas->read($params, true));
	}

	/* Agregar Venta */
	public function add($params)
	{
		// GET: ./tienda/Ventas/add?idProdcuto=<<idProdcuto>>&cantidad=<<cantidad>>&idFactura=<<idFactura>>
		$Ventas = new Tables('Ventas');
		$id = $Ventas->create($params);
		$alert = array(
			'id' => $id,
			'type' => ($id) ? 'success' : 'warning',
			'msg' => ($id) ? 'El Venta fue registrado con éxito. Codigo de registro: ' . md5($id)
				: 'El Venta no pudo ser registrado'
		);

		$this->render(array('alert' => $alert));
	}

	/* Actualizar un Venta */
	public function update($params)
	{
		// GET: ./tienda/Ventas/update?idVenta=<<idVenta>>&idProdcuto=<<idProdcuto>>&cantidad=<<cantidad>>&idFactura=<<idFactura>>
		extract($params);
		$Ventas = new Tables('Ventas');
		$row = $Ventas->read(array('idVenta' => $idVenta), true, 'idVenta');
		$update = ($row) ? $Ventas->update($params, array('idVenta' => $idVenta)) : false;

		$alert = array(
			'type' => ($update) ? 'success' : 'warning',
			'msg' => ($update) ? 'El Venta fue actualizado con éxito. Codigo de registro: ' . md5($idVenta)
				: 'El Venta no pudo ser actualizado.'
		);

		$this->render(array('alert' => $alert));
	}

	/* Eliminar un Venta */
	public function delete($params)
	{
		// GET: ./tienda/Ventas/delete?idVenta=<<idVenta>>
		$Ventas = new Tables('Ventas');
		$row = $Ventas->read($params, true, 'idVenta');
		$delete = ($row) ? $Ventas->delete($params) : false;

		$alert = array(
			'type' => ($delete) ? 'success' : 'warning',
			'msg' => ($delete) ? 'El Venta fue borrado con éxito. Codigo de registro: ' . md5($row['idVenta'])
				: 'El Venta no pudo ser borrado.'
		);

		$this->render(array('alert' => $alert));
	}
}
