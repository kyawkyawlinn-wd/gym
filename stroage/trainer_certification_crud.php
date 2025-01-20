<?php

function add_trainer_certification($mysqli, $certification_id, $trainer_id)
{
  $sql = "INSERT INTO `trainer_certifications`(`certification_id`, `trainer_id`) VALUES ($certification_id, $trainer_id)";
  $mysqli->query($sql);
}

function get_trainer_certification($mysqli)
{
  $sql = "SELECT * FROM `trainer_certifications` WHERE `status`=0";
  return $mysqli->query($sql);
}

function update_trainer_certification_with_id($mysqli, $id)
{
  $sql = "SELECT * FROM `trainer_certifications` WHERE `id`=$id";
  $trainer = $mysqli->query($sql);
  return $trainer->fetch_assoc();
}

function update_trainer_certification($mysqli, $id, $certification_id, $trainer_id)
{
  $sql = "UPDATE `trainer_certifications` SET `cretification_id`=$certification_id, `trainer_id`=$trainer_id WHERE `id`=$id";
  return $mysqli->query($sql);
}

function delete_trainer_certification($mysqli, $id)
{ 
  $sql = "UPDATE `trainer_certifications` SET `status`=1 WHERE `trainer_id`=$id";
  return $mysqli->query($sql);
};

function get_trainer_certification_with_trainer_id($mysqli)
{
  $sql = "SELECT `id`,`trainer_name`,(SELECT 
    GROUP_CONCAT(
        (SELECT `certification_name` 
         FROM `certifications` 
         WHERE `id` = tc.certification_id)
    ) AS certifications_name
FROM `trainer_certifications` tc 
WHERE tc.trainer_id = t.id and tc.`status`=0) as certification_name FROM `trainers` t HAVING 
    certification_name IS NOT NULL
";
  return $mysqli->query($sql);
}
