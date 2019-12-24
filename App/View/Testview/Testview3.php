<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>test title</title>
    <style>
        p{
            border: 3px solid black;
            background:#0000CD;
            color:white;
            text-align:center;
            width:1200px;
        }
    </style>
</head>
<body>
    <p>
        <?php
        if($data){
            echo "插入成功";
        }
        else{
            echo "插入失敗";
        }
        ?>
    </p>
</body>
</html>