<?php
require_once ('../config.php');
require_once ('../func.php');

MySQL::$db = new PDO
              (
                "mysql:host=$host;dbname=$dbname",
                $user,
                $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
              );
$id = $_GET['id'];
$date = $_GET['calendar'];
//print_r(getOrdersById($id, $date));
$orders = getOrdersById($id, $date);
?>


<!DOCTYPE html>
<html>
<head>

</head>
<body>
  <div>
    <form method="get" action="agents-orders.php">
     <p>Выберите дату:
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="date" name="calendar" value="<?php echo $date; ?>" min="2016-04-22">
        <input type="submit" value="Показать">
      </p>
    </form>
  </div>
  <div>
    <table border="1" cellpadding="5" cellspacing="0" width="80%">
        <caption><h2>Заявки <?php echo getAgentsNameById($id)[0][0]; ?> на <?php echo $date;?> </h2></caption>
        <tr>
            <th rowspan="2">Клиент</th>
            <th rowspan="2">Форма оплаты</th>
            <th rowspan="2">Дата доставки</th>
            <th colspan="3">Время</th>
            <th rowspan="2">Комментарий</th>
        </tr>
        <tr>
            <th>Начала</th>
            <th>Завершения</th>
            <th>Отправки</th>
        </tr>
        <?php

          //print_r($orders);
          $M = count($orders);
          for($i = 0; $i < $M; $i++)
          {
            echo '<tr>';
              echo "<td title=\"". getClientsAdressById((integer) $orders[$i]['clientid'])[0][0] . "\">";
    /*1*/     echo getClientsNameById((integer) $orders[$i]['clientid'])[0][0];
              echo '</td>';
              echo '<td>';
    /*2*/     echo $orders[$i]['pricetypename'];
              echo '</td>';
              echo '<td>';
    /*3*/     echo $orders[$i]['dateout'];
              echo '</td>';
              echo '<td>';
    /*4*/     echo $orders[$i]['timestart'];
              echo '</td>';
              echo '<td>';
    /*5*/     echo $orders[$i]['timefinish'];
              echo '</td>';
              echo '<td>';
    /*6*/     echo $orders[$i]['timesend'];
              echo '</td>';
              echo '<td>';
    /*7*/     echo $orders[$i]['comment'];
              echo '</td>';
            echo '</tr>';
          }
        ?>
    </table>
  </div>
</body>
</html>
