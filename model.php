<?php



class Model
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "dknights";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        } catch (\Throwable $th) {
         
            echo "Connection error " . $th->getMessage();
        }
    }

   




    public function fetch_tpn()
    {
        $data = [];

        $query = "SELECT s.tid,t.topic_name,t.year FROM score_table s INNER JOIN topic_table t ON s.tid = t.tid GROUP BY s.tid ORDER BY  s.tid";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }




   
    public function fetch()
    {
  
        $data = [];

        $query = "SELECT month,year,status FROM score_table WHERE sid=0";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

  

  
public function fetch_filter($tpn)
    {
      
        $data = [];

        $query = "SELECT year,month,COUNT(CASE WHEN status = 'Fail' THEN 1 END) / COUNT(sid) * 100 AS 'FAIL',
        COUNT(CASE WHEN STATUS = 'Pass' THEN 1 END) / COUNT(sid) * 100 AS 'PASS',  COUNT(sid) AS 'scount', COUNT(CASE WHEN status = 'Fail' THEN 1 END) AS bagsak,COUNT(CASE WHEN STATUS = 'Pass' THEN 1 END) As pasado  FROM score_table  WHERE tid = '$tpn' GROUP BY month,year ORDER BY FIELD(MONTH,'January','February','March','April','May','June','July','August','September','October','November','December')";

        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

   

  
}