<?php

class PurchaseOrder
{
    private $db;

    public $id;
    public $purchase_order;
    public $quotation;
    public $customer;
    public $des_quant_rate_total;
    public $cgst;
    public $sgst;
    public $discount;
    public $total;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_purchase_order()
    {
        $sql_create = "INSERT INTO purchase_order (purchase_order,quotation,customer,des_quant_rate_total,cgst,sgst,discount,total) VALUES ('$this->purchase_order','$this->quotation','$this->customer','$this->des_quant_rate_total','$this->cgst','$this->sgst','$this->discount','$this->total')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_purchase_order_by_crm()
    {
        $sql_read = "SELECT customer.name,customer.mobile_number,customer.email_id,customer.address1,customer.address2,customer.address3,customer.pan,customer.tan,customer.gst,purchase_order.id,purchase_order.purchase_order,purchase_order.quotation,purchase_order.customer,purchase_order.des_quant_rate_total,purchase_order.cgst,purchase_order.sgst,purchase_order.discount,purchase_order.total,quotation.quotation,quotation.id as quotation_id
        FROM purchase_order
        LEFT JOIN quotation ON quotation.id=purchase_order.quotation
        LEFT JOIN customer ON customer.id=purchase_order.customer";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function read_purchase_order_by_customer()
    {
        $sql_read = "SELECT customer.name,customer.mobile_number,customer.email_id,customer.address1,customer.address2,customer.address3,customer.pan,customer.tan,customer.gst,purchase_order.id,purchase_order.purchase_order,purchase_order.quotation,purchase_order.customer,purchase_order.des_quant_rate_total,purchase_order.cgst,purchase_order.sgst,purchase_order.discount,purchase_order.total,quotation.quotation,quotation.id as quotation_id
        FROM purchase_order
        LEFT JOIN quotation ON quotation.id=purchase_order.quotation
        LEFT JOIN customer ON customer.id=purchase_order.customer
        WHERE customer.id=$this->customer";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function get_serial_number()
    {
        $sql_check = "SELECT customer.name,customer.mobile_number,customer.email_id,customer.address1,customer.address2,customer.address3,customer.pan,customer.tan,customer.gst,purchase_order.id,purchase_order.purchase_order,purchase_order.quotation,purchase_order.customer,purchase_order.des_quant_rate_total,purchase_order.cgst,purchase_order.sgst,purchase_order.discount,purchase_order.total,quotation.quotation
        FROM purchase_order
        LEFT JOIN quotation ON quotation.id=purchase_order.quotation
        LEFT JOIN customer ON customer.id=purchase_order.customer
        WHERE quotation.id=$this->quotation";
        //echo $sql_check;die;
        $this->result = $this->db->query($sql_check);
        return $this->result;
    }
    public function get_quotation_from_quotation()
    {
        $sql_quotation = "SELECT * from quotation where id=$this->quotation";
        //echo $sql_customer;die;
        $this->result = $this->db->query($sql_quotation);
        return $this->result;
    }
    public function update_purchase_order()
    {
        $sql_update = "UPDATE purchase_order SET
        quotation='$this->quotation',
        customer = $this->customer,
        des_quant_rate_total = '$this->des_quant_rate_total',
        cgst=$this->cgst,
        sgst=$this->sgst,
        discount=$this->discount,
        total=$this->total
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }

    public function delete_purchase_order()
    {
        $sql_update = "DELETE FROM  purchase_order WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
}
