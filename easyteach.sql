-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Feb 24, 2020 alle 09:45
-- Versione del server: 5.7.26
-- Versione PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `easyteach`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `earnings`
--

CREATE TABLE `earnings` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `earnings`
--

INSERT INTO `earnings` (`id`, `amount`, `earning_types_id`, `notes`) VALUES
(1, 345, 1, 'ggg');

-- --------------------------------------------------------

--
-- Struttura della tabella `earning_types`
--

CREATE TABLE `earning_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `earning_types`
--

INSERT INTO `earning_types` (`id`, `type`) VALUES
(1, 'hyu');

-- --------------------------------------------------------

--
-- Struttura della tabella `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `students_id` int(11) DEFAULT NULL,
  `earnings_id` int(11) NOT NULL,
  `notes` varchar(1000) DEFAULT NULL,
  `event_types_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `events`
--

INSERT INTO `events` (`id`, `date`, `time`, `address`, `students_id`, `earnings_id`, `notes`, `event_types_id`) VALUES
(1, '2020-02-03', '00:00:00', 'gvvvv', 144, 1, 'vvv', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `events_files_and_links`
--

CREATE TABLE `events_files_and_links` (
  `event_id` int(11) NOT NULL,
  `files_and_links_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `event_types`
--

CREATE TABLE `event_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `default_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `event_types`
--

INSERT INTO `event_types` (`id`, `type`, `default_price`) VALUES
(1, 'Music Lesson', 30),
(2, 'Concert', 100);

-- --------------------------------------------------------

--
-- Struttura della tabella `files_and_links`
--

CREATE TABLE `files_and_links` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `instruments`
--

CREATE TABLE `instruments` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `instruments`
--

INSERT INTO `instruments` (`id`, `type`) VALUES
(1, 'Sax'),
(2, 'Flute'),
(3, 'Clarinet'),
(4, 'Recorder'),
(5, 'Piano');

-- --------------------------------------------------------

--
-- Struttura della tabella `instruments_students`
--

CREATE TABLE `instruments_students` (
  `instruments_id` int(11) NOT NULL,
  `students_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `lesson_length`
--

CREATE TABLE `lesson_length` (
  `id` int(11) NOT NULL,
  `length` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `lesson_length`
--

INSERT INTO `lesson_length` (`id`, `length`) VALUES
(1, '50 Min'),
(2, '30 Min'),
(3, '1 Hour');

-- --------------------------------------------------------

--
-- Struttura della tabella `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `image` blob,
  `student_price` varchar(255) DEFAULT NULL,
  `student_sources_id` int(11) DEFAULT NULL,
  `instruments_id` int(11) DEFAULT NULL,
  `lesson_length_id` int(11) DEFAULT NULL,
  `student_regularity_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `students`
--

INSERT INTO `students` (`id`, `name`, `surname`, `email`, `phone`, `date_of_birth`, `image`, `student_price`, `student_sources_id`, `instruments_id`, `lesson_length_id`, `student_regularity_id`) VALUES
(150, 'Primo Salvati', 'Salvati', '', '4334441353', NULL, NULL, '', 3, 3, 1, 1),
(154, 'Eleonora', 'Salvati', 'lallsk@jhmg.it', '433', NULL, NULL, '123', 2, 3, 1, 1),
(155, 'Primo Salvati', 'Salvati', '', '4334441353', NULL, NULL, '', 3, 3, 1, 1),
(156, 'Primo', 'Salvati', 'parlareavanvera@hotmail.it', '34', NULL, NULL, '', 4, 5, 3, 3),
(157, 'Martinone', 'Tono', '', '', NULL, NULL, '', 5, 2, 1, 2),
(158, 'Andrea', 'Ranieriere', '', '', NULL, NULL, '', 3, 3, 1, 1),
(159, 'Primo Salvati', 'Salvati', 'frolli@inghinghingo.it', '4334441353', '2012-12-12', NULL, '123', 5, 5, 2, 2),
(161, 'Günther', 'Goll', 'abc@sonnenschein.gmx.at', '06764456345', '1961-04-04', NULL, '35', 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `student_regularity`
--

CREATE TABLE `student_regularity` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `student_regularity`
--

INSERT INTO `student_regularity` (`id`, `type`) VALUES
(1, 'Once a Week'),
(2, 'Every two Weeks'),
(3, 'One Time');

-- --------------------------------------------------------

--
-- Struttura della tabella `student_sources`
--

CREATE TABLE `student_sources` (
  `id` int(11) NOT NULL,
  `source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `student_sources`
--

INSERT INTO `student_sources` (`id`, `source`) VALUES
(1, 'Private'),
(2, 'MusikMomente'),
(3, 'Lessondo'),
(4, 'Musedu'),
(5, 'MUK Wien');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `earning_types_id` (`earning_types_id`);

--
-- Indici per le tabelle `earning_types`
--
ALTER TABLE `earning_types`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `students_id` (`students_id`),
  ADD KEY `earnings_id` (`earnings_id`),
  ADD KEY `event_types_id` (`event_types_id`);

--
-- Indici per le tabelle `events_files_and_links`
--
ALTER TABLE `events_files_and_links`
  ADD PRIMARY KEY (`event_id`,`files_and_links_id`);

--
-- Indici per le tabelle `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `files_and_links`
--
ALTER TABLE `files_and_links`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `instruments_students`
--
ALTER TABLE `instruments_students`
  ADD PRIMARY KEY (`instruments_id`,`students_id`);

--
-- Indici per le tabelle `lesson_length`
--
ALTER TABLE `lesson_length`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_sources_id` (`student_sources_id`),
  ADD KEY `instruments_id` (`instruments_id`),
  ADD KEY `lesson_length_id` (`lesson_length_id`),
  ADD KEY `student_regularity_id` (`student_regularity_id`);

--
-- Indici per le tabelle `student_regularity`
--
ALTER TABLE `student_regularity`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `student_sources`
--
ALTER TABLE `student_sources`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `earning_types`
--
ALTER TABLE `earning_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `files_and_links`
--
ALTER TABLE `files_and_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `instruments`
--
ALTER TABLE `instruments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `lesson_length`
--
ALTER TABLE `lesson_length`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT per la tabella `student_regularity`
--
ALTER TABLE `student_regularity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `student_sources`
--
ALTER TABLE `student_sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `earnings`
--
ALTER TABLE `earnings`
  ADD CONSTRAINT `earnings_ibfk_1` FOREIGN KEY (`earning_types_id`) REFERENCES `earning_types` (`id`);

--
-- Limiti per la tabella `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`earnings_id`) REFERENCES `earnings` (`id`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`event_types_id`) REFERENCES `event_types` (`id`),
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Limiti per la tabella `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`student_sources_id`) REFERENCES `student_sources` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`instruments_id`) REFERENCES `instruments` (`id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`lesson_length_id`) REFERENCES `lesson_length` (`id`),
  ADD CONSTRAINT `students_ibfk_4` FOREIGN KEY (`student_regularity_id`) REFERENCES `student_regularity` (`id`);
