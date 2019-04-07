<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html>
<html>
<body>

<h1>Occurence in Dictionary</h1>

<form action="/assignment1/templateques1.php">
    <label for="wordsAndLength">Enter N and M with space in middle:</label>
    <br>
    <input type="text" name="wordsAndLength" id="wordsAndLength" value="">
    <div id="wordsContainer"></div>
    
    <label for="numberOfQueries">Enter number of queries:</label>
    <br>
    <input type="text" name="numberOfQueries" id="numberOfQueries" value="">
    <div id="queriesContainer"></div>
  <input type="submit" value="Submit">
</form> 
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>

<?php

if (isset($_GET['wordsAndLength'])) {
	// To get the value of number of words and length of each word.
	$words = $_GET['wordsAndLength'];
	// Specifying a pattern to get the values of word.
	$pattern = '/word[0-9]/';
	// Specifying a pattern to get query.
	$queryPattern = '/query[0-9]/';
	$words = [];
	// Creating an array of all words of dictionary.
	foreach($_GET as $key => $value) {
		if(preg_match($pattern, $key)) {
			$words[]= $value;
		}
	}

	foreach($_GET as $key => $value){
		if(preg_match($queryPattern, $key)) {
			$count = 0;
			$patternToSearch = $value;
			// Replacing the query wildcard character with a dot.
			$value = '/'.str_replace('?', '.', $value).'/';
			// Looping through the words array to check if the 
			// query pattern matches the words in words array.
			for($i = 0; $i < count($words); $i++) {
				if(preg_match($value, $words[$i])) {
					$count++;
				}
			}
			echo "Result of occurence of ".$patternToSearch. " is ". $count;
			echo "\n";
		}
	}
}
?>