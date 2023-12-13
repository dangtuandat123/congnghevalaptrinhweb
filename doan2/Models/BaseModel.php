<?php
class BaseModel extends Database
{
    protected $connect;
    public function __construct()
    {
        $this->connect = $this->connect();
    }

    // lay ra tat ca du liieu trong bang
    public function selectAll($table)
    {

        $sql = "SELECT * FROM ${table}";
        $query = $this->_query($sql);
        
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        
        return $data;
    }

    public function selectByValue($table, $select="*", array $data = [], $more = "")
    {
        $values = "";
        foreach ($data as $key => $value) {
            $values = $key."="."'".$value."'"." AND ".$values;  
        }
        $values = substr($values, 0, -5);
        
        $sql = "SELECT ${select} FROM ${table} WHERE ${values} ${more}";
        $query = $this->_query($sql);
        $data = [];
        

        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }
    public function selectCustom($sql)
    {

        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }
    public function findById($id)
    {
        return __METHOD__;
    }
    // them du lieu vao bang
    public function insert($table, array $data = [])
    {
        $colum = "";
        $values = "";
        foreach ($data as $key => $value) {
            $colum = $key . "," . $colum;
            $values = "'".$value."'" . "," . $values;
        }
        $colum = substr($colum, 0, -1);
        $values = substr($values, 0, -1);
        $sql = "INSERT INTO ${table} (${colum}) VALUES (${values})";
        // echo $sql;
        // die();
        try {
            $query = $this->_query($sql);
        } catch (\Throwable $th) {
            return "khongthanhcong";
        }
        
        return "thanhcong";

    }
    // update du lieu
    public function update($table,array $data = [],array $where = [])
    {
        $colum = "";
        $values = "";
        foreach ($data as $key => $value) {

            $colum = "$key='$value'";
            $values = $values.",".$colum;
            
        }
        $values = substr($values, 1);
        $values_2 = "";
        foreach ($where as $key => $value) {
            $values_2 = $key."="."'".$value."'"." AND ".$values_2;  
        }
        $values_2 = substr($values_2, 0, -5);
        
        $sql ="UPDATE $table SET $values WHERE $values_2";
    
        try {
            $this->_query($sql);

        } catch (\Throwable $th) {
            return "khongthanhcong";
        }
        
    }
    public function updateCustom($sql)
    {
       
        try {
            $this->_query($sql);

        } catch (\Throwable $th) {
            return "khongthanhcong";
        }
        
    }


    // xoa du lieu 
    public function delete($table,array $where = [])
    {
       
        $values_2 = "";
        foreach ($where as $key => $value) {
            $values_2 = $key."="."'".$value."'"." AND ".$values_2;  
        }
        $values_2 = substr($values_2, 0, -5);
        
        $sql ="DELETE FROM  $table WHERE $values_2";
    
        try {
            $this->_query($sql);
            return "thanhcong";

        } catch (\Throwable $th) {
            return "khongthanhcong";
        }
    }
    private function _query($sql)
    {
       
        return mysqli_query($this->connect, $sql);
       
    }
}
