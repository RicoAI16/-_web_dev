<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="Web開発開発第５回目"/>
</head>
<body>
    <?php
        $fruit = [
            'apple' => 'りんご',
            'lemon' => 'レモン',
            'grape' => 'ぶどう',
            'tomato' => 'トマト'
        ];
        foreach ($fruit as $key => $value) {
            echo '英語 : ' . $key . '<br>';
            echo '日本語 : ' . $value . '<br>';
        }
    ?>
</body>
</html>