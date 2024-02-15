-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 15, 2024 at 02:54 AM
-- Server version: 10.10.2-MariaDB
-- PHP Version: 8.0.26an

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE IF NOT EXISTS `recipes`
(
    `id`           int(11)      NOT NULL AUTO_INCREMENT,
    `recipe_name`  varchar(255) DEFAULT NULL,
    `creator`      varchar(255) NOT NULL,
    `date_entered` datetime     DEFAULT current_timestamp(),
    `ingredients`  text         DEFAULT NULL,
    `instructions` text         DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  AUTO_INCREMENT = 34
  DEFAULT CHARSET = latin1
  COLLATE = latin1_swedish_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `recipe_name`, `creator`, `date_entered`, `ingredients`, `instructions`)
VALUES (29, 'Meatballs', 'Yitzu Holtzberg', '2023-12-31 22:10:02', 'Tomato Sauce, Ground meat', 'cook cook cook'),
       (6, 'Chicken Caesar Salad', 'Chef Julia', '2023-02-15 00:00:00',
        'Romaine lettuce, grilled chicken, Caesar dressing, croutons, Parmesan cheese',
        'Toss the lettuce with dressing, top with chicken, croutons, and cheese.'),
       (7, 'Mushroom Risotto', 'Chef Giovanni', '2023-03-01 00:00:00',
        'Arborio rice, mushrooms, chicken broth, Parmesan cheese, white wine',
        'Saute mushrooms, add rice, broth, and wine, cook until creamy, stir in cheese.'),
       (9, 'Pad Thai', 'Chef Lin', '2023-03-15 00:00:00',
        'Rice noodles, shrimp, peanuts, bean sprouts, egg, Pad Thai sauce',
        'Cook noodles, stir-fry shrimp, add egg and sauce, mix with noodles, garnish with peanuts and sprouts.'),
       (10, 'Fish Tacos', 'Chef Carlos', '2023-03-20 00:00:00',
        'White fish, corn tortillas, cabbage slaw, lime, avocado',
        'Grill fish, serve on tortillas with slaw, top with lime and avocado.'),
       (11, 'Chicken Tikka Masala', 'Chef Singh', '2023-04-01 00:00:00',
        'Chicken, yogurt, masala spices, tomato sauce, cream',
        'Marinate chicken in yogurt and spices, grill, simmer in tomato sauce and cream.'),
       (12, 'Vegetable Quiche', 'Chef Emma', '2023-04-05 00:00:00',
        'Pie crust, eggs, cream, spinach, mushrooms, cheese',
        'Mix eggs and cream, add vegetables and cheese, bake in crust at 350°F for 45 minutes.'),
       (13, 'Sushi Rolls', 'Chef Sato', '2023-04-10 00:00:00', 'Sushi rice, nori, salmon, avocado, cucumber',
        'Spread rice on nori, add salmon, avocado, cucumber, roll and slice.'),
       (14, 'Moroccan Couscous', 'Chef Fatima', '2023-04-15 00:00:00',
        'Couscous, chickpeas, raisins, carrots, Moroccan spices',
        'Cook couscous with spices, add chickpeas, raisins, and carrots.'),
       (15, 'Greek Salad', 'Chef Elena', '2023-04-20 00:00:00',
        'Cucumber, tomatoes, olives, feta cheese, olive oil, oregano',
        'Combine cucumber, tomatoes, olives, top with feta, dress with olive oil and oregano.'),
       (16, 'English Breakfast', 'Chef Oliver', '2023-05-01 00:00:00', 'Eggs, bacon, baked beans, mushrooms, toast',
        'Fry eggs and bacon, grill mushrooms, serve with beans and toast.'),
       (17, 'Lemon Garlic Shrimp Pasta', 'Chef Sophia', '2023-05-05 00:00:00',
        'Pasta, shrimp, garlic, lemon, parsley, olive oil',
        'Cook pasta, sauté shrimp with garlic, toss with pasta, lemon, and parsley.'),
       (20, 'Indian Butter Chicken', 'Chef Raj', '2023-05-20 00:00:00',
        'Chicken, butter, cream, tomato sauce, garam masala',
        'Cook chicken, add butter, tomato sauce, cream, and spices, simmer until thick.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
