<?php
    class Database{
        public $db;
        public function get_connection(){
            $this->db=null;
            try{
                $this->db= new mysqli('localhost','root','','girnar_backend');
            }
            catch(Exception $e)
            {
                echo "Database Cannot Be Connected";
            }
            return $this->db;
        }
    }