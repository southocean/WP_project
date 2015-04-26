<html lang="vi">
<head>
    <meta charset="iso-8859-1" />
</head>
<body>
<h1> List Question <h1>
    <?php
        echo "<p>";
        if($questions==NULL){
            echo "<h2>Dada Empty</h2>";
        } else {
            echo "<table>
                <tr>
                    <th>id</th>
                    <th>Statement</th>
                    <th>Topic</th>
                    <th>Subject</th>
                    <th>Created time</th>
                </tr>";
            foreach($questions as $item){
                echo "<tr>";
                echo "<td>".$item['Question']['qID']."</td>";
                echo "<td><a href='questions/view/".$item['Question']['qID']."' >".$item['Question']['qStatement']."</a></td>";
                echo "<td>".$item['Topic']['topName']."</td>";
                echo "<td>".$item['Subject']['sbName']."</td>";
                echo "<td>".$item['Question']['created']."</td>";
                echo "</tr>";
            }
        }
        echo "</p><p>";
        echo $this->Html->link('Add question', array('controller' => 'Questions','action' => 'add'));
        echo "</p>";
    ?>
</body>
</html>