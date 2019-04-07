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

<form action="/assignment1/action.php">
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