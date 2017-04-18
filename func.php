<?php
function getOrderByTime($agentid, $date, $time){
  $query2 = "SELECT hd.id FROM hd WHERE hd.agentid = :agentid AND hd.timesend < :timesend AND hd.datein = :datein";
  $stmt = MySQL::$db->prepare($query2);
  $stmt->bindParam('timesend', $time);
  $stmt->bindParam('datein', $date);
  $stmt->bindParam('agentid', $agentid);
  $stmt->execute();
  return $stmt->fetchAll();
}

function getOrdersById($agentid, $date){
  $query = "SELECT * FROM hd WHERE agentid = :id AND datein = :datein ORDER BY hd.timestart";
  $stmt = MySQL::$db->prepare($query);
  $stmt->bindParam('id', $agentid);
  $stmt->bindParam('datein', $date);
  $stmt->execute();
  return $stmt->fetchAll();
}

function getAgentsNameById($agentid){
  $query = "SELECT agents.name FROM agents WHERE agents.id = :id";
  $stmt = MySQL::$db->prepare($query);
  $stmt->bindParam('id', $agentid);
  $stmt->execute();
  return $stmt->fetchAll();
}

function getClientsAdressById($clientid){
  $query = "SELECT clients.address FROM clients WHERE clients.id = :id";
  $stmt = MySQL::$db->prepare($query);
  $stmt->bindParam('id', $clientid);
  $stmt->execute();
  return $stmt->fetchAll();
}

function getClientsNameById($clientid){
  $query = "SELECT clients.name FROM clients WHERE clients.id = :id";
  $stmt = MySQL::$db->prepare($query);
  $stmt->bindParam('id', $clientid);
  $stmt->execute();
  return $stmt->fetchAll();
}
