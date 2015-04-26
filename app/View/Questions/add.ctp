<html>
<body>
<h1> Create Question <h1>
<?php
    echo $this->Form->create('Question');
    echo $this->Form->input('qStatement', array('label' => 'Question statement:'));
    echo $this->Form->input('option_1', array('label' => 'Option 1:'));
    echo $this->Form->input('option_2', array('label' => 'Option 2:'));
    echo $this->Form->input('option_3', array('label' => 'Option 3:'));
    echo $this->Form->input('option_4', array('label' => 'Option 4:'));
    echo $this->Form->input('qAns', array('label' => 'Answer:'));
    echo $this->Form->input('topics', array('label' => 'Topic:'));
    echo $this->Form->input('subjects', array('label' => 'Subject:'));

    echo $this->Form->end('Save Question');
?>
</body>
</html>