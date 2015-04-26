<html>
<body>
<h1> Create Test <h1>
<?php
    echo $this->Form->create('Test');
    echo $this->Form->input('sbID', array('label' => 'Subject:'));
    echo $this->Form->input('testLevel', array('label' => 'Test\'s level::'));
    echo $this->Form->input('numberQuestion', array('label' => 'Number of question:'));

    echo $this->Form->end('Create Test');
?>
</body>
</html>