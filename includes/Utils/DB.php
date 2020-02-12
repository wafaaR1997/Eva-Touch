<?php



class DB
{
    
    private $connection;
	public $last_query;

    public function __construct($host, $user, $pass, $db_name)
    {
		 
		$this->connection = new mysqli($host, $user, $pass, $db_name);
		
        // $connection = mysqli_connect($host, $user, $pass, $db_name) or die("Cannot connect to database");
         //$connection->set_charset("utf8");

    }

    public function query($sql)
    {
		 
        $this->last_query = $sql;
        
		
		$this->connection->query($sql);
	
    }

    /**
     * Get Fields as array of objects
     *
     * @param $sql
     * @return array
     */
    public function getRows($sql)
    {
 
        //$result = $this->query($sql);
       // $result = $this->query($sql);
		 
  

// Create connection
 
 //$connection = new mysqli($servername, $username, $password, $dbname);
 
  // Check connection
 
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
 
//$sql = "CALL getSubCategories()";
$result = $this->connection->query($sql);
 
  $out = [];
        if ($result)
            for ($i = 0; $i < $result->num_rows; $i++) {
				 
                $out[] = (object)$result->fetch_assoc();
            }
        return $out; 
		 
		 
		 
		 /*
 
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
		
        echo "id111111111111: " . $row["id"]. " - Name: " . $row["name"]  . ' -  mainCat' . $row['main_category_id']  . '<br>';
    } 	
} else {
    echo "0 results";
}*/
$this->connection->close();
 

		
	
    }

    /**
     * get one row from db
     * @param $sql
     * @return bool|object
     */
    public function getRow($sql)
    {
		
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

        $result =$this->connection->query($sql);
		 
 
 /*$out = [];
        if ($result)
            for ($i = 0; $i < $result->num_rows; $i++) {
				 
                 $out[] = (object)$result->fetch_assoc();
            }
			
			 
        return $out; 
		*/
        if (is_object($result))
			 
            return $result->num_rows > 0 ? (object)$result->fetch_assoc() : false;
        //return false;
    }
 
    public function escape($str)
    {
		die ($str) ;
        return $this->$str;
    }
 
    public function insert($table, array $data)
    {
		
		
        $sql = "INSERT INTO $table ";

        $cols = array_keys($data);

		
        $sql .= "(" . implode(',', $cols) . ") VALUES ";
		
		 
        $sql .= $this->prepareInsertValues($data);

 
      $result   = $this->connection->query($sql);
		
        $insert_id = $this->connection->insert_id;
		
		 
        return $result ? $insert_id ? $insert_id : true : false;

    }

    public function insert_multi($table, $cols_array, $data_array)
    {
        $sql = "INSERT INTO $table ";
        $sql .= "(" . implode(',', $cols_array) . ") VALUES ";
        $values = [];
        foreach ($data_array as $row) {
            $values[] = $this->prepareInsertValues($row);
        }
        $sql .= join(",", $values);
        return $this->query($sql);
    }

    public function prepareInsertValues($data) {
        // phone number workaround
        if (isset($data['phone'])) $data['phone'] .= " ";


        $vals = array_values($data);
        $sql = "(";
        $i = 0;
		
		 
        foreach ($vals as $val) {
			
            $sql .= $this->check($val); /* super :P */
            $sql .= $i++ < count($vals) - 1 ? "," : "";
  
		}
        $sql .= ")";
 
        return $sql;
    }



    public function update($table, array $data, $where)
    {
        $sql = "UPDATE $table SET ";

        // phone number workaround
        if (isset($data['phone'])) $data['phone'] .= " ";

        $set = [];
        foreach ($data as $col => $val) {
            $set[] = "$col = " . $this->check($val);
        }
        $sql .= implode(' , ', $set);
        $sql .= " WHERE $where";
        return $this->query($sql);
    }



    public function last_error()
    {
        return "QUERY: " . $this->last_query . "\nERROR MESSAGE:" . $this->connection->error;
    }

    public function check($val)
    {
 
   	//return (is_string($val) ?  '"' . $val . '"' : $this->escape($val));
 return (is_string($val) ?  '"' . $val . '"' :  $val );
		  
	
    }

    public function insert_id()
    {
        return $this->connection->insert_id;
    }

}