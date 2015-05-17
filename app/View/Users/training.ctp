<html>
<head>
</head>

<body>
<h1> Training <h1>
    <div class="jumbotron">
<?php
    
    echo $this->Form->create('TrainingSubmit');
    $item = $question;
    echo "<fieldset>";
    echo 'Câu hỏi: '.$item['Question']['qStatement'];
    echo "<br>";
    echo $this->Form->radio($item['Question']['qID'], array(
        '1' => ' A.'.$item['Question']['option_1'],
        '2' => ' B.'.$item['Question']['option_2'],
        '3' => ' C.'.$item['Question']['option_3'],
        '4' => ' D.'.$item['Question']['option_4'],
    ), array('legend' => false));
    echo "</fieldset>";
    
    
    echo $this->Form->end('Submit answers');
?>
    </div>
</body>
</html>
