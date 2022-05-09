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
    WHERE paraula like '$textoBusqueda%' ORDER BY total DESC LIMIT 5";
    $objStatement = $objPDO->prepare($strQuery);
    $objStatement->execute();
    $arParaules = $objStatement->fetchAll(PDO::FETCH_ASSOC);

    if(empty($arParaules)){
        $objDatos = new Datos($objPDO);
        $objDatos->setParaula($textoBusqueda)->setTotal(1)->setUltimaVista(date("d-m-y h:i:s"));
        $objDatos->Save();
    }else{
        $jsondata = array();
        foreach($arParaules as $value){
            $paraula = $value['paraula'];
            array_push($jsondata, $paraula);
        }
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsondata,JSON_FORCE_OBJECT);
    }
}

if(isset($_POST["submit"])){
    $textoBusqueda = $_POST["submit"];

    $strQuery = "SELECT * FROM datos 
    WHERE paraula like '$textoBusqueda%' ORDER BY total DESC LIMIT 5";
    $objStatement = $objPDO->prepare($strQuery);
    $objStatement->execute();
    $arParaules = $objStatement->fetchAll(PDO::FETCH_ASSOC);

    $jsondata = array();
    foreach($arParaules as $value){
        $id = $value['id'];
        $paraula = $value['paraula'];
        $total = $value['total'];
        $visita = $value['ultima_visita'];

        array_push($jsondata, $id, $paraula, $total, $visita);
    }
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsondata,JSON_FORCE_OBJECT);
}
?>