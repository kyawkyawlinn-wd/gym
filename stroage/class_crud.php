<?php 

function add_class($mysqli, $class_name, $max_people, $description ){
    $sql = "INSERT INTO `training_class_types`(`class_name`,`max_people`, `description`) VALUES ('$class_name', $max_people, '$description')";
    return $mysqli->query($sql);
}; 

function get_training_class($mysqli)
{
  $sql = "SELECT * FROM `training_class_types` WHERE `status`=0";
  return $mysqli->query($sql);
};
 
function get_training_class_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `training_class_types` WHERE `id`=$id";
    $admin = $mysqli->query($sql);
    return $admin->fetch_assoc();
};

function update_training_class($mysqli, $id, $class_name, $max_people, $description)
{
  $sql = "UPDATE `training_class_types` SET `class_name`='$class_name', `max_people`=$max_people, `description`='$description' WHERE `id`=$id";
  return $mysqli->query($sql);
};
function delete_class($mysqli, $id)
{
  $sql = "UPDATE `training_class_types` SET `status`=1 WHERE `id`=$id";
  return $mysqli->query($sql);
};