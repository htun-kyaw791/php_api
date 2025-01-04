-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 03:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enrollment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_tokens`
--

CREATE TABLE `access_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access_tokens`
--

INSERT INTO `access_tokens` (`id`, `user_id`, `token`, `created_at`, `expires_at`) VALUES
(1, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUxODY5OTYsImV4cCI6MTczNTI3MzM5NiwidXNlcklkIjoiMSJ9.QIPfmZyg24becS9rK7mr6KG_FcTzQZTubnCmcuqRiwg', '2024-12-26 04:23:16', '0000-00-00 00:00:00'),
(2, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUxOTA1NjEsImV4cCI6MTczNTI3Njk2MSwidXNlcklkIjoiNCJ9.zjax3FFuT1KJECEvQp1kmBBnhhfLt--UcRRnmtgP6s0', '2024-12-26 05:22:41', '0000-00-00 00:00:00'),
(5, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUxOTY4MTAsImV4cCI6MTczNTI4MzIxMCwidXNlcklkIjoxfQ.uDyxCsZM7t_Izjb6PSQLh2EtCZVZw4on8etybRumdoM', '2024-12-26 07:06:50', '0000-00-00 00:00:00'),
(6, 9, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUxOTg2MjYsImV4cCI6MTczNTI4NTAyNiwidXNlcklkIjoiOSJ9._70MpusgnIR9NOf9BYN4gDdCWZkPgoQCWvLUKWLrbA0', '2024-12-26 07:37:06', '0000-00-00 00:00:00'),
(7, 9, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUxOTg2NTAsImV4cCI6MTczNTI4NTA1MCwidXNlcklkIjo5fQ.4qkVZucYXXtYOaPGOgGnPgcEdwgRaxXEb1LGYDpM-Cg', '2024-12-26 07:37:30', '0000-00-00 00:00:00'),
(8, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUyMDE3MzQsImV4cCI6MTczNTI4ODEzNCwidXNlcklkIjo1fQ.xoMYofAWv2PIGZtwOWxlcuskjCklamjN45a6fGjRjfg', '2024-12-26 08:28:54', '0000-00-00 00:00:00'),
(9, 12, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzNzM1NDAsImV4cCI6MTczNTQ1OTk0MCwidXNlcklkIjoiMTIifQ.yjAKF9wlkb9klZ39T4qgqE7MGp6qnvMQvSzLN_l6voY', '2024-12-28 08:12:20', '0000-00-00 00:00:00'),
(10, 12, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzNzQxNDgsImV4cCI6MTczNTQ2MDU0OCwidXNlcklkIjoxMn0.JjmHVwMkDZy8IPTM65OCLu4z57H7nGLNhxzwEwYehlo', '2024-12-28 08:22:28', '0000-00-00 00:00:00'),
(12, 12, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzNzQ4MjYsImV4cCI6MTczNTQ2MTIyNiwidXNlcklkIjoxMn0.TMXXjgIEwj4LhYkedQjvZNLabJXrYXPnZCb4yH8hAOc', '2024-12-28 08:33:46', '0000-00-00 00:00:00'),
(13, 12, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzNzQ4MjksImV4cCI6MTczNTQ2MTIyOSwidXNlcklkIjoxMn0.N5sPs1DpqgtkmKis6X9ykhT4p4q_rvYPZkOd35BCpPk', '2024-12-28 08:33:49', '0000-00-00 00:00:00'),
(14, 12, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzNzQ5MDIsImV4cCI6MTczNTQ2MTMwMiwidXNlcklkIjoxMn0.z6Ub7a9VXCtmDsjVyT0357EJ87ZWXj-vy_W-AnXMV7k', '2024-12-28 08:35:02', '0000-00-00 00:00:00'),
(15, 12, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzNzUxMzcsImV4cCI6MTczNTQ2MTUzNywidXNlcklkIjoxMn0.L-yuO-NFZI4X4FyWfgrnzFIUEccDGMkpjR-sG47ph9g', '2024-12-28 08:38:57', '0000-00-00 00:00:00'),
(16, 12, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzNzUzMjQsImV4cCI6MTczNTQ2MTcyNCwidXNlcklkIjoxMn0.FTW7h5g5Ugq3gCrTRVjSm3hAzhmQ6REmWFevc7rMDmc', '2024-12-28 08:42:04', '0000-00-00 00:00:00'),
(17, 13, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzNzY1MDAsImV4cCI6MTczNTQ2MjkwMCwidXNlcklkIjoiMTMifQ.JuQUwwa8hqt0EO0ixeThp-yRwPF7Qn_Ot-jeRwtMrmY', '2024-12-28 09:01:40', '0000-00-00 00:00:00'),
(18, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzNzY2NDcsImV4cCI6MTczNTQ2MzA0NywidXNlcklkIjo3fQ.56N6xLf1lbQwd61Y-WHg3-WwqvdQOdk6K4gn7RQB3YQ', '2024-12-28 09:04:07', '0000-00-00 00:00:00'),
(19, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzNzY4MDYsImV4cCI6MTczNTQ2MzIwNiwidXNlcklkIjo1fQ.LXZKz6RPAuQ1q6s7AIwaeKDQnlksjQYld3A4VXPemqQ', '2024-12-28 09:06:46', '0000-00-00 00:00:00'),
(20, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzNzc4NTgsImV4cCI6MTczNTQ2NDI1OCwidXNlcklkIjoxfQ._84h5H2RdesRhbRfU0ne5jyN9Jw5UE7gAnvP0GGmERU', '2024-12-28 09:24:18', '0000-00-00 00:00:00'),
(21, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzODY5MDEsImV4cCI6MTczNTQ3MzMwMSwidXNlcklkIjo1fQ.C996yRoKXBXi34dGITss0rimnjGW1xGGCuXBkTjxvyQ', '2024-12-28 11:55:01', '0000-00-00 00:00:00'),
(22, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzODY5OTIsImV4cCI6MTczNTQ3MzM5MiwidXNlcklkIjoxfQ.gEFhycHmi_BV3pEaRQXlhz38IXVgozy9Cm90MHhaY0g', '2024-12-28 11:56:32', '0000-00-00 00:00:00'),
(23, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzODgzMTcsImV4cCI6MTczNTQ3NDcxNywidXNlcklkIjoxfQ.zJFMujAVC3QmEMxCGj8adnerBCPjuN08n_eOm6CZdIM', '2024-12-28 12:18:37', '0000-00-00 00:00:00'),
(24, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzODg2NjUsImV4cCI6MTczNTQ3NTA2NSwidXNlcklkIjoxfQ.bQcJovm1y7DHLdgWMgIWZMy2PjaXkWQU0a3hR_Nn33I', '2024-12-28 12:24:25', '0000-00-00 00:00:00'),
(25, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzOTA2NjUsImV4cCI6MTczNTQ3NzA2NSwidXNlcklkIjo1fQ.QBK04sx4rOIfT2PfSEleeoVi6Pv4auyrIt5o1mOOuYg', '2024-12-28 12:57:45', '0000-00-00 00:00:00'),
(26, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzUzOTE4MzIsImV4cCI6MTczNTQ3ODIzMiwidXNlcklkIjo3fQ.pL-HEY3fhMcQdPgO__jY3WGE9lKVxxzI7ADEVtnT7uI', '2024-12-28 13:17:12', '0000-00-00 00:00:00'),
(27, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU0MDI0ODcsImV4cCI6MTczNTQ4ODg4NywidXNlcklkIjoxfQ.vfNry7LEJjkHHxd5yGDjcAX3Bj9nWdUAzhInscsosOs', '2024-12-28 16:14:47', '0000-00-00 00:00:00'),
(28, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU0MDI1OTYsImV4cCI6MTczNTQ4ODk5NiwidXNlcklkIjo1fQ.hbQXqzFUcbMyZcsaRc7999h359HJxJMTcMkW-zzlwFo', '2024-12-28 16:16:36', '0000-00-00 00:00:00'),
(29, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU0Mzk0NTUsImV4cCI6MTczNTUyNTg1NSwidXNlcklkIjoxfQ.Z6hfXqenmQB2NT1ovafV0ck6fuduDF2o-zwJx5pGg80', '2024-12-29 02:30:55', '0000-00-00 00:00:00'),
(30, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU1Mjc2OTgsImV4cCI6MTczNTYxNDA5OCwidXNlcklkIjo1fQ.uF3P0GtSlBDRqoO0hfzPkeHCS1r9TKKdrqy3y_nedoI', '2024-12-30 03:01:38', '0000-00-00 00:00:00'),
(31, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU1Mjg4NzcsImV4cCI6MTczNTYxNTI3NywidXNlcklkIjo1fQ.1jRpwTvZsYI3QFu5LiRZfeAvLBP1MVMM777EiusPp5Y', '2024-12-30 03:21:17', '0000-00-00 00:00:00'),
(32, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU1MzY5MzYsImV4cCI6MTczNTYyMzMzNiwidXNlcklkIjoxfQ.fqc9vhXYDElQgfdBC1F3PL33TY1YWSSHZ9hoEBJim_c', '2024-12-30 05:35:36', '0000-00-00 00:00:00'),
(33, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU1NDYwMjEsImV4cCI6MTczNTYzMjQyMSwidXNlcklkIjoxfQ.hfR0f7BV3R9o-XdRoLFM02rgy7cubxEx98A3IuhFdj8', '2024-12-30 08:07:01', '0000-00-00 00:00:00'),
(34, 16, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU1NzIxODEsImV4cCI6MTczNTY1ODU4MSwidXNlcklkIjoiMTYifQ.m0mdQ1_oujwju8AytjElPBsW6u4ODZtHRpGS8K0Y2SQ', '2024-12-30 15:23:01', '0000-00-00 00:00:00'),
(35, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU1NzMzNTYsImV4cCI6MTczNTY1OTc1NiwidXNlcklkIjoiMTcifQ.sPSWGrnTMKBTbbJThs031s5HPX95yWm_g6nnUnmEMJ4', '2024-12-30 15:42:36', '0000-00-00 00:00:00'),
(36, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU1NzQ1OTgsImV4cCI6MTczNTY2MDk5OCwidXNlcklkIjo1fQ.tgS1QiBsVqAv4WVXGtT1_UcBUu0ZvGMsXv_RVo0H-i4', '2024-12-30 16:03:18', '0000-00-00 00:00:00'),
(37, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU1NzQ2NDEsImV4cCI6MTczNTY2MTA0MSwidXNlcklkIjo3fQ.wy5L8rn2oqI5v1PJfKbW7gyXyv8cfTWehf17dzZtO_M', '2024-12-30 16:04:01', '0000-00-00 00:00:00'),
(38, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU1NzQ4MDEsImV4cCI6MTczNTY2MTIwMSwidXNlcklkIjoxfQ.Xwxlba1H6ZqZ82UusZk5QUGwAgTvaQVvBhA0Xm7xLc0', '2024-12-30 16:06:41', '0000-00-00 00:00:00'),
(39, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTQ2NTUsImV4cCI6MTczNTcwMTA1NSwidXNlcklkIjo1fQ.vo3J4kcqx3E6rEvLF35uZ6OMtco6dnGQnTs2Aa4OFpg', '2024-12-31 03:10:55', '0000-00-00 00:00:00'),
(40, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTY4NzEsImV4cCI6MTczNTcwMzI3MSwidXNlcklkIjoxN30.l1kW48iGyb8GprkucNimUWM3RG_RHDa4_GHAu0UyrbE', '2024-12-31 03:47:51', '0000-00-00 00:00:00'),
(41, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkwNDksImV4cCI6MTczNTcwNTQ0OSwidXNlcklkIjoxN30.SETIbYjcRQrPNRj5biBGu3aWXiYXX665sVAEIMnnn7w', '2024-12-31 04:24:09', '0000-00-00 00:00:00'),
(42, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkwNTEsImV4cCI6MTczNTcwNTQ1MSwidXNlcklkIjoxN30.Qd8fMqfJMu3LNdaPwEe1S5HYOuOKYRe3m9HHESVkoXo', '2024-12-31 04:24:11', '0000-00-00 00:00:00'),
(43, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkwNTIsImV4cCI6MTczNTcwNTQ1MiwidXNlcklkIjoxN30._-ec6EWMwzk-QNBcIvlAU3iVqRdhLigH8lOiila19WU', '2024-12-31 04:24:12', '0000-00-00 00:00:00'),
(44, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkwNTIsImV4cCI6MTczNTcwNTQ1MiwidXNlcklkIjoxN30._-ec6EWMwzk-QNBcIvlAU3iVqRdhLigH8lOiila19WU', '2024-12-31 04:24:12', '0000-00-00 00:00:00'),
(45, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkwNTIsImV4cCI6MTczNTcwNTQ1MiwidXNlcklkIjoxN30._-ec6EWMwzk-QNBcIvlAU3iVqRdhLigH8lOiila19WU', '2024-12-31 04:24:12', '0000-00-00 00:00:00'),
(46, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkwNTIsImV4cCI6MTczNTcwNTQ1MiwidXNlcklkIjoxN30._-ec6EWMwzk-QNBcIvlAU3iVqRdhLigH8lOiila19WU', '2024-12-31 04:24:12', '0000-00-00 00:00:00'),
(47, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkwNTQsImV4cCI6MTczNTcwNTQ1NCwidXNlcklkIjoxN30.Fsp_anuB16sMQNmLvS1sngZLOTWTSCi74Kn75aJaEWs', '2024-12-31 04:24:14', '0000-00-00 00:00:00'),
(48, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkwNTUsImV4cCI6MTczNTcwNTQ1NSwidXNlcklkIjoxN30.CzCnq-4TfRs0MR4R7gy5ajyN-5poMyt1hvieJspZul8', '2024-12-31 04:24:15', '0000-00-00 00:00:00'),
(49, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkwNTcsImV4cCI6MTczNTcwNTQ1NywidXNlcklkIjoxN30.zjvPEW6CawsZJXS8_k8a605Dia2_YPqQt7mBT1aZUhE', '2024-12-31 04:24:17', '0000-00-00 00:00:00'),
(50, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkwNTcsImV4cCI6MTczNTcwNTQ1NywidXNlcklkIjoxN30.zjvPEW6CawsZJXS8_k8a605Dia2_YPqQt7mBT1aZUhE', '2024-12-31 04:24:17', '0000-00-00 00:00:00'),
(51, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkwNTcsImV4cCI6MTczNTcwNTQ1NywidXNlcklkIjoxN30.zjvPEW6CawsZJXS8_k8a605Dia2_YPqQt7mBT1aZUhE', '2024-12-31 04:24:17', '0000-00-00 00:00:00'),
(52, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MTkyMzUsImV4cCI6MTczNTcwNTYzNSwidXNlcklkIjoxN30.4iyKQWf2-ncuDwBN9Ot7rHfAj2h_LM1sBz1Pu2F1d8M', '2024-12-31 04:27:15', '0000-00-00 00:00:00'),
(53, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MjE5MjUsImV4cCI6MTczNTcwODMyNSwidXNlcklkIjoxN30.VoxHxyhYu_VPcuvIMaZNClzlcUEdb_aWlOf1gRpi7Eg', '2024-12-31 05:12:05', '0000-00-00 00:00:00'),
(54, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MjcyNTUsImV4cCI6MTczNTcxMzY1NSwidXNlcklkIjoxN30.PzSlX6JiimG0VrnrGRRRSwmDMcM9_PqbOnlUMXBP6wY', '2024-12-31 06:40:55', '0000-00-00 00:00:00'),
(55, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2MzcyNTEsImV4cCI6MTczNTcyMzY1MSwidXNlcklkIjoxfQ.7jphQ4ps3XDWI5ETyZL_hyzVjuRt6_oWNJPWCDsAiSY', '2024-12-31 09:27:31', '0000-00-00 00:00:00'),
(56, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2NDU0NjYsImV4cCI6MTczNTczMTg2NiwidXNlcklkIjoxfQ.dQrRB8Wao48iunmo6OfUvdH5sJXpcL-KMPwmuaWN2kA', '2024-12-31 11:44:26', '0000-00-00 00:00:00'),
(57, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2NDk1ODEsImV4cCI6MTczNTczNTk4MSwidXNlcklkIjoxN30.yu395DfhcpK8zpAbVVCAHjrWTMOE8w0VOb7S68Gjy9Y', '2024-12-31 12:53:01', '0000-00-00 00:00:00'),
(58, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2NTA3ODAsImV4cCI6MTczNTczNzE4MCwidXNlcklkIjoxN30.0NDAaGHuF_uO6UgSLSSuhLXeH6vzaXqHLlEparZnmlE', '2024-12-31 13:13:00', '0000-00-00 00:00:00'),
(59, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2NTEwOTksImV4cCI6MTczNTczNzQ5OSwidXNlcklkIjoxN30.ZWumQJMQ2dFBULCfuY5FUNIR-ceNJkLvs-SrH4V6OLg', '2024-12-31 13:18:19', '0000-00-00 00:00:00'),
(60, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2NTE1MTMsImV4cCI6MTczNTczNzkxMywidXNlcklkIjoxN30.VtuLzQW1I3SgTkY7uYM6QVbHNpxO-AW31mAotvQVz04', '2024-12-31 13:25:13', '0000-00-00 00:00:00'),
(61, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2NTE1NDAsImV4cCI6MTczNTczNzk0MCwidXNlcklkIjo3fQ.v81xFh-HPSda8hFzE620S6bavOFRbg9iVPNgy_t1lQI', '2024-12-31 13:25:40', '0000-00-00 00:00:00'),
(62, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2NTE3MTQsImV4cCI6MTczNTczODExNCwidXNlcklkIjoxN30.wMl-mBDzatpRc8r0PRah9mNnmZ36mUnw6qypB5SvY9g', '2024-12-31 13:28:34', '0000-00-00 00:00:00'),
(63, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU2NTMxMjAsImV4cCI6MTczNTczOTUyMCwidXNlcklkIjoxfQ.m3q4M9FLtP0oMtVKEJy8rRxj6VEK7TBiyPgHra-SHUE', '2024-12-31 13:52:00', '0000-00-00 00:00:00'),
(64, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU3MDQ0MTQsImV4cCI6MTczNTc5MDgxNCwidXNlcklkIjoxfQ.jsGGjLgXcY0XotfjxL5NoxJHju423zNLPfgOIn0VUB4', '2025-01-01 04:06:54', '0000-00-00 00:00:00'),
(65, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU3MDQ1MDQsImV4cCI6MTczNTc5MDkwNCwidXNlcklkIjoxfQ.I42pO0dKo4lJiXH2IAI2XRehS45g38ZdnXu8FuVEZwE', '2025-01-01 04:08:24', '0000-00-00 00:00:00'),
(66, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU3MTk1NDAsImV4cCI6MTczNTgwNTk0MCwidXNlcklkIjoxfQ.53atOKFszmMfp3GOj7pjHzyYopHr1JUqW9AIcbNJApY', '2025-01-01 08:19:00', '0000-00-00 00:00:00'),
(67, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4MTEzODYsImV4cCI6MTczNTg5Nzc4NiwidXNlcklkIjoxfQ.09ujZMUrI4bWPVdSTkShNVBJF-HHj6gHcOG8Bplu-O8', '2025-01-02 09:49:46', '0000-00-00 00:00:00'),
(68, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4MTE2MzEsImV4cCI6MTczNTg5ODAzMSwidXNlcklkIjoxfQ.4pNDpr-8saoxEVJJcKwiq4i-9ZUmHWI0OhybO79WfsU', '2025-01-02 09:53:51', '0000-00-00 00:00:00'),
(69, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4MTMwMzksImV4cCI6MTczNTg5OTQzOSwidXNlcklkIjoxfQ.3kVdyWuYAJ_ui_M1lCFX0zd9p9JPnqweYBxHVcLirBQ', '2025-01-02 10:17:19', '0000-00-00 00:00:00'),
(70, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4MjA3OTYsImV4cCI6MTczNTkwNzE5NiwidXNlcklkIjoxfQ.UKMJ3Hlk2qQQfDUOBo4vNgx3KdGaV5fLp_E_ofaUJOY', '2025-01-02 12:26:36', '0000-00-00 00:00:00'),
(71, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4MjcyNDQsImV4cCI6MTczNTkxMzY0NCwidXNlcklkIjoxfQ.w1lpDBM9zWSgl5-jYR-zNFQl9prDfVBVuQLIv1qzQ3o', '2025-01-02 14:14:04', '0000-00-00 00:00:00'),
(72, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4MjczNDYsImV4cCI6MTczNTkxMzc0NiwidXNlcklkIjo1fQ.gWN-wPsm319KeP8C0uPfHZaRS-ezPcXoZaVWiXN9w9M', '2025-01-02 14:15:46', '0000-00-00 00:00:00'),
(73, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4MzM5MjksImV4cCI6MTczNTkyMDMyOSwidXNlcklkIjoxfQ.8oCPQB1aIfyhoDwAWeUNebOaOGUNqIVyUmKDX9h0bNk', '2025-01-02 16:05:29', '0000-00-00 00:00:00'),
(74, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4MzQxMDEsImV4cCI6MTczNTkyMDUwMSwidXNlcklkIjoxfQ.0Q02ouWb9SLj7k2YKmxtEDYXTteDGRzBsVTglMVTE88', '2025-01-02 16:08:21', '0000-00-00 00:00:00'),
(75, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4NDI4MTUsImV4cCI6MTczNTkyOTIxNSwidXNlcklkIjoxfQ.4znnnf6VfribcIt9zxfXJLUfidmTlUk_JHlJVHpT7As', '2025-01-02 18:33:35', '0000-00-00 00:00:00'),
(76, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4NjkxNTEsImV4cCI6MTczNTk1NTU1MSwidXNlcklkIjoxfQ.lnA20OHLcRVhHVhtoQIyeFr1zTOm5UQPZ-OHRHHqWyE', '2025-01-03 01:52:31', '0000-00-00 00:00:00'),
(77, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4NzQ2MTksImV4cCI6MTczNTk2MTAxOSwidXNlcklkIjoxfQ.AfcOrtho4KFnLsOj8_ty_rylPwEQW9KNU4ZqVdtTD-k', '2025-01-03 03:23:39', '0000-00-00 00:00:00'),
(78, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4ODc1MjMsImV4cCI6MTczNTk3MzkyMywidXNlcklkIjoxfQ.b6lw20jelzMXQWPHBeQh6cm1ON3uTMf96tQqx31P5y4', '2025-01-03 06:58:43', '0000-00-00 00:00:00'),
(79, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4ODc1NDQsImV4cCI6MTczNTk3Mzk0NCwidXNlcklkIjoxfQ.kMlRnSwQ9SerRl69ZOejnnMHkx5NqSVqrT1t0u8jESA', '2025-01-03 06:59:04', '0000-00-00 00:00:00'),
(80, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4OTI0NzUsImV4cCI6MTczNTk3ODg3NSwidXNlcklkIjoxN30.Q_fgCgG9jtN4TwKci45eRxmSe4EXWBUVNZy5e5aUQfU', '2025-01-03 08:21:15', '0000-00-00 00:00:00'),
(81, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4OTMyOTQsImV4cCI6MTczNTk3OTY5NCwidXNlcklkIjoxN30.948p67AXRsI3U-2f8dwkMWLakLAZv1tKvq8W4WRHQSs', '2025-01-03 08:34:54', '0000-00-00 00:00:00'),
(82, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4OTQyMTcsImV4cCI6MTczNTk4MDYxNywidXNlcklkIjoxN30.Qy35hMPOBAwMu2Hf8ZCEeHGobPZm7mtleCqI93PgpzA', '2025-01-03 08:50:17', '0000-00-00 00:00:00'),
(83, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4OTkwNDcsImV4cCI6MTczNTk4NTQ0NywidXNlcklkIjoxfQ.oRZdRI1puY_vQkLvOD8JbX9lwG36_vjY6tm4IlGGCb0', '2025-01-03 10:10:47', '0000-00-00 00:00:00'),
(84, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU4OTkwNjIsImV4cCI6MTczNTk4NTQ2MiwidXNlcklkIjoxfQ.X8PJ9N_r93kSrNQWHUYl3Soh7zFXSNnboEFgOsbRQ9Y', '2025-01-03 10:11:02', '0000-00-00 00:00:00'),
(85, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MDAwMjMsImV4cCI6MTczNTk4NjQyMywidXNlcklkIjoxN30.Sqny1ZYnHS8miEz4wPC9klbJ3bL3EHXfv46XlKDk9SI', '2025-01-03 10:27:03', '0000-00-00 00:00:00'),
(86, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MDI1MjUsImV4cCI6MTczNTk4ODkyNSwidXNlcklkIjoxN30.zWEteLz1gE1PDeuXcPwE5XD--9yzM15u5W_V_i6g-MI', '2025-01-03 11:08:45', '0000-00-00 00:00:00'),
(87, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MDg0NDIsImV4cCI6MTczNTk5NDg0MiwidXNlcklkIjo1fQ.D9ryRzh4vJ71aNMpyeP0CqGlqXZU5Bl-50W7-AjVNyE', '2025-01-03 12:47:22', '0000-00-00 00:00:00'),
(88, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MDk4ODksImV4cCI6MTczNTk5NjI4OSwidXNlcklkIjo1fQ.A_pAk-8hyvF5SOnYqMJPlGi_5yMkkAUXWMOsbh_GF0A', '2025-01-03 13:11:29', '0000-00-00 00:00:00'),
(89, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MTIzNjcsImV4cCI6MTczNTk5ODc2NywidXNlcklkIjo1fQ.dYwgx2vYgNIF9Wx5UVCx-Tk68NZHmfkRrDxkQZVWmRo', '2025-01-03 13:52:47', '0000-00-00 00:00:00'),
(90, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MTMzMjksImV4cCI6MTczNTk5OTcyOSwidXNlcklkIjoxfQ.8XTxDsw62rxxdgw3p8Wt-OGUU0O4QCcU01MxMcXJuLo', '2025-01-03 14:08:49', '0000-00-00 00:00:00'),
(91, 18, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MTQ4MTMsImV4cCI6MTczNjAwMTIxMywidXNlcklkIjoiMTgifQ.UpSaFbphuOg5LZPnR8lgUYKcoWZp_9-RW69eD46_V64', '2025-01-03 14:33:33', '0000-00-00 00:00:00'),
(92, 18, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MTQ4ODYsImV4cCI6MTczNjAwMTI4NiwidXNlcklkIjoxOH0.RG4xzaG_Bf3En4fcQONzhorIYiQVI5Mc9xh8d6_M-mM', '2025-01-03 14:34:46', '0000-00-00 00:00:00'),
(93, 19, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MTUxOTQsImV4cCI6MTczNjAwMTU5NCwidXNlcklkIjoiMTkifQ._lmgfTCkSAwPaUTXEwtNO1Uaqcl8wVANGtqCUsrcFZg', '2025-01-03 14:39:54', '0000-00-00 00:00:00'),
(94, 19, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MTUyMTQsImV4cCI6MTczNjAwMTYxNCwidXNlcklkIjoxOX0.RHXQFB7ZfX77eoFQ3TGG0qQB8YLcwTd905c-h2X29ZA', '2025-01-03 14:40:14', '0000-00-00 00:00:00'),
(95, 20, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MTk5NTUsImV4cCI6MTczNjAwNjM1NSwidXNlcklkIjoiMjAifQ.m_z_lZP_8Y1jB8y5G9lJzGKV50_SgD98HATEbCcpLMI', '2025-01-03 15:59:15', '0000-00-00 00:00:00'),
(96, 20, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjAwMjAsImV4cCI6MTczNjAwNjQyMCwidXNlcklkIjoyMH0.aphP3_gsrP3INYxUuD8lQu0Qh4SWp-YduIZpLeJfdiY', '2025-01-03 16:00:20', '0000-00-00 00:00:00'),
(97, 21, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjAxNjgsImV4cCI6MTczNjAwNjU2OCwidXNlcklkIjoiMjEifQ.9aoYeO-4yZ0D8LyKUWvjzJZc0dSg9LJedhSsmYldaLY', '2025-01-03 16:02:48', '0000-00-00 00:00:00'),
(98, 21, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjAxOTcsImV4cCI6MTczNjAwNjU5NywidXNlcklkIjoyMX0.FJ9esD1SAX2iIjy34dUBkqCmMy5paZpiZf1FQmvX2TM', '2025-01-03 16:03:17', '0000-00-00 00:00:00'),
(99, 22, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjA2ODgsImV4cCI6MTczNjAwNzA4OCwidXNlcklkIjoiMjIifQ.9uhgxjSTBGXpqHcX7XPt7BiJpelFHNBfX6y_2-obesE', '2025-01-03 16:11:28', '0000-00-00 00:00:00'),
(100, 22, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjA3NjIsImV4cCI6MTczNjAwNzE2MiwidXNlcklkIjoyMn0.Ml96iDfZzFPfphkpZgpMpb0oi-jH5aHE5ToeBQ0Ymuk', '2025-01-03 16:12:42', '0000-00-00 00:00:00'),
(101, 23, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjEwMjQsImV4cCI6MTczNjAwNzQyNCwidXNlcklkIjoiMjMifQ.qvSCz1xkQJG2EPbd1tQfqO5c9gTmpaXidOXUQTlFpWc', '2025-01-03 16:17:04', '0000-00-00 00:00:00'),
(102, 23, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjEwODUsImV4cCI6MTczNjAwNzQ4NSwidXNlcklkIjoyM30.180FJt4X5qMQCxDr-tcp39bd-4aFk2UUI9OCB9x9xF8', '2025-01-03 16:18:05', '0000-00-00 00:00:00'),
(103, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjEzNzMsImV4cCI6MTczNjAwNzc3MywidXNlcklkIjoxN30.BakWVcRyfPygOUGBqbuOePV9IzsD--kKOxAkISC7G5Q', '2025-01-03 16:22:53', '0000-00-00 00:00:00'),
(104, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjE2MzUsImV4cCI6MTczNjAwODAzNSwidXNlcklkIjoxN30.e6ntG2cGu5xQWg55g8UmOLWXcBPjyxXZMOkQ8snz4fU', '2025-01-03 16:27:15', '0000-00-00 00:00:00'),
(105, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjE2NTgsImV4cCI6MTczNjAwODA1OCwidXNlcklkIjoxN30.qif6ImwGt6TyUv3_XTe5lbW-_WIh7-TRuEfDiR_97xc', '2025-01-03 16:27:38', '0000-00-00 00:00:00'),
(106, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjIzOTUsImV4cCI6MTczNjAwODc5NSwidXNlcklkIjoxN30.zxUwt2pN5o8rtBLFvnF7X5_uR3xwOlLwDU9s50ATJ-I', '2025-01-03 16:39:55', '0000-00-00 00:00:00'),
(107, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjI1MTEsImV4cCI6MTczNjAwODkxMSwidXNlcklkIjo3fQ.PF3BPT6IL_Rw4pkjLGcybfbsMVNZNA1scyulr-IIIsk', '2025-01-03 16:41:51', '0000-00-00 00:00:00'),
(108, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjI2NDIsImV4cCI6MTczNjAwOTA0MiwidXNlcklkIjo3fQ.lfiHpyuTQYO9d1AdQnIJ7N76Z4IwHlzve0ir5XxToaU', '2025-01-03 16:44:02', '0000-00-00 00:00:00'),
(109, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjM4MjYsImV4cCI6MTczNjAxMDIyNiwidXNlcklkIjo3fQ.rcFucTRyES8oRHpXp9CdQ4R4PfRF3dgBESXoFujEyqs', '2025-01-03 17:03:46', '0000-00-00 00:00:00'),
(110, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjM4NDIsImV4cCI6MTczNjAxMDI0MiwidXNlcklkIjo3fQ.7BbzKETAL3v09xqmApoFRpQbhu8Inf0T5BoAkLeunTs', '2025-01-03 17:04:02', '0000-00-00 00:00:00'),
(111, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjQwNTAsImV4cCI6MTczNjAxMDQ1MCwidXNlcklkIjo3fQ.vA66vQBoBoACFmYhdH_yCfAhherK9phvrMtq8NcOW9c', '2025-01-03 17:07:30', '0000-00-00 00:00:00'),
(112, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5MjcyOTksImV4cCI6MTczNjAxMzY5OSwidXNlcklkIjo3fQ.LrHrHNH1Biiih2-FsQF8ku-3MSIwqpSucQIjFnQV5Io', '2025-01-03 18:01:39', '0000-00-00 00:00:00'),
(113, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5Mjc3MTksImV4cCI6MTczNjAxNDExOSwidXNlcklkIjo3fQ.A-rTOlmDfFqtUNprbFavSAFdlhMnZ29LOfmVa_b8G2A', '2025-01-03 18:08:39', '0000-00-00 00:00:00'),
(114, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyX2FwcF9uYW1lIiwiYXVkIjoieW91cl9hcHBfYXVkaWVuY2UiLCJpYXQiOjE3MzU5Mjc4MDUsImV4cCI6MTczNjAxNDIwNSwidXNlcklkIjoxfQ.8buCuE3y0KZjuFflkK7yw7mKXARxFyCRl1xYKyvvws0', '2025-01-03 18:10:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `teacher_id`, `created_at`, `updated_at`) VALUES
(2, 'SWD Dec 2024', 'to be a fronted-developer', 10, '2024-12-29 05:26:40', '2025-01-03 07:07:56'),
(3, 'PUD Jann 2025', 'a designer', 10, '2025-01-02 16:04:11', '2025-01-02 18:06:46'),
(5, 'BUD Feb 2025', 'a professional designer', 10, '2025-01-02 16:37:34', '2025-01-02 16:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `section_id`, `amount`, `created_at`, `updated_at`) VALUES
(3, 0, 0, 0, '2024-12-30 03:22:29', '2024-12-30 04:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `evidence_image` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','rejected') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `enrollment_id`, `payment_type_id`, `student_id`, `amount`, `evidence_image`, `status`, `created_at`, `updated_at`) VALUES
(4, 3, 8, 5, 7000.00, 'image_67736250de44b.jpg', 'pending', '2024-12-31 03:17:36', '2024-12-31 03:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `paymenttypeid` int(11) NOT NULL,
  `paymenttypename` varchar(255) NOT NULL,
  `paymenttypeimage` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`paymenttypeid`, `paymenttypename`, `paymenttypeimage`, `created_at`, `updated_at`) VALUES
(9, 'wave pay', 'image_6773fd2f76aba.png', '2024-12-31 14:18:23', '2024-12-31 14:18:23'),
(10, 'kpay', 'image_6776862674441.png', '2025-01-01 08:49:46', '2025-01-02 12:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `course_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`course_ids`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `start_date`, `end_date`, `cost`, `course_ids`, `created_at`, `updated_at`) VALUES
(1, 'S2025Sets testing', '2024-12-10', '2025-06-10', 250000.00, '3', '2024-12-29 13:09:22', '2025-01-03 06:54:18'),
(17, 'S2024Sets', '2024-11-10', '2025-05-10', 450000.00, '2', '2025-01-03 05:42:35', '2025-01-03 06:28:26'),
(22, 'testing4', '2025-01-09', '2025-02-06', 450000.00, '3', '2025-01-03 14:21:22', '2025-01-03 14:21:22'),
(23, 'testing5', '2025-01-09', '2025-02-06', 450000.00, '3', '2025-01-03 14:22:37', '2025-01-03 14:22:37'),
(24, 'oityv', '2025-01-08', '2025-01-29', 450000.00, '3', '2025-01-03 14:24:52', '2025-01-03 14:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `nrc_id` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_contact` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nrc_id`, `date_of_birth`, `gender`, `phone_number`, `address`, `guardian_name`, `guardian_contact`, `user_id`, `created_at`, `updated_at`) VALUES
(5, '7/iuy(N)000622', '2000-02-19', 'male', '09986732457', 'Mandalay', 'kyaw12', '09440226826', 13, '2024-12-28 09:01:40', '2024-12-28 09:01:40'),
(7, '8/mathana(n)385949', '2006-09-04', 'female', '09904689489', 'Myothit, Magway', 'Thet Mon', '09765427586', 17, '2024-12-30 15:42:36', '2025-01-03 12:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `course_id`) VALUES
(2, 'html', 2),
(3, 'js', 2),
(4, 'css', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','teacher','student') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$oauBHOznGAVTNwmCgcgRcueXNtU4izgEmpRUGqWVC3e66VCNcxcq.', 'admin', '2024-12-26 04:23:16', '2024-12-26 04:23:16'),
(7, 'Teacher100', 'teacher100@gmail.com', '$2y$10$uHn/RURbuBnrRwwbeY1SVeLGHzlvr3Z8F9xT1iA.dsCzk76L2KM4.', 'teacher', '2024-12-26 07:25:52', '2025-01-03 18:00:21'),
(8, 'Teacher2', 'teacher2@gmail.com', '$2y$10$PA55MT657WIiTCkvQ/6Qg.YdZ69hG1x0Epl8O9v1Qqa4Owt/xfujy', 'teacher', '2024-12-26 07:26:02', '2024-12-26 07:26:02'),
(10, 'Teacher3', 'teacher3@gmail.com', '$2y$10$Q11MQ4qi43IP/.YFJ6i1kukaEUxT0YVPr1tKPDJXEu6e9QOqtaHzS', 'teacher', '2024-12-26 07:38:27', '2024-12-26 07:38:27'),
(13, 'kyawkyaw', 'stu3@gmail.com', '$2y$10$6ky0kQvBAcYoCcdnNnmwTOaaiUdRafiCPq5wq/ouqBn0Pg371ttu2', 'student', '2024-12-28 09:01:40', '2024-12-28 09:01:40'),
(15, 'Teacher6', 'teacher6@gmail.com', '$2y$10$bC7M4lOfC4F76/1RSA9S0u4NL4DzrDlsX7utvLVvrOPIPYcjoOClq', 'teacher', '2024-12-28 12:28:26', '2024-12-28 12:28:26'),
(17, 'Thet Thet Mon', 'thetthetmon.mgaway@gmail.com', '$2y$10$iMFZJnLIoUuC7ucu.GnzCOnFHmgvuch8FRpO1hVJ83xRvJNO2b/Ba', 'student', '2024-12-30 15:42:36', '2025-01-03 12:16:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_tokens`
--
ALTER TABLE `access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`paymenttypeid`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_course` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_tokens`
--
ALTER TABLE `access_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `paymenttypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `fk_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
