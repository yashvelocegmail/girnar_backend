<?php

class MaterialGrade
{
    private $db;
    public $db_table = "material_grade";

    public $id;
    public $material_grade;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_material_grade()
    {
        $sql_create = "INSERT INTO $this->db_table (material_grade) VALUES ('$this->material_grade')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_material_grade()
    {
        $sql_read = "SELECT * FROM $this->db_table";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function update_material_grade()
    {
        $sql_update = "UPDATE $this->db_table SET
        material_grade='$this->material_grade'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }

    public function delete_material_grade()
    {
        $sql_update = "DELETE FROM  $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
}
