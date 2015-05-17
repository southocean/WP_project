<html>
<head>
	<?php
		echo $this->Html->css('timer');
		echo $this->Html->css('style');
		echo $this->Html->script('timer');
		echo "<script> var time = ". $testInfo['Test']['time'] ."</script>";
	?>

	<script type="text/javascript">

    $(document).ready(function () {

      $('#timer-7').timer({duration: time, unit: 'm'});
      document.write(duration);
    })

  </script>
</head>

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
        echo "<br>Time: ".$testInfo['Test']['time']." minutes";
        echo "<br>Number Questions: ".count($listQues);
        echo "</fieldset>";

        echo "<div class=\"container\" style=\"margin-top:30px;\">";
    	echo "<div class=\"row\"><div class=\"col col-12\"><div class=\"col col-1-3\"><div id=\"timer-7\"></div></div></div></div></div>";
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

<!-- <span id="countdown" class="timer"></span> -->
<?php
	echo  "<script>var miutes = ".$testInfo['Test']['time']."</script>";
?>
<script>
	seconds = miutes * 60;
	seconds = 3;	
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
