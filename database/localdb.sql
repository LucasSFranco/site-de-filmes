-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2020 at 04:30 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `localdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `senha` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `senha`) VALUES
(1, 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `email` text NOT NULL,
  `senha` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `senha`) VALUES
(53, 'Lucas Surdi Franco', 'surdifranco@gmail.com', '12345'),
(56, 'Lucas José Lunelli Vital', 'lunellivital@gmail.com', '12345'),
(57, 'Lucas Daian Wagner', 'daianwagner@gmail.com', '12345'),
(58, 'Bernardo Ribeiro Böhm', 'ribeirobohm@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `sinopse` text NOT NULL,
  `imagem` text NOT NULL,
  `video` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filmes`
--

INSERT INTO `filmes` (`id`, `titulo`, `sinopse`, `imagem`, `video`) VALUES
(16, 'Maleficent', 'A vengeful fairy is driven to curse an infant princess, only to discover that the child may be the one person who can restore peace to their troubled land.', 'https://m.media-amazon.com/images/M/MV5BMjAwMzAzMzExOF5BMl5BanBnXkFtZTgwOTcwMDA5MTE@._V1_UY209_CR0,0,140,209_AL_.jpg', 'https://imdb-video.media-imdb.com/vi1449634329/MV5BZGYzZjgzNmMtZjE4Yi00OTQxLWFlNDgtZTNjM2JkYmI3M2MzXkExMV5BbXA0XkFpbWRiLWV0cy10cmFuc2NvZGU@.mp4?Expires=1603454047&Signature=qMBxwCcpjrWS9-pkhJp917gOIowJ3cgSmxq4yhcmuXqIDn5eaYGJZahlcREI4xr0j2ZDCVG~aRYZ8lGnb105uNIzdBQCjYoB0gMrAWksoIxuYTPRZ2v24A6elYV-nupQZ9dOapveWIBWevERONAVm18xBk7hHrcnSENbSS0CWtyk2DxntLIqPm8y6n1~3FY1qeVGgIujfXT~EVoTRWOfHWQ6LksWgcuBSsTFwncOPLtwu4vEfs1CtJiVqBTDXcP7qkoSJ3wjhwEvUFV9bBvJxW-1XxnQYPDUF0Rk7drsbFnhiScrNzG2KRYqfJxWJGsFri9hZ9e8G4NIRT6xkcmFgg__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA'),
(17, 'Beverly Hills Chihuahua', 'While on vacation in Mexico, Chloe, a ritzy Beverly Hills chihuahua, finds herself lost and in need of assistance in order to get back home.', 'https://m.media-amazon.com/images/M/MV5BMTI2NzUxNjEzMl5BMl5BanBnXkFtZTcwOTMyNjM4MQ@@._V1_UX182_CR0,0,182,268_AL_.jpg', 'https://imdb-video.media-imdb.com/vi1054671129/MV5BMTk5MDUyMTcyNV5BMTFeQW1wNF5BbWU3MDg1MzA4OTY@.mp4?Expires=1603459754&Signature=I8fX7vtYOBM2L3IqTwHRuUGXLvFcuvwWBZbmKcYLtnlnDfzYFyJXdcrgCPyNglvjm9ZjYY9PRWK9UqW1GwcaekpTNwa1622v2CK8UN2g-kftwxLCkmFJBSvNANo78gK4tayp~Zque5JAhKEshdcShK1FXQy2t9xh-Yrm9RL-YeLrxjhC7EtJTkPDqlQm41ig5fxaT19SxjEfJK-KLdjskfA8MbRrlYeapSziT2gmBGH9oqi4EZm6-TP3A2ooeUwh2Kaf4jCYKawuYdDSWXtL~bLKTuvY3YwJG8oYj7Atw2eGXKywS2UqGhL8Xl4yGdMXr~h2aMLuDXtX21ZdhqUJbQ__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA'),
(18, 'Cheaper by the Dozen 2 ', 'The Bakers, while on vacation, find themselves competing with a rival family of eight children.', 'https://m.media-amazon.com/images/M/MV5BOWFhMjQ5ZDgtZTUwZC00Mjg0LTk1OGYtYTA2ZDMxZmE4ZjYzXkEyXkFqcGdeQXVyNTIzOTk5ODM@._V1_UY268_CR2,0,182,268_AL_.jpg', 'https://imdb-video.media-imdb.com/vi62783769/1434659607842-pgv4ql-1563427888715.mp4?Expires=1603459815&Signature=qxKhlMNwHCU23SaZvQBalHl5f3gXNa8uQDBLf3Xi8wRu4FV9wAYr58OI~uiiabdpEqf01AZyQKZHkORjO-3nls73sqprCS2I9Xx4behHtTh6PWHjIPRgJhhzGE9ChF~n53L4AZshYXK0OhVzvo57K12QhmA~d2uvd-Tyub7zZkBSM2NgvJZ~jI7paoYxillEKv~pnygObmf2r794JIWusJdlGkaMF4MZ~8RVJhAmm925WSlpd0xE4vbKFwTibOZILBb6nhVbDW9PS6FHiD9Sck5hANUCB9ykFhfg5JX7ZWI8zNkyWFc44bUncD1zsHjxeCuf921P3YqNpKF6WgCllQ__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA'),
(19, 'The Chronicles of Narnia: The Voyage of the Dawn Treader', 'Lucy and Edmund Pevensie return to Narnia with their cousin Eustace where they meet up with Prince Caspian for a trip across the sea aboard the royal ship The Dawn Treader.', 'https://m.media-amazon.com/images/M/MV5BNjQ2MDQzMzExNl5BMl5BanBnXkFtZTcwMTYzOTc5Mw@@._V1_UY209_CR0,0,140,209_AL_.jpg', 'https://imdb-video.media-imdb.com/vi2423167257/MV5BMTk4NjY1OTgzNF5BMTFeQW1wNF5BbWU3MDI4MDM4MDQ@.mp4?Expires=1603460156&Signature=dO9tMPaUA-hIm4l~EKT4MyTxJLNSVcJTzF0ke--5~Ah2gZQPeivMZJNTGSl~62Yiriiz93-thtgAsIrO0ylW5gQlJ4R821riAT2aLObJ1LCWtrroBuLdSra8pNJ4W0PppU9LMQOAKakUAm2NNW93cJLzwhzVrtMec0kTXyYrIyls50GnS8LGY7ZfKG6OyIJQlkO6ybDc-jT1T8uUPP4gC8f9QR9lx3rhncsyr6N0mreD4VRSDekzloWn1q2I3dxyNyjeCuzw5Dy3pUaRjhI8XkOcZEZCOyK3shpfA82vCoopixLgQp8jKZ2lYl1TX8AiSgYdK8PxioNsCptFv8cScQ__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA'),
(20, 'The Mandalorian', 'The travels of a lone bounty hunter in the outer reaches of the galaxy, far from the authority of the New Republic.', 'https://m.media-amazon.com/images/M/MV5BZDhlMzY0ZGItZTcyNS00ZTAxLWIyMmYtZGQ2ODg5OWZiYmJkXkEyXkFqcGdeQXVyODkzNTgxMDg@._V1_UY209_CR0,0,140,209_AL_.jpg', 'https://imdb-video.media-imdb.com/vi1945813273/1434659607842-pgv4ql-1603159415617.mp4?Expires=1603460400&Signature=R3Bx2g9RGPezZywZ8adZrQDUk~aOEXrUeg179ECeffFn6Qm5lVv-PICTTRGSD5WkBF1v9sAi3CfqMz6qVhL0F8A2nw~Qr8kExrZUHVY6wzHiuHcfbsymehXX6jyRZB5EkMuR~03SwZi7P1Ov5FU3rra7cOFLV2UAXeJ6aE-fQygPj1hvOEWTB2UsxtxpMRJGsenwZzllXPA3fGkXSXoGXKrPFykpoz4KyFD6Mu24ta~Pzs0Rqp9h5yPK2d2doS~d7JeZWbYDQp-7MYVLMdd~vpaHFzgKHAL94csrzQmXAzoY1etqh5XoLkGpqUToOHmH7ooHMSEc~fcl6MgtR3tolw__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA'),
(21, 'The Lord of the Rings: The Fellowship of the Ring', 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.', 'https://m.media-amazon.com/images/M/MV5BN2EyZjM3NzUtNWUzMi00MTgxLWI0NTctMzY4M2VlOTdjZWRiXkEyXkFqcGdeQXVyNDUzOTQ5MjY@._V1_UX182_CR0,0,182,268_AL_.jpg', 'https://imdb-video.media-imdb.com/vi2073101337/MV5BNmNkYTg1NzctMzljNi00Y2I5LTkzOGQtNzE1YmZlYWM3NWEwXkExMV5BbXA0XkFpbWRiLWV0cy10cmFuc2NvZGU@.mp4?Expires=1603460821&Signature=ioFBxoiVY-t6yQ3la8bvvgwi-kko9L2eWyZj~GcROTq1Qc-V-i3sJTxXIsdfEJs8-DaAB1ItpZyJ5ukFdNZUzkIU6drXmBasla5uvRTz0o78W7-6ZkwzMbxMLimB766h1Sz1dLIQtYdJm5wXeEGTnxFmHvlfyD8sM8rx4VjitDx832NScPF4GPS1J~9sI~M~x89CMUbF5ObA9ccUegcJdIVl5ifePEv1olvRRWjgrfxiA02LrDN9PSqsKV4xfA8UVtVI8-CBdMJ-eqpZo61-n3p-AouWjj51-aNB4xaBni1K5negH-lPX0w0jeme1CduSY-5k4Wu~0lzy61WEpUVxg__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA'),
(22, 'The Lord of the Rings: The Return of the King', 'Gandalf and Aragorn lead the World of Men against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.', 'https://m.media-amazon.com/images/M/MV5BNzA5ZDNlZWMtM2NhNS00NDJjLTk4NDItYTRmY2EwMWZlMTY3XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_UX182_CR0,0,182,268_AL_.jpg', 'https://imdb-video.media-imdb.com/vi2073101337/MV5BNmNkYTg1NzctMzljNi00Y2I5LTkzOGQtNzE1YmZlYWM3NWEwXkExMV5BbXA0XkFpbWRiLWV0cy10cmFuc2NvZGU@.mp4?Expires=1603461039&Signature=nqR5ODhJ0WKwSnpFP5~0RnBRRxYQg6lVx2hk3znl5Q42cAi~RVYS0HzQ6WkANv3vQhGpeh2sYJg81q333QZH8PjRzppAi3aRYdRsKjaV07y7XwxjfrBMWpRgtplqKa8ywMqv4fm1a4Ks6XARAxfBC-BmQa1JjiyQe9tLBuAa0Xd~R~y~e-Z9QcJpE7ApXys9kAS7t9yXBtWOYpn1~2Cg~NlAt6-OyFfIsFyoDw8wM4iaGSiawt1ZdbQfoD1emBTToFzsPDfnvSaZdql28Qipm9cNUXN3w6kOwiOUM9AZc0V7nqxCq6~IoDGaTzeSwYcZEFtwpO0NJsKAhvY3JTbcMQ__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA'),
(23, 'The Lord of the Rings: The Two Towers', 'While Frodo and Sam edge closer to Mordor with the help of the shifty Gollum, the divided fellowship makes a stand against Sauron\'s new ally, Saruman, and his hordes of Isengard.', 'https://m.media-amazon.com/images/M/MV5BZGMxZTdjZmYtMmE2Ni00ZTdkLWI5NTgtNjlmMjBiNzU2MmI5XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_UX182_CR0,0,182,268_AL_.jpg', 'https://imdb-video.media-imdb.com/vi2073101337/MV5BNmNkYTg1NzctMzljNi00Y2I5LTkzOGQtNzE1YmZlYWM3NWEwXkExMV5BbXA0XkFpbWRiLWV0cy10cmFuc2NvZGU@.mp4?Expires=1603461090&Signature=kLctI~2mSFxSCnTeYdmkcvzMesqsiMZlloXHvrM2hn1efRC~5SlZARKxYa~WdyxqP7O0p-Dm5LSVYIZ6rjv5XykelQZ4d5pro1alOiZ1hQ6Ddy2f~8BrxxO4FcP4hC-fwemOG9jUV8X1pEK7QT-2IIiOGXWknnV2mY6mgQdw9TOR~VkzsfvZNRzCu4D8xCCK0E8hdb0Uj~cPMbOaNRmipKrPCFqhDhQ2XdSv0i6XqQFefhso469KswpOLM~bxxI-F55Lt0rbBoYJEvTjAeei6EOHQc8E1ijsozt-Wp3loKM-63cGVdOGYR23aOEsvtxgGx~PrmVBHFtOYHdj02ro6Q__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA'),
(24, 'The Hobbit: An Unexpected Journey', 'A reluctant Hobbit, Bilbo Baggins, sets out to the Lonely Mountain with a spirited group of dwarves to reclaim their mountain home, and the gold within it from the dragon Smaug.', 'https://m.media-amazon.com/images/M/MV5BMTcwNTE4MTUxMl5BMl5BanBnXkFtZTcwMDIyODM4OA@@._V1_UX182_CR0,0,182,268_AL_.jpg', 'https://imdb-video.media-imdb.com/vi650683417/MV5BMjIyMzE4MzA2MF5BMTFeQW1wNF5BbWU3MDgzNjg5NDg@.mp4?Expires=1603461137&Signature=X71vME2qcqMNrHvQK5yHCYBcAjRBkU41EDb3ks5yalJ0U3uFEJ2uM7BUr1VHRWtZyk48hWKuBWdV~T5UpfJQ8Nw7QEcPoZn00cuknSCxAUdmPWCpDDkBlqVzrswERTk-kcmT6XlNQvehARs0Pf1b8wnWZCVnExPtJ15oXTlFYYXgk927tGSg~3i-Xsl-9aPlJhXZzoZIMe3IbWP-q9U1oZdHbRtXom08MR0WLxR~aHnQa-zVaLe8tmjyp~4ndiI-fngwubngP29cwBEpBd69KFb25v8jXcJ4rStgS8CUbuUHggGYrelbS1NrapKiZwOQa8J9w~sBx3Jhw8sz6nROYA__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA'),
(25, 'The Hobbit: The Battle of the Five Armies', 'Bilbo and company are forced to engage in a war against an array of combatants and keep the Lonely Mountain from falling into the hands of a rising darkness.', 'https://m.media-amazon.com/images/M/MV5BMTYzNDE3OTQ3MF5BMl5BanBnXkFtZTgwODczMTg4MjE@._V1_UX182_CR0,0,182,268_AL_.jpg', 'https://imdb-video.media-imdb.com/vi1092005657/MV5BMTY2NDA4ODY3N15BMTFeQW1wNF5BbWU4MDYxNDA4MzMx.mp4?Expires=1603461182&Signature=hZ2PTCn9pOnxORelUOQ~5ay76LIQThZ7rvI-UqmO0kIYa2mHCuC2Tu8UhRWspid6Ad2vToOOnWZN6PrKl9FwCA3H4VbFR~1Gp-nX3YVY1LPt9IUOFHJr8p6lzEfP8bmcOIRykSQC7OueFHJqWt1HvV0aUNAcaVyXf9LI~pnunyKIfjvQlBlzCpklBUnEkI5eu0xAvHnt5UEtzaOqon2SaR00V-6VZYxdfPCjYd4AKSagFuaR8DS-RG6fuGb1PfS6LUkyStWrA2Rs-KeAqt-Ld5uXa0YksDpuWnLUhiwxvQZjatQrrnN-soNQzOnzU69qv0VBd1Yitaxdrrj6V-MurA__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA'),
(26, 'The Hobbit: The Desolation of Smaug', 'The dwarves, along with Bilbo Baggins and Gandalf the Grey, continue their quest to reclaim Erebor, their homeland, from Smaug. Bilbo Baggins is in possession of a mysterious and magical ring.', 'https://m.media-amazon.com/images/M/MV5BMzU0NDY0NDEzNV5BMl5BanBnXkFtZTgwOTIxNDU1MDE@._V1_UX182_CR0,0,182,268_AL_.jpg', 'https://imdb-video.media-imdb.com/vi2165155865/MV5BZGRjMzUwMzAtNTNiOS00Mjg2LTk1MjgtOGU4YTRlNzk2NjZkXkExMV5BbXA0XkFpbWRiLWV0cy10cmFuc2NvZGU@.mp4?Expires=1603461233&Signature=nr7sgdVFGNXHCCZSRAqWUu4WE2jAdwcSQf~EL16-GF-2aNUqz7~9jFgQ4Xm4zO0v1vQ0LGhTUJCkGSQWOquZSo8iLBxPtE~NMTSulkSTlI5VgjnSGpwoDI6-UHba808UoX7JMZgiAIqKL5dxscCfdYKn8MHqi4hztIDGGZUqXmrOo30QhkUUf~XVWNsvCHOdU~uWeByQMVf2~4DGj7dQLdUjleuHLkIlxp3GJjYiWsqI4r-xWSrO7hVA2jgaerJ434LbEfW1CTTTpqXAGV~uauToEe0y3KECm4mQos8Bn3Q-tpOFyLID-LTceefYJmAE8hb4lmjN5MAE-rkSaD43Mg__&Key-Pair-Id=APKAIFLZBVQZ24NQH3KA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
