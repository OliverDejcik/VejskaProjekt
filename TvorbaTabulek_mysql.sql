CREATE TABLE `menza` (
  `menza_id` INT AUTO_INCREMENT PRIMARY KEY,
  `nazev` VARCHAR(255),
  `adresa` VARCHAR(255)
);

CREATE TABLE `obedy` (
  `obed_id` INT AUTO_INCREMENT PRIMARY KEY,
  `nazev_obedu` VARCHAR(255),
  `datum_vydani` DATE,
  `hodnoceni` FLOAT,
  `menza_id` INT,
  `cas_vyhodnoceni` TIMESTAMP,
  FOREIGN KEY (`menza_id`) REFERENCES `menza` (`menza_id`)
);

CREATE TABLE `users` (
  `user_id` INT AUTO_INCREMENT PRIMARY KEY,
  `osobni_cislo` VARCHAR(255) UNIQUE NOT NULL,
  `skolni_email` VARCHAR(255) UNIQUE,
  `heslo` VARCHAR(255) NOT NULL,
  `avatar` VARCHAR(255),
  `jmeno` VARCHAR(255),
  `prijmeni` VARCHAR(255),
  `role` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `last_login` TIMESTAMP NULL,
  `is_admin` BOOLEAN
);

CREATE TABLE `recenze` (
  `recenze_id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT,
  `obed_id` INT,
  `text_recenze` TEXT,
  `hodnoceni` INT,
  `created_at` TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  FOREIGN KEY (`obed_id`) REFERENCES `obedy` (`obed_id`)
);
