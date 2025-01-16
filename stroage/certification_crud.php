<?php 

function add_certification($mysqli, $certification_name, $place){
    $sql = "INSERT INTO `certifications`(`certification_name`,`place`) VALUES ('$certification_name', '$place')";
    return $mysqli->query($sql);
}; 

function get_certification($mysqli)
{
  $sql = "SELECT * FROM `certifications`";
  return $mysqli->query($sql);
};
 
function get_certification_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `certifications` WHERE `id`=$id";
    $admin = $mysqli->query($sql);
    return $admin->fetch_assoc();
};

function update_certification($mysqli, $id, $certification_name, $place)
{
  $sql = "UPDATE `certifications` SET `certification_name`='$certification_name', `place`='$place' WHERE `id`='$id'";
  return $mysqli->query($sql);
};

function delete_certifications($mysqli, $id)
{
  $sql = "DELETE FROM `certifications` WHERE `id`=$id";
  return $mysqli->query($sql);
};