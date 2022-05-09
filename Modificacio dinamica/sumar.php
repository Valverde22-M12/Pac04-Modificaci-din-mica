<?php
require("class.pdofactory.php");
require("abstract.databoundobject.php");
require("class.Datos.php");


$strDSN = "pgsql:dbname=buscador;host=localhost;port=5433";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "postgres", array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



if(isset($_POST["texto"])){
    $textoBusqueda = $_POST["texto"];
    
    $strQuery = "SELECT * FROM datos 
    WHERE paraula = '$textoBusqueda'";
    $objStatement = $objPDO->prepare($strQuery);
    $objStatement->execute();
    $arParaules = $objStatement->fetchAll(PDO::FETCH_ASSOC);

    foreach($arParaules as $value){
        $id = $value['id'];
        $total = $value['total'];
        $objDatoExistente = new Datos($objPDO, $id);            
        $objDatoExistente->setTotal($total+1)->setUltimaVista(date('d-m-y h:i:s'));
        $objDatoExistente->Save();
    }

    
}
?>