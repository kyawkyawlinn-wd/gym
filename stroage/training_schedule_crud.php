<?php
function add_training_schedule($mysqli, $start_time, $end_time, $trainer_id, $training_class_id, $fees)
{
  try {

    $sql = "INSERT INTO `training_schedules`(`start_time`, `end_time`, `trainer_id`, `training_class_id`, `fees`) VALUES ('$start_time', '$end_time', $trainer_id, $training_class_id, $fees)";
    $mysqli->query($sql);
    return true;
  } catch (Exception $e) {
    var_dump($e);
    return false;
  }
}

function get_training_schedule($mysqli)
{
  $sql = "SELECT `trainers`.`trainer_name`, `training_class_types`.`class_name`, `training_schedules`.`fees`, `training_schedules`.`start_time` AS `start`, `training_schedules`.`end_time` AS `end`, `training_schedules`.`id` FROM `training_schedules` INNER JOIN `training_class_types` ON `training_class_types`.`id`=`training_schedules`.`training_class_id` INNER JOIN `trainers` ON `trainers`.`id`=`training_schedules`.`trainer_id` WHERE `training_schedules`.`status`=0";
  return $mysqli->query($sql);
}

function get_training_schedule_with_id($mysqli, $id)
{
  $sql = "SELECT `trainers`.`id` AS `trainer_id`,`training_class_types`.`id` AS `class_id`,`trainers`.`trainer_name`, `training_class_types`.`class_name`, `training_schedules`.`fees`, `training_schedules`.`start_time` AS `start`, `training_schedules`.`end_time` AS `end`, `training_schedules`.`id` FROM `training_schedules` INNER JOIN `training_class_types` ON `training_class_types`.`id`=`training_schedules`.`training_class_id` INNER JOIN `trainers` ON `trainers`.`id`=`training_schedules`.`trainer_id` WHERE `training_schedules`.`id`=$id";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}

function get_trainer_details_with_id($mysqli, $id)
{
  $sql = "SELECT `trainers`.`trainer_name`, `trainers`.`email`, `trainers`.`exp`, `trainers`.`age`,`training_class_types`.`class_name`,
  GROUP_CONCAT(`certifications`.`certification_name` SEPARATOR ', ') AS `certification_names`
  FROM `trainers` INNER JOIN `training_schedules` ON `training_schedules`.`trainer_id` = `trainers`.`id` INNER JOIN `training_class_types` on `training_class_types`.`id` = `training_schedules`.`training_class_id` INNER JOIN `trainer_certifications` ON `trainers`.`id` = `trainer_certifications`.`trainer_id` INNER JOIN `certifications` ON `certifications`.`id` = `trainer_certifications`.`certification_id` WHERE `trainers`.`id` = $id";
  $status = $mysqli->query($sql);
  return $status->fetch_assoc();
}

function update_training_schedule($mysqli, $id, $start_time, $end_time, $trainer_id, $training_class_id, $fees)
{
  $sql = "UPDATE `training_schedules` SET `start_time`='$start_time', `end_time`='$end_time', `trainer_id`=$trainer_id, `training_class_id`=$training_class_id, `fees`=$fees WHERE `id`=$id ";
  return $mysqli->query($sql);
}

function delete_training_schedule($mysqli, $id)
{
  $sql = "UPDATE `training_schedules` SET `status`=1 WHERE `id`=$id";
  return $mysqli->query($sql);
}

// function update_trainer_certification_with_id($mysqli, $id)
// {
//   $sql = "SELECT * FROM `trainer_cretifications` WHERE `id`=$id";
//   $trainer = $mysqli->query($sql);
//   return $trainer->fetch_assoc();
// }

// function update_trainer_certification($mysqli, $id, $certification_id, $trainer_id)
// {
//   $sql = "UPDATE `trainer_cretifications` SET `cretification_id`=$certification_id, `trainer_id`=$trainer_id WHERE `id`=$id";
//   return $mysqli->query($sql);
// }

// function delete_trainer_certification($mysqli, $id)
// {
//   $sql = "DELETE FROM `trainer_cretifications` WHERE `id`=$id";
//   return $mysqli->query($sql);
// }
