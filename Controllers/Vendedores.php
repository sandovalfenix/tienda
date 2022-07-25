<?php

namespace Controllers;

use Config\Autoload;
use Entity\Tables;

class Vendedores extends Autoload
{
	/* Lista de Vendedores */
	public function list($params)
	{
		// GET: ./tienda/vendedores/list
		$Vendedores = new Tables('Vendedores');
		$this->render($Vendedores->read($params));
	}

	public function row($params)
	{
		// GET: ./tienda/vendedores/row?idVendedor=<<idVendedor>>
		$Vendedores = new Tables('Vendedores');
		$this->render($Vendedores->read($params, true));
	}

	/* Agregar Vendedor */
	public function add($params)
	{
		// GET: ./tienda/vendedores/add?cedula=<<cedula>>&nombre=<<nombre>>&apellido=<<apellido>>&telefono=<<telefono>>
		$Vendedores = new Tables('Vendedores');
		$id = $Vendedores->create($params);
		$alert = array(
			'id' => $id,
			'type' => ($id) ? 'success' : 'warning',
			'msg' => ($id) ? 'El Vendedor fue registrado con éxito. Codigo de registro: ' . md5($id)
				: 'El Vendedor no pudo ser registrado'
		);

		$this->render(array('alert' => $alert));
	}

	/* Actualizar un Vendedor */
	public function update($params)
	{
		// GET: ./tienda/vendedores/update?idVendedor=<<idVendedor>>&cedula=<<cedula>>&nombre=<<nombre>>&apellido=<<apellido>>&telefono=<<telefono>>
		extract($params);
		$Vendedores = new Tables('Vendedores');
		$row = $Vendedores->read(array('idVendedor' => $idVendedor), true, 'idVendedor');
		$update = ($row) ? $Vendedores->update($params, array('idVendedor' => $idVendedor)) : false;

		$alert = array(
			'type' => ($update) ? 'success' : 'warning',
			'msg' => ($update) ? 'El Vendedor fue actualizado con éxito. Codigo de registro: ' . md5($idVendedor)
				: 'El Vendedor no pudo ser actualizado.'
		);

		$this->render(array('alert' => $alert));
	}

	/* Eliminar un Vendedor */
	public function delete($params)
	{
		// GET: ./tienda/vendedores/delete?idVendedor=<<idVendedor>>
		$Vendedores = new Tables('Vendedores');
		$row = $Vendedores->read($params, true, 'idVendedor');
		$delete = ($row) ? $Vendedores->delete($params) : false;

		$alert = array(
			'type' => ($delete) ? 'success' : 'warning',
			'msg' => ($delete) ? 'El Vendedor fue borrado con éxito. Codigo de registro: ' . md5($row['idVendedor'])
				: 'El Vendedor no pudo ser borrado.'
		);

		$this->render(array('alert' => $alert));
	}
}
