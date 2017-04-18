<?php
require_once ('../config.php');
require_once ('../func.php');
//$date;

if(isset($_GET['calendar'])){
  $date = $_GET['calendar'];
  //$timestamp = ;
}
else{
  $date = date('Y-m-d',  time());
}
//echo date("d.m.Y", strtotime($date));



MySQL::$db = new PDO
              (
                "mysql:host=$host;dbname=$dbname",
                $user,
                $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
              );

$query = "SELECT a.name, a.bpid, a.id FROM agents a WHERE a.bpid <> '' ";
$stmt = MySQL::$db->prepare($query);
$stmt->bindParam('id', $id);
$stmt->execute();
$agents = $stmt->fetchAll();



//минимальная дата в базе
//SELECT DISTINCT datein FROM `hd` GROUP by datein
?>



<!DOCTYPE html>
<html>
<head>

</head>
<body>
  <div>
    <form method="get" action="index.php">
     <p>Выберите дату:
        <input type="date" name="calendar" value="<?php echo $date; ?>" min="2016-04-22">
        <input type="submit" value="Показать">
      </p>
    </form>
  </div>
  <div>
    <table border="1" cellpadding="5" cellspacing="0" width="60%">
        <caption><h2>Тайминг заявок: <?php echo $date;?></h2></caption>
        <tr>
            <th>Агент</th>
            <th>До 10:00</th>
            <th>До 12:00</th>
            <th>До 14:00</th>
            <th>Всего заявок</th>
            <th>% заявок до 14:00</th>
        </tr>
        <?php

          //print_r($agents);
          $M = count($agents);
          for($i = 0; $i < $M; $i++)
          {
            echo '<tr>';
              echo '<td>';
              print('<a title="Подробнее по клиентно" href="http://vinomania.loc/agents-orders.php?id='.$agents[$i]['id']."&". 'calendar='. $date . '"' . ">{$agents[$i]['name']}</a>");
              echo '</td>';
              echo '<td>';
              echo count(getOrderByTime($agents[$i]['id'], $date, '10:00:00'));
              echo '</td>';
              echo '<td>';
              echo count(getOrderByTime($agents[$i]['id'], $date, '12:00:00'));
              echo '</td>';
              echo '<td>';
              $dead_line = count(getOrderByTime($agents[$i]['id'], $date, '14:00:00'));
              echo $dead_line;
              echo '</td>';
              echo '<td>';
              $all = count(getOrderByTime($agents[$i]['id'], $date, '22:00:00'));
              echo $all;
              echo '</td>';
              echo '<td>';
              $all != 0 ? print(intval($dead_line/$all*100) . '%') : print('Нет данных');
              echo '</td>';
            echo '</tr>';
          }
        ?>
    </table>
  </div>
</body>
</html>
