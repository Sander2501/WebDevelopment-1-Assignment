-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 16 jan 2026 om 18:27
-- Serverversie: 12.1.2-MariaDB-ubu2404
-- PHP-versie: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `published_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `trainer_id`, `title`, `content`, `published_at`) VALUES
(1, 1, '5 Tips for Building Muscle Mass', 'Building muscle requires consistent training, proper nutrition, and adequate rest.  Here are my top 5 tips:  1) Focus on compound movements like squats, deadlifts, and bench press. 2) Implement progressive overload by gradually increasing weight.  3) Consume 1.6-2.2g of protein per kg of bodyweight daily. 4) Get 7-9 hours of quality sleep.  5) Be patient and consistent - muscle growth takes time.', '2026-01-13 21:18:09'),
(2, 1, 'The Importance of Progressive Overload', 'Progressive overload is the key principle behind muscle growth. It means gradually increasing the stress placed on your muscles during training. This can be done by increasing weight, reps, sets, or decreasing rest time.  Without progressive overload, your muscles have no reason to adapt and grow. Track your workouts and aim to improve each week.', '2026-01-13 21:18:09'),
(3, 1, 'Recovery:  The Missing Piece', 'Many people focus only on training hard but neglect recovery. Your muscles grow during rest, not during workouts.  Prioritize sleep, proper nutrition, and active recovery.  Consider foam rolling, stretching, and light cardio on rest days. Listen to your body and don\'t be afraid to take extra rest when needed.', '2026-01-13 21:18:09'),
(4, 2, 'Yoga for Beginners: Getting Started', 'Starting your yoga journey can be intimidating, but it doesn\'t have to be. Begin with basic poses like Mountain, Downward Dog, and Child\'s Pose. Focus on your breath - inhale through the nose, exhale through the nose. Don\'t compare yourself to others.  Yoga is a personal practice.  Start with 15-20 minutes daily and gradually increase. ', '2026-01-13 21:18:09'),
(5, 2, 'Improving Flexibility:  A 30-Day Challenge', 'Flexibility is crucial for overall fitness and injury prevention.  Commit to 20 minutes of stretching daily for 30 days. Focus on major muscle groups:  hamstrings, hip flexors, shoulders, and back. Hold each stretch for 30-60 seconds.  You\'ll be amazed at the progress you can make in just one month.', '2026-01-13 21:18:09'),
(6, 2, 'The Mind-Body Connection in Yoga', 'Yoga is more than just physical exercise.  It\'s about connecting your mind and body through breath and movement. Practice mindfulness during each pose.  Notice how your body feels. Let go of judgment.  This connection reduces stress, improves mental clarity, and enhances overall wellbeing.', '2026-01-13 21:18:09'),
(7, 3, 'Maximize Your Cardio Workouts', 'Getting the most out of your cardio sessions requires smart training.  Use interval training for better results in less time. Try 30 seconds of high intensity followed by 90 seconds of recovery, repeated for 20 minutes. This burns more calories and improves both aerobic and anaerobic fitness.', '2026-01-13 21:18:09'),
(8, 3, 'HIIT vs Steady State Cardio', 'Both HIIT and steady state cardio have their place.  HIIT is time-efficient and burns more calories in less time.  Steady state is easier to recover from and builds aerobic base. For best results, include both in your training.  Do HIIT 2-3 times per week and steady state 1-2 times per week.', '2026-01-13 21:18:09'),
(9, 3, 'Fueling Your Cardio Sessions', 'Proper nutrition is crucial for cardio performance. Eat complex carbs 2-3 hours before training for sustained energy. Stay hydrated - drink water before, during, and after workouts. Post-workout, consume protein and carbs within 30-60 minutes to aid recovery. ', '2026-01-13 21:18:09'),
(10, 4, 'Boxing Basics: Stance and Footwork', 'Proper stance is the foundation of good boxing technique. Stand with feet shoulder-width apart, dominant foot slightly back. Keep weight on the balls of your feet for quick movement. Practice your footwork daily - forward, backward, side to side. Good footwork creates angles for offense and keeps you safe on defense.', '2026-01-13 21:18:09'),
(11, 4, 'The Jab: Your Most Important Punch', 'The jab is your most versatile weapon. Use it to measure distance, set up combinations, and control the pace.  Keep your guard up, extend straight from the shoulder, and snap it back quickly. Practice jabbing hundreds of times daily. A great jab makes everything else work better.', '2026-01-13 21:18:09'),
(12, 4, 'Mental Toughness in Combat Sports', 'Boxing is as much mental as physical.  Develop mental toughness through challenging training.  Push through fatigue.  Stay calm under pressure.  Visualize success. Learn from losses. The fighter who can stay composed and execute their game plan under stress usually wins.', '2026-01-13 21:18:09');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'confirmed',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `class_id`, `start_at`, `end_at`, `status`, `created_at`, `updated_at`) VALUES
(34, 4, NULL, '2026-01-14 04:30:00', '2026-01-14 05:30:00', 'confirmed', '2026-01-13 22:32:59', '2026-01-13 22:32:59'),
(35, 4, 1, '2026-01-14 09:00:00', '2026-01-14 10:00:00', 'confirmed', '2026-01-13 22:33:19', '2026-01-13 22:33:19'),
(36, 4, 2, '2026-01-14 10:30:00', '2026-01-14 11:30:00', 'confirmed', '2026-01-13 22:36:37', '2026-01-13 22:36:37'),
(37, 4, 7, '2026-01-22 20:00:00', '2026-01-22 21:00:00', 'confirmed', '2026-01-13 22:46:56', '2026-01-13 22:46:56'),
(40, 6, 1, '2026-01-17 09:00:00', '2026-01-17 10:00:00', 'confirmed', '2026-01-16 17:13:39', '2026-01-16 17:13:39'),
(41, 6, 1, '2026-01-18 09:00:00', '2026-01-18 10:00:00', 'confirmed', '2026-01-16 17:13:46', '2026-01-16 17:13:46'),
(42, 7, NULL, '2026-01-16 20:00:00', '2026-01-16 21:00:00', 'confirmed', '2026-01-16 17:15:29', '2026-01-16 17:15:29');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `trainer` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT 20,
  `booked` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `classes`
--

INSERT INTO `classes` (`id`, `name`, `trainer`, `location`, `start_at`, `end_at`, `capacity`, `booked`, `description`, `created_at`) VALUES
(1, 'Morning Yoga', 'Sarah Krom\n', 'Studio A', '2026-01-15 09:00:00', '2026-01-15 10:00:00', 15, 8, 'Start your day with relaxing yoga flow.  Suitable for all levels.', '2026-01-13 21:18:09'),
(2, 'HIIT Training', 'Mike Meijer', 'Gym Floor', '2026-01-15 10:30:00', '2026-01-15 11:30:00', 20, 12, 'High-intensity interval training to boost your metabolism. ', '2026-01-13 21:18:09'),
(3, 'Boxing Basics', 'Emma Klaver', 'Boxing Ring', '2026-01-15 14:00:00', '2026-01-15 15:00:00', 12, 10, 'Learn fundamental boxing techniques and combinations.', '2026-01-13 21:18:09'),
(4, 'Strength Training', 'John Boer', 'Weight Room', '2026-01-15 18:00:00', '2026-01-15 19:00:00', 15, 5, 'Build muscle and strength with guided weight training.', '2026-01-13 21:18:09'),
(5, 'Evening Yoga', 'Sarah Krom\n', 'Studio A', '2026-01-16 19:00:00', '2026-01-16 20:00:00', 15, 3, 'Unwind with evening yoga and stretching. ', '2026-01-13 21:18:09'),
(6, 'Cardio Blast', 'Mike Meijer', 'Gym Floor', '2026-01-16 17:00:00', '2026-01-16 18:00:00', 20, 7, 'Intense cardio workout to improve endurance.', '2026-01-13 21:18:09'),
(7, 'Advanced Boxing', 'Emma Klaver', 'Boxing Ring', '2026-01-16 20:00:00', '2026-01-16 21:00:00', 10, 8, 'Advanced techniques for experienced boxers.', '2026-01-13 21:18:09'),
(8, 'Power Lifting', 'John Boer', 'Weight Room', '2026-01-16 16:00:00', '2026-01-16 17:00:00', 12, 6, 'Focus on compound lifts:  squat, bench, deadlift.', '2026-01-13 21:18:09'),
(10, 'HIIT & Core', 'Mike Meijer', 'Gym Floor', '2026-01-18 11:30:00', '2026-01-18 12:30:00', 18, 9, 'HIIT combined with core strengthening exercises.', '2026-01-13 21:18:09');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact_requests`
--

CREATE TABLE `contact_requests` (
  `id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `contact_requests`
--

INSERT INTO `contact_requests` (`id`, `trainer_id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 1, 'Test User', 'test@atleviasports.com', '.............', '2026-01-13 21:18:09'),
(5, 1, 'Test', 'smmeijer2501@hotmail.nl', 'TEST', '2026-01-16 18:07:36');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `trainers`
--

INSERT INTO `trainers` (`id`, `name`, `email`, `phone`, `specialization`, `bio`, `photo`, `created_at`) VALUES
(1, 'John Boer', 'john@atleviasports.com', '+31612345678', 'Strength Training', 'Certified personal trainer with 10+ years experience in strength and conditioning.  Specializes in powerlifting and bodybuilding.  Former competitive athlete with a passion for helping clients reach their fitness goals.', NULL, '2026-01-13 21:18:09'),
(2, 'Sarah Krom', 'sarah@atleviasports.com', '+31612345679', 'Yoga & Flexibility', 'Yoga instructor specializing in flexibility and mindfulness training. Certified in Vinyasa, Hatha, and Yin yoga. Believes in the healing power of movement and breath work for both body and mind.', NULL, '2026-01-13 21:18:09'),
(3, 'Mike Meijer', 'mike@atleviasports.com', '+31612345680', 'HIIT & Cardio', 'High-intensity interval training specialist focused on cardiovascular health. Former marathon runner with expertise in endurance training. Passionate about helping people achieve their fitness goals efficiently.', NULL, '2026-01-13 21:18:09'),
(4, 'Emma Klaver', 'emma@atleviasports.com', '+31612345681', 'Boxing & Combat', 'Professional boxing coach with competitive fighting background. Trained amateur and professional fighters. Specializes in technique, conditioning, and mental toughness for combat sports.', NULL, '2026-01-13 21:18:09');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `name`, `phone`, `profile_photo`, `created_at`, `updated_at`) VALUES
(4, 'emuzun@my.aci.k12.com', '$2y$12$Om6dC7k3Qodo2z16pXdkMO0m5scur28ICNNPfRbNZWEyK/ncabZVa', 'Melisa Uzun', NULL, NULL, '2026-01-13 21:24:22', '2026-01-13 22:28:40'),
(6, 'smmeijer2501@hotmail.nl', '$2y$12$7B/bg9IAmQKDJaOzMcg0cOrZfPwJ2CKHiCfem00yXz.Yqz8zNZlv6', 'Sander Meijer', NULL, NULL, '2026-01-14 19:05:53', '2026-01-14 19:05:53'),
(7, 'Sander@hotmail.nl', '$2y$12$HLKu4IMUtoq2j4RvwR.pSuTcmq7zvIICssPg89AawldeyFv3/WGw.', 'Remko Meijer', '0683714833', NULL, '2026-01-16 17:15:00', '2026-01-16 17:16:58'),
(8, 'test@user.com', '$2y$12$WrxkbPDCHp.CLfNfjqwll.1yoiTsVUqnofs9KLyzDSKnbqP7B518u', 'Test', NULL, NULL, '2026-01-16 18:20:18', '2026-01-16 18:20:18');

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `v_user_bookings`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `v_user_bookings` (
`id` int(11)
,`user_id` int(11)
,`class_id` int(11)
,`class_name` varchar(100)
,`start_at` datetime
,`end_at` datetime
,`status` varchar(20)
,`created_at` datetime
);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_trainer` (`trainer_id`),
  ADD KEY `idx_published` (`published_at`);

--
-- Indexen voor tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_time` (`user_id`,`start_at`,`end_at`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_class_id` (`class_id`),
  ADD KEY `idx_start_time` (`start_at`),
  ADD KEY `idx_status` (`status`);

--
-- Indexen voor tabel `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_start_time` (`start_at`),
  ADD KEY `idx_trainer` (`trainer`);

--
-- Indexen voor tabel `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_trainer` (`trainer_id`),
  ADD KEY `idx_created` (`created_at`);

--
-- Indexen voor tabel `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_name` (`name`),
  ADD KEY `idx_email` (`email`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT voor een tabel `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

-- --------------------------------------------------------

--
-- Structuur voor de view `v_user_bookings`
--
DROP TABLE IF EXISTS `v_user_bookings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `v_user_bookings`  AS SELECT `b`.`id` AS `id`, `b`.`user_id` AS `user_id`, `b`.`class_id` AS `class_id`, `c`.`name` AS `class_name`, `b`.`start_at` AS `start_at`, `b`.`end_at` AS `end_at`, `b`.`status` AS `status`, `b`.`created_at` AS `created_at` FROM (`bookings` `b` left join `classes` `c` on(`c`.`id` = `b`.`class_id`)) ;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE SET NULL;

--
-- Beperkingen voor tabel `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD CONSTRAINT `1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
