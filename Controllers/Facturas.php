<?php

namespace Controllers;

use Config\Autoload;
use Entity\Tables;

class Facturas extends Autoload
{
	/* Lista de Facturas */
	public function list($params)
	{
		// GET: ./tienda/facturas/list
		$Facturas = new Tables('Facturas');
		$this->render($Facturas->read($params));
	}

	public function row($params)
	{
		// GET: ./tienda/facturas/row?idFactura=<<idFactura>>
		$Facturas = new Tables('Facturas');
		$this->render($Facturas->read($params, true));
	}

	/* Agregar Factura */
	public function add($params)
	{
		// GET: ./tienda/facturas/add?idVendedor=<<idVendedor>>&valorTotal=<<valorTotal>>
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
	public function update($params)
	{
		// GET: ./tienda/facturas/update?idFactura=<<idFactura>>&idVendedor=<<idVendedor>>&valorTotal=<<valorTotal>>
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
	public function delete($params)
	{
		// GET: ./tienda/facturas/delete?idFactura=<<idFactura>>
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
