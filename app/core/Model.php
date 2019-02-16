<?php 

class Model 
{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $charset;

	private $db;

	function __construct()
	{
		$this->servername = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "baza";
		$this->charset = "utf8mb4";

		try {
			$dsn = "mysql:host=".$this->servername.";dbname=" . $this->dbname . ";charset=". $this->charset;
			$pdo = new PDO($dsn, $this->username, $this->password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$this->db = $pdo;
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}

	public function select($sql, array $params = [])
	{
		if(empty($params)) {
			$stmt = $this->db->query($sql);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$stmt = $this->db->prepare($sql);
			$stmt->execute($params);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		}

		return $result;
	}

	public function insert($sql, array $params)
	{
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
		return $this->db->lastInsertId();
	}

	public function update($sql, array $params)
	{
		$stmt = $this->db->prepare($sql);
		$result = $stmt->execute($params);
		return $result;
	}

	public function delete($sql, array $params) 
	{
		$stmt = $this->db->prepare($sql);
		$result = $stmt->execute($params);
		return $result;
	}

	public function insertConnect($sql, array $params)
	{
		$stmt = $this->db->prepare($sql);
		$result = $stmt->execute($params);
		return $result;
	}

}