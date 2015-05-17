<html>
<head>
</head>

<body>
<h1> Training <h1> <br>
    <div class="col-lg-10 col-md-10 col-sm-9 leaderboard">
    <div class="container-fluid">
    <div class="jumbotron">
    <?php
        
        echo $this->Form->create('TrainingNext');
        $item = $trainingResult;
        for($i = 1; $i < 5; $i++)  $style[$i] = '';
        if ($item['state'] == 'true') {
            echo '<h1>Bạn đã trả lời Đúng.</h1';
            $style[$item['Question']['qAns']] = 'color:green';
        } else {
            echo '<h1>Bạn đã trả lời Sai.</h1';
            $style[$item['userAns']] = 'color:red;text-decoration:line-through';
            $style[$item['Question']['qAns']] = 'color:green';
        }

        echo '<br><br>Câu hỏi: '.$item['Question']['qStatement'];
        echo "<br>";
        echo '<h3 style='.$style[1].'> A.'.$item['Question']['option_1']."</h3><br>";
        echo '<h3 style='.$style[2].'> B.'.$item['Question']['option_2']."</h3><br>";
        echo '<h3 style='.$style[3].'> C.'.$item['Question']['option_3']."</h3><br>";
        echo '<h3 style='.$style[4].'> D.'.$item['Question']['option_4']."</h3><br>";
        
        
        echo $this->Form->end('Next');
        echo $this->Form->create('TrainingFinish');
        echo $this->Form->hidden('flag', array('value' => 'Finish'));
        echo $this->Form->end('Finish', array('class' => 'custom-class', 'title' => 'Custom Title'));
    ?>
    </div></div></div>
</body>
</html>