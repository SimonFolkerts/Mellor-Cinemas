-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2016 at 04:43 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mellor_cinemas`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL,
  `showing_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `booking_status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `showing_id`, `user_id`, `booking_status`) VALUES
(44, 11, 13, 'active'),
(45, 17, 13, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `bookings_seats`
--

CREATE TABLE IF NOT EXISTS `bookings_seats` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings_seats`
--

INSERT INTO `bookings_seats` (`id`, `booking_id`, `seat_id`) VALUES
(41, 44, 1),
(42, 44, 2),
(43, 45, 1),
(44, 45, 2),
(45, 45, 24),
(46, 45, 25);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL,
  `movie_title` varchar(255) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `movie_synopsis` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `movie_title`, `poster`, `movie_synopsis`, `status`) VALUES
(5, 'Fantastic Movies and Where to Find Them', 'poster-1.jpg', 'Curabitur et egestas nisl. Mauris maximus erat vitae risus convallis vulputate. Duis bibendum tempus nisi, eget accumsan turpis pretium commodo. Ut faucibus ex dolor, at pellentesque est fermentum vel. Phasellus vel laoreet dui. Quisque convallis metus ut elit vestibulum pulvinar. Sed placerat purus non dolor mollis iaculis. Pellentesque nec consectetur purus. Sed iaculis, velit ut aliquam mattis, dolor nisl tincidunt nibh, in dignissim eros nisi in est. Nullam pretium turpis felis, vitae fermentum metus fringilla quis. Pellentesque egestas dapibus lectus, et blandit felis molestie eget. Vivamus nec arcu arcu.', 'active'),
(6, 'The Second Movie', 'poster-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed volutpat et diam nec pretium. Phasellus egestas et augue vitae vestibulum. Vestibulum imperdiet feugiat feugiat. Nam semper enim vitae libero posuere, quis fringilla lacus interdum. Praesent ullamcorper velit mi, eu molestie ante imperdiet ac. Phasellus sagittis ultrices libero sit amet tristique. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed lobortis mauris id est aliquam ultricies. Nulla quis volutpat nibh, nec pellentesque turpis. Phasellus viverra purus et semper lobortis. Phasellus massa eros, rhoncus sed est vitae, porta pellentesque orci. Nulla iaculis turpis quis lacus blandit, id hendrerit orci molestie. In eros nunc, lacinia at nunc non, lobortis vulputate lacus. Mauris quis nibh in ex facilisis commodo.', 'active'),
(7, 'Delicious Movies', 'poster-3.jpg', 'Aliquam libero velit, luctus a lacinia at, feugiat ornare tellus. Proin sit amet ligula quis nisi mollis pretium. Ut luctus orci eget quam elementum congue. Pellentesque id erat finibus, interdum lacus venenatis, laoreet diam. Donec porta lacus nulla, eget aliquam purus finibus sed. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse condimentum metus non diam facilisis interdum. Nullam euismod congue aliquet. Nulla rhoncus dui non ligula euismod, id cursus lorem vestibulum. Proin porta ligula eu tincidunt egestas. Suspendisse eget metus sit amet lorem vulputate ullamcorper sed id tortor. Cras eleifend aliquet mauris. Fusce lacinia, justo ut egestas egestas, massa orci congue sapien, non mollis odio velit ac ipsum. Nam vel nisl imperdiet, varius metus nec, mattis massa. Nulla quis volutpat dui. Etiam sed tortor at tellus sodales viverra.', 'active'),
(8, 'Movie: The Movie', 'poster-4.jpg', 'Quisque lacinia lectus volutpat nibh scelerisque volutpat. Ut venenatis risus quam, quis euismod mi fermentum ac. Quisque laoreet lacinia libero, ut accumsan nisi egestas ut. In vitae blandit felis. In ac felis consequat quam sollicitudin mollis in at tortor. Pellentesque tristique ut libero vitae pellentesque. In nulla urna, hendrerit vel nulla et, interdum viverra dolor. Fusce sem massa, luctus et tincidunt eu, elementum et velit.', 'active'),
(9, 'Movie: The Movie 2V', 'poster-5.jpg', 'Curabitur varius ullamcorper nisi, in molestie augue congue id. Donec pellentesque neque ac mauris eleifend varius. Etiam a ante ut nunc facilisis ultrices. Cras dignissim hendrerit dolor ac suscipit. Donec sit amet maximus ligula, lobortis feugiat arcu. Etiam tellus odio, suscipit a aliquam et, accumsan eu erat. Sed maximus commodo sem sed suscipit. Pellentesque eu fringilla odio. Duis tristique ligula massa, pretium finibus odio imperdiet quis. In quis purus sed tortor aliquam tristique.', 'active'),
(10, 'Movienator', 'poster-6.jpg', 'Donec dolor justo, tincidunt in turpis eu, eleifend blandit neque. Vivamus venenatis tristique nibh, sit amet aliquam quam ultricies nec. Mauris posuere, eros ut vestibulum congue, ligula nulla pharetra mauris, quis varius erat lectus sed ante. Nunc quis erat magna. Cras id lobortis diam, at interdum libero. Sed consectetur blandit dignissim. Duis varius varius dui, non pulvinar lorem lobortis commodo. Fusce eu nisl suscipit nibh interdum porta ac et libero. Donec pretium justo ac elementum tempor. Vestibulum tincidunt ex id elit vehicula iaculis. Nulla id semper orci, vitae vulputate nulla. Integer blandit tempus massa in egestas. Morbi non congue orci, quis luctus diam. Etiam maximus ultrices dolor, vehicula interdum risus tristique vel. Aenean molestie felis est, in finibus arcu tempor vitae.', 'active'),
(11, 'Bad Movie 2', 'poster-7.jpg', 'Aenean bibendum nisl vitae quam egestas, volutpat ornare justo viverra. Curabitur lacinia, mi egestas auctor ultrices, massa felis egestas sapien, id varius felis quam posuere leo. Ut dui enim, porta at bibendum interdum, sodales sit amet enim. Maecenas nec pellentesque eros. Pellentesque ornare vitae nisi eget laoreet. Phasellus varius diam tincidunt, aliquam dolor non, eleifend ante. Nam rhoncus, leo eget convallis varius, purus mauris vulputate turpis, in feugiat libero magna aliquam magna. Aenean sit amet mattis tortor.', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE IF NOT EXISTS `seats` (
  `id` int(11) NOT NULL,
  `cinema` int(11) NOT NULL,
  `cinema_row` int(11) NOT NULL,
  `cinema_column` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `cinema`, `cinema_row`, `cinema_column`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 1, 3),
(4, 1, 1, 4),
(24, 1, 2, 1),
(25, 1, 2, 2),
(26, 1, 2, 3),
(27, 1, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `showings`
--

CREATE TABLE IF NOT EXISTS `showings` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `cinema` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `showings`
--

INSERT INTO `showings` (`id`, `movie_id`, `date`, `start_time`, `end_time`, `cinema`, `status`) VALUES
(11, 5, '12/12/12', '24:00', '24:00', '1', 'active'),
(12, 5, '12/12/12', '15:00', '17:00', '1', 'active'),
(13, 5, '11/12/12', '10:00', '12:00', '1', 'active'),
(14, 5, '11/12/12', '24:00', '24:00', '1', 'active'),
(15, 5, '10/12/12', '10:00', '12:00', '1', 'active'),
(16, 5, '10/12/12', '24:00', '24:00', '1', 'active'),
(17, 5, '12/12/12', '08:00', '10:00', '1', 'active'),
(18, 5, '12/12/12', '17:00', '19:00', '1', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `status`) VALUES
(12, 'administrator', 'admin', 'admin@mellor.com', 'admin'),
(13, 'simon', 'password', 'simon@email.com', 'active'),
(14, 'asd', 'asd', 'asd@asd.asd', 'active'),
(15, 'test', 'TEST', 'TEST@TEST.TEST', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings_seats`
--
ALTER TABLE `bookings_seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showings`
--
ALTER TABLE `showings`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `bookings_seats`
--
ALTER TABLE `bookings_seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `showings`
--
ALTER TABLE `showings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
