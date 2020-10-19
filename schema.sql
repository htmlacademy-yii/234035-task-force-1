CREATE DATABASE taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE taskforce;

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  registration_date DATETIME NOT NULL,
  name VARCHAR(128) NOT NULL,
  email VARCHAR(64) NOT NULL,
  password VARCHAR(64) NOT NULL,
  address VARCHAR(64),
  birthday_date DATE,
  info VARCHAR(1024),
  avatar VARCHAR(128),
  rate DECIMAL(4,2),
  phone VARCHAR(64),
  skype VARCHAR(64),
  messenger VARCHAR(64),
  city_id INT UNSIGNED,
  category_id INT UNSIGNED,
  FOREIGN KEY (city_id) REFERENCES cities(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tasks (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(128) NOT NULL,
  description VARCHAR(512),
  budget DECIMAL(8,2) NOT NULL,
  registration_date DATETIME NOT NULL,
  execution_date DATETIME,
  finish_date DATETIME,
  city_id INT UNSIGNED,
  category_id INT UNSIGNED,
  executor_id INT UNSIGNED,
  customer_id INT UNSIGNED,
  status_id INT UNSIGNED,
  FOREIGN KEY (city_id) REFERENCES cities(id),
  FOREIGN KEY (category_id) REFERENCES categories(id),
  FOREIGN KEY (executor_id) REFERENCES users(id),
  FOREIGN KEY (customer_id) REFERENCES users(id),
  FOREIGN KEY (status_id) REFERENCES statuses(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE cities (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  city VARCHAR(64),
  latitude DECIMAL(10,7),
  longitude DECIMAL(10,7)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE statuses (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(64)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE categories (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(64),
  icon VARCHAR(64)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE files (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  path VARCHAR(128),
  task_id INT UNSIGNED,
  FOREIGN KEY (task_id) REFERENCES tasks(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE opinions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  registration_date DATETIME,
  rate DECIMAL(4,2),
  text VARCHAR(512),
  user_id INT UNSIGNED,
  task_id INT UNSIGNED,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (task_id) REFERENCES tasks(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE replies (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  registration_date DATETIME,
  rate DECIMAL(4,2),
  text VARCHAR(1024),
  user_id INT UNSIGNED,
  task_id INT UNSIGNED,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (task_id) REFERENCES tasks(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE chats (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  registration_date DATETIME,
  message VARCHAR(128),
  sender_id INT UNSIGNED,
  recipient_id INT UNSIGNED,
  FOREIGN KEY (sender_id) REFERENCES users(id),
  FOREIGN KEY (recipient_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE users_categories (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED,
  category_id INT UNSIGNED,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
