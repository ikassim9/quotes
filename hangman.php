<?php
define("letters", "ABCDEFGHIJKLMNOPQRSTUVWXYZ");

const quotes = array("App", "Television", "Hungry", "Basketball", "Hangman");

// $correctQuote = quotes[array_rand(quotes)]; // gets random key and then searches for the value fo that key in the array_rand
$correctQuote = "hungry";


function createButtons()
{
    $length = strlen(letters);

    for ($i = 0; $i < $length; $i++) {
        // this so to not put all letters in one line
        if ($i == 13) {
            echo "<br>";
            echo "<button type='submit' name='letter-guess' value='" . letters[$i] . "'>" . letters[$i] . "</button>";
        } else {
            echo "<button type='submit' name='letter-guess' value='" . letters[$i] . "'>" . letters[$i] . "</button>";
        }
    }
}

function createInputs($correctQuote)
{
    $length = strlen($correctQuote);
    $correctQuoteArray = str_split($correctQuote);
    $visibility = "hidden";

    for ($i = 0; $i < $length; $i++) {
        // this is so we have about 4 inputs max in each line
        if(validateInputs($correctQuote) == null){
            $visibility = "visible";
            echo "<span><span style='visibility:$visibility'>" . "&nbsp;&nbsp" .$correctQuoteArray[$i] . "</span></span>";

        }
        else{
            $visibility = "hidden";
            echo "<span><span style='visibility:$visibility'>" . "&nbsp;&nbsp" .$correctQuoteArray[$i] . "</span></span>";
        }
     }
}

function getCurrentQuote()
{
}



function validateInputs($correctQuote)
{
    $correctQuoteArray = str_split($correctQuote);
    if(isset($_GET['letter-guess'])){
    $guess_letter = $_GET['letter-guess'];
 

   // echo "guess letter is " . $guess_letter;
 

    if(in_array(strtolower($guess_letter), $correctQuoteArray)){
     $index = array_search(strtolower($guess_letter), $correctQuoteArray);
     return $guess_letter;
     }
     else{
        return null;
     }
    

    }
}



    // get input from keyboard and check against the array


 

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

 
 
    <div class="container">


        <div class="hangman-container">

            <div>
                <img src="./css/images/hangman- full.png" alt="Hangman full">
            </div>

            <div>You Lose, try again laters</div>

        </div>


        <div class="input-container">
           

            <?php


            createInputs($correctQuote);

            ?>
        </div>


        <div class="button-container">
        <form action="hangman.php" method="get">

            <?php
            createButtons();
         
            ?>
                </form>

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