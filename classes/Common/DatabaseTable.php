<?php
namespace Common;

use Exception;

class DatabaseTable {
	private $pdo;
	private $table;
	private $primaryKey;
	private $className;
	private $constructorArgs;

	public function __construct(\PDO $pdo, string $table, string $primaryKey, string $className = '\stdClass', array $constructorArgs = []) {
		$this->pdo = $pdo;
		$this->table = $table;
		$this->primaryKey = $primaryKey;
		$this->className = $className;
		$this->constructorArgs = $constructorArgs;
	}

	public function getDatabase(){
		return $this->pdo;
	}

	private function query($sql, $parameters = []) {
		try{
			$query = $this->pdo->prepare($sql);
			//echo $sql."</br>";print_r($parameters);
			$query->execute($parameters);
			return $query;
		}catch(Exception $e){
			echo "</br>".$e->getMessage()."</br>In ".$e->getFile()."</br>";
		}
	}	

	public function total($field = null, $value = null) {
		$sql = 'SELECT COUNT(*) FROM `' . $this->table . '`';
		$parameters = [];

		if (!empty($field)) {
			$sql .= ' WHERE `' . $field . '` = :value';
			$parameters = ['value' => $value];
		}
		
		$query = $this->query($sql, $parameters);
		$row = $query->fetch();
		return $row[0];
	}

	public function findById($value) {
		$query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';

		$parameters = [
			'value' => $value
		];

		$query = $this->query($query, $parameters);

		return $query->fetchObject($this->className, $this->constructorArgs);
	}

	public function findByThreeColumn($column1,$value1,$column2,$value2,$column3,$value3,$orderBy=null,$limit=null,$offset=null){
		$query= 'SELECT * FROM ' . $this->table . ' WHERE ' . $column1 . ' = :value1 AND '. 
		$column2. ' = :value2 AND '.$column3.' = :value3';
		$parameters = [
			'value1'=> $value1,
			'value2'=> $value2,
			'value3'=> $value3
		];

		if ($orderBy != null) {
			$query .= ' ORDER BY ' . $orderBy;
		}

		if ($limit != null) {
			$query .= ' LIMIT ' . $limit;
		}

		if ($offset != null) {
			$query .= ' OFFSET ' . $offset;
		}
		$query = $this->query($query, $parameters);

		return $query->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
	}

	public function findByTwoColumn($column1,$value1,$column2,$value2,$orderBy = null, $limit = null, $offset = null){
		$query=	'SELECT * FROM ' . $this->table . ' WHERE ' . $column1 . ' = :value1 AND '. 
				$column2. ' = :value2';
		
		$parameters = [
			'value1'=> $value1,
			'value2'=> $value2
		];

		if ($orderBy != null) {
			$query .= ' ORDER BY ' . $orderBy;
		}

		if ($limit != null) {
			$query .= ' LIMIT ' . $limit;
		}

		if ($offset != null) {
			$query .= ' OFFSET ' . $offset;
		}
		$query = $this->query($query, $parameters);

		return $query->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
	}
	public function find($column, $value, $orderBy = null, $limit = null, $offset = null) {
		$query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = :value';

		$parameters = [
			'value' => $value
		];

		if ($orderBy != null) {
			$query .= ' ORDER BY ' . $orderBy;
		}

		if ($limit != null) {
			$query .= ' LIMIT ' . $limit;
		}

		if ($offset != null) {
			$query .= ' OFFSET ' . $offset;
		}

		$query = $this->query($query, $parameters);

		return $query->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
	}

	private function insert($fields) {
		$query = 'INSERT INTO `' . $this->table . '` (';

		foreach ($fields as $key => $value) {
			$query .= '`' . $key . '`,';
		}

		$query = rtrim($query, ',');

		$query .= ') VALUES (';


		foreach ($fields as $key => $value) {
			$query .= ':' . $key . ',';
		}

		$query = rtrim($query, ',');

		$query .= ')';

		$fields = $this->processDates($fields);

		$this->query($query, $fields);

		return $this->pdo->lastInsertId();
	}


	private function update($fields) {
		$query = ' UPDATE `' . $this->table .'` SET ';

		foreach ($fields as $key => $value) {
			$query .= '`' . $key . '` = :' . $key . ',';
		}

		$query = rtrim($query, ',');

		$query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';

		//Set the :primaryKey variable
		$fields['primaryKey'] = $fields[$this->primaryKey];

		$fields = $this->processDates($fields);

		$this->query($query, $fields);
	}


	public function delete($id) {
		$parameters = [':id' => $id];

		$this->query('DELETE FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :id', $parameters);
	}

	public function deleteWhere($column, $value) {
		$query = 'DELETE FROM ' . $this->table . ' WHERE ' . $column . ' = :value';

		$parameters = [
			'value' => $value
		];

		$query = $this->query($query, $parameters);
	}

	public function findRoomSchedule($roomNo,$day,$tableName){
		$parameters=['roomNo'=>$roomNo,'day'=>$day];

		$query='SELECT `period` FROM '.$tableName.' WHERE `roomNo`=:roomNo AND `day`=:day';
		$result=$this->query($query,$parameters);
		return $result->fetchAll();
	}

	public function findAll($orderBy = null, $limit = null, $offset = null) {
		$query = 'SELECT * FROM ' . $this->table;

		if ($orderBy != null) {
			$query .= ' ORDER BY ' . $orderBy;
		}

		if ($limit != null) {
			$query .= ' LIMIT ' . $limit;
		}

		if ($offset != null) {
			$query .= ' OFFSET ' . $offset;
		}

		$result = $this->query($query);

		return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
	}

	public function findOccupiedRooms($day,$period,$orderBy=null,$limit=null,$offset=null){
		$query=	'SELECT roomNo FROM ' . $this->table . ' WHERE day = :day AND period = :period';
		
		$parameters = [
			'day'=> $day,
			'period'=> $period
		];

		if ($orderBy != null) {
			$query .= ' ORDER BY ' . $orderBy;
		}

		if ($limit != null) {
			$query .= ' LIMIT ' . $limit;
		}

		if ($offset != null) {
			$query .= ' OFFSET ' . $offset;
		}
		$query = $this->query($query, $parameters);
		$result=$query->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

	private function processDates($fields) {
		foreach ($fields as $key => $value) {
			if ($value instanceof \DateTime) {
				$fields[$key] = $value->format('Y-m-d');
			}
		}

		return $fields;
	}


	public function save($record) {
		$entity = new $this->className(...$this->constructorArgs);
		
		try {	
			if ($record[$this->primaryKey] == '') {
				$record[$this->primaryKey] = null;
			}
			$insertId = $this->insert($record);
			$entity->{$this->primaryKey} = $insertId;
		}
		catch (\PDOException $e) {
			echo $e;
			$this->update($record);
		}

		foreach ($record as $key => $value) {
			if (!empty($value)) {
				$entity->$key = $value;	
			}			
		}

		return $entity;	
	}
}