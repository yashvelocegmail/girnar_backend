<?php

class EmployeeShift
{
    private $db;
    public $db_table = "employee_shift";

    public $id;
    public $shift;
    public $employee;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_emp_shift()
    {
        $sql_check="SELECT * FROM $this->db_table WHERE employee='$this->employee'";
        $check = $this->db->query($sql_check);
        //print_r($check->num_rows) ;die;
        if($check->num_rows==0)
        {
            $sql_create = "INSERT INTO $this->db_table (shift,employee,position) VALUES ('$this->shift','$this->employee','$this->position')";
            //echo $sql_create;die;
            $this->result = $this->db->query($sql_create);
            return $this->db;
        }
        else
        {
            return "duplicate entry";
        }
        
    }
    public function read_shift()
    {
        $sql_read="SELECT employee_shift.id,employee_shift.shift,employee_shift.employee,employee_shift.position,shift.shift_name,employee.name FROM employee_shift JOIN shift ON employee_shift.shift=shift.id JOIN employee ON employee_shift.employee=employee.id";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function update_shift()
    {
        $sql_update = "UPDATE $this->db_table SET
        position='$this->position',
        shift='$this->shift',
        employee='$this->employee'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }

    public function delete_shift()
    {
        $sql_update = "DELETE FROM  $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
}
