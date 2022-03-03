<?php

class ThirdParty
{
    private $db;
    public $db_table = "third_party";

    public $id;
    public $name;
    public $email;
    public $mobile_number;
    public $type_of_operation;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_third_party()
    {
        $sql_create = "INSERT INTO $this->db_table(name,email,mobile_number,type_of_operation) VALUES('$this->name','$this->email','$this->mobile_number','$this->type_of_operation')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_third_party()
    {
        $sql_create = "SELECT * FROM ".$this->db_table."";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->result;
    }
    public function update_third_party()
    {
        $sql_update = "UPDATE $this->db_table SET name='$this->name',email='$this->email',mobile_number='$this->mobile_number',type_of_operation='$this->type_of_operation' WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function delete_third_party()
    {
        $sql_delete = "DELETE FROM $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_delete);
        return $this->result;
    }
}
