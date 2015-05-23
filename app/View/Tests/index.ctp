<html>
<head></head>
<body>
<h1> List Test </h1>
<?php
    echo "<p>";
    if($listTest == NULL){
        echo "<h2>Dada Empty</h2>";
    } else {
        echo "<table>";
        	echo "<tr>"; 
        		echo "<th>";echo $this->Paginator->sort('testID', 'ID'); echo " </th>";
        		echo "<th>";echo $this->Paginator->sort('sbID', 'Subject'); echo " </th>";
        		echo "<th>";echo $this->Paginator->sort('username', 'Teacher'); echo " </th>";
        		echo "<th>";echo $this->Paginator->sort('testLevel', 'Level'); echo " </th>";
        		echo "<th>";echo $this->Paginator->sort('created', 'Created'); echo " </th>";
                if(AuthComponent::User('role') != 'student') {
                    echo "<th>Edit</th>";
                    echo "<th>Delete</th>";
                }
    		echo "</tr>";
        foreach($listTest as $item){
            echo "<tr>";
            echo "<td>".$this->Html->link($item['Test']['testID'], array('controller' => 'Users','action' => 'makeTest', $item['Test']['testID']))."</td>";
            echo "<td>".$item['Subject']['sbName']."</td>";     
            echo "<td>".$item['User']['username']."</td>";
            echo "<td>".$item['Test']['testLevel']."</td>";
            echo "<td>".$item['Test']['created']."</td>";
            if(AuthComponent::User('role') != 'student') {
                echo "<td>".$this->Html->link('Edit', array('controller' => 'Tests','action' => 'edit', $item['Test']['testID']))."</td>";
                echo "<td>".$this->Html->link('Delete', array('controller' => 'Tests','action' => 'delete', $item['Test']['testID']), array('confirm' => 'Bạn có chắc muốn xóa bài test này không?'))."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    echo "</p><p>";
    if(AuthComponent::User('role') != 'student') {
        echo $this->Html->link('Add Test', array('controller' => 'Tests','action' => 'add'));
    }
    echo "</p>";
?>
</body>
</html>