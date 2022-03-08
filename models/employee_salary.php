<?php

class EmployeeSalary
{
    private $db;

    public $id;
    public $employee;
    public $month;
    public $no_of_leaves;
    public $salary;
    public $salary_deduction;
    public $gross_salary;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function create_employee_salary()
    {
        $sql_create = "INSERT INTO employee_salary(employee,month,no_of_leaves,salary,salary_deduction,gross_salary) values('$this->employee','$this->month','$this->no_of_leaves','$this->salary','$this->salary_deduction','$this->gross_salary')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_employee_salary()
    {
        $sql_read = "SELECT employee.name,employee_salary.employee,employee_salary.month,employee_salary.id,employee_salary.no_of_leaves,employee_salary.salary,employee_salary.salary_deduction,employee_salary.gross_salary FROM employee_salary
        JOIN employee ON employee.id=employee_salary.employee";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_read);
        return $this->result;
    }
    public function update_employee_salary()
    {
        $sql_update = "UPDATE employee_salary SET
        employee=$this->employee,
        month=$this->month,
        no_of_leaves=$this->no_of_leaves,
        salary=$this->salary,
        salary_deduction=$this->salary_deduction,
        gross_salary=$this->gross_salary
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function delete_employee_salary()
    {
        $sql_delete = "DELETE FROM employee_salary WHERE id=$this->id";
        $this->result = $this->db->query($sql_delete);
        return $this->result;
    }
}
