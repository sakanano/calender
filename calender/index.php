<?php
    if (isset($_GET['ym'])) {
        $ym = $_GET['ym'];
    } else {
        $ym = date('Y-m');
    }
    
    $timestamp = strtotime($ym);
    if ($timestamp === false) {
        $ym = date('Y-m');
        $timestamp = strtotime($ym);
    }
//年・月    
    $html_title = date('Y-F', $timestamp);
//曜日
    $aryWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
//月の日数
    $day_count = date('t', $timestamp);

//1日の曜日
    $firt_week = date('w', $timestamp);

//先月ボタン・次の月ボタンの変数
    $prev = date('Y-m', strtotime('-1 month', $timestamp));
    $next = date('Y-m', strtotime('+1 month', $timestamp));

//配列
    $weeks = [];
    $week = '';
//１日までの空白
    $week .= str_repeat('<td></td>', $firt_week);
//1日から最後まで
    for ( $day = 1; $day <= $day_count; $day++, $firt_week++) {
        $week .= '<td>'. $day.'</td>';
        //改行
        if ($firt_week % 7 == 6 || $day == $day_count) {
        // if ($firt_week % 7 == 6 ) {
            //最後の空白
            if ($day == $day_count) {
                $week .= str_repeat('<td></td>', 6 - ($firt_week % 7));
            }
            // weeks配列に要素を追加する
            $weeks[] = '<tr>' . $week . '</tr>';
            $week = '';
        }
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <!-- タイトル -->
    <h3 class="title">
        <a href="?ym=<?php echo $prev; ?>">&lt;</a>
            <?php echo $html_title; ?> 
        <a href="?ym=<?php echo $next; ?>">&gt;</a>
    </h3>
    <!-- カレンダー -->
    <table class="calender">
        <!-- 曜日の表示 -->
        <?php foreach ($aryWeek as $week) : ?>
            <th><?php echo $week ?></th>
        <?php endforeach;  ?>
        <!-- 日の表示 -->
        <?php
            foreach ($weeks as $day) {
                echo $day;
            }
        ?>
    </table>
</body>
</html>