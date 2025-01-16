<?php 

try {
  $mysqli = new mysqli( "localhost", "root", "");
  $sql = "CREATE DATABASE IF NOT EXISTS `gym`";
  if($mysqli->query($sql)) {
      if($mysqli->select_db("gym")) {
        create_table($mysqli);
      }
  }
} catch (\Throwable $th) {
    echo "Can't not create Database";
    die();
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
            PRIMARY KEY(`id`) )";
            if(!$mysqli->query($sql)) {
              return false;
            }
            
            $sql = "CREATE TABLE IF NOT EXISTS `training_class_types`(
                   `id` INT NOT NULL AUTO_INCREMENT, 
                   `class_name` VARCHAR(225) NOT NULL,
                   `max_people` INT NOT NULL, 
                    PRIMARY KEY(`id`) )";
                    if(!$mysqli->query($sql)) {
                        return false;
                      }

   $sql = "CREATE TABLE IF NOT EXISTS `training_schedules`(
          `id` INT NOT NULL AUTO_INCREMENT, 
          `trainer_id` INT NOT NULL,
          `training_class_id` INT NOT NULL, 
          `fees` INT NOT NULL, 
            PRIMARY KEY(`id`),
            FOREIGN KEY(`trainer_id`) REFERENCES `trainers`(`id`), 
            FOREIGN KEY(`training_class_id`) REFERENCES `training_class_types`(`id`) )";
            if(!$mysqli->query($sql)) {
              return false;
            }
            
            
              $sql = "CREATE TABLE IF NOT EXISTS `members`(
                     `id` INT NOT NULL AUTO_INCREMENT, 
                     `name` VARCHAR(225) NOT NULL, 
                     `age` INT NOT NULL,
                     `email` VARCHAR(80) NOT NULL, 
                     `phone_number` INT NOT NULL ,
                      PRIMARY KEY(`id`) )";
                      if(!$mysqli->query($sql)) {
                          return false;
                        }

  $sql = "CREATE TABLE IF NOT EXISTS `member_schedules`(
         `id` INT NOT NULL AUTO_INCREMENT, 
         `training_schedule_id` INT NOT NULL, 
         `member_id` INT NOT NULL,
         `join_date` DATETIME NOT NULL, 
          PRIMARY KEY(`id`),
          FOREIGN KEY(`training_schedule_id`) REFERENCES `training_schedules`(`id`),
          FOREIGN KEY(`member_id`) REFERENCES `members`(`id`))";
          if(!$mysqli->query($sql)) {
              return false;
          }
          
          $sql = "CREATE TABLE IF NOT EXISTS `cretifications`(
                 `id` INT NOT NULL AUTO_INCREMENT, 
                 `cretification_name` VARCHAR(225) NOT NULL, 
                 `place` VARCHAR(225) NOT NULL, 
                 PRIMARY KEY(`id`) )";
                 if(!$mysqli->query($sql)) {
                    return false;
                  }
                  
                  
                  $sql = "CREATE TABLE IF NOT EXISTS `trainer_cretifications`(
                         `id` INT NOT NULL AUTO_INCREMENT, 
                         `cretification_id` INT NOT NULL,
                         `trainer_id` INT NOT NULL, 
                         PRIMARY KEY(`id`),
                         FOREIGN KEY(`cretification_id`) REFERENCES `cretifications`(`id`),
                         FOREIGN KEY(`trainer_id`) REFERENCES `trainers`(`id`))";
                         if(!$mysqli->query($sql)) {
                            return false;
                         }
}