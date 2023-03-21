include results.php;
<?php

    $topic = $_POST['topic'];
    $questions = array();

    $showOptions = array(
        
        // questions & answers for The Mandolorian
        $mandolorian = array(
            array(
                'question' => 'Who Plays the Mandolorian?',
                'options' => array('Pedro Pascal', 'Ewan McGreggor', 'Alan Tudyk'),
                'answer' => 0
            ),
            array(
                'question' => 'Who weilds the darksaber?',
                'options' => array('Bo Katan', 'The Mandolorian', 'Moff Gideon'),
                'answer' => 1
            ),
            array(
                'question' => 'What is Baby Yodas real name?',
                'options' => array('Grogu', 'Yodu', 'Baby Yoda'),
                'answer' => 0
            ),
        ),

        // questions & answers for South Park
        $southpark = array(
            array(
            'question' => 'What color is Kyles hair?',
            'options' => array('Red', 'Blonde', 'Black'),
            'answer' => 0
            ),
            array(
                'question' => 'Who is Canadian?',
                'options' => array('Cartman', 'Ike', 'Butters'),
                'answer' => 1
            ),
            array(
                'question' => 'What does Randy do for work?', 
                'options' => array('Runs a Marijuana Farm', 'Teaches at South Park', 'He doesnt have a job'),
                'answer' => 0
            ),
        )
    );

    $selectedShow = $_POST['topic'];
    $questions = $showOptions[$selectedShow];
   
?>

<form action="results.php" method="post">
    <?php foreach ($questions as $i => $question) : ?>
        <h2><?php echo $question['question']; ?></h2>
        <?php foreach ($question['options'] as $j => $option) : ?>
            <label>
                <input type="radio" name="answer[<?php echo $i; ?>]" value="<?php echo $j; ?>">
                <?php echo $option; ?>
            </label>
        <?php endforeach; ?>
    <?php endforeach; ?>
    <button type="submit">Submit</button>
</form>

<?php $answers = $_POST['answer']; ?>