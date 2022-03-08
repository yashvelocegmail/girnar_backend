<?php

class Quotation
{
    private $db;
    public $db_table = "quotation";

    public $id;
    public $customer_enquiry;
    public $des_quant_rate;
    public $total;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_quotation()
    {
        $sql_create = "INSERT INTO $this->db_table (customer_enquiry,des_quant_rate,total) VALUES ('$this->customer_enquiry','$this->des_quant_rate','$this->total')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_quotation()
    {
        $sql_read = "SELECT * FROM $this->db_table";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    // public function update_material_type()
    // {
    //     $sql_update = "UPDATE $this->db_table SET
    //     material_type='$this->material_type'
    //     WHERE id=$this->id";
    //     //echo $sql_update;die;
    //     $this->result = $this->db->query($sql_update);
    //     return $this->result;
    // }

    // public function delete_material_type()
    // {
    //     $sql_update = "DELETE FROM  $this->db_table WHERE id=$this->id";
    //     $this->result = $this->db->query($sql_update);
    //     return $this->result;
    // }
}
