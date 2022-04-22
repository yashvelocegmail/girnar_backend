<?php

class Transportation
{
    private $db;
    public $db_table = "transportation";

    public $id;
    public $work_order;
    public $address;
    public $date;
    public $status;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_transportation()
    {
        $sql_create = "INSERT INTO $this->db_table (work_order,address,date,status) VALUES ('$this->work_order','$this->address','$this->date','$this->status')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_transportation()
    {
        $sql_read = "SELECT transportation.id,transportation.address,transportation.work_order,transportation.date,transportation.status,work_order.work_order as work_order_name FROM $this->db_table 
        LEFT JOIN work_order ON transportation.work_order=work_order.id";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function update_work_order_as_completed()
    {
        $sql_update_work_order="UPDATE work_order SET status='completed' WHERE id=$this->work_order";
        $this->result = $this->db->query($sql_update_work_order);
        return $this->result;
    }
    public function update_work_order_as_assigned()
    {
        $sql_update_work_order="UPDATE work_order SET status='assigned' WHERE id=$this->work_order";
        $this->result = $this->db->query($sql_update_work_order);
        return $this->result;
    }
    public function update_transportation()
    {
        $sql_update = "UPDATE $this->db_table SET
        work_order='$this->work_order',
        address='$this->address',
        date = '$this->date',
        status = '$this->status'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }

    public function delete_transportation()
    {
        $sql_update = "DELETE FROM  $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
}
