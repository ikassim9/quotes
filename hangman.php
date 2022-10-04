<?php
define("letters", "ABCDEFGHIJKLMNOPQRSTUVWXYZ");
session_start();

const quotes = array("App", "Television", "Hungry", "Basketball", "Hangman");

$correctQuote = "basketball";

if(empty($_SESSION["test"])){
    resetGame();
}

// Creates HTML for the buttons.
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

// Creates HTML for the inputs.
function createInputs($correctQuote)
{
    for ($i = 0; $i < strlen($correctQuote); $i++) {
        echo "<span>" . "&nbsp;&nbsp" .$_SESSION["test"][$i] . "</span>";
     }
}

function getCurrentQuote()
{
}


// Updates the 'test' array and guesses.
function validateInputs()
{
    if(isset($_GET['letter-guess'])){ // If letter guess is set.

        $guess_letter = strtolower($_GET['letter-guess']); // Get the letter from the URL.

        if(in_array($guess_letter, $_SESSION["quote"])){ // If the letter is a correct guess, update 'test' array.
            updateArray($guess_letter);
        }
        else {
            $_SESSION["guesses"] = $_SESSION["guesses"] + 1; // If the letter is incorrect, add one to guesses.
        }
    }
}

// Use wpapi to break quote into base characters
function getBaseChars($quote) {
    $data = file_get_contents('https://wpapi.telugupuzzles.com/api/getBaseCharacters.php?input1='.$quote.'&input2=English');
    $santitizeData = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data);
    $decodedData = json_decode($santitizeData);
    return $decodedData->data;
}


//Updates session array for instance of the guess letter
function updateArray($letter)
{
    for ($index = 0; $index < count($_SESSION["quote"]); $index++ ) {
        if (strcmp($letter, $_SESSION["quote"][$index]) == 0) {
            $_SESSION["test"][$index] = strtoupper($letter);
        }

    }
}

// Calls validateInput and then sets the hangman image.
function setState()
{
    validateInputs();

    switch ($_SESSION["guesses"]) { // Checks how many bad guesses have been made and sets the image.
        case 0:
            echo "./css/images/gallow0.png";
            break;
        case 1:
            echo "./css/images/gallow1.png";
            break;
        case 2:
            echo "./css/images/gallow2.png";
            break;
        case 3:
            echo "./css/images/gallow3.png";
            break;
        case 4:
            echo "./css/images/gallow4.png";
            break;
        case 5:
            echo "./css/images/gallow5.png";
            break;
        default:
            echo "./css/images/gallow6.png";
            break;
    }
}

// Resets the session variables.
function resetGame()
{
    $_SESSION["quote"] = getBaseChars("basketball");
    $_SESSION["test"] = array("_", "_", "_", "_", "_", "_", "_", "_", "_", "_");
    $_SESSION["guesses"] = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link rel="stylesheet" href="./css/hangman_style.css"/>
</head>

<body>

 
 
    <div class="container">


        <div class="hangman-container">

            <div>
                <img src="<?php setState()?>" alt="Hangman full">
            </div>

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