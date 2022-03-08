<?php

class CustomerInquiry
{
    private $db;
    public $db_table = "customer_inquiry";

    public $id;
    public $customer;
    public $material_thickness;
    public $material_type;
    public $material_grade;
    public $material_status;
    public $type_of_process;
    public $expected_delivery;
    public $design_upload;
    public $description;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_customer_inquiry()
    {
        $sql_create = "INSERT INTO ".$this->db_table."(customer,material_type,material_thickness,material_grade,material_status,type_of_process,expected_delivery,design_upload,description) VALUES (".$this->customer.",".$this->material_type.",".$this->material_thickness.",'".$this->material_grade."','".$this->material_status."','".$this->type_of_process."','".$this->expected_delivery."','".$this->design_upload."','".$this->description."')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function create_customer_without_inquiry()
    {
        $sql_create = "INSERT INTO ".$this->db_table."(customer,design_upload) VALUES (".$this->customer.",'".$this->design_upload."')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_all_inquiry()
    {
        //$sql_create = "SELECT * FROM ".$this->db_table."";
        $sql_create = "SELECT
                        customer_inquiry.id,
                        customer.name as customer_name,
                        customer.mobile_number as customer_mobile_number,
                        customer.email_id as customer_email_id,
                        customer_inquiry.customer,
                        customer_inquiry.material_type,
                        customer_inquiry.material_thickness,
                        customer_inquiry.material_grade,
                        customer_inquiry.material_status,
                        customer_inquiry.type_of_process,
                        customer_inquiry.expected_delivery,
                        customer_inquiry.design_upload,
                        customer_inquiry.description,
                        customer_inquiry.status,
                        material_type.id as material_type_id,
                        material_type.material_type as material_type_material_type,
                        material_thickness.id as material_thickness_id,
                        material_thickness.material_thickness as material_thickness_material_thickness
                        FROM customer_inquiry
                        LEFT JOIN material_type
                        ON customer_inquiry.material_type = material_type.id
                        LEFT JOIN material_thickness
                        ON customer_inquiry.material_thickness = material_thickness.id
                        LEFT JOIN customer
                        ON customer.id = customer_inquiry.customer";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->result;
    }
    public function read_customer_inquiry()
    {
        //$sql_create = "SELECT * FROM ".$this->db_table."";
        $sql_create = "SELECT
                        customer_inquiry.id,
                        customer_inquiry.customer,
                        customer_inquiry.material_type,
                        customer_inquiry.material_thickness,
                        customer_inquiry.material_grade,
                        customer_inquiry.material_status,
                        customer_inquiry.type_of_process,
                        customer_inquiry.expected_delivery,
                        customer_inquiry.design_upload,
                        customer_inquiry.description,
                        material_type.id as material_type_id,
                        material_type.material_type as material_type_material_type,
                        material_thickness.id as material_thickness_id,
                        material_thickness.material_thickness as material_thickness_material_thickness
                        FROM customer_inquiry
                        LEFT JOIN material_type
                        ON customer_inquiry.material_type = material_type.id
                        LEFT JOIN material_thickness
                        ON customer_inquiry.material_thickness = material_thickness.id
                        WHERE customer=".$this->customer;
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->result;
    }
    public function update_customer_inquiry()
    {
        $sql_update = "UPDATE ".$this->db_table." SET
        customer=".$this->customer."
        ,material_type=".$this->material_type."
        ,material_thickness=".$this->material_thickness."
        ,material_grade='".$this->material_grade."'
        ,material_status='".$this->material_status."'
        ,type_of_process='".$this->type_of_process."'
        ,expected_delivery='".$this->expected_delivery."'
        ,design_upload='".$this->design_upload."'
        ,description='".$this->description."'
        WHERE id=".$this->id;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function update_customer_inquiry_status()
    {
        $sql_update = "UPDATE $this->db_table SET
        status='$this->status'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function update_customer_inquiry_without_file()
    {
        $sql_update = "UPDATE ".$this->db_table." SET
        customer=".$this->customer."
        ,material_type=".$this->material_type."
        ,material_thickness=".$this->material_thickness."
        ,material_grade='".$this->material_grade."'
        ,material_status='".$this->material_status."'
        ,type_of_process='".$this->type_of_process."'
        ,expected_delivery='".$this->expected_delivery."'
        ,description='".$this->description."'
        WHERE id=".$this->id;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function delete_customer_inquiry()
    {
        $sql_update = "DELETE FROM  ".$this->db_table." WHERE id=".$this->id;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
}
