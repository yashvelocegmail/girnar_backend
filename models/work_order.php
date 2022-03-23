<?php

class WorkOrder
{
    private $db;
    public $db_table = "work_order";

    public $id;
    public $work_order;
    public $purchase_order;
    public $designer_head;
    public $designer_head_description_status;
    public $designer_head_approval_by_crm_operator;
    public $designer_head_approval_by_super_admin;
    public $designer_head_file;
    public $designer;
    public $designer_description_status;
    public $designer_approval_by_designer_head;
    public $designer_file;
    public $programmer_description_status;
    public $programmer_approval_by_designer;
    public $programmer_approval_by_designer_head;
    public $programmer_file;
    public $machine_operator_description_status;
    public $machine_operator_approval_by_designer;
    public $machine_operator_file;
    public $machine_operator_parameter;
    public $transporter_description_status;
    public $transporter_approval_by_crm_operator;
    public $transporter_file;

    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function create_work_order_with_files()
    {
        $sql_create = "INSERT INTO work_order(
            work_order,
            purchase_order,
            designer_head,
            designer_head_file,
            designer_head_description_status,
            designer,
            designer_file,
            designer_description_status,
            programmer,
            programmer_file,
            programmer_description_status,
            machine_operator,
            machine_operator_file,
            machine_operator_description_status,
            machine_operator_parameter,
            transporter,
            transporter_file,
            transporter_description_status
            ) VALUES (
                '$this->work_order',
                '$this->purchase_order',
                '$this->designer_head',
                '$this->designer_head_file',
                '$this->designer_head_description_status',
                '$this->designer',
                '$this->designer_file',
                '$this->designer_description_status',
                '$this->programmer',
                '$this->programmer_file',
                '$this->programmer_description_status',
                '$this->machine_operator',
                '$this->machine_operator_file',
                '$this->machine_operator_description_status',
                '$this->machine_operator_parameter',
                '$this->transporter',
                '$this->transporter_file',
                '$this->transporter_description_status'
                )";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function create_work_order()
    {
        $sql_create = "INSERT INTO work_order(
            work_order,
            purchase_order,
            designer_head,
            designer_head_description_status,
            designer,
            designer_description_status,
            programmer,
            programmer_description_status,
            machine_operator,
            machine_operator_description_status,
            machine_operator_parameter,
            transporter,
            transporter_description_status
            ) VALUES (
                '$this->work_order',
                '$this->purchase_order',
                '$this->designer_head',
                '$this->designer_head_description_status',
                '$this->designer',
                '$this->designer_description_status',
                '$this->programmer',
                '$this->programmer_description_status',
                '$this->machine_operator',
                '$this->machine_operator_description_status',
                '$this->machine_operator_parameter',
                '$this->transporter',
                '$this->transporter_description_status'
                )";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function get_purchase_order_from_work_order()
    {
        $get_purchase_order = "SELECT * FROM work_order WHERE purchase_order=$this->purchase_order";
        $this->result = $this->db->query($get_purchase_order);
        return $this->result;
    }
    public function get_purchase_order()
    {
        $get_purchase_order = "SELECT * FROM purchase_order WHERE id=$this->purchase_order";
        $this->result = $this->db->query($get_purchase_order);
        return $this->result;
    }
    public function read_work_order_by_crm()
    {
        $sql_read = "SELECT 
                    work_order.id,
                    work_order.work_order,
                    work_order.purchase_order,
                    work_order.designer_head,
                    work_order.designer_head_file,
                    work_order.designer_head_description_status,
                    work_order.designer,
                    work_order.designer_file,
                    work_order.designer_description_status,
                    work_order.programmer,
                    work_order.programmer_description_status,
                    work_order.programmer_file,
                    work_order.machine_operator,
                    work_order.machine_operator_description_status,
                    work_order.machine_operator_parameter,
                    work_order.machine_operator_file,
                    work_order.transporter,
                    work_order.transporter_description_status,
                    work_order.transporter_file,
                    p1.name as designer_head_name,
                    p2.name as designer_name,
                    p3.name as programmer_name,
                    p4.name as machine_operator_name,
                    p5.name as transporter_name
                    FROM work_order
                    LEFT JOIN employee as p1 ON work_order.designer_head=p1.id
                    LEFT JOIN employee as p2 ON work_order.designer=p2.id
                    LEFT JOIN employee as p3 ON work_order.programmer=p3.id
                    LEFT JOIN employee as p4 ON work_order.machine_operator=p4.id
                    LEFT JOIN employee as p5 ON work_order.transporter=p5.id";
        //echo $sql_read;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function update_work_order()
    {
        $sql_update = "UPDATE work_order SET 
        purchase_order=$this->purchase_order,
        designer_head='$this->designer_head',
        designer_head_description_status='$this->designer_head_description_status',
        designer=$this->designer,
        designer_description_status='$this->designer_description_status',
        programmer=$this->programmer,
        programmer_description_status='$this->programmer_description_status',
        machine_operator=$this->machine_operator,
        machine_operator_description_status='$this->machine_operator_description_status',
        machine_operator_parameter='$this->machine_operator_parameter',
        transporter=$this->transporter,
        transporter_description_status='$this->transporter_description_status'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function delete_work_order()
    {
        $sql_delete = "DELETE FROM work_order WHERE id=$this->id";
        $this->result = $this->db->query($sql_delete);
        return $this->result;
    }
    public function update_work_order_with_files()
    {
        $sql_update = "UPDATE work_order SET 
        purchase_order=$this->purchase_order,
        designer_head='$this->designer_head',
        designer_head_description_status='$this->designer_head_description_status',
        designer_head_file = '$this->designer_head_file',
        designer=$this->designer,
        designer_description_status='$this->designer_description_status',
        designer_file='$this->designer_file',
        programmer=$this->programmer,
        programmer_description_status='$this->programmer_description_status',
        programmer_file='$this->programmer_file',
        machine_operator=$this->machine_operator,
        machine_operator_description_status='$this->machine_operator_description_status',
        machine_operator_parameter='$this->machine_operator_parameter',
        machine_operator='$this->machine_operator_file',
        transporter=$this->transporter,
        transporter_description_status='$this->transporter_description_status',
        transporter_file='$this->transporter_file'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function read_work_order_by_designer()
    {
        // $sql_read_designer_head_status = "SELECT * FROM work_order WHERE designer=$this->designer";
        // $read_result = $this->db->query($sql_read_designer_head_status);
        // $status_data=[];
        // while($row=$read_result->fetch_assoc())
        // {
        //     array_push($status_data,trim($row['designer_head_description_status'],'"'));
        // }
        // for($i=0;$i<count($status_data);$i++)
        // {
        //     print_r(json_decode($status_data[$i]));die;
        // }
        // print_r($status_data);die;
        $sql_read_designer = "SELECT 
        work_order.id,
                    work_order.work_order,
                    work_order.purchase_order,
                    work_order.designer_head,
                    work_order.designer_head_file,
                    work_order.designer_head_description_status,
                    work_order.designer,
                    work_order.designer_file,
                    work_order.designer_description_status,
                    work_order.programmer,
                    work_order.programmer_description_status,
                    work_order.programmer_file,
                    work_order.machine_operator,
                    work_order.machine_operator_description_status,
                    work_order.machine_operator_parameter,
                    work_order.machine_operator_file,
                    work_order.transporter,
                    work_order.transporter_description_status,
                    work_order.transporter_file,
        employee.name as designer_name
        FROM work_order
        LEFT JOIN employee ON employee.id=work_order.designer
        WHERE work_order.designer=$this->designer";
        $this->result = $this->db->query($sql_read_designer);
        return $this->result;
    }
}
