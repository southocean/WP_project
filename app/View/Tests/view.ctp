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
        echo "Test code: ".$test['Test']['testID'];
        echo "<br>Subject: ".$test['Subject']['sbName'];
        echo "<br>Teacher:".$test['User']['username'];
        echo "<br>Level: ".$test['Test']['testLevel'];
        echo "<br>Number Questions: ".count($listQues);
        echo "</fieldset>";
        
        
        foreach($listQues as $item){
            echo "<fieldset>";
            echo "  <legend>Question :".$item['ExamQuestion']['index']."</legend>";
            echo $item['Question']['qStatement'];
            echo "<br>A.".$item['Question'][$transformOption[$item['ExamQuestion']['A']]];
            echo "<br>B.".$item['Question'][$transformOption[$item['ExamQuestion']['B']]];
            echo "<br>C.".$item['Question'][$transformOption[$item['ExamQuestion']['C']]];
            echo "<br>D.".$item['Question'][$transformOption[$item['ExamQuestion']['D']]];
            echo "</fieldset>";
        }
    }
    
?>
</body>
</html>