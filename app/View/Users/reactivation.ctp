<html>
<body>
<h1> Create Test <h1>
<?php
    echo $this->Form->create('reactivation');
    echo $this->Form->input('email', array('label' => 'Email:', 'type' => 'email'));
    echo $this->Form->end('Reactivate');
?>
</body>
</html>