<?php

class Table
{

    public function __construct($name)
    {
        $this->data = null;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    function getCountColumns()
    {
        return (int)mysqli_num_fields($this->data);
    }

    function getCountRows()
    {
        return (int)mysqli_num_rows($this->data);
    }

    function render()
    {
        $columnsCount = $this->getCountColumns();
        $tableData = $this->data;
        $fields = mysqli_fetch_fields($tableData);
        $cnt = 0;
        $class = '';
        echo "<table  id='customers' >";
        echo "<thead>";
        echo "<tr style='color:black;'>";
        foreach ($fields as $field) {

            echo '<th> <a style="color:black;" href="test.php">';
            echo $field->name;
            echo "</th>\n";
        }
        echo "</tr>\n";
        echo "</thead>\n";
        echo "<tbody>\n";
        while ($row = mysqli_fetch_array($tableData)) {
            $cnt++;

            if ($cnt % 2)
                $class = 'odd';

            else
                $class = 'even';
            echo "<tr >";
            for ($x = 0; $x < $columnsCount; $x++) {
                echo "<td class=$class >" . $row[$x] . "</td>\n";
            }
            echo "</tr>\n";
        }
        echo "</tbody>";
        echo "</table>";
    }

}

?>
