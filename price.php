<?php
include "Nebulous.php";

$userBikeMake="Yamaha";
$userBikeModel="Bolt";
if (isset($_GET['make'])) {
    $userBikeMake = $_GET['make'];
}
if (isset($_GET['model'])) {
    $userBikeModel = $_GET['model'];
}

getAveragePrice($userBikeMake, $userBikeModel);

function getAveragePrice($bikeMake, $bikeModel)
{
$i=0;
$total=0;

$testing=(TOL_Nebulous::getInstance()->getCycles(
array(
"makeDisplayName" => $bikeMake,
"modelDisplayName" => $bikeModel,
"minYear" => "2012",
"maxYear" => "2012",
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
/*

Sample javascript
$.ajax({
'url' : 'price.php',
'dataType':'json',
data: {
    make: 'Honda',
    model: 'Gold Wing',
    year: 2012
},
success: function(data){
$('input#price').val(data.Price);
console.log(data.Price);
}
});

*/

?>
