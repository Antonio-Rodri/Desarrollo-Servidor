
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>Indice</th>
                <th>Valor</th>
            </tr>
        <?php
        foreach ($_SERVER as $key => $value) {
            echo "<tr><td>".$key."</td><td>".$value."</td></tr>";
        }
        ?>
        </table>
    </body>
</html>