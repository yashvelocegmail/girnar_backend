<?php

class MonthlyLeaves
{
    private $db;

    public $id;
    public $employee;
    public $month;
    public $no_of_leaves;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function create_monthly_leaves()
    {
        $sql_create = "INSERT INTO monthly_leaves(employee,month,no_of_leaves) values('$this->employee','$this->month','$this->no_of_leaves')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_monthly_leaves_by_id()
    {
        $sqlQueryReadEmployee = "SELECT * FROM monthly_leaves WHERE employee=$this->employee";
        $this->result_single_read_employee= $this->db->query($sqlQueryReadEmployee);
        return $this->result_single_read_employee;
    }
    public function read_monthly_leaves_by_month()
    {
        $sqlQueryRead= "SELECT id,employee,month,sum(no_of_leaves) as no_of_leaves FROM monthly_leaves WHERE employee=$this->employee and month=$this->month";
        $this->result_single_read= $this->db->query($sqlQueryRead);
        return $this->result_single_read;
    }
}
