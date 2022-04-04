<?php
class Employee
{
    private $db;
    public $db_table_employee = "employee";
    public $db_table_user = "users";

    public $id;
    public $name;
    public $email;
    public $mobile;
    public $address;
    public $username;
    public $password;
    // public $user_type;
    public $users;
    public $adhaar_no;
    public $pan_no;
    public $bank_name;
    public $branch;
    public $ifsc;
    public $account_no;
    public $photo;
    public $salary;
    public $position;
    public $result_create_user;
    public $result_single_read_employee;
    public $result_create_employee;
    public $result_read_employee;
    public $result_update_employee;
    public $result_delete_employee;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function read_single_employee()
    {
        $sqlQueryReadEmployee = "SELECT * FROM employee WHERE mobile=".$this->mobile;
        $this->result_single_read_employee= $this->db->query($sqlQueryReadEmployee);
        return $this->db;
    }
    public function read_single_employee_by_id()
    {
        $sqlQueryReadEmployee = "SELECT * FROM employee WHERE id=$this->id";
        $this->result_single_read_employee= $this->db->query($sqlQueryReadEmployee);
        return $this->result_single_read_employee;
    }
    public function login_employee()
    {
        $sqlQueryReadEmployee = "SELECT
        employee.id as employee_id,
        users.id,
        users.username,
        users.password,
        users.user_type
        FROM users
        JOIN employee
        ON employee.users = users.id
        WHERE
        users.username='".$this->username."'
        and users.password='".$this->password."'";
        //print_r($sqlQueryReadCustomer);die;
        $login_employee= $this->db->query($sqlQueryReadEmployee);
        return $login_employee;
    }
    public function create_employee_user()
    {
      $sqlQueryCreateUser = "INSERT INTO users(username,password,user_type) VALUES('$this->username','$this->password','$this->position')";
      //echo $sqlQueryCreateEmployee;die;
      $this->result_create_user = $this->db->query($sqlQueryCreateUser);
      return $this->db->insert_id;
    }
    public function create_employee()
    {
      $sqlQueryCreateEmployee = "INSERT INTO employee(users,name,mobile,email,address,position,adhaar_no,pan_no,bank_name,branch,ifsc,account_no,photo,salary) VALUES('$this->users','$this->name','$this->mobile','$this->email','$this->address','$this->position','$this->adhaar_no','$this->pan_no','$this->bank_name','$this->branch','$this->ifsc','$this->account_no','$this->photo','$this->salary')";
      //echo $sqlQueryCreateEmployee;die;
      $this->result_create_employee = $this->db->query($sqlQueryCreateEmployee);
      return $this->result_create_employee;
    }
    public function read_employee()
    {
      $sqlQueryReadEmployee =
      "SELECT employee.id,employee.users,employee.name,employee.email,employee.mobile,employee.address,employee.position,employee.adhaar_no,employee.pan_no,employee.bank_name,employee.branch,employee.ifsc,employee.account_no,employee.photo,employee.salary,users.username,users.password,users.user_type FROM employee
      JOIN users ON employee.users=users.id";
      //echo $sqlQueryCreateEmployee;die;
      $this->result_read_employee = $this->db->query($sqlQueryReadEmployee);
      return $this->result_read_employee;
    }
    public function update_employee_without_photo()
    {
      $sqlQueryUpdateEmployee = "UPDATE employee
      INNER JOIN
      users
      ON employee.users = users.id
      SET employee.name = '$this->name',
      employee.email = '$this->email',
      employee.mobile = '$this->mobile',
      employee.address = '$this->address',
      employee.position = '$this->position',
      employee.adhaar_no = '$this->adhaar_no',
      employee.pan_no = '$this->pan_no',
      employee.bank_name = '$this->bank_name',
      employee.branch = '$this->branch',
      employee.ifsc = '$this->ifsc',
      employee.account_no = '$this->account_no',
      employee.salary = '$this->salary',
      users.username = '$this->username',
      users.password = '$this->password',
      users.user_type = '$this->position'
      WHERE employee.id=$this->id";
      //echo $sqlQueryUpdateEmployee;die;
      $this->result_update_employee = $this->db->query($sqlQueryUpdateEmployee);
      return $this->result_update_employee;
    }
    public function update_employee_with_photo()
    {
      $sqlQueryUpdateEmployee = "UPDATE employee
      INNER JOIN
      users
      ON employee.users = users.id
      SET employee.name = '$this->name',
      employee.email = '$this->email',
      employee.mobile = '$this->mobile',
      employee.address = '$this->address',
      employee.position = '$this->position',
      employee.adhaar_no = '$this->adhaar_no',
      employee.pan_no = '$this->pan_no',
      employee.bank_name = '$this->bank_name',
      employee.branch = '$this->branch',
      employee.ifsc = '$this->ifsc',
      employee.account_no = '$this->account_no',
      employee.photo = '$this->photo',
      employee.salary = '$this->salary',
      users.username = '$this->username',
      users.password = '$this->password',
      users.user_type = '$this->position'
      WHERE employee.id=$this->id";
      //echo $sqlQueryUpdateEmployee;die;
      $this->result_update_employee = $this->db->query($sqlQueryUpdateEmployee);
      return $this->result_update_employee;
    }
    public function delete_employee()
    {
      $sqlQueryDeleteEmployee = "DELETE users,employee FROM users  INNER JOIN employee
      WHERE users.id= employee.users AND employee.id='$this->id'";
      $this->result_delete_employee = $this->db->query($sqlQueryDeleteEmployee);
      return $this->result_delete_employee;
    }
    public function read_employee_by_position()
    {
      $sqlQueryReadPosition = "SELECT * FROM employee WHERE position='$this->position'";
      //echo $sqlQueryReadPosition;die;
      $this->result_read_employee = $this->db->query($sqlQueryReadPosition);
      return $this->result_read_employee;
    }
}
