<?php

namespace Controllers;

use Config\Autoload;
use Entity\Tables;

class Ventas extends Autoload
{

	/* Lista de Ventas */
	public function list($params)
	{
		// GET: ./tienda/Ventas/list
		$Ventas = new Tables('Ventas');
		$this->render($Ventas->read($params));
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

	/* Agregar Factura */
	public function addFactura($params)
	{
		// GET: ./tienda/Ventas/addFactura?idComprador=<<idComprador>>&idCupon=<<idCupon>>&fecha=<<fecha>>&valorTotal=<<valorTotal>>
		$Facturas = new Tables('Facturas');
		$id = $Facturas->create($params);
		$alert = array(
			'id' => $id,
			'type' => ($id) ? 'success' : 'warning',
			'msg' => ($id) ? 'El Factura fue registrado con éxito. Codigo de registro: ' . md5($id)
				: 'El Factura no pudo ser registrado'
		);

		$this->render(array('alert' => $alert));
	}

	/* Actualizar un Factura */
	public function updateFactura($params)
	{
		// GET: ./tienda/Ventas/updateFactura?idFactura=<<idFactura>>&idComprador=<<idComprador>>&idCupon=<<idCupon>>&fecha=<<fecha>>&valorTotal=<<valorTotal>>
		extract($params);
		$Facturas = new Tables('Facturas');
		$row = $Facturas->read(array('idFactura' => $idFactura), true, 'idFactura');
		$update = ($row) ? $Facturas->update($params, array('idFactura' => $idFactura)) : false;

		$alert = array(
			'type' => ($update) ? 'success' : 'warning',
			'msg' => ($update) ? 'El Factura fue actualizado con éxito. Codigo de registro: ' . md5($idFactura)
				: 'El Factura no pudo ser actualizado.'
		);

		$this->render(array('alert' => $alert));
	}

	/* Eliminar un Factura */
	public function deleteFactura($params)
	{
		// GET: ./tienda/Ventas/deleteFactura?idFactura=<<idFactura>>
		$Facturas = new Tables('Facturas');
		$row = $Facturas->read($params, true, 'idFactura');
		$delete = ($row) ? $Facturas->delete($params) : false;

		$alert = array(
			'type' => ($delete) ? 'success' : 'warning',
			'msg' => ($delete) ? 'El Factura fue borrado con éxito. Codigo de registro: ' . md5($row['idFactura'])
				: 'El Factura no pudo ser borrado.'
		);

		$this->render(array('alert' => $alert));
	}
}
