<html>
<head>
    <?php //echo $menuBuilder->build('main-menu');?>
</head>
<body>
<h1> Kết quả bài test <h1>

<?php
    $transformOption = array('1'=>'option_1', '2'=>'option_2', '3'=>'option_3', '4'=>'option_4');
    echo "<p>";
    if($listQues == NULL ){
        echo "<h2>Please make test first!</h2>";
    } else {
        echo "<div id=\"testInfo\"><p>";
        echo "<fieldset>";  
        echo "  <legend>TEST INFO</legend>";
        echo "Test code: ".$testInfo['Test']['testID'];
        echo "<br>Subject: ".$testInfo['Subject']['sbName'];
        echo "<br>Teacher:".$testInfo['User']['username'];
        echo "<br>Level: ".$testInfo['Test']['testLevel'];
        echo "<br>Number Questions: ".count($listQues);
        echo "</fieldset>";
        echo "</p></div>";
        echo "<div id=\"testResuMark\"><p>";
        echo "Số câu trả lời đúng: ".$trueAns."<br>";
        echo "Điểm: ".round(10*($trueAns/count($listQues)), 2);
        echo "</p></div>";

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
            echo "<h2 style=\"color:".$color."\"> A.".$item['Question'][$transformOption[$item['ExamQuestion']['A']]]."</h2><br>";
            echo "<h2 style=\"color:".$color."\"> B.".$item['Question'][$transformOption[$item['ExamQuestion']['B']]]."</h2><br>";
            echo "<h2 style=\"color:".$color."\"> C.".$item['Question'][$transformOption[$item['ExamQuestion']['C']]]."</h2><br>";
            echo "<h2 style=\"color:".$color."\"> D.".$item['Question'][$transformOption[$item['ExamQuestion']['D']]]."</h2><br>";
            
            echo "</fieldset>";
        }

    }
?>
</body>
</html>