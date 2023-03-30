SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "Europe/Moscow";
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS `tasklist_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tasklist_db`;

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$/0IK3/YIJnMR0bI5dHip1ecxtVJSpIjoZKtIajzYbmuGx5oQ/xkry');

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tasks` (`id`, `username`, `email`, `date`, `status`, `text`) VALUES
(1, 'Пользователь 1', 'user_1@example.com', SUBDATE(NOW(), INTERVAL 1 HOUR), 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras egestas sapien sit amet quam malesuada, non varius purus pellentesque. Ut venenatis magna risus, quis sodales urna tempus nec. Ut fermentum nibh sed velit euismod aliquam eget ut eros. Maecenas auctor velit non turpis viverra, consequat pharetra felis cursus. Etiam commodo diam ullamcorper, feugiat justo eget, dignissim felis. Aenean interdum risus arcu, et lobortis ex tincidunt vel. Aliquam ullamcorper ex at scelerisque eleifend. Vivamus hendrerit nec ex et dictum. Proin lacus augue, tincidunt in malesuada vitae, rutrum at ante. Praesent nec enim massa. Pellentesque commodo in libero vitae lobortis. Sed vel dictum lacus, quis pulvinar neque.'),
(2, 'Пользователь 2', 'user_2@example.com', SUBDATE(NOW(), INTERVAL 6 HOUR), 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut sem sem. Cras lobortis rutrum ipsum, non vestibulum dui consequat ac. Aliquam molestie ligula sapien, id ullamcorper massa bibendum vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum mi ex, rhoncus et gravida in, hendrerit nec orci. Praesent tincidunt faucibus sapien sodales imperdiet. Suspendisse malesuada faucibus nulla et euismod.'),
(3, 'Пользователь 3', 'user_3@example.com', SUBDATE(NOW(), INTERVAL 12 HOUR), 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque accumsan ex sed ligula malesuada, sit amet elementum mi iaculis. Suspendisse potenti. Curabitur libero diam, egestas at vulputate eget, tristique eget lorem. Maecenas in sagittis erat. Nam eu volutpat ipsum. Nullam mollis at magna elementum luctus. Proin nibh lorem, tempus sed venenatis sit amet, sagittis vel nisl. Phasellus consectetur convallis lacus, nec condimentum diam hendrerit vitae. Nam elit nisi, imperdiet ut dui id, bibendum viverra lacus. Sed volutpat dictum erat vitae hendrerit. Quisque vel tincidunt lectus. Pellentesque vestibulum scelerisque ex in auctor. Proin imperdiet justo in mi aliquet viverra. Phasellus malesuada mauris a interdum scelerisque. Vivamus turpis augue, suscipit non tincidunt in, condimentum sed mauris.'),
(4, 'Пользователь 4', 'user_4@example.com', SUBDATE(NOW(), INTERVAL 1 DAY), 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec nunc sodales, iaculis lorem non, pretium massa. Nunc tempus massa nec urna maximus, non tristique ante ultrices. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam ut orci ac purus imperdiet consectetur.'),
(5, 'Пользователь 5', 'user_5@example.com', NOW(), 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu libero vitae elit semper consectetur. Cras faucibus velit quis lacinia suscipit. Praesent fringilla, nulla in condimentum consectetur, purus eros convallis nulla, quis luctus risus elit ac magna. Phasellus massa arcu, feugiat quis sagittis ac, ultrices sit amet sem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Morbi sit amet condimentum est. Phasellus vestibulum libero nec ex lobortis bibendum.');
COMMIT;