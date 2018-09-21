<?php 
include('config/db_connect.php');

/**
 * CoreModel Class
 *
 * @package
 * @subpackage
 * @category
 * @DateOfCreation      5 July 2018
 * @DateOfDeprecated
 * @ShortDescription    This class contains all necessary function for database CRUD operation
 * @LongDescription
 */
class CoreModel
{
    public function __construct()
    {
        $obj1 = new DataBaseConnection;
        $this->conn = $obj1->getConnection();
    }
    /**
     * @DateOfCreation      5 July 2018
     * @DateOfDeprecated   
     * @ShortDescription    this function insert data in database          
     * @LongDescription     
     * @param  [string] $table_name [Name of table ]
     * @param  array  $array        [key,value pair of columns and value to insert data]
     * @return [boolean]            [true if inserted]
     */
    public function insert($table_name, $insert_array = [])
    {
        $sql = sprintf('INSERT INTO '.$table_name .'(%s) VALUES ("%s")', implode(',', array_keys($insert_array)), implode('","', array_values($insert_array)));
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
    }
    /**
     * @DateOfCreation      5 July 2018
     * @DateOfDeprecated   
     * @ShortDescription    this function select data from database          
     * @LongDescription     
     * @param  [string] $table_name  [Name of table]
     * @param  [string] $select_data [comma separated string of columns name to fetch value]
     * @param  [array]  $where_array [associative array to specify conditions]
     * @return [array]               [result array]
     */
    public function select($table_name, $select_data = '', $where_array = [])
    {
        $sql = 'SELECT '.$select_data .' FROM '.$table_name;
        $i=1;
        $count=count($where_array);
        if (!empty($where_array)) {
            $sql.=' WHERE ';
            foreach ($where_array as $key => $value) {
                # code..
                $sql .=  mysqli_real_escape_string($this->conn, $key);
                $sql .= ' = \'';
                $sql .= mysqli_real_escape_string($this->conn, $value);

                if ($i==$count) {
                    $sql .= '\'';
                } else {
                    $sql .=  '\' AND ';
                }
                $i++;
            }
        }
        if ($result = mysqli_query($this->conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
                    return $row;
                }
            }
        }
    }
    /**
     * @DateOfCreation      5 July 2018
     * @DateOfDeprecated   
     * @ShortDescription    this function update data in database          
     * @LongDescription   
     * @param  [string] $table_name   [Name Of Table]
     * @param  [array]  $update_array [associative array to update value in database]
     * @param  [array]  $where_array  [associative array contains condition when to update value in database]
     * @return [boolean]              [true if updated]
     */
    public function update($table_name, $update_array = [], $where_array = [])
    {
        $sql = 'UPDATE '.$table_name.' SET ';
        $i=1;
        $count=count($update_array);

        foreach ($update_array as $key => $value) {
            # code...
            $sql .=  mysqli_real_escape_string($this->conn, $key);
            $sql .= ' = \'';
            $sql .= mysqli_real_escape_string($this->conn, $value);
            if ($i==$count) {
                $sql .= '\' ';
            } else {
                $sql .=  '\',';
            }
            $i++;
        }
        $i=1;
        $count=count($update_array);
        if (!empty($where_array)) {
            $sql.=' WHERE ';
            foreach ($where_array as $key => $value) {
                # code..
                $sql .=  mysqli_real_escape_string($this->conn, $key);
                $sql .= ' = \'';
                $sql .= mysqli_real_escape_string($this->conn, $value);

                if ($i==$count) {
                    $sql .=  '\' AND ';
                } else {
                    $sql .= '\' ';
                }
                $i++;
            }
        }

        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
    }
    /**
     * @DateOfCreation      5 July 2018
     * @DateOfDeprecated   
     * @ShortDescription    this function delete data from database          
     * @LongDescription   
     * @param  [string] $table_name   [Name Of Table]
     * @param  [array]  $where_array  [associative array contains condition when to delete data from database]
     * @return [boolean]              [true if deleted]
     */
    public function delete($table_name, $where_array=[])
    {
        $sql = 'DELETE FROM '.$table_name;
        $i=1;
        $count=count($where_array);
        if (!empty($where_array)) {
            $sql.=' WHERE ';
            foreach ($where_array as $key => $value) {
                # code..
                $sql .=  mysqli_real_escape_string($this->conn, $key);
                $sql .= ' = \'';
                $sql .= mysqli_real_escape_string($this->conn, $value);

                if ($i==$count) {
                    $sql .= '\'';
                } else {
                    $sql .=  '\' AND ';
                }
                $i++;
            }
        }
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
    }
    /**
     * @DateOfCreation      5 July 2018
     * @DateOfDeprecated
     * @ShortDescription    this function select data from two tables in database
     * @LongDescription
     * @param  [string] $selectData [comma separated string of columns name to fetch value]
     * @param  [string] $table1     [Name of first table ]
     * @param  [string] $table2     [Name of second table ]
     * @param  [string] $joinType   [type of join]
     * @param  [string] $condition  [condition to fetch data]
     * @return [array]             [result array]
     */
    public function selectDataFromTwoTable($selectData, $table1, $table2, $joinType, $condition)
    {
        $sql = ' SELECT '.$selectData.' FROM '.$table1.' '.$joinType.' JOIN '.$table2.' ON '.$condition;
        if ($result = mysqli_query($this->conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
                    return $row;
                }
            }
        }
    }
}
