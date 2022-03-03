<?php

class MaterialThickness
{
    private $db;
    public $db_table = "material_thickness";

    public $id;
    public $material_thickness;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_material_thickness()
    {
        $sql_create = "INSERT INTO $this->db_table(material_thickness) VALUES ('$this->material_thickness')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_material_thickness()
    {
        $sql_create = "SELECT * FROM $this->db_table";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->result;
    }
    public function update_material_thickness()
    {
        $sql_update = "UPDATE $this->db_table SET
        material_thickness='$this->material_thickness'
        WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }

    public function delete_material_thickness()
    {
        $sql_delete = "DELETE FROM $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_delete);
        return $this->result;
    }
}
