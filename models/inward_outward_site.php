<?php

class InwardOutwardSite
{
    private $db;
    public $db_table = "inward_outward_site";

    public $id;
    public $inward_site;
    public $outward_site;
    public $work_order;
    public $outward_date;
    public $outward_time;
    public $inward_date;
    public $inward_time;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_inward_outward_site()
    {
        $sql_check_duplicate = "SELECT * FROM inward_outward_site WHERE work_order='$this->work_order'";
        $duplicate = $this->db->query($sql_check_duplicate);
        if ($duplicate->num_rows == 0) 
        {
            $sql_create = "INSERT INTO $this->db_table (inward_site,outward_site,work_order,outward_date,outward_time,inward_date,inward_time) VALUES ('$this->inward_site','$this->outward_site','$this->work_order','$this->outward_date','$this->outward_time','$this->inward_date','$this->inward_time')";
            //echo $sql_create;die;
            $this->result = $this->db->query($sql_create);
            return $this->db;
        } 
        else 
        {
            return "duplicate";
        }
    }
    public function read_inward_outward_site()
    {
        $sql_read = "SELECT inward_outward_site.id,inward_outward_site.inward_site,inward_outward_site.outward_site,inward_outward_site.work_order,inward_outward_site.inward_date,inward_outward_site.inward_time,inward_outward_site.outward_date,inward_outward_site.outward_time,work_order.work_order as work_order_name,inward_outward_site.inward_site as inward_site_name,inward_outward_site.outward_site as outward_site_name  FROM $this->db_table
        LEFT JOIN work_order ON inward_outward_site.work_order=work_order.id
        LEFT JOIN branch as t1 ON t1.id=inward_outward_site.inward_site
        LEFT JOIN branch as t2 ON t2.id=inward_outward_site.outward_site";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function update_inward_outward_site()
    {
        $sql_update = "UPDATE $this->db_table SET
        inward_site='$this->inward_site',
        outward_site='$this->outward_site',
        work_order='$this->work_order',
        outward_date='$this->outward_date',
        outward_time='$this->outward_time',
        inward_date='$this->inward_date',
        inward_time='$this->inward_time'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }

    public function delete_inward_outward_site()
    {
        $sql_update = "DELETE FROM  $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function inward_inward_outward_site()
    {
        $sql_update = "UPDATE $this->db_table SET
        inward_date = '$this->inward_date',
        inward_time= '$this->inward_time'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
}
