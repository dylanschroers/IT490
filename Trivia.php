<?php
require('functions.php');
require('header.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="triviastyle.css">
        <title>Trivia Game</title>
    </head>
    <body>
        <h1>Trivia Game</h1>
        <p style="text-align:center">
            Select which TV show you want to attempt.
            During this game, select the option with the correct answer (either a, b, or c).
            You will see your results at the end.
            Now lets see how well you know your shows!
        </p>
        
        <div class="container">
            <main>

                <form action="TriviaGame.php" method="post">
                    <label for="topic">Choose a show:</label>
                    <select id="topic" name="topic">
                        <option value="Mandolorian">Mandolorian</option>
                        <option value="South Park">South Park</optoin>
                    </select>
                    <button type="submit">Start Game</button>
                </form>
            </main>
        </div>
    </body>
</html>