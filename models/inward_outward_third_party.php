<?php

class InwardOutward
{
    private $db;
    public $db_table = "inword_outword_thirdparty";

    public $id;
    public $work_order;
    public $third_party_name;
    public $outward_date;
    public $outward_time;
    public $inward_date;
    public $inward_time;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_outward()
    {
        $sql_check_duplicate="SELECT * FROM inword_outword_thirdparty WHERE work_order='$this->work_order'";
        $duplicate=$this->db->query($sql_check_duplicate);
        if($duplicate->num_rows==0)
        {
            $sql_create = "INSERT INTO $this->db_table (work_order,third_party_name,outward_date,outward_time,inward_date,inward_time) VALUES ('$this->work_order','$this->third_party_name','$this->outward_date','$this->outward_time','$this->inward_date','$this->inward_time')";
            //echo $sql_create;die;
            $this->result = $this->db->query($sql_create);
            return $this->db;  
        }
        else
        {
            return "duplicate";
        }
    }
    public function read_outward()
    {
        $sql_read = "SELECT inword_outword_thirdparty.id,inword_outword_thirdparty.work_order,inword_outword_thirdparty.third_party_name,inword_outword_thirdparty.outward_date,inword_outword_thirdparty.outward_time,inword_outword_thirdparty.inward_date,inword_outword_thirdparty.inward_time,work_order.work_order as work_order_name,third_party.name as third_party_name_name  FROM $this->db_table 
        LEFT JOIN work_order ON inword_outword_thirdparty.work_order=work_order.id
        LEFT JOIN third_party ON third_party.id=inword_outword_thirdparty.third_party_name";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    // public function update_work_order_as_completed()
    // {
    //     $sql_update_work_order="UPDATE work_order SET status='completed' WHERE id=$this->work_order";
    //     $this->result = $this->db->query($sql_update_work_order);
    //     return $this->result;
    // }
    // public function update_work_order_as_assigned()
    // {
    //     $sql_update_work_order="UPDATE work_order SET status='assigned' WHERE id=$this->work_order";
    //     $this->result = $this->db->query($sql_update_work_order);
    //     return $this->result;
    // }
    public function update_inward_outward()
    {
        $sql_update = "UPDATE $this->db_table SET
        inward_date = '$this->inward_date',
        inward_time= '$this->inward_time'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function all_update_inward_outward()
    {
        $sql_update = "UPDATE $this->db_table SET
   work_order='$this->work_order',
   third_party_name='$this->third_party_name',
   outward_date = '$this->outward_date',
   outward_time = '$this->outward_time',
   inward_date = '$this->inward_date',
   inward_time = '$this->inward_time'
   WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function delete_inward_outward()
    {
        $sql_update = "DELETE FROM  $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
}
