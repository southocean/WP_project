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
        echo $this->Form->create('TestResult');
        foreach($listQues as $item){
            echo "<fieldset>";
            echo "  <legend>Question :".$item['ExamQuestion']['index']."</legend>";
            echo $item['Question']['qStatement'];
            echo "<br>";
            echo $this->Form->radio('Cau '.$item['ExamQuestion']['index'], array(
                'A' => ' A.'.$item['Question'][$transformOption[$item['ExamQuestion']['A']]],
                'B' => ' B.'.$item['Question'][$transformOption[$item['ExamQuestion']['B']]],
                'C' => ' C.'.$item['Question'][$transformOption[$item['ExamQuestion']['C']]],
                'D' => ' D.'.$item['Question'][$transformOption[$item['ExamQuestion']['D']]],
            ), array('legend' => false));
            echo "</fieldset>";
        }
        
        echo $this->Form->end('Submit answers');

    }


?>
</body>
</html>