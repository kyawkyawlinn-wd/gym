<?php 

function add_member_schedule($mysqli, $training_schedule_id, $member_id)
{
  $sql = "INSERT INTO `member_schedules`(`training_schedule_id`,`member_id`) VALUES ($training_schedule_id, $member_id)";
    return $mysqli->query($sql);
}


function get_member_schedule($mysqli){
  $sql = "SELECT ts.id,tc.class_name,tr.trainer_name FROM `training_schedules` ts INNER JOIN `training_class_types` tc ON tc.id=ts.training_class_id INNER JOIN `trainers` tr ON tr.id=ts.trainer_id ";
  return $mysqli->query($sql);
}

function get_member_schedule_trainer($mysqli)
{
  $sql = "SELECT DISTINCT m.`name`,ts.`start_time`,ts.`end_time`,t.`trainer_name`,tcs.`class_name`,ms.`id` FROM `member_schedules` ms INNER JOIN `members` m ON m.`id`=ms.`member_id` INNER JOIN `training_schedules` ts ON ts.`id` = ms.`training_schedule_id` INNER JOIN `trainers` t ON  t.`id`=ts.`trainer_id` INNER JOIN `training_class_types` tcs ON tcs.`id`=ts.`training_class_id` WHERE ms.`status`=0";
  return $mysqli->query($sql);
}

function delete_member_schedule($mysqli, $id)
{
  $sql = "UPDATE `member_schedules` SET `status`=1 WHERE `id`=$id";
  return $mysqli->query($sql);
}

