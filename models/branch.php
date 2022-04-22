<?php

class Branch
{
    private $db;
    public $db_table = "branch";

    public $id;
    public $branch_name;
    public $address;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_branch()
    {
        $sql_create = "INSERT INTO $this->db_table (branch_name,address) VALUES ('$this->branch_name','$this->address')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_branch()
    {
        $sql_read = "SELECT * FROM $this->db_table";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function update_branch()
    {
        $sql_update = "UPDATE $this->db_table SET
        branch_name='$this->branch_name',
        address='$this->address'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }

    public function delete_branch()
    {
        $sql_update = "DELETE FROM  $this->db_table WHERE id=$this->id";
         //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
}
