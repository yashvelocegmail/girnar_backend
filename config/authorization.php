<?php
class Authorization
{
    public $authorized=false;
    public function __construct()
    {
        $headers = getallheaders();
        //print_r($headers["Authorization"]);die;
        $authHeader = $headers["Authorization"];
        if($_COOKIE['token']==$authHeader)
        {
            $this->authorized="true";
            return $this->authorized;
        }
        else
        {
            $this->authorized="false";
            return $this->authorized;
        }
        
    }
}
?>