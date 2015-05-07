<html>
<head>
	
</head>
<body>
<h1> Chấm Thi </h1>


<?php 
	echo $this->Form->create('TestID');
    echo $this->Form->input('testID', array('label' => 'Test ID', 'type' => 'number', 'min' => '1'));
    echo $this->Form->submit('Lấy câu hỏi', array('class' => 'form-submit')); 
?>
</body>
