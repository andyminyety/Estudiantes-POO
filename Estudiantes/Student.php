<?php

    class Estudiantes{

        public $Id;
        public $Nombre;
        public $Apellido;
        public $Carreras;
        public $ProfilePhoto;
        public $Materias;
        public $Status;
        public function __construct($id,$nombre,$apellido,$carreras,$materias,$status)
        {

            $this->Id = $id;
            $this->Nombre = $nombre;
            $this->Apellido = $apellido;
            $this->Carreras = $carreras;
            $this->Materias = $materias;
            $this->Status = $status;         
        }
    }
    
?>