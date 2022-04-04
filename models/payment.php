<?php
class Payment
{
    private $db;

    public $id;
    public $customer;
    public $purchase_order;
    public $bill_amount;
    public $amount_received;
    public $amount_pending;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_payment()
    {
        $sql_create = "INSERT INTO payment (customer,purchase_order,bill_amount,amount_received,amount_pending) VALUES ('$this->customer','$this->purchase_order','$this->bill_amount','$this->amount_received','$this->amount_pending')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_payment()
    {
        $sql_read = "SELECT payment.id,payment.customer,payment.purchase_order,payment.bill_amount,payment.amount_received,payment.amount_pending,customer.name as customer_name,purchase_order.purchase_order as purchase_order_name 
        FROM payment LEFT JOIN customer ON customer.id=payment.customer
        LEFT JOIN purchase_order ON  payment.purchase_order=purchase_order.id";
        //echo $sql_read;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function update_payment()
    {
        $sql_update = "UPDATE payment SET
        customer='$this->customer',
        purchase_order='$this->purchase_order',
        bill_amount='$this->bill_amount',
        amount_received='$this->amount_received',
        amount_pending='$this->amount_pending'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }

    public function delete_payment()
    {
        $sql_update = "DELETE FROM payment WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
}