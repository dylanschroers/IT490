<?php
    
    $num_qs = 0;
    $score = 0;
    
    include 'TriviaGame.php';

    foreach ($questions as $question) {
        $user_answer = $_POST[$question['id']];
        if ($user_answer == $question['answer']) {
            $score++;
        }
        $num_qs ++;
    }


    function finalScore(int $qs, int $correct){
        $percent = ($correct/$qs)*100;
        echo "You scored: $correct out of $qs";
        if ($percent < 50){
            echo "Were you really watching?";
        }
        elseif ($percent < 75 && $percent >= 50){
            echo "You definitely paid attention";
        }
        elseif ($percent < 90 && $percent >= 75){
            echo "You know your stuff!";
        }
        elseif ($percent >= 90){
            echo "Did you write this show?! Outstanding!";
        }
    }

    echo finalScore($num_qs, $score);

?>
