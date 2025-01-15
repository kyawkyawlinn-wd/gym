<?php 

function add_class($mysqli, $class_name, $exp, $age, $password, $email){
    // $hashed = password_hash($password,PASSWORD_BCRYPT);
    $sql = "INSERT INTO `trainers`(`trainer_name`,`exp`,`age`,`password`,`email`) VALUES ('$class_name', $exp, $age, '$password', '$email')";
    return $mysqli->query($sql);
}; 

function get_admin($mysqli)
{
  $sql = "SELECT * FROM `trainers`";
  $admin = $mysqli->query($sql);
  return $admin->fetch_assoc();
};
 
function get_admin_email ($mysqli , $email)
{
  $sql ="SELECT * FROM `trainers` WHERE `email`='$email'";
  $user = $mysqli->query($sql);
  return $user->fetch_assoc();
}
function get_admin_id($mysqli, $id)
{
    $sql = "SELECT * FROM `trainers` WHERE `id`=$id";
    $admin = $mysqli->query($sql);
    return $admin->fetch_assoc();
};

function update_admin($mysqli, $id, $trainer_name, $exp, $password, $email)
{
  $sql = "UPDATE `trainers` SET `trainer_name`=`$trainer_name`, `exp`=$exp, `password`=`$password`, `email`=`$email` WHERE `id`=$id";
  return $mysqli->query($sql);
};

function delete_admin($mysqli, $id)
{
  $sql = "DELETE FROM `trainers` WHERE `id`=$id";
  return $mysqli->query($sql);
};