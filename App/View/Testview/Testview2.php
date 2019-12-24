<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>test title</title>
    <style>
        p{
            border: 3px solid black;
            background:#DC143C;
            text-align:center;
            width:1200px;
        }
    </style>
</head>
<body>
    <p>
        <?php
        foreach($data as $key =>$value){
            print_r($value);
            echo "<br>";
        }
        ?>
    </p>
</body>
</html>