<?php
$a1 = [-1, -2, -3, -4, -5, -6, -7, -8, -9, -10];
$a2 = [-1, 1, -2, 2, 3, -3, -4, 5];
$a3 = [-0.01, -0.0001, -.15];
$a4 = ["-1", "2", "-3", "4", "-5", "5", "-6", "6", "-7", "7"];

function bePositive($arr) {
    echo "Processing Array:<br><pre>" . var_export($arr, true) . "</pre>";
    echo "Positive output:<br>";

    foreach ($arr as $value) {
        if ($value < 0 || $value === "-0") {
            echo abs($value) . "<br>";
        } else {
            echo $value . "<br>";
        }
    }
}

echo "Problem 3: Be Positive<br>";
?>
<table>
    <thead> <!-- Fixed typo here -->
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
