<?php 
class DBController{

	private $host = "localhost";

	private $user = "root";

	private $password = "";

	private $database = "proiect";

	private static $conn;

	function __construct(){
		$this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
		//conectarea la baza de date o pastram in variabila curenta conn (referita prin $this->conn)
	}


	public static function getConnection(){
		if(empty($this->conn)){
			new Database();
			//daca nu gaseste o conexiune, creeaza o noua baza de date
		}
	}

	function getDBResult($query, $params = array()){
		$sql_statement = $this->conn->prepare($query);
		//prepararea bazei de date pentru executia statement-ului stocat in $query => la sql_statement se va aplica doar execute

		if(!empty($params)){
			$this->bindParams($sql_statement, $params);
		}

		$sql_statement->execute();
		$result = $sql_statement->get_result();
		if($result->num_rows > 0){
			//daca numarul de randuri din result este mai mare decat 0, adica daca executia statement-ului a generat cel putin un rand
			while($row = $result->fetch_assoc()){
			//cat timp exista randuri care pot fi preluate ca o matrice asociativa (array), le stocam in array-ul resultset
				$resultset[] = $row;
			}
		}

		if(!empty($resultset)){
			//daca am avut cel putin un rand generat dupa executie, il returnam
			return $resultset;
		}
	}



	function updateDB($query, $params = array()){
		$sql_statement = $this->conn->prepare($query);

		if(!empty($params)){
			//$params -> array definit individual pentru fiecare funtie din shoppingCart
			$this->bindParams($sql_statement, $params);
		}

		$sql_statement->execute();
		return true;
	}




	function bindParams($sql_statement, $params){
		$param_type = "";
		foreach ($params as  $query_param) {
			$param_type .= $query_param["param_type"];
			//$a .= $b  shortcut for:  $a = $a. '$b';  pe scurt, prescurtare pentru concatenare
			//tradus: $param_type = $param_type. " $query_param['param_type'] "; 
		}

		$bind_params[] =& $param_type;//$bind_params[] este o referinta a lui $param_type, deci daca se modifica param_type, implicit bin_param[] va lua aceeasi valoare

		foreach ($params as $k=>$query_params) {
			$bind_params[] =& $params[$k]["param_value"];
		}

		call_user_func_array(array($sql_statement, 'bind_param'), $bind_params);
	}
}

 ?>