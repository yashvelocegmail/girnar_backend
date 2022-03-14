<?php

class Quotation
{
    private $db;
    public $db_table = "quotation";

    public $id;
    public $customer_id;
    public $quotation;
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
        $sql_create = "INSERT INTO $this->db_table (quotation,customer_enquiry,des_quant_rate,total) VALUES ('$this->quotation','$this->customer_enquiry','$this->des_quant_rate','$this->total')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_quotation()
    {
        $sql_read = "SELECT quotation.id,quotation.quotation,quotation.customer_enquiry,quotation.des_quant_rate,quotation.total,customer.name as customer_name
        FROM quotation 
        LEFT JOIN customer_inquiry ON customer_inquiry.id=quotation.customer_enquiry
        LEFT JOIN customer ON customer.id = customer_inquiry.customer";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function read_quotation_by_customer()
    {
        $sql_read = "SELECT quotation.id,quotation.quotation,quotation.customer_enquiry,quotation.des_quant_rate,quotation.total,customer.name as customer_name
        FROM quotation 
        LEFT JOIN customer_inquiry ON customer_inquiry.id=quotation.customer_enquiry
        LEFT JOIN customer ON customer.id = customer_inquiry.customer
        WHERE customer.id=$this->customer";
        //echo $sql_read;die;
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
    public function get_serial_number()
    {
        $sql_check = "SELECT quotation.id,quotation.customer_enquiry,quotation.des_quant_rate,quotation.total,customer.name as customer_name
        FROM quotation 
        LEFT JOIN customer_inquiry ON customer_inquiry.id=quotation.customer_enquiry
        LEFT JOIN customer ON customer.id = customer_inquiry.customer
        WHERE customer.id=$this->customer_id";
        //echo $sql_check;die;
        $this->result = $this->db->query($sql_check);
        return $this->result;
    }
    public function get_customer_enquiry()
    {
        $sql_customer = "SELECT * from customer_inquiry
        WHERE id=$this->customer_enquiry";
        //echo $sql_customer;die;
        $this->result = $this->db->query($sql_customer);
        return $this->result;
    }
    public function get_quotation()
    {
        $sql_get_quotation = "SELECT quotation.id,customer_inquiry.inquiry as customer_inquiry from 
        quotation 
        LEFT JOIN customer_inquiry ON customer_inquiry.id=quotation.customer_enquiry 
        WHERE customer_enquiry='$this->customer_enquiry'";
        $this->result = $this->db->query($sql_get_quotation);
        return $this->result;
    }
    public function get_customer_from_quotation()
    {
        $sql_get_quotation = "SELECT quotation.id,customer_inquiry.inquiry as customer_inquiry,customer.id,customer.name as customer_name from 
        quotation 
        LEFT JOIN customer_inquiry ON customer_inquiry.id=quotation.customer_enquiry 
        LEFT JOIN customer ON customer_inquiry.customer=customer.id 
        WHERE quotation='$this->quotation'";
        $this->result = $this->db->query($sql_get_quotation);
        return $this->result;
    }
}
