<html>

<head>
</head>

<body>
<h1> Chấm Thi </h1>

<?php
    $transformOption = array('1'=>'option_1', '2'=>'option_2', '3'=>'option_3', '4'=>'option_4');
    echo "<p>";
    if(isset($listQues)) {
	    if($listQues == NULL){
	        echo "<h2>Dada Empty</h2>";
	    } else {
	        echo "<fieldset>";  
	        echo "  <legend>Thông tin bài Test</legend>";
	        echo "Test code: ".$testInfo['Test']['testID'];
	        echo "<br>Môn học: ".$testInfo['Subject']['sbName'];
	        echo "<br>Người tạo:".$testInfo['User']['username'];
	        echo "<br>Level: ".$testInfo['Test']['testLevel'];
	        echo "<br>Thời gian làm bài: ".$testInfo['Test']['time']." minutes";
	        echo "<br>Số lượng câu hỏi: ".count($listQues);
	        echo "</fieldset>";

	        
	        echo $this->Form->create('TestResult');
	        foreach($listQues as $item){
	            echo "<fieldset>";
	            echo "Question ".$item['ExamQuestion']['index'].": ";
	            echo $item['Question']['qStatement'];
	            echo "<br><br>";
	            echo $this->Form->select(
				    'Cau '.$item['ExamQuestion']['index'],
				    ['A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D'],	
				    ['empty' => '(choose anser)']
				);
	            echo "</fieldset>";
	        }
	        
	        echo $this->Form->end('Submit answers');

	    }
	}
    

?>