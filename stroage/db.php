<?php

try {
  $mysqli = new mysqli("localhost", "root", "");
  $sql = "CREATE DATABASE IF NOT EXISTS `gym`";
  if ($mysqli->query($sql)) {
    if ($mysqli->select_db("gym")) {
      create_table($mysqli);
      first_admin($mysqli);
    }
  }
} catch (\Throwable $th) {
  echo "Can't not create Database";
  die();
}

function first_admin($mysqli) {
  $sql = "SELECT * FROM `trainers` WHERE `status` = 0";
  $result = $mysqli->query($sql);

  if (count($result->fetch_all()) == 0) {
      $password = password_hash("super", PASSWORD_BCRYPT);
      $sql = "INSERT INTO `trainers` (`trainer_name`, `exp`, `age`, `password`, `email`, `about`) 
              VALUES ('super', 10, 30, '$password', 'super@gmail.com', 'about')";
      $mysqli->query($sql);
  }
}

function create_table($mysqli)
{
  $sql = "CREATE TABLE IF NOT EXISTS `trainers`(
          `id` INT NOT NULL AUTO_INCREMENT,
          `trainer_name` VARCHAR(225) NOT NULL,
          `exp` INT NOT NULL, 
          `age` INT NOT NULL, 
          `password` VARCHAR(60) NOT NULL, 
          `email` VARCHAR(80) NOT NULL, 
          `about` TEXT NOT NULL,
          `status` TINYINT(1) NOT NULL DEFAULT 0,
            PRIMARY KEY(`id`) )";
  if (!$mysqli->query($sql)) {
    return false;
  }

  $sql = "CREATE TABLE IF NOT EXISTS `training_class_types` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `class_name` VARCHAR(225) NOT NULL,
    `max_people` INT NOT NULL,
    `description` VARCHAR(225) NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(`id`)
)";
  if (!$mysqli->query($sql)) {
    return false;
  }

  $sql = "CREATE TABLE IF NOT EXISTS `training_schedules` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `start_time` TIME NOT NULL,
    `end_time` TIME NOT NULL,
    `trainer_id` INT NOT NULL,
    `training_class_id` INT NOT NULL,
    `fees` INT NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`trainer_id`) REFERENCES `trainers`(`id`),
    FOREIGN KEY(`training_class_id`) REFERENCES `training_class_types`(`id`)
)";
  if (!$mysqli->query($sql)) {
    return false;
  }


  $sql = "CREATE TABLE IF NOT EXISTS `members` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(225) NOT NULL,
    `age` INT NOT NULL,
    `email` VARCHAR(80) NOT NULL,
    `phone` VARCHAR(225) NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(`id`)
)";
  if (!$mysqli->query($sql)) {
    return false;
  }

  $sql = "CREATE TABLE IF NOT EXISTS `member_schedules` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `training_schedule_id` INT NOT NULL,
    `member_id` INT NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`training_schedule_id`) REFERENCES `training_schedules`(`id`),
    FOREIGN KEY(`member_id`) REFERENCES `members`(`id`)
)";
  if (!$mysqli->query($sql)) {
    return false;
  }

  $sql = "CREATE TABLE IF NOT EXISTS `certifications` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `certification_name` VARCHAR(225) NOT NULL,
    `place` VARCHAR(225) NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(`id`)
)";
  if (!$mysqli->query($sql)) {
    return false;
  }


  $sql = "CREATE TABLE IF NOT EXISTS `trainer_certifications` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `certification_id` INT NOT NULL,
    `trainer_id` INT NOT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`certification_id`) REFERENCES `certifications`(`id`),
    FOREIGN KEY(`trainer_id`) REFERENCES `trainers`(`id`)
)";
  if (!$mysqli->query($sql)) {
    return false;
  }
}
