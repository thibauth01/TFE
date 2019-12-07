CREATE TABLE `account` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(255),
  `last_name` varchar(255),
  `email` varchar(255),
  `username` varchar(255),
  `password` varchar(255),
  `birth_date` date,
  `street` varchar(255),
  `postcode` int,
  `city` varchar(255),
  `country` varchar(255)
);

CREATE TABLE `requester` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_account` int,
  `premium` boolean DEFAULT false
);

CREATE TABLE `worker` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `maximum_distance` int,
  `id_type_work` int,
  `id_account` int,
  `id_availability` int,
  `star` double
);

CREATE TABLE `type_work` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255)
);

CREATE TABLE `availability` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_day` int,
  `time_start` time,
  `time_end` time
);

CREATE TABLE `day` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255)
);

CREATE TABLE `work` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255),
  `id_type` int,
  `description` text,
  `id_requester` int,
  `id_worker` int DEFAULT null,
  `date_start` date,
  `date_end` time,
  `time_start` time,
  `time_end` time,
  `place` varchar(255),
  `id_statut_progress` int,
  `paid` boolean DEFAULT false,
  `cancelled` boolean DEFAULT false
);

CREATE TABLE `statut_progress` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) DEFAULT "To Come"
);

ALTER TABLE `requester` ADD FOREIGN KEY (`id_account`) REFERENCES `account` (`id`);

ALTER TABLE `worker` ADD FOREIGN KEY (`id_type_work`) REFERENCES `type_work` (`id`);

ALTER TABLE `worker` ADD FOREIGN KEY (`id_account`) REFERENCES `account` (`id`);

ALTER TABLE `worker` ADD FOREIGN KEY (`id_availability`) REFERENCES `availability` (`id`);

ALTER TABLE `availability` ADD FOREIGN KEY (`id_day`) REFERENCES `day` (`id`);

ALTER TABLE `work` ADD FOREIGN KEY (`id_type`) REFERENCES `type_work` (`id`);

ALTER TABLE `requester` ADD FOREIGN KEY (`id`) REFERENCES `work` (`id_requester`);

ALTER TABLE `worker` ADD FOREIGN KEY (`id`) REFERENCES `work` (`id_worker`);

ALTER TABLE `work` ADD FOREIGN KEY (`id_statut_progress`) REFERENCES `statut_progress` (`id`);
