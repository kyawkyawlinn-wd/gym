<?php 

function add_class($mysqli, $class_name, $max_people, $description ){
    $sql = "INSERT INTO `training_class_types`(`class_name`,`max_people`, `description`) VALUES ('$class_name', $max_people, ''$description)";
    return $mysqli->query($sql);
}; 

// function get_class($mysqli)
// {
//   $sql = "SELECT * FROM `training_class_types`";
//   return $mysqli->query($sql);
// };
 
// function get_class_with_id($mysqli, $id)
// {
//     $sql = "SELECT * FROM `training_class_types` WHERE `id`=$id";
//     $admin = $mysqli->query($sql);
//     return $admin->fetch_assoc();
// };

// function update_class($mysqli, $id, $class_name, $max_people)
// {
//   $sql = "UPDATE `training_class_types` SET `trainer_name`=`$class_name`, `max_people`=$max_people WHERE `id`=$id";
//   return $mysqli->query($sql);
// };

// function delete_class($mysqli, $id)
// {
//   $sql = "DELETE FROM `training_class_types` WHERE `id`=$id";
//   return $mysqli->query($sql);
// };