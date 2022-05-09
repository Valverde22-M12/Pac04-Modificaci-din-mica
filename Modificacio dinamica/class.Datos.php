<?php

class Datos extends DataBoundObject {

        protected $ID;
        protected $Paraula;
        protected $Total;
        protected $UltimaVisita;


        protected function DefineTableName() {
                return("datos");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "ID",
                        "paraula" => "Paraula",
                        "total" => "Total",
                        "ultima_visita" => "UltimaVisita"));
        }
}


?>