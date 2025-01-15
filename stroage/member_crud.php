<?php 

function add_member($mysqli, $member_name,  $age, $email, $phone )
{
    $sql = "INSERT INTO `members`(`name`,`age`,`email`,`phone_number`) VALUES ('$member_name', $age, '$email', $phone)";
    return $mysqli->query($sql);
}; 

function get_member($mysqli)
{
  $sql = "SELECT * FROM `members`";
  $member = $mysqli->query($sql);
  return $member->fetch_assoc();
};

function get_member_email($mysqli , $email)
{
  $sql ="SELECT * FROM `members` WHERE `email`='$email'";
  $user = $mysqli->query($sql);
  return $user->fetch_assoc();
}

function get_member_id($mysqli, $id)
{
    $sql = "SELECT * FROM `members` WHERE `id`=$id";
    $member = $mysqli->query($sql);
    return $member->fetch_assoc();
};

function update_member($mysqli, $id, $member_name, $age, $email, $phone)
{
  $sql = "UPDATE `members` SET `name`='$member_name' ,`age`=$age ,`email`='$email' ,`phone_number`=$phone WHERE `id`=$id ";
  return $mysqli->query($sql);
};

function delete_member($mysqli, $id)
{
  $sql = "DELETE FROM `members` WHERE `id`=$id";
  return $mysqli->query($sql);
};