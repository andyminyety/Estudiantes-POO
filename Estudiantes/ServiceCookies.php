<?php

 class ServiceCookies{   

    private $CookieName;
    private $Utilities;

    public function __construct(){
        session_start();
        $this->CookieName = "Estudiantes";
        $this->Utilities = new Utilities();
    }

    public function Add($item){

        $Students = $this->GetList();
        $StudentId = 1;

        if(!empty($Students)){
            $lastElement = $this->Utilities->GetLastElement($Students);

            $StudentId = $lastElement->Id + 1;
        }
        $item->ProfilePhoto = "";  
        $item->Id = $StudentId;
    
        if(isset($_FILES["ProfilePhoto"])){

            $photoFile = $_FILES["ProfilePhoto"];
            if($photoFile["error"] == 4){
                $item->ProfilePhoto = "";
            }else{
                $typeReplace =str_replace("image/","",$_FILES["ProfilePhoto"]["type"]);
                $type = $_FILES["ProfilePhoto"]["type"];
                $size = $_FILES["ProfilePhoto"]["size"];
                $nombre =  $StudentId . '.'. $typeReplace;
                $tmpname = $photoFile["tmp_name"];
    
                $success= $this->Utilities->uploadImage("../assets/Img/Estudiante/",$nombre,$tmpname,$type,$size);
    
                if($success){
                    $item->ProfilePhoto= $nombre;
                }
            }
        }

        array_push($Students, $item);        

        setcookie($this->CookieName,json_encode($Students),$this->GetCookieTime(), "/");

    }

    public function Edit($item){   

        $Students = $this->GetList();
        $index = $this->Utilities->GetIndexElement($Students,"Id",$item->Id);

        if(isset($_FILES["ProfilePhoto"])){

            $photoFile = $_FILES["ProfilePhoto"];

            if($photoFile["error"]== 4){
                
                $item->ProfilePhoto = $index->ProfilePhoto;

            }else{
                
                $typeReplace =str_replace("mage/","",$_FILES["ProfilePhoto"]["type"]);
                $type = $_FILES["ProfilePhoto"]["type"];
                $size = $_FILES["ProfilePhoto"]["size"];
                $nombre =  $index . ".". $typeReplace;
                $tmpname = $photoFile["tmp_name"];
    
                $success= $this->Utilities->uploadImage("../assets/Img/Estudiante/",$nombre,$tmpname,$type,$size);
    
                if($success){
                    $item->ProfilePhoto= $nombre;
                }
            }
        }

        if($index !== null){
            $Students[$index] = $item;

            setcookie($this->CookieName,json_encode($Students),$this->GetCookieTime(), "/");    
        }             
    }

    public function ver($item){
        
        $Students = $this->GetList();
        
        $index = $this->Utilities->GetIndexElement($Students,"Id",$item->Id);
        if(isset($_FILES["ProfilePhoto"])){

            $photoFile = $_FILES["ProfilePhoto"];
            if($photoFile["error"]== 4){
                $item->ProfilePhoto = $index->ProfilePhoto;
            }else{
                $typeReplace =str_replace("mage/","",$_FILES["ProfilePhoto"]["type"]);
                $type = $_FILES["ProfilePhoto"]["type"];
                $size = $_FILES["ProfilePhoto"]["size"];
                $nombre =  $index . ".". $typeReplace;
                $tmpname = $photoFile["tmp_name"];
    
                $success= $this->Utilities->uploadImage("../assets/Img/Estudiante/",$nombre,$tmpname,$type,$size);
    
                if($success){
                    $item->ProfilePhoto = $nombre;
                }
            }
        }

        if($index !== null){
            $Students[$index] = $item;

            setcookie($this->CookieName,json_encode($Students),$this->GetCookieTime(), "/");    
        } 
    }

    public function Delete($id){
        $Students = $this->GetList();

        $index = $this->Utilities->GetIndexElement($Students,"Id",$id);

        if(count($Students) > 0){
            unset($Students[$index]);
            
            setcookie($this->CookieName,json_encode($Students),$this->GetCookieTime(), "/");
        }
    }

    public function GetById($id){

        $Students = $this->GetList();

        $Student = $this->Utilities->SearchProperty($Students,"Id",$id);     
        
        return $Student[0];
    }

    public function GetList(){

       $Students = array();

       if(isset($_COOKIE[$this->CookieName])){

         $Students =(array) json_decode($_COOKIE[$this->CookieName]); 

       }
       return $Students;
    }

    private function GetCookieTime(){
        return time() + 60 * 60 * 24 * 30;
    }     
}

?>