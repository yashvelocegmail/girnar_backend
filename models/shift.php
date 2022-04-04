<?php

class Shift
{
    private $db;
    public $db_table = "shift";

    public $id;
    public $shift_name;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_shift()
    {
        $sql_create = "INSERT INTO $this->db_table (shift_name) VALUES ('$this->shift_name')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_shift()
    {
        $sql_read = "SELECT * FROM $this->db_table";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function update_shift()
    {
        $sql_update = "UPDATE $this->db_table SET
        shift_name='$this->shift_name'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }

    public function delete_shift()
    {
        $sql_update = "DELETE FROM  $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
}
