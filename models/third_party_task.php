<?php

class ThirdPartyTask
{
    private $db;
    public $db_table = "third_party_task";

    public $id;
    public $third_party;
    public $task_details;
    public $file_upload;
    public $time_required;
    public $remarks;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create_third_party_task()
    {
        $sql_create = "INSERT INTO $this->db_table(third_party,task_details,file_upload,time_required,remarks) VALUES('$this->third_party','$this->task_details','$this->file_upload','$this->time_required','$this->remarks')";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->db;
    }
    public function read_third_party_task()
    {
        $sql_create = "SELECT third_party_task.id
        ,third_party_task.task_details
        ,third_party_task.file_upload
        ,third_party_task.time_required
        ,third_party_task.remarks
        ,third_party_task.third_party
        ,third_party.name
        FROM $this->db_table JOIN third_party ON third_party.id=third_party_task.third_party";
        //echo $sql_create;die;
        $this->result = $this->db->query($sql_create);
        return $this->result;
    }
    public function update_third_party_task_with_file()
    {
        $sql_update = "UPDATE $this->db_table SET third_party='$this->third_party',task_details='$this->task_details',file_upload='$this->file_upload',time_required='$this->time_required',remarks='$this->remarks' WHERE id=$this->id";
      //  echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function update_third_party_task_without_file()
    {
        $sql_update = "UPDATE $this->db_table SET third_party='$this->third_party',task_details='$this->task_details',time_required='$this->time_required',remarks='$this->remarks' WHERE id=$this->id";
        //echo $sql_update;die;
        $this->result = $this->db->query($sql_update);
        return $this->result;
    }
    public function delete_third_party_task()
    {
        $sql_delete = "DELETE FROM $this->db_table WHERE id=$this->id";
        $this->result = $this->db->query($sql_delete);
        return $this->result;
    }
}
