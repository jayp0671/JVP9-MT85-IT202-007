<?php
function bePositive($arr) {
    echo "Processing Array:<br><pre>" . var_export($arr, true) . "</pre>";
    echo "Positive output:<br>";
    
    foreach ($arr as $value) {
        $positiveValue = $value >= 0 ? $value : abs($value);
        echo var_export($positiveValue, true) . "<br>";
    }
}

echo "Problem 3: Be Positive<br>";
?>
<table>
    <thead>
        <th>A1</th>
        <th>A2</th>
        <th>A3</th>
        <th>A4</th>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php bePositive($a1); ?>
            </td>
            <td>
                <?php bePositive($a2); ?>
            </td>
            <td>
                <?php bePositive($a3); ?>
            </td>
            <td>
                <?php bePositive($a4); ?>
            </td>
        </tr>
    </tbody>
</table>
<style>
    table {
        border-spacing: 2em 3em;
        border-collapse: separate;
    }

    td {
        border-right: solid 1px black;
        border-left: solid 1px black;
    }
</style>
