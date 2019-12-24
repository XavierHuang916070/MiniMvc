<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>test title</title>
    <style>
        p{
            border: 3px solid black;
            background:#800000;
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
            echo "更新成功";
        }
        else{
            echo "更新失敗";
        }
        ?>
    </p>
</body>
</html>