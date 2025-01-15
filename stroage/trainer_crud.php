<?php
function get_trainer($mysqli){
  $sql = "SELECT * FROM `trainer`";
  return $mysqli->query($sql);
}

?>