<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>test title</title>
    <style>
        p{
            border: 3px solid black;
            background:#556B2F;
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
            echo "刪除成功";
        }
        else{
            echo "刪除失敗";
        }
        ?>
    </p>
</body>
</html>