CREATE DATABASE taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE taskforce;

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(128),
  email VARCHAR(64),
  password VARCHAR(64),
  address VARCHAR(64),
  date DATETIME,
  info VARCHAR(128),
  avatar VARCHAR(128),
  rating FLOAT,
  phone VARCHAR(64),
  skype VARCHAR(64),
  messenger VARCHAR(64),
  city_id INT,
  category_id INT,
  FOREIGN KEY (city_id) REFERENCES city(id),
  FOREIGN KEY (category_id) REFERENCES category(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE task (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(128),
  description VARCHAR(128),
  budget FLOAT,
  reg_date DATETIME,
  exe_date DATETIME,
  finish_date DATETIME,
  city_id INT,
  category_id INT,
  executor_id INT,
  customer_id INT,
  status_id INT,
  FOREIGN KEY (city_id) REFERENCES city(id),
  FOREIGN KEY (category_id) REFERENCES category(id),
  FOREIGN KEY (executor_id) REFERENCES user(id),
  FOREIGN KEY (customer_id) REFERENCES user(id),
  FOREIGN KEY (status_id) REFERENCES status(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE city (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(64)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE status (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(64)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(64)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE file (
  id INT AUTO_INCREMENT PRIMARY KEY,
  path VARCHAR(128),
  task_id INT,
  FOREIGN KEY (task_id) REFERENCES task(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE feedback (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reg_date DATETIME,
  text VARCHAR(128),
  user_id INT,
  task_id INT,
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (task_id) REFERENCES task(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE response (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reg_date DATETIME,
  text VARCHAR(128),
  user_id INT,
  task_id INT,
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (task_id) REFERENCES task(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE chat (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reg_date DATETIME,
  message VARCHAR(128),
  sender_id INT,
  recipient_id INT,
  FOREIGN KEY (sender_id) REFERENCES user(id),
  FOREIGN KEY (recipient_id) REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE user_category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  category_id INT,
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (category_id) REFERENCES category(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
