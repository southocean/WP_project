<html>
<body>
<h1> Create Test <h1>
<?php
    echo $this->Form->create('Test');
    echo $this->Form->input('subjects', array('label' => 'Subject:'));
    echo $this->Form->input('testLevel', array('label' => 'Test\'s level:'));
    echo $this->Form->input('time', array('label' => 'Thời gian làm bài:'));
    echo $this->Form->input('numberQuestion', array('label' => 'Số lượng câu hỏi:'));

    echo $this->Form->end('Create Test');
?>
</body>
</html>