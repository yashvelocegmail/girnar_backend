<?php

class Products
{
    private $db;
    public $db_table = "products";

    public $id;
    public $product_name;
    public $available_stock;
    public $uom;
    public $price;
    public $product_file;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_products()
    {
        $sql_create = "INSERT INTO $this->db_table(product_name,available_stock,uom,price,product_file) VALUES ('$this->product_name','$this->available_stock','$this->uom','$this->price','$this->product_file')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_products()
    {
        $sql_create = "SELECT * FROM $this->db_table";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->result;
    }
    public function update_products_with_file()
    {
        $sql_update = "UPDATE $this->db_table SET
        product_name='$this->product_name',
        available_stock='$this->available_stock',
        uom='$this->uom',
        price='$this->price',
        product_file='$this->product_file'
        WHERE id=$this->id";
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function update_products_without_file()
    {
        $sql_update = "UPDATE $this->db_table SET
        product_name='$this->product_name',
        available_stock='$this->available_stock',
        uom='$this->uom',
        price='$this->price'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function delete_products()
    {
        $sql_delete = "DELETE FROM $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_delete);
        return $this->result;
    }
}
