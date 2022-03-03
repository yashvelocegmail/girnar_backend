<?php

class Vacancies
{
    private $db;
    public $db_table = "vacancies";

    public $id;
    public $position;
    public $no_of_vacancies;
    public $skills;
    public $result;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_vacancies()
    {
        $sql_create = "INSERT INTO $this->db_table(position,no_of_vacancies,skills) VALUES ('$this->position','$this->no_of_vacancies','$this->skills')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_vacancies()
    {
        $sql_create = "SELECT * FROM $this->db_table";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->result;
    }
    public function update_vacancies()
    {
        $sql_update = "UPDATE $this->db_table SET
        position='$this->position',
        no_of_vacancies=$this->no_of_vacancies,
        skills='$this->skills'
        WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }

    public function delete_vacancies()
    {
        $sql_delete = "DELETE FROM $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_delete);
        return $this->result;
    }
}
