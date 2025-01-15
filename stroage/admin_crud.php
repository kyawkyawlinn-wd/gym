<?php 

function add_admin($mysqli, $trainer_name, $exp, $age, $password, $email, $about){
    // $hashed = password_hash($password,PASSWORD_BCRYPT);
    $sql = "INSERT INTO `trainers`(`trainer_name`,`exp`,`age`,`password`,`email`, `about`) VALUES ('$trainer_name', $exp, $age, '$password', '$email', '$about')";
    return $mysqli->query($sql);
}; 

function get_admin($mysqli)
{
  $sql = "SELECT * FROM `trainers`";
  return $mysqli->query($sql);
};
 
function get_admin_email ($mysqli , $email)
{
  $sql ="SELECT * FROM `trainers` WHERE `email`='$email'";
  $user = $mysqli->query($sql);
  return $user->fetch_assoc();
}
function get_admin_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `trainers` WHERE `id`=$id";
    $admin = $mysqli->query($sql);
    return $admin->fetch_assoc();
};

function update_admin($mysqli, $id, $trainer_name, $exp, $age , $password, $email, $about)
{
  $sql = "UPDATE `trainers` SET `trainer_name`='$trainer_name', `exp`='$exp', `age`= '$age',`password`='$password', `email`='$email', `about`='$about' WHERE `id`='$id'";
  return $mysqli->query($sql);
};

function delete_admin($mysqli, $id)
{
  $sql = "DELETE FROM `trainers` WHERE `id`=$id";
  return $mysqli->query($sql);
};