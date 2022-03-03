<?php

class StockAvailable
{
    private $db;
    public $db_table = "stock_available";

    public $id;
    public $material_type;
    public $material_thickness;
    public $material_grade;
    public $no_of_sheets;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_stock_available()
    {
        $sql_create = "INSERT INTO $this->db_table (material_type,material_thickness,material_grade,no_of_sheets) VALUES ('$this->material_type','$this->material_thickness','$this->material_grade','$this->no_of_sheets')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_stock_available()
    {
        $sql_read = "SELECT stock_available.id,material_type.id as material_type_id,material_thickness.id as material_thickness_id,material_grade.id as material_grade_id,stock_available.no_of_sheets,material_type.material_type,material_thickness.material_thickness,material_grade.material_grade FROM $this->db_table 
        JOIN material_type ON stock_available.material_type=material_type.id
        JOIN material_thickness ON stock_available.material_thickness=material_thickness.id
        JOIN material_grade ON stock_available.material_grade=material_grade.id";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function update_stock_available()
    {
        $sql_update = "UPDATE $this->db_table SET
        no_of_sheets=no_of_sheets+$this->no_of_sheets
        WHERE material_type=$this->material_type and
        material_thickness=$this->material_thickness and
        material_grade=$this->material_grade";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function delete_stock_available()
    {
        $sql_update = "DELETE FROM  $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
}
