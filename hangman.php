<?php
define("letters", "ABCDEFGHIJKLMNOPQRSTUVWXYZ");

const quotes = array("App", "Television", "Hungry", "Basketball", "Hangman");

function createButtons()
{
    $length = strlen(letters);

    for ($i = 0; $i < $length; $i++) {
        // this so to not put all letters in one line
        if ($i == 13) {
            echo "<br>";
            echo "<button type='submit'>" . letters[$i] . "</button>";
        } else {
            echo "<button type='submit'>" . letters[$i] . "</button>";
        }
    }
}

function createInputs()
{
    $random_key = array_rand(quotes);
    $random_quote = quotes[$random_key];
    $length = strlen($random_quote);
    for ($i = 0; $i < $length; $i++) {
        // this is so we have about 4 inputs max in each line
 
            echo "<span>" .  $random_quote[$i] . "</span>";
        
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link rel="stylesheet" href="./css/hangman_style.css" />
</head>

<body>


    <form action="hangman.php"></form>


    <div class="container">

        <div class="input-container">
            <?php


            createInputs();

            ?>
        </div>


        <div class="button-container">


            <?php
            createButtons()
            ?>
        </div>

        <div class="stats-container">
            <div>
                Longest Streak: 0
            </div>


            <div>Current Streak: 0</div>

        </div>


    </div>


</body>

</html>