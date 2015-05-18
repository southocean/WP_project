<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <title>
        CakePHP: the rapid development php framework:
        Users   </title>
    <link href="/WP_project/favicon.ico" type="image/x-icon" rel="icon">
    <link href="/WP_project/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/WP_project/css/cake.generic.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/WP_project/css/stylesMenu.css">
    <script type="text/javascript" src="/WP_project/js/jquery-1.11.2.min.js"></script>
    

    <?php
        echo $this->Html->css('timer');
        echo $this->Html->css('style');
        echo $this->Html->script('timer');
        echo "<script> var time = ". $testInfo['Test']['time'] ."</script>";
    ?>

    <script type="text/javascript">
    // tính thời gian làm bài
    $(document).ready(function () {

      $('#timer-7').timer({duration: time, unit: 'm'});
      document.write(duration);
    })
    </script>

</head>


<body>
<h1> View Test </h1>

<div class="question">
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
        echo "<br>Time: ".$testInfo['Test']['time']." minutes";
        echo "<br>Number Questions: ".count($listQues);
        echo "</fieldset>";
        echo "<div class=\"count-time\" style=\"margin-top:-30px;margin-left:70%; position: fixed; float:left\">";
        echo "<div id=\"timer-7\"></div></div>";
        
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
</div>

<!-- <span id="countdown" class="timer"></span> -->
<?php
	echo  "<script>var miutes = ".$testInfo['Test']['time']."</script>";
?>
<script>
	seconds = miutes * 60;
	//seconds = 3;	
    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;
    }
    //document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        window.alert("Bạn đã hết thời gian làm bài! \n Click OK to get result.");
        document.getElementById("TestResultMakeTestForm").submit();
    } else {
        seconds--;
    }
    }
    var countdownTimer = setInterval('secondPassed()', 1000);
</script>
</body>
</html>
