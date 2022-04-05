<?php
date_default_timezone_set('Asia/Kolkata');
class EmployeeAttendance
{
    private $db;
    public $db_table = "employee_attendance";

    public $id;
    public $date;
    public $fromDate;
    public $toDate;
    public $check_in;
    public $check_out;
    public $completed_hrs;
    public $late_hrs;
    public $employee;
    public $result;
    public $validation_check;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function check_in()
    {
        $sql_validation = "SELECT * FROM $this->db_table WHERE date='$this->date' and employee=$this->employee";
        $sql_check_shift = "SELECT shift.shift_from from 
        employee_shift LEFT JOIN shift ON employee_shift.shift=shift.id WHERE employee=$this->employee";
        $check_shift = $this->db->query($sql_check_shift);
       
        while($row=$check_shift->fetch_assoc())
        {
            $shift_from=$row['shift_from'];
        }
        $this->validation_check=$this->db->query($sql_validation);
        //print_r($this->db->affected_rows);die;
        if($this->db->affected_rows>0 && $this->db->affected_rows!=0)
        {
            return "not_valid";
        }
        else
        {
            $time3 = strtotime(date("H:i:s"));
            $time4 = strtotime($shift_from);
            $difference2 = round(abs($time3 - $time4) / 3600);
            $sql_check_in = "INSERT INTO $this->db_table (date,check_in,employee,late_hrs) VALUES ('$this->date','$this->check_in','$this->employee','$difference2')";
            //echo $sql_check_in;die;
            $this->result = $this->db->query($sql_check_in);
            return $this->db;
        }
        
    }
    public function check_out()
    {
        $time1 = strtotime($this->check_in);
        $time2 = strtotime($this->check_out);
        $difference1 = round(abs($time2 - $time1) / 3600, 2);
        //echo $difference1;die;
        $sql_check_out = "UPDATE $this->db_table SET check_out='$this->check_out',completed_hrs='$difference1' WHERE employee=$this->employee and date='$this->date'";
        //echo date("H:i:s");die;
        $this->result = $this->db->query($sql_check_out);
        return $this->db;
    }
    public function check_in_approval()
    {
        $sql_check_in_approval = "UPDATE $this->db_table SET check_in_approval='approved' WHERE id=$this->id";
        $this->result = $this->db->query($sql_check_in_approval);
        return $this->db;
    }
    public function check_out_approval()
    {
        $sql_check_out_approval = "UPDATE $this->db_table SET check_out_approval='approved' WHERE id=$this->id";
        $this->result = $this->db->query($sql_check_out_approval);
        return $this->db;
    }
    
    public function read_check_approval()
    {
        $sql_check_approval = "SELECT * FROM $this->db_table WHERE date='$this->date' and employee=$this->employee";
        //echo $sql_check_approval;die;
        $this->result = $this->db->query($sql_check_approval);
        return $this->result;
    }
    public function read_check_in_approval()
    {
        $sql_check_approval = "SELECT employee_attendance.id,employee_attendance.date,employee_attendance.check_in,employee_attendance.check_out,employee_attendance.completed_hrs,employee_attendance.late_hrs,employee_attendance.employee,employee_attendance.check_in_approval,employee_attendance.check_out_approval,employee.name as employee_name FROM $this->db_table JOIN employee ON employee_attendance.employee=employee.id WHERE date='$this->date' and check_in_approval='not_approved'";
        //echo $sql_check_approval;die;
        $this->result = $this->db->query($sql_check_approval);
        return $this->result;
    }
    public function read_check_out_approval()
    {
        $sql_check_approval = "SELECT  employee_attendance.id,employee_attendance.date,employee_attendance.check_in,employee_attendance.check_out,employee_attendance.completed_hrs,employee_attendance.late_hrs,employee_attendance.employee,employee_attendance.check_in_approval,employee_attendance.check_out_approval,employee.name as employee_name FROM $this->db_table JOIN employee ON employee_attendance.employee=employee.id WHERE date='$this->date' and check_out_approval='not_approved' and check_out IS NOT NULL";
        //echo $sql_check_approval;die;
        $this->result = $this->db->query($sql_check_approval);
        return $this->result;
    }
    public function search_employee_attendance()
    {
        $sql_search_attendance = "SELECT  employee_attendance.id,employee_attendance.date,employee_attendance.check_in,employee_attendance.check_out,employee_attendance.completed_hrs,employee_attendance.late_hrs,employee_attendance.employee,employee_attendance.check_in_approval,employee_attendance.check_out_approval,employee.name,employee.position as employee_name FROM $this->db_table JOIN employee ON employee_attendance.employee=employee.id WHERE date BETWEEN '$this->fromDate'  AND '$this->toDate' and employee=$this->employee";
        //echo $sql_search_attendance;die;
        $this->result = $this->db->query($sql_search_attendance);
        return $this->result;
    }
    public function check_in_rejected()
    {
        $sql_check_in_approval = "UPDATE $this->db_table SET check_in_approval='rejected' WHERE id=$this->id";
        $this->result = $this->db->query($sql_check_in_approval);
        return $this->db;
    }
    public function check_out_rejected()
    {
        $sql_check_out_approval = "UPDATE $this->db_table SET check_out_approval='rejected' WHERE id=$this->id";
        $this->result = $this->db->query($sql_check_out_approval);
        return $this->db;
    }
}
