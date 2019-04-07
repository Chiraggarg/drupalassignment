<?php

// To get the count of testcases.
$words = $_GET['testCases'];

// Looping equal to the number of test cases.
for($i = 0; $i < $words; $i++) {
	
	// Pattern to be searched in string.
	$pattern = '/'.$_GET["string2-".$i].'/';
	// Getting substring of source string on the basis if there is an index position also provided.
	$final_string = substr($_GET["string1-".$i], $_GET["index-".$i]);
	// Condition if the user provides Y.
	if($_GET['bool-'.$i] == 'Y') {
		preg_match($pattern, $final_string, $matches, PREG_OFFSET_CAPTURE);
		// To check if the string to be searched is at start or end of source of string.
		if($matches[0][1] == 0 || ($matches[0][1] + $_GET["index-".$i]) == (strlen($_GET["string1-".$i]) - strlen($_GET["string2-".$i]))) {
			// If nothing is found return no worries else return the position.
			if(!isset($matches[0])) {
				echo "No worries";
			} else{
				echo $matches[0][1] + $_GET["index-".$i];
			}
		}
		// There will be a change in pattern if the string is not found at starting or end.
		else {
			$pattern = '/ '.$_GET["string2-".$i].' /';
			preg_match($pattern, $final_string, $matches, PREG_OFFSET_CAPTURE);
			if(!isset($matches[0])) {
				echo "No worries";
			} else {
				echo $matches[0][1] + 1 + $_GET["index-".$i];
			}
		}
	}
	// Case where the user provides N.
	else {	
		preg_match($pattern, $final_string, $matches, PREG_OFFSET_CAPTURE);
		if (isset($matches[0])) {
			echo $_GET["index-".$i] + $matches[0][1];
		} else {
			echo "No worries";
		}
	}
	echo "\r\n";
}