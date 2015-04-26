<html>
<body>
<h1> View Test <h1>

<?php
    $transformOption = array('1'=>'option_1', '2'=>'option_2', '3'=>'option_3', '4'=>'option_4');
    echo "<p>";
    if($listQues == NULL){
        echo "<h2>Dada Empty</h2>";
    } else {
        echo "<fieldset>";  
        echo "  <legend>TEST INFO</legend>";
        echo "Test code: ".$testInfo['Test']['testID'];
        echo "<br>Subject: ".$testInfo['Subject']['sbName'];
        echo "<br>Teacher:".$testInfo['User']['username'];
        echo "<br>Level: ".$testInfo['Test']['testLevel'];
        echo "<br>Number Questions: ".count($listQues);
        echo "</fieldset>";


        foreach($listQues as $item){
            if($item['state'] == 'true') {
                $color = "green";
                
            }
            else {
                $color = "red";
            }

            echo "<fieldset>";
            echo "  <legend>Question ".$item['ExamQuestion']['index'].":</legend>";
            echo $item['Question']['qStatement'];
            echo "<br>";
            
            
            echo "<h2 style=\"color:green\"> A.".$item['Question'][$transformOption[$item['ExamQuestion']['A']]]."</h2><br>";
            echo "<h2 style=\"color:green\"> B.".$item['Question'][$transformOption[$item['ExamQuestion']['B']]]."</h2><br>";
            echo "<h2 style=\"color:green\"> C.".$item['Question'][$transformOption[$item['ExamQuestion']['C']]]."</h2><br>";
            echo "<h2 style=\"color:green\"> D.".$item['Question'][$transformOption[$item['ExamQuestion']['D']]]."</h2><br>";
            
            echo "</fieldset>";
        }

    }


?>
</body>
</html>