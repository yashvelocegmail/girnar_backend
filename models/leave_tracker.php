<?php

class LeaveTracker
{
    private $db;

    public $id;
    public $employee;
    public $leave_from;
    public $leave_to;
    public $fromDate;
    public $toDate;
    public $reason;
    public $approval;
    public $applied_on;
    public $attachment;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function create_leave_tracker()
    {
        $sql_create = "INSERT INTO leave_tracker(employee,leave_from,leave_to,reason,applied_on,attachment) values('$this->employee','$this->leave_from','$this->leave_to','$this->reason','$this->applied_on','$this->attachment')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_leave_tracker_hr()
    {
        $sql_read = "SELECT employee.id,employee.name as emp_name,
        leave_tracker.id,
        leave_tracker.employee,
        leave_tracker.leave_from,
        leave_tracker.leave_to,
        leave_tracker.reason,
        leave_tracker.approval,
        leave_tracker.applied_on,
        leave_tracker.attachment
        from leave_tracker JOIN employee ON
        employee.id=leave_tracker.employee";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);//print_r($this->result);die;
        return $this->result;
    }
    public function read_leave_tracker_employee()
    {
        $sql_read = "SELECT * from leave_tracker WHERE employee=$this->employee";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);//print_r($this->result);die;
        return $this->result;
    }
    public function update_leave_tracker_hr_with_attachment()
    {
        $sql_update = "UPDATE leave_tracker SET employee=$this->employee,leave_from='$this->leave_from',leave_to='$this->leave_to',reason='$this->reason',approval='$this->approval',applied_on='$this->applied_on',attachment='$this->attachment' WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);//print_r($this->result);die;
        return $this->result;
    }
    public function update_leave_tracker_hr_without_attachment()
    {
        $sql_update = "UPDATE leave_tracker SET employee=$this->employee,leave_from='$this->leave_from',leave_to='$this->leave_to',reason='$this->reason',approval='$this->approval',applied_on='$this->applied_on'WHERE id=$this->id";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_update);//print_r($this->result);die;
        return $this->result;
    }
    public function delete_leave_tracker_hr()
    {
        $sql_delete = "DELETE FROM leave_tracker WHERE id=$this->id";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_delete);//print_r($this->result);die;
        return $this->result;
    }
    public function search_leave_tracker()
    {
        $sql_read = "SELECT employee.id,employee.name as emp_name,
        leave_tracker.id,
        leave_tracker.employee,
        leave_tracker.leave_from,
        leave_tracker.leave_to,
        leave_tracker.reason,
        leave_tracker.approval,
        leave_tracker.applied_on,
        leave_tracker.attachment
        from leave_tracker JOIN employee ON
        employee.id=leave_tracker.employee WHERE (leave_tracker.leave_from >= '$this->fromDate' and leave_tracker.leave_to <= '$this->toDate') and employee=$this->employee";
        //echo $sql_read;die;
        $this->result = $this->db->query($sql_read);//print_r($this->result);die;
        return $this->result;
    }
}
