-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2021 at 02:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `publishDate` date NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `cover`, `publishDate`, `createdAt`, `updatedAt`) VALUES
(1, 'Where the Crawdads Sing', ' Delia Owens', 'Where the Crawdads Sing is a 2018 novel by American author Delia Owens. It has topped The New York Times Fiction Best Sellers of 2019 and The New York Times Fiction Best Sellers of 2020 for a combined 32 non-consecutive weeks. As of late January 2021, the', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRU7VvrmHmwlH_984mE_ylF6cc5BVNiPtl7NDrMRxyzRYVCWO8Z', '2018-08-14', '2021-09-08 09:48:22', '2021-09-08 09:48:22'),
(2, 'Atomic Habits', 'James Clear', 'The #1 New York Times bestseller. Over 2 million copies sold! Tiny Changes, Remarkable Results No matter your goals, Atomic Habits offers a proven framework for improving--every day.', 'https://images-na.ssl-images-amazon.com/images/I/81iAADNy2NL.jpg', '2018-10-16', '2021-09-08 10:42:09', '2021-09-08 10:42:09'),
(3, 'It Ends with Us: A Novel', 'Colleen Hoover', 'In this “brave and heartbreaking novel that digs its claws into you and doesn’t let go, long after you’ve finished it” ', 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1470427482l/27362503._SY475_.jpg', '2016-08-02', '2021-09-13 11:57:23', '2021-09-13 11:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing`
--

CREATE TABLE `borrowing` (
  `id` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `borrowerId` int(11) NOT NULL,
  `librarianId` int(11) NOT NULL,
  `borrowedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `returnedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `createdAt`, `updatedAt`) VALUES
(2, 'Student', 'Borrows Books', '2021-09-07 08:02:57', '2021-09-07 08:02:57'),
(3, 'Admin', 'Can manage all aspects of the Library System', '2021-09-07 08:29:51', '2021-09-07 08:29:51'),
(5, 'Librarian', 'Can create, edit and lend books', '2021-09-07 09:35:45', '2021-09-07 09:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phoneNo` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `roleId` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phoneNo`, `address`, `roleId`, `avatar`, `createdAt`, `updatedAt`) VALUES
(1, 'Alvin Kigen', '254712012246', '14952-00800 ', 2, 'https://randomuser.me/api/portraits/men/91.jpg', '2021-09-07 11:20:56', '2021-09-07 11:20:56'),
(2, 'Sandra Olembo', '+254722885561', '14952-00800 westlands', 5, 'https://uifaces.co/our-content/donated/XdLjsJX_.jpg', '2021-09-07 11:21:38', '2021-09-07 11:21:38'),
(3, 'Salim Maina', '+254722662310', '14952-00800 westlands', 3, 'https://randomuser.me/api/portraits/men/59.jpg', '2021-09-07 11:26:33', '2021-09-07 11:26:33'),
(10, 'Carys Metz', '+254700123456', 'Some place in Nai', 5, 'https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=faces&fit=crop&h=200&w=200&s=aa3a807e1bbdfd4364d1f449eaa96d82', '2021-09-08 07:45:10', '2021-09-08 07:45:10'),
(11, 'Patricia Wirimu', '+254701123456', 'Pangani', 2, 'https://randomuser.me/api/portraits/women/89.jpg', '2021-09-10 05:29:31', '2021-09-10 05:29:31'),
(12, 'Kevin Mwololo', '+2540706341846', 'Langata', 5, 'https://randomuser.me/api/portraits/men/80.jpg', '2021-09-10 05:32:45', '2021-09-10 05:32:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
