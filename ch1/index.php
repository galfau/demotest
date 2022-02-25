<?php
/**
* Given a list of products such as 'name', 'unit price', 'quantity',
*
* - write a script to display the products sorted by prices, the most expensive first
* - if 2 products have the same price, sort by quantities, the highest first
* - bonus: display in your sorted list of products the total price per product (quantity * unit price)
*/

$products = [
	['Milk', '1.25', 2],
	['Eggs', '4.99', 1],
	['Granulated sugar', '1.25', 1],
	['Broccoli', '2.34', 3],
	['Chocolate bar', '1.25', 5],
	['Organic All-purpose flour', '4.99', 2]
];

usort($products, function($x, $y) {

	// if the unit price is equal use quantity
	if($x[1] == $y[1]){
		return $y[2] - $x[2];
	}

    return $y[1] - $x[1];
});

echo str_pad("NAME", 40) . "\t" . str_pad("UNIT PRICE", 10) . "\t" . str_pad("QTY", 10) . "\t" . "TOTAL\r\n";

foreach($products as $p){
	$total = $p[1] * $p[2];
	$name = str_pad($p[0], 40);
	$price = str_pad($p[1], 10);
	$qty = str_pad($p[2], 10);
	echo "{$name}\t\${$price}\t{$qty}\t\${$total}\r\n";
}