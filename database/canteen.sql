-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2018 at 11:42 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner'),
(4, 'Burger'),
(5, 'Beverage'),
(6, 'Desserts'),
(10, 'Fries');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `veg_nonveg` varchar(15) NOT NULL,
  `food_img` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `category`, `food_name`, `veg_nonveg`, `food_img`, `price`, `quantity`) VALUES
(1, 4, 'Chicken Maharaja Burger', 'nonveg', 'burger_1.png', 100, 2),
(2, 4, 'Veg Maharaja Burger', 'veg', 'burger_2.png', 50, 24),
(3, 4, 'Veg Burger', 'veg', 'burger_3.png', 25, 12),
(4, 5, 'Strawberry Shake', 'veg', 'bev_1.png', 50, 9),
(5, 5, 'Cold Coffee', 'veg', 'bev_2.png', 50, 18),
(6, 5, 'Coke Float', 'veg', 'bev_3.png', 25, 10),
(7, 5, 'Tea', 'veg', 'bev_4.png', 10, 94),
(8, 6, 'Red Pastry', 'veg', 'des_1.png', 30, 21),
(9, 6, 'Oreo Dessert', 'veg', 'des_2.png', 50, 14),
(10, 6, 'Chocolate Cream', 'veg', 'des_3.png', 35, 35),
(13, 4, 'Chicken Cheese', 'nonveg', 'burger_5.png', 125, 23),
(16, 4, 'Veg Cheese', 'veg', 'burger_6.png', 110, 24),
(17, 2, 'Chicken Lunch Meal', 'nonveg', 'lunch_1.png', 150, 30),
(18, 2, 'Veg Lunch Meal', 'veg', 'lunch_2.png', 130, 30),
(19, 1, 'Chicken Breakfast', 'nonveg', 'breakfast_1.png', 80, 30),
(20, 1, 'Chicken Cheese Breakfast', 'nonveg', 'breakfast_2.png', 90, 30),
(23, 1, 'Veg Breakfast', 'veg', 'breakfast_3.png', 65, 28),
(24, 10, 'Fries', 'veg', 'fries.png', 60, 40);

-- --------------------------------------------------------

--
-- Table structure for table `hero`
--

CREATE TABLE `hero` (
  `hero_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hero`
--

INSERT INTO `hero` (`hero_id`, `cat_id`, `image`) VALUES
(11, 1, 'Offer1.jpeg'),
(12, 2, 'Offer2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `ord_history_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_quantity` int(11) NOT NULL,
  `food_subtotal` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_placed_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `order_completed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`ord_history_id`, `food_id`, `food_quantity`, `food_subtotal`, `user_id`, `order_placed_at`, `order_completed_at`) VALUES
(1, 5, 1, 50, 2, '2018-09-30 20:30:09', '2018-10-01 20:31:18'),
(2, 1, 1, 100, 2, '2018-10-01 20:29:48', '2018-10-01 20:31:22'),
(3, 4, 2, 100, 2, '2018-10-01 20:29:48', '2018-10-01 20:31:23'),
(4, 6, 1, 25, 1, '2018-10-01 20:28:31', '2018-10-01 20:33:47'),
(5, 3, 2, 50, 1, '2018-10-01 20:28:31', '2018-10-01 20:33:48'),
(6, 8, 1, 30, 1, '2018-10-01 20:35:44', '2018-10-01 20:35:59'),
(7, 11, 1, 75, 1, '2018-10-01 20:41:05', '2018-10-01 20:41:23'),
(8, 4, 2, 100, 2, '2018-10-02 07:16:23', '2018-10-02 07:17:05'),
(9, 6, 1, 25, 1, '2018-10-02 08:28:03', '2018-10-02 08:32:37'),
(10, 11, 1, 75, 1, '2018-10-02 08:28:03', '2018-10-02 08:41:06'),
(11, 1, 4, 400, 1, '2018-10-02 07:15:01', '2018-10-02 11:58:15'),
(12, 16, 1, 110, 1, '2018-10-02 14:37:23', '2018-10-02 14:38:05'),
(13, 8, 2, 60, 1, '2018-10-02 14:37:22', '2018-10-02 14:38:06'),
(14, 13, 2, 250, 1, '2018-10-02 15:07:55', '2018-10-02 15:08:51'),
(15, 1, 1, 100, 1, '2018-10-03 17:22:42', '2018-10-04 16:46:54'),
(16, 9, 1, 50, 1, '2018-10-03 17:22:42', '2018-10-04 16:46:55'),
(17, 23, 2, 130, 26, '2018-10-04 21:31:38', '2018-10-04 21:35:07');

-- --------------------------------------------------------

--
-- Table structure for table `order_notification`
--

CREATE TABLE `order_notification` (
  `notif_id` int(11) NOT NULL,
  `food_quantity` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_subtotal` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_completed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pending_order`
--

CREATE TABLE `pending_order` (
  `po_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_quantity` int(11) NOT NULL,
  `food_subtotal` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_placed_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `food_id`, `rating`, `user_id`, `review_time`) VALUES
(1, 3, 3, 3, '2018-10-02 10:51:17'),
(2, 2, 3, 2, '2018-10-02 10:51:26'),
(5, 3, 5, 1, '2018-10-02 11:12:13'),
(6, 11, 5, 1, '2018-10-02 11:16:12'),
(7, 1, 4, 1, '2018-10-02 11:58:40'),
(8, 1, 3, 2, '2018-10-02 11:59:22'),
(9, 6, 3, 1, '2018-10-02 12:01:44'),
(10, 9, 4, 1, '2018-10-02 15:08:25'),
(11, 23, 3, 26, '2018-10-04 21:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phno` varchar(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `password`, `phno`, `role`) VALUES
(1, 'Pratik', 'Singh', 'pratiksingh.kr@gmail.com', '1234', '9987045119', 0),
(2, 'test', 'test', 'test@gmail.com', '1234', '1234', 0),
(3, 'test1', 'test1', 'test1@gmail.com', '1234', '1234', 0),
(4, 'super', 'admin', 'sadmin@gmail.com', '1234', '1234', 1),
(26, 'Singh', 'Pratik', 'pratik4android@gmail.com', '1234', '1234567', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`hero_id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`ord_history_id`);

--
-- Indexes for table `order_notification`
--
ALTER TABLE `order_notification`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `pending_order`
--
ALTER TABLE `pending_order`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `hero`
--
ALTER TABLE `hero`
  MODIFY `hero_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `ord_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_notification`
--
ALTER TABLE `order_notification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pending_order`
--
ALTER TABLE `pending_order`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
