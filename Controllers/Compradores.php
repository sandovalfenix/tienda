<?php

namespace Controllers;

use Config\Autoload;
use Entity\Tables;

class Compradores extends Autoload
{
	/* Lista de Compradores */
	public function list($params)
	{
		// GET: ./tienda/compradores/list
		$Compradores = new Tables('Compradores');
		$this->render($Compradores->read($params));
	}

	public function row($params)
	{
		// GET: ./tienda/compradores/row?idComprador=<<idComprador>>
		$Compradores = new Tables('Compradores');
		$this->render($Compradores->read($params, true));
	}

	/* Agregar Comprador */
	public function add($params)
	{
		// GET: ./tienda/compradores/add?cedula=<<cedula>>&nombre=<<nombre>>&apellido=<<apellido>>&telefono=<<telefono>>
		$Compradores = new Tables('Compradores');
		$id = $Compradores->create($params);
		$alert = array(
			'id' => $id,
			'type' => ($id) ? 'success' : 'warning',
			'msg' => ($id) ? 'El Comprador fue registrado con éxito. Codigo de registro: ' . md5($id)
				: 'El Comprador no pudo ser registrado'
		);

		$this->render(array('alert' => $alert));
	}

	/* Actualizar un Comprador */
	public function update($params)
	{
		// GET: ./tienda/compradores/update?idComprador=<<idComprador>>&cedula=<<cedula>>&nombre=<<nombre>>&apellido=<<apellido>>&telefono=<<telefono>>
		extract($params);
		$Compradores = new Tables('Compradores');
		$row = $Compradores->read(array('idComprador' => $idComprador), true, 'idComprador');
		$update = ($row) ? $Compradores->update($params, array('idComprador' => $idComprador)) : false;

		$alert = array(
			'type' => ($update) ? 'success' : 'warning',
			'msg' => ($update) ? 'El Comprador fue actualizado con éxito. Codigo de registro: ' . md5($idComprador)
				: 'El Comprador no pudo ser actualizado.'
		);

		$this->render(array('alert' => $alert));
	}

	/* Eliminar un Comprador */
	public function delete($params)
	{
		// GET: ./tienda/compradores/delete?idComprador=<<idComprador>>
		$Compradores = new Tables('Compradores');
		$row = $Compradores->read($params, true, 'idComprador');
		$delete = ($row) ? $Compradores->delete($params) : false;

		$alert = array(
			'type' => ($delete) ? 'success' : 'warning',
			'msg' => ($delete) ? 'El Comprador fue borrado con éxito. Codigo de registro: ' . md5($row['idComprador'])
				: 'El Comprador no pudo ser borrado.'
		);

		$this->render(array('alert' => $alert));
	}

	/* Lista Prodcutos en Carrito */
	public function listCarrito($params)
	{
		// GET: ./tienda/compradores/list?idComprador=<<idComprador>>
		$Carritos = new Tables('Carritos');
		$this->render($Carritos->read($params));
	}

	/* Agregar Prodcuto a Carrito */
	public function addCarrito($params)
	{
		// GET: ./tienda/compradores/addCarrito?idComprador=<<idComprador>>&idProducto=<<idProducto>>&cantidad=<<cantidad>>
		$Carritos = new Tables('Carritos');
		$id = $Carritos->create($params);
		$alert = array(
			'id' => $id,
			'type' => ($id) ? 'success' : 'warning',
			'msg' => ($id) ? 'El Carrito fue registrado con éxito. Codigo de registro: ' . md5($id)
				: 'El Carrito no pudo ser registrado'
		);

		$this->render(array('alert' => $alert));
	}

	/* Actualizar un Producto en Carrito */
	public function updateCarrito($params)
	{
		// GET: ./tienda/compradores/updateCarrito?idCarrito=<<idCarrito>>&idProducto=<<idProducto>>&cantidad=<<cantidad>>
		extract($params);
		$Carritos = new Tables('Carritos');
		$row = $Carritos->read(array('idCarrito' => $idCarrito), true, 'idCarrito');
		$update = ($row) ? $Carritos->update($params, array('idCarrito' => $idCarrito)) : false;

		$alert = array(
			'type' => ($update) ? 'success' : 'warning',
			'msg' => ($update) ? 'El Carrito fue actualizado con éxito. Codigo de registro: ' . md5($idCarrito)
				: 'El Carrito no pudo ser actualizado.'
		);

		$this->render(array('alert' => $alert));
	}

	/* Eliminar un Prodcuto en Carrito */
	public function deleteCarrito($params)
	{
		// GET: ./tienda/compradores/deleteCarrito?idCarrito=<<idCarrito>>
		$Carritos = new Tables('Carritos');
		$row = $Carritos->read($params, true, 'idCarrito');
		$delete = ($row) ? $Carritos->delete($params) : false;

		$alert = array(
			'type' => ($delete) ? 'success' : 'warning',
			'msg' => ($delete) ? 'El Carrito fue borrado con éxito. Codigo de registro: ' . md5($row['idCarrito'])
				: 'El Carrito no pudo ser borrado.'
		);

		$this->render(array('alert' => $alert));
	}

	/* Lista Factura de Comprador */
	public function listFactura($params)
	{
		// GET: ./tienda/compradores/listFactura?idComprador=<<idComprador>>
		$Facturas = new Tables('Facturas');
		$this->render($Facturas->read($params));
	}
}
