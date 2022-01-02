-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 02, 2022 at 09:26 PM
-- Server version: 8.0.26
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebookshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int UNSIGNED NOT NULL,
  `firstName` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `description` longtext,
  `photoId` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `bindings`
--

CREATE TABLE `bindings` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `bookauthors`
--

CREATE TABLE `bookauthors` (
  `bookId` int UNSIGNED NOT NULL,
  `authorId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `bookgenres`
--

CREATE TABLE `bookgenres` (
  `bookId` int UNSIGNED NOT NULL,
  `genreId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `bookreviews`
--

CREATE TABLE `bookreviews` (
  `bookId` int UNSIGNED NOT NULL,
  `reviewId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int UNSIGNED NOT NULL,
  `seriesId` int UNSIGNED DEFAULT NULL COMMENT 'серия книг',
  `publisherId` int UNSIGNED DEFAULT NULL COMMENT 'издательство',
  `coverId` int UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT 'название на русском',
  `subtitle` varchar(150) DEFAULT NULL COMMENT 'Book subtitle',
  `ISBN10` varchar(10) DEFAULT NULL,
  `ISBN13` varchar(13) DEFAULT NULL,
  `publishingYear` int DEFAULT NULL COMMENT 'Publishing year and month',
  `pages` int DEFAULT NULL COMMENT 'страницы',
  `description` longtext COMMENT 'описание',
  `notes` varchar(500) DEFAULT NULL COMMENT 'Book notes',
  `quantity` int NOT NULL DEFAULT '0' COMMENT 'Number of copies',
  `actualQuantity` int NOT NULL DEFAULT '0' COMMENT 'Actual number of book copies that can be issued right now',
  `edition` varchar(150) DEFAULT NULL COMMENT 'Edition of the book',
  `binding` enum('Hardcover','Softcover') DEFAULT 'Hardcover' COMMENT 'переплет',
  `physicalForm` enum('Book','Manuscript','Journal','CD/DVD','Other') DEFAULT 'Book' COMMENT 'Physical form of book',
  `size` enum('Medium','Large','Huge','Small','Tiny') DEFAULT 'Medium' COMMENT 'Book size',
  `type` enum('Standard','Digital') DEFAULT 'Standard' COMMENT 'Type of book',
  `price` decimal(10,2) DEFAULT NULL COMMENT 'Book price',
  `language` varchar(45) DEFAULT NULL COMMENT 'Language of the book',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Last update time',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL DEFAULT 'Noname category',
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(250) NOT NULL,
  `metaTitle` varchar(100) DEFAULT NULL,
  `metaKeywords` varchar(255) DEFAULT NULL,
  `metaDescription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `dynamicshortcodes`
--

CREATE TABLE `dynamicshortcodes` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `columnName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `emailnotifications`
--

CREATE TABLE `emailnotifications` (
  `id` int NOT NULL,
  `route` varchar(100) NOT NULL COMMENT 'should be routeName',
  `userId` int UNSIGNED NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` longtext,
  `templateName` varchar(255) DEFAULT NULL,
  `from` varchar(255) NOT NULL COMMENT 'JSON object {email:Name}',
  `to` longtext NOT NULL COMMENT 'JSON array of objects {email1:Name1;email2:Name2;...}',
  `creationDateTime` datetime DEFAULT NULL,
  `updateDateTime` datetime DEFAULT NULL,
  `isEnabled` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int UNSIGNED NOT NULL,
  `path` varchar(300) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `uploaded_at` datetime DEFAULT NULL,
  `isGallery` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int UNSIGNED NOT NULL COMMENT 'Order ID',
  `userId` int UNSIGNED NOT NULL COMMENT 'User that created order',
  `bookId` int UNSIGNED NOT NULL,
  `requestId` int UNSIGNED DEFAULT NULL,
  `issueDate` date NOT NULL COMMENT 'Date of issue of the book',
  `expiryDate` date NOT NULL COMMENT 'Expiration date - date when book should be returned',
  `returnDate` date DEFAULT NULL COMMENT 'Date of return of the book - real return date',
  `isLost` bit(1) NOT NULL DEFAULT b'0',
  `penalty` decimal(5,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `shortCode` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `menuitems`
--

CREATE TABLE `menuitems` (
  `id` int UNSIGNED NOT NULL,
  `menuId` int UNSIGNED NOT NULL COMMENT 'ID of menu: 1 - main menu, 2 - left menu, etc.',
  `parentId` int UNSIGNED NOT NULL COMMENT 'Parent menu item (0 - no parent)',
  `title` varchar(150) NOT NULL COMMENT 'Text to display on menu item',
  `pageId` int UNSIGNED DEFAULT NULL COMMENT 'Use specified page as menu item (by pageId)',
  `postId` int UNSIGNED DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL COMMENT 'Link as menu item',
  `order` int UNSIGNED DEFAULT NULL COMMENT 'Order number of menu item',
  `class` varchar(50) DEFAULT NULL COMMENT 'CSS class'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Menu name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int UNSIGNED NOT NULL,
  `parentId` int UNSIGNED DEFAULT NULL,
  `userId` int UNSIGNED NOT NULL,
  `url` varchar(300) DEFAULT NULL,
  `partialUrl` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` longtext,
  `metaTitle` varchar(200) DEFAULT NULL,
  `metaKeywords` varchar(250) DEFAULT NULL,
  `metaDescription` longtext,
  `imageId` int UNSIGNED DEFAULT NULL,
  `status` enum('Publish','Future','Pending') DEFAULT 'Pending',
  `publishDateTime` datetime DEFAULT NULL,
  `shortDescription` varchar(100) DEFAULT NULL,
  `creationDateTime` datetime DEFAULT NULL,
  `updateDateTime` datetime DEFAULT NULL,
  `customTemplate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `passwordconfirmation`
--

CREATE TABLE `passwordconfirmation` (
  `email` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `validDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int UNSIGNED NOT NULL,
  `routeName` varchar(50) NOT NULL,
  `routeTitle` varchar(100) DEFAULT NULL,
  `isPublic` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `postcategories`
--

CREATE TABLE `postcategories` (
  `postId` int UNSIGNED NOT NULL,
  `categoryId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int UNSIGNED NOT NULL,
  `userId` int UNSIGNED NOT NULL,
  `url` varchar(300) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `secondTitle` varchar(100) DEFAULT NULL,
  `shortDescription` varchar(250) DEFAULT NULL,
  `content` longtext,
  `metaTitle` varchar(200) DEFAULT NULL,
  `metaKeywords` varchar(250) DEFAULT NULL,
  `metaDescription` longtext,
  `imageId` int UNSIGNED DEFAULT NULL,
  `status` enum('Publish','Future','Pending') DEFAULT 'Pending',
  `publishDateTime` datetime DEFAULT NULL,
  `creationDateTime` datetime DEFAULT NULL,
  `updateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int UNSIGNED NOT NULL COMMENT 'Request ID',
  `userId` int UNSIGNED NOT NULL COMMENT 'User that create request',
  `bookId` int UNSIGNED NOT NULL,
  `status` enum('Pending','Accepted','Rejected') NOT NULL DEFAULT 'Pending' COMMENT 'Current request status',
  `notes` longtext COMMENT 'Request notes',
  `creationDate` date NOT NULL COMMENT 'Request creation date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int UNSIGNED NOT NULL COMMENT 'Review ID',
  `userId` int UNSIGNED NOT NULL COMMENT 'User that created this review',
  `text` longtext COMMENT 'Content of review'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `rolepermissions`
--

CREATE TABLE `rolepermissions` (
  `roleId` int UNSIGNED NOT NULL,
  `permissionId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Name of role',
  `issueDayLimit` int NOT NULL COMMENT 'Issue day limitation',
  `issueBookLimit` int NOT NULL COMMENT 'Issue book limitation',
  `finePerDay` decimal(10,2) NOT NULL COMMENT 'Fine per day after late book return',
  `priority` tinyint UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `issueDayLimit`, `issueBookLimit`, `finePerDay`, `priority`) VALUES
(1, 'Admin', 0, 0, '0.00', 0),
(2, 'Web User', 0, 0, '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `isComplete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `staticshortcodes`
--

CREATE TABLE `staticshortcodes` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `value` mediumtext,
  `isLongText` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `usermessages`
--

CREATE TABLE `usermessages` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` longtext,
  `url` varchar(250) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  `isViewed` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `roleId` int UNSIGNED NOT NULL COMMENT 'User''s role ID',
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `isActive` bit(1) NOT NULL DEFAULT b'1' COMMENT 'Is user active or not?',
  `phone` varchar(45) DEFAULT NULL COMMENT 'User''s phone',
  `address` varchar(500) DEFAULT NULL COMMENT 'User''s address',
  `gender` enum('Male','Female') DEFAULT 'Male' COMMENT 'User''s gender',
  `photoId` int UNSIGNED DEFAULT NULL COMMENT 'Id of user''s photo',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roleId`, `email`, `password`, `firstName`, `middleName`, `lastName`, `isActive`, `phone`, `address`, `gender`, `photoId`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin@mail.com', '0b4449abb7c8850fa5e5b560aadb00d0827261dc', 'Admin', NULL, NULL, b'1', NULL, NULL, 'Male', NULL, '2022-01-03 00:52:41', '2022-01-03 00:52:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `AUTHOR_PHOTO_idx` (`photoId`);

--
-- Indexes for table `bindings`
--
ALTER TABLE `bindings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `bookauthors`
--
ALTER TABLE `bookauthors`
  ADD KEY `BOOKAUTHOR_BOOK_idx` (`bookId`),
  ADD KEY `BOOKAUTHOR_AUTHOR_idx` (`authorId`);

--
-- Indexes for table `bookgenres`
--
ALTER TABLE `bookgenres`
  ADD KEY `BOOKGENRE_BOOK_idx` (`bookId`),
  ADD KEY `BOOKGENRE_GENRE_idx` (`genreId`);

--
-- Indexes for table `bookreviews`
--
ALTER TABLE `bookreviews`
  ADD KEY `BOOKREWIES_BOOK_idx` (`bookId`),
  ADD KEY `BOOKREVIEWS_REVIEW_idx` (`reviewId`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `BOOK_IMAGE_idx` (`coverId`),
  ADD KEY `BOOK_SERIES_idx` (`seriesId`),
  ADD KEY `BOOK_PUBLISHER_idx` (`publisherId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `url_UNIQUE` (`url`);

--
-- Indexes for table `dynamicshortcodes`
--
ALTER TABLE `dynamicshortcodes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`);

--
-- Indexes for table `emailnotifications`
--
ALTER TABLE `emailnotifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `routeName_UNIQUE` (`route`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `ISSUE_USER_idx` (`userId`),
  ADD KEY `ISSUE_BOOK_idx` (`bookId`),
  ADD KEY `ISSUE_REQUEST_idx` (`requestId`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`id`,`menuId`),
  ADD KEY `MENUITEM_MENU_idx` (`menuId`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `url_UNIQUE` (`url`(255)),
  ADD KEY `PAGE_USER_idx` (`userId`);

--
-- Indexes for table `passwordconfirmation`
--
ALTER TABLE `passwordconfirmation`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `hash_UNIQUE` (`hash`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `routeName_UNIQUE` (`routeName`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `postcategories`
--
ALTER TABLE `postcategories`
  ADD KEY `POSTCATEGORIES_POST_idx` (`postId`),
  ADD KEY `POSTCATEGORIES_CATEGORY___idx` (`categoryId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `url_UNIQUE` (`url`(255)),
  ADD KEY `POST_USER_idx` (`userId`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `REQUEST_USER_idx` (`userId`),
  ADD KEY `REQUEST_BOOK_idx` (`bookId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Id_UNIQUE` (`id`),
  ADD KEY `REVIEW_USER_idx` (`userId`);

--
-- Indexes for table `rolepermissions`
--
ALTER TABLE `rolepermissions`
  ADD KEY `ROLEPERMISSION_PERMISSION` (`permissionId`),
  ADD KEY `ROLEPERMISSION_ROLE` (`roleId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `staticshortcodes`
--
ALTER TABLE `staticshortcodes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`);

--
-- Indexes for table `usermessages`
--
ALTER TABLE `usermessages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `UserID` (`id`),
  ADD KEY `USER_ROLE_idx` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bindings`
--
ALTER TABLE `bindings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dynamicshortcodes`
--
ALTER TABLE `dynamicshortcodes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emailnotifications`
--
ALTER TABLE `emailnotifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Order ID';

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Request ID';

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Review ID';

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staticshortcodes`
--
ALTER TABLE `staticshortcodes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usermessages`
--
ALTER TABLE `usermessages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authors`
--
ALTER TABLE `authors`
  ADD CONSTRAINT `AUTHOR_PHOTO` FOREIGN KEY (`photoId`) REFERENCES `images` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `bookauthors`
--
ALTER TABLE `bookauthors`
  ADD CONSTRAINT `BOOKAUTHOR_AUTHOR` FOREIGN KEY (`authorId`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `BOOKAUTHOR_BOOK` FOREIGN KEY (`bookId`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookgenres`
--
ALTER TABLE `bookgenres`
  ADD CONSTRAINT `BOOKGENRE_BOOK` FOREIGN KEY (`bookId`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `BOOKGENRE_GENRE` FOREIGN KEY (`genreId`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookreviews`
--
ALTER TABLE `bookreviews`
  ADD CONSTRAINT `BOOKREVIEWS_BOOK` FOREIGN KEY (`bookId`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `BOOKREVIEWS_REVIEW` FOREIGN KEY (`reviewId`) REFERENCES `reviews` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `BOOK_IMAGE` FOREIGN KEY (`coverId`) REFERENCES `images` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `BOOK_PUBLISHER` FOREIGN KEY (`publisherId`) REFERENCES `publishers` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `BOOK_SERIES` FOREIGN KEY (`seriesId`) REFERENCES `series` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `ISSUE_BOOK` FOREIGN KEY (`bookId`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ISSUE_REQUEST` FOREIGN KEY (`requestId`) REFERENCES `requests` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `ISSUE_USER` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD CONSTRAINT `MENUITEM_MENU` FOREIGN KEY (`menuId`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `PAGE_USER` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postcategories`
--
ALTER TABLE `postcategories`
  ADD CONSTRAINT `POSTCATEGORIES_CATEGORY__` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `POSTCATEGORIES_POST` FOREIGN KEY (`postId`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `POST_USER` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `REQUEST_BOOK` FOREIGN KEY (`bookId`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `REQUEST_USER` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `REVIEW_USER` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rolepermissions`
--
ALTER TABLE `rolepermissions`
  ADD CONSTRAINT `ROLEPERMISSION_PERMISSION` FOREIGN KEY (`permissionId`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ROLEPERMISSION_ROLE` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `LIBRARYCMS_USER_ROLE` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
