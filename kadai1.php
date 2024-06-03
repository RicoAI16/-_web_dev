<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8" />
        <meta name="kadai1" content="web開発4回目"/>
    </head>
    <body>
    <table border="3">
        <tr>
            <th>商品</th>
            <th>価格</th>
        </tr>
        <tr>
            <th>りんご (２つ)</th>
            <th>100円</th>
        </tr>
        <tr>
            <th>お肉 (１個)</th>
            <th>1000円</th>
        </tr>
        <tr>
            <th>卵 (2個)</th>
            <th>200円</th>
        </tr>
    </table>
    
    <?php
    $prices = array(100*2, 1000*1, 200*2);
    $total_price = array_sum($prices);
    $tax_rate = 0.08;
    $total_taxed = $total_price * (1 + $tax_rate);

    echo "<p>税抜き合計金額: ¥ $total_price</p>";
    echo "<p>税込み合計金額: ¥ $total_taxed</p>";
    ?>
    </body>
</html>