<html>
<body>
<h1> List Test <h1>

<?php
    echo "<p>";
    if($listTest == NULL){
        echo "<h2>Dada Empty</h2>";
    } else {
        echo "<table> 
        	<tr>"; 
        		echo "<th>";echo $this->Paginator->sort('testID', 'ID'); echo " </th>";
        		echo "<th>";echo $this->Paginator->sort('sbID', 'Subject'); echo " </th>";
        		echo "<th>";echo $this->Paginator->sort('username', 'Teacher'); echo " </th>";
        		echo "<th>";echo $this->Paginator->sort('testLevel', 'Level'); echo " </th>";
        		echo "<th>";echo $this->Paginator->sort('created', 'Created'); echo " </th>";
        		echo "
    		</tr>";
        foreach($listTest as $item){
            echo "<tr>";
            echo "<td>".$this->Html->link($item['Test']['testID'], array('controller' => 'Users','action' => 'makeTest', $item['Test']['testID']))."</td>";
            //echo "<td><a href='view/".$item['Test']['testID']."' >".$item['Test']['testID']."</a></td>";
            echo "<td>".$item['Subject']['sbName']."</td>";     
            echo "<td>".$item['User']['username']."</td>";
            echo "<td>".$item['Test']['testLevel']."</td>";
            echo "<td>".$item['Test']['created']."</td>";
            echo "</tr>";
        }
    }
    echo "</p><p>";
    echo $this->Html->link('Add Test', array('controller' => 'Test','action' => 'add'));

    echo "</p>";
?>
</body>
</html>