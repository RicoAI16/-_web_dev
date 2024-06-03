<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8" />
        <meta name="領収書" content="web開発4回目"/>
    </head>
    <body>
    <table border="1">
        <tr>
            <th>商品</th>
            <th>価格</th>
        </tr>
        <tr>
            <td>りんご (２つ)</td>
            <td>¥100</td>
        </tr>
        <tr>
            <td>肉</td>
            <td>¥1000</td>
        </tr>
        <tr>
            <td>卵(2つ)</td>
            <td>¥200</td>
        </tr>
    </table>

    <?php
    // 商品の価格リスト
    $prices = array(100*2, 1000, 200*2);

    // 税抜きの合計金額を計算
    $subtotal = array_sum($prices);

    // 税率（8%）を定義
    $tax_rate = 0.08;

    // 税込みの合計金額を計算
    $total_with_tax = $subtotal * (1 + $tax_rate);
    ?>
    <p>税抜き合計金額: ¥<?php echo $subtotal; ?></p>
    <p>税込み合計金額: ¥<?php echo $total_with_tax; ?></p>

    </body>
</html>