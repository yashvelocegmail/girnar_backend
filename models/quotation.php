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
        $sql_read = "SELECT quotation.id,quotation.customer_enquiry,quotation.des_quant_rate,quotation.total,customer.name as customer_name
        FROM quotation 
        LEFT JOIN customer_inquiry ON customer_inquiry.id=quotation.customer_enquiry
        LEFT JOIN customer ON customer.id = customer_inquiry.customer";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function update_quotation()
    {
        $sql_update = "UPDATE $this->db_table SET
        customer_enquiry='$this->customer_enquiry',
        des_quant_rate='$this->des_quant_rate',
        total='$this->total'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }

    public function delete_quotation()
    {
        $sql_delete = "DELETE FROM $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_delete);
        return $this->result;
    }
}
