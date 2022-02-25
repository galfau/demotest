<?php

/**
* Write a function that validates a Universal Product Code (UPC).
*
* UPC codes are always 12 numeric digits.
*
* The final digit of a UPC is a check digit computed as follows:
*
* 1. Add the digits in the odd-numbered positions from the right (first, third, fifth, etc. - not including the check
* digit) together and multiply by three.
* 2. Add the digits (up to but not including the check digit) in the even-numbered positions (second, fourth, sixth,
* etc.) to the result.
* 3. Take the remainder of the result divided by 10 (ie. the modulo 10 operation). If the remainder is equal to 0 then
* use 0 as the check digit, and if not 0 subtract the remainder from 10 to derive the check digit.
*
* Example 1:
* - Input: 012345678905
* - Output: true
*
* Example 2:
* - Input: 01234567a905
* - Output: false
*
* Example 3:
* - Input: 036000241457
* - Output: true
*
* Example 4:
* - Input: 01
* - Output: false
*
* Example 5:
* - Input: 010101010105
* - Output: true
*
* @param string $upc
*
* @return bool
*/

function isValid(string $upc) {
	if(strlen($upc) != 12 || !is_numeric($upc)){
		return false;
	}

	$check = substr($upc, -1);
	$data = substr($upc, 0, -1);

	$odds = 0;
	$evens = 0;

	for($i = 0; $i <= (strlen($data) -1); $i++){
		if ($i % 2) {
			$evens += $data[$i];
		}else{
			$odds += $data[$i] * 3;
		}
	}

	$sum = $odds + $evens;
	$div = $sum % 10;
	$result = $div == 0 ? 0 : 10 - $div;

	if($result == $check){
		return true;
	}

	return false;
}

function optimizedValidation(string $upc){
	if(strlen($upc) != 12 || !is_numeric($upc)){
		return false;
	}

	$calc = 0;
	for ($i = 0; $i < (strlen($upc) - 1); $i++) {
		$calc += $i % 2 ? $upc[$i] * 1 : $upc[$i] * 3;
	}
	if (substr(10 - (substr($calc, -1)), -1) != substr($upc, -1)) {
		return false;
	} else {
		return true;
	}
}



$examples = [
	['012345678905', true],
	['01234567a905', false],
	['036000241457', true],
	['01', false],
	['010101010105', true],
];

echo "
#############################################
ATTEMPT 1 RAW
#############################################
";
foreach($examples as $ex){
	$shouldBe = "SHOULD BE ". ($ex[1] ? "TRUE" : "FALSE");
	$testResult = isValid($ex[0]) == $ex[1] ? 'PASSED' : 'FAILED';
	$data = str_pad($ex[0], 12);

	echo "UPC:\t{$data}\t{$shouldBe}\t\tTEST {$testResult}\r\n";
}

echo "
#############################################
ATTEMPT 2 OPTIMIZED
#############################################
";
foreach($examples as $ex){
	$shouldBe = "SHOULD BE ". ($ex[1] ? "TRUE" : "FALSE");
	$testResult = optimizedValidation($ex[0]) == $ex[1] ? 'PASSED' : 'FAILED';
	$data = str_pad($ex[0], 12);

	echo "UPC:\t{$data}\t{$shouldBe}\t\tTEST {$testResult}\r\n";
}