<?php

namespace Entity;

use Entity\Connect;

class Tables extends Connect
{
	private $Table = '';

	public function __construct($table)
	{
		parent::__construct();
		$this->Table = $table;
	}

	private function data_complemet($data, $type = "WHERE", $condition = "=")
	{
		$complement = " " . $type . " ";
		$i = 0;
		foreach ($data as $name => $value) {
			$complement .=  (($i == 0) ? "" : (($type == "WHERE") ? " AND " : ", ")) . $name . " " . $condition . " :" . $name;
			$i++;
		}
		return $complement;
	}

	//metodos para CRUD database
	public function create($data)
	{
		$Query = $this->prepare("INSERT INTO " . $this->Table . $this->data_complemet($data, "SET"));

		$Query->execute($data);

		return $this->lastInsertId();
	}

	public function read($data = array(), $row = false, $col = '*')
	{
		$query = "SELECT " . $col . " FROM " . $this->Table . ((sizeof($data) > 0) ? $this->data_complemet($data) : "");

		$Query = $this->prepare($query);

		$Query->execute($data);

		return ($row) ? $Query->fetch($this::FETCH_ASSOC) : $Query->fetchAll($this::FETCH_ASSOC);;
	}

	public function update($data, $where)
	{
		$Query = $this->prepare("UPDATE " . $this->Table . $this->data_complemet($data, "SET") .  $this->data_complemet($where));

		return $Query->execute($data);
	}

	public function delete($where)
	{
		$Query = $this->prepare("DELETE FROM " . $this->Table .  $this->data_complemet($where));

		return $Query->execute($where);
	}
}
