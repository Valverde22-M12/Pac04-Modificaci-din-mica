<?php
require("class.pdofactory.php");
require("abstract.databoundobject.php");
require("class.Datos.php");


$strDSN = "pgsql:dbname=buscador;host=localhost;port=5433";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "postgres", array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$objDatos = new Datos($objPDO);
// $objDatos->setParaula("peluche")->setTotal(1)->setUltimaVista(date("Y-m-d"));
// $objDatos->setParaula("movil")->setTotal(6)->setUltimaVista(date("Y-m-d"));
// $objDatos->setParaula("twitter")->setTotal(8)->setUltimaVista(date("Y-m-d"));
// $objDatos->setParaula("steam")->setTotal(2)->setUltimaVista(date("Y-m-d"));
// $objDatos->setParaula("alpinista")->setTotal(1)->setUltimaVista(date("Y-m-d"));


$objDatos->Save();

print "Id: " . $objDatos->getID() . "<br />";
print "Paraula: " . $objDatos->getParaula() . "<br />";
print "Total: " . $objDatos->getTotal() . "<br />";
print "Ultima visita: " . $objDatos->getUltimaVisita() . "<br />";




?>