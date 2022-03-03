<?php
class CompanyCustomer
{
    private $db;
    public $db_table_customer = "customer";
    public $db_table_user = "users";

    public $id;
    public $name;
    public $address1;
    public $address2;
    public $address3;
    public $mobile_number;
    public $email_id;
    public $website;
    public $director_name;
    public $director_mobile;
    public $director_email_id;
    public $type_of_industry;
    public $gst;
    public $pan;
    public $tan;
    public $contact_person;
    public $designation;
    public $company_customer;
    public $username;
    public $password;

    public $result_user;
    public $result_customer;
    public $result_read_customer;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function read_single_customer()
    {
        $sqlQueryReadCustomer = "SELECT * FROM CUSTOMER WHERE mobile_number=".$this->mobile_number;
        $this->result_read_customer= $this->db->query($sqlQueryReadCustomer);
        return $this->db;
    }
    public function register_user()
    {
        $sqlQueryUser = "INSERT INTO " . $this->db_table_user . " SET
        username = '" . $this->username . "'
        ,password = '" . $this->password . "'
        ,user_type = '" . $this->user_type . "'";
        $this->result_user= $this->db->query($sqlQueryUser);
        return $this->db->insert_id;
    }
    public function register_company_customer()
    {
        $sqlQueryCustomer = "INSERT INTO " . $this->db_table_customer . " SET
         name = '$this->name'
        ,users = '$this->users'
        ,address1 = '$this->address1'
        ,address2 = '$this->address2'
        ,address3 = '$this->address3'
        ,mobile_number = '$this->mobile_number'
        ,email_id = '$this->email_id'
        ,website = '$this->website'
        ,director_name = '$this->director_name'
        ,director_mobile = '$this->director_mobile'
        ,director_email_id = '$this->director_email_id'
        ,type_of_industry = '$this->type_of_industry'
        ,gst = '$this->gst'
        ,pan = '$this->pan'
        ,tan = '$this->tan'
        ,contact_person_designation = '$this->contact_person_designation'";
        //print_r($sqlQueryCustomer);die;
        $this->result_customer= $this->db->query($sqlQueryCustomer);
        return $this->db->insert_id;
    }

    // public function read_company_customer()
    // {
    //     $sqlReadQueryCustomer = "SELECT * FROM $this->db_table_customer WHERE contact_person_designation IS NOT NULL";
    //     //print_r($sqlReadQueryCustomer);die;
    //     $this->result_customer= $this->db->query($sqlReadQueryCustomer);
    //     return $this->result_customer;
    // }
    public function read_company_customer()
    {
        $sqlReadQueryCustomer = "SELECT
        customer.id,
        customer.name,
        customer.users,
        customer.address1,
        customer.address2,
        customer.address3,
        customer.mobile_number,
        customer.email_id,
        customer.website,
        customer.director_name,
        customer.director_mobile,
        customer.director_email_id,
        customer.type_of_industry,
        customer.gst,
        customer.pan,
        customer.tan,
        customer.contact_person_designation,
        users.username,
        users.password,
        users.user_type FROM customer JOIN users
        ON customer.users=users.id
        WHERE contact_person_designation IS NOT NULL";
        //echo $sqlQueryReadCustomer;die;
        $this->result_customer= $this->db->query($sqlReadQueryCustomer);
        return $this->result_customer;
    }
    // public function update_company_customer()
    // {
    //     $sqlQueryUpdateCustomer = "UPDATE $this->db_table_customer SET
    //      name = '$this->name'
    //     ,address1 = '$this->address1'
    //     ,address2 = '$this->address2'
    //     ,address3 = '$this->address3'
    //     ,mobile_number = '$this->mobile_number'
    //     ,email_id = '$this->email_id'
    //     ,website = '$this->website'
    //     ,director_name = '$this->director_name'
    //     ,director_mobile = '$this->director_mobile'
    //     ,director_email_id = '$this->director_email_id'
    //     ,type_of_industry = '$this->type_of_industry'
    //     ,gst = '$this->gst'
    //     ,pan = '$this->pan'
    //     ,tan = '$this->tan'
    //     ,username = '$this->username'
    //     ,password = '$this->password'
    //     ,contact_person_designation = '$this->contact_person_designation'
    //     WHERE id=$this->id";
    //     //print_r($sqlQueryCustomer);die;
    //     $this->result_customer= $this->db->query($sqlQueryUpdateCustomer);
    //     return $this->result_customer;
    // }
    public function update_company_customer()
    {
      $sqlQueryUpdateCustomer = "UPDATE customer JOIN users ON
      customer.users=users.id SET
      customer.name='$this->name',
      customer.address1='$this->address1',
      customer.address2='$this->address2',
      customer.address3='$this->address3',
      customer.mobile_number='$this->mobile_number',
      customer.email_id = '$this->email_id',
      customer.website = '$this->director_name',
      customer.director_name = '$this->director_name',
      customer.director_mobile = '$this->director_mobile',
      customer.director_email_id='$this->director_email_id',
      customer.type_of_industry = '$this->gst',
      customer.pan= '$this->pan',
      customer.tan='$this->tan',
      customer.contact_person_designation = '$this->contact_person_designation',
      users.username ='$this->username',
      users.password = '$this->password',
      users.user_type = '$this->user_type'
      WHERE customer.id = $this->id ";
        //echo $sqlQueryUpdateCustomer;die;
        $this->result_customer= $this->db->query($sqlQueryUpdateCustomer);
        return $this->result_customer;
    }
    public function delete_company_customer()
    {
      $sqlQueryDeleteCustomer = "DELETE FROM $this->db_table_customer WHERE id=$this->id";
      $this->result_customer= $this->db->query($sqlQueryDeleteCustomer);
      return $this->result_customer;
    }
}
