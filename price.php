<?php
include "Nebulous.php";

$userBikeMake="Yamaha";
$userBikeModel="Bolt";

getAveragePrice($userBikeMake, $userBikeModel);

function getAveragePrice($bikeMake, $bikeModel)
{
$i=0;
$total=0;

$testing=(TOL_Nebulous::getInstance()->getCycles(
array(
"makeDisplayName" => $bikeMake,
"modelDisplayName" => $bikeModel,
"view" => "full"
)));

foreach ($testing["result"] as $cycle)
{
 $total = $total + $cycle["price"];
 $i++;
}

echo json_encode(
	array(
		"Make" => $bikeMake,
		"Model" => $bikeModel,
		"Price" => round($total/$i), 
	)
);



}


?>
