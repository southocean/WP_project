<html>
<body>
<h1> Create Subject <h1>
<?php
    echo $this->Form->create('Subject');
    echo $this->Form->input('sbName', array('label' => 'Subject\'s name:'));

    echo $this->Form->end('Save Subject');

?>
</body>
</html>