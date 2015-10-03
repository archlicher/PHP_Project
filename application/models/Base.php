<?php

namespace Models;

class Base {

	protected $table;
	protected $limit;
	protected $db;

	public function __construct($args = array()) {
		$default = array('limit' => 0);

		$args = array_merge($default, $args);

		if (!isset($args['table'])) {
			die('Table not found.');
		}

		extract($args);

		$this->table = $table;
		$this->limit = $limit;

		$this->db = new \Framework\DB\SimpleDB();
	}

	public function add($element) {
		$keys = array_keys($element);
		$values = array();
		foreach ($element as $key => $value) {
			$values[] = $value;
		}
		$keys = implode($keys, ', ');
		$numOfValues = count($values);
		$query = "INSERT INTO {$this->table} ($keys) VALUES (";
		for ($i=0; $i < $numOfValues; $i++) { 
			$query .= "?";
			if ($i!=$numOfValues-1) {
				$query .= ", ";
			}
		}
		$query .= ')';
		var_dump($query);
		$result = $this->db->prepare($query, $values)->execute()->getLastInsertId();

		return $result;
	}

	public function update($element) {
		if (!isset($element['id'])) die('Wrong model set.');

		$query = "UPDATE {$this->table} SET";
		$values = array();
		foreach ($element as $key => $value) {
			if ($key === 'id') continue;
			$values[] = $value;
			$query .= "$key = ? ,";
		}

		$query = rtrim($query, ',');

		$query .= "WHERE id = {$element['id']}";
		$result = $this->db->prepare($query, $values)->execute()->fetchAllNum();

		return $result;
	}

	public function get($id) {
		return $this->find(array('where' => 'id = '.$id ));
	}

	public function find($args = array()) {
		$defaults = array(
			'table' => $this->table,
			'limit' => $this->limit,
			'where' => '',
			'columns' => '*'
		);
		$args = array_merge($defaults, $args);

		extract($args);

		$query = "SELECT {$columns} FROM {$table}";

		if (!empty($where)) {
			$query .= " WHERE $where";
		}

		if (!empty($limit)) {
			$query .= " LIMIT $limit";
		}

		$result = $this->db->prepare($query)->execute()->fetchAllAssoc();

		return $result;
	}
}