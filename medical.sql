-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 192.168.0.106:3306
-- Время создания: Май 18 2023 г., 03:38
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `medical`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doctor_list`
--

CREATE TABLE `doctor_list` (
  `id` int NOT NULL,
  `specialization` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `office` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `internal_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `working_hours` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `change_doctors` varchar(1) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `doctor_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `doctor_list`
--

INSERT INTO `doctor_list` (`id`, `specialization`, `office`, `internal_phone`, `working_hours`, `change_doctors`, `status`, `doctor_id`) VALUES
(1, 'Невролог', '23', '#741', '15:00 - 21:30', '2', 'На работе', '1'),
(2, 'Терапевт', '12', '#234', '15:00 - 21:30', '2', 'Выходной', '2'),
(3, 'Хирург', '23', '#643', '15:00 - 21:30', '2', 'Выходной', '3'),
(4, 'Оториноларинголог', '21', '#213', '7:30 - 14:30', '1', 'На работе', '4'),
(5, 'Офтальмолог', '13', '#126', '15:00 - 21:30', '2', 'На работе', '5'),
(6, 'Травматолог', '11', '#834', '15:00 - 21:30', '2', 'Выходной', '6'),
(7, 'Кардиолог', '4', '#674', '7:30 - 14:30', '1', 'На работе', '7'),
(8, 'Стоматолог', '7', '#278', '7:30 - 14:30', '1', 'Выходной', '8'),
(9, 'Эндокринолог', '5', '#925', '15:00 - 21:30', '2', 'На работе', '9'),
(10, 'Аллерголог', '8', '#631', '7:30 - 14:30', '1', 'Выходной', '10');

-- --------------------------------------------------------

--
-- Структура таблицы `patients`
--

CREATE TABLE `patients` (
  `id` int UNSIGNED NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `login` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sector_card` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT 'Не указано',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `patients`
--

INSERT INTO `patients` (`id`, `password`, `login`, `sector_card`, `date`) VALUES
(16, '$2y$10$/.dvbCHRmtmVybWx6DFsLeCwyPhXewR4lSuQU5aKT7m8zjzizYNLq', 'vlasov', 'Не указано', '2023-04-01 17:01:11'),
(17, '$2y$10$p8fcicy5mDPN.f1SemM8AOxcrGgVWRgwfnjVGZQZGjWv7rbRm6Vke', 'vlasov.handson', 'Не указано', '2023-04-02 04:18:32'),
(18, '$2y$10$w50yn01bWzwUl6KebdjODukYfNdK/8C/LzWK.nCFrdj6Y9IRKd/Eu', 'vladislav.prokof', 'Не указано', '2023-04-02 15:01:15'),
(19, '$2y$10$3pUdiQFFYFZvp/ifdnlQ8OrqiPNC9gltBai0iDyDsBRKihRD83wd6', '+7(977)2706065', 'Не указано', '2023-04-02 15:05:00'),
(20, '$2y$10$grP35DBZSKkMk4lHsISdxuKCX4fQB3Lhzk8PIxcgQQhDfJuV4nRE2', 'Жопа', 'Не указано', '2023-04-14 17:30:18'),
(21, '$2y$10$CjgkX7GdJXU/2no79CW3Nu7nPv9cAhITlQsKI/GRq6qqN/1IVPp2S', 'vlad0231', 'Не указано', '2023-04-23 16:10:45'),
(22, '$2y$10$0aZTPh1zWZN5HRu99kldTOKYuWPigsA6X.T8mmY3ak0Pmvs479dKi', '123456678', 'Не указано', '2023-05-04 15:29:42');

-- --------------------------------------------------------

--
-- Структура таблицы `record_patients_date`
--

CREATE TABLE `record_patients_date` (
  `id` int NOT NULL,
  `doctor_id` varchar(255) NOT NULL,
  `day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `disabled` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `time_id_disabled` varchar(255) NOT NULL,
  `date_del` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `record_patients_date`
--

INSERT INTO `record_patients_date` (`id`, `doctor_id`, `day`, `month`, `year`, `disabled`, `time_id_disabled`, `date_del`) VALUES
(2, '1', '27', '04', '2023', 'disabled', '2', '2023-04-27'),
(3, '1', '25', '04', '2023', 'disabled', '2', '2023-04-25'),
(4, '1', '26', '04', '2023', 'disabled', '2', '2023-04-26'),
(5, '1', '25', '04', '2023', 'disabled', '29', '2023-04-25'),
(6, '5', '26', '04', '2023', 'disabled', '21', '2023-04-26'),
(8, '4', '31', '05', '2023', 'disabled', '6', '2023-05-31'),
(9, '2', '18', '05', '2023', 'disabled', '21', '2023-05-18'),
(10, '1', '16', '05', '2023', 'disabled', '4', '2023-05-16'),
(11, '6', '10', '05', '2023', 'disabled', '19', '2023-05-10'),
(12, '8', '17', '05', '2023', 'disabled', '5', '2023-05-17'),
(13, '1', '11', '05', '2023', 'disabled', '5', '2023-05-11'),
(14, '1', '11', '05', '2023', 'disabled', '3', '2023-05-11'),
(15, '4', '18', '05', '2023', 'disabled', '6', '2023-05-18'),
(16, '1', '18', '05', '2023', 'disabled', '18', '2023-05-18');

-- --------------------------------------------------------

--
-- Структура таблицы `record_patients_list`
--

CREATE TABLE `record_patients_list` (
  `id` int NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `patients` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `date_del` date NOT NULL,
  `registr_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Самозапись'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `record_patients_list`
--

INSERT INTO `record_patients_list` (`id`, `doctor`, `patients`, `time`, `day`, `month`, `year`, `date_del`, `registr_id`) VALUES
(2, '1', '17', '2', '27', '04', '2023', '2023-04-27', 'vladislav0351'),
(3, '1', '17', '2', '25', '04', '2023', '2023-04-25', 'vlasov032'),
(4, '1', '16', '2', '26', '04', '2023', '2023-04-26', 'vlasov342'),
(5, '1', '21', '29', '25', '04', '2023', '2023-04-25', 'admin'),
(6, '5', '18', '21', '26', '04', '2023', '2023-04-26', 'Самозапись'),
(8, '4', '18', '6', '31', '05', '2023', '2023-05-31', 'Самозапись'),
(9, '2', '18', '21', '18', '05', '2023', '2023-05-18', 'Самозапись'),
(10, '1', '18', '4', '16', '05', '2023', '2023-05-16', 'Самозапись'),
(11, '6', '18', '19', '10', '05', '2023', '2023-05-10', 'Самозапись'),
(12, '8', '18', '5', '17', '05', '2023', '2023-05-17', 'Самозапись'),
(13, '1', '18', '5', '11', '05', '2023', '2023-05-11', 'Самозапись'),
(14, '1', '18', '3', '11', '05', '2023', '2023-05-11', 'Самозапись'),
(15, '4', '22', '6', '18', '05', '2023', '2023-05-18', 'Самозапись'),
(16, '1', '16', '18', '18', '05', '2023', '2023-05-18', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `record_patients_time`
--

CREATE TABLE `record_patients_time` (
  `id` int NOT NULL,
  `time_name` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `change` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `record_patients_time`
--

INSERT INTO `record_patients_time` (`id`, `time_name`, `change`) VALUES
(1, '7:30', '1'),
(2, '8:00', '1'),
(3, '8:30', '1'),
(4, '9:00', '1'),
(5, '9:30', '1'),
(6, '10:00', '1'),
(7, '10:30', '1'),
(8, '11:00', '1'),
(9, '11:30', '1'),
(10, '12:00', '1'),
(11, '12:30', '1'),
(12, '13:00', '1'),
(13, '13:30', '1'),
(14, '14:00', '1'),
(15, '14:30', '1'),
(16, '15:00', '2'),
(17, '15:30', '2'),
(18, '16:00', '2'),
(19, '16:30', '2'),
(20, '17:00', '2'),
(21, '17:30', '2'),
(22, '18:00', '2'),
(23, '18:30', '2'),
(24, '19:00', '2'),
(25, '19:30', '2'),
(26, '20:00', '2'),
(27, '20:30', '2'),
(28, '21:00', '2'),
(29, '21:30', '2');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `login` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `admin` varchar(1) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `password`, `login`, `status`, `admin`) VALUES
(1, '$2y$10$mkINL8wwsv/g8k/oaF5RsOwy3bFNn9AiPN1rQnjvW0KqHRpwhD4Ge', 'admin', '1', '1'),
(2, '$2y$10$IVp7CKZ8ApjrCHfVXeRlweKVby5gQ.N4qlKrClK.jrKIu7RSoFzkq', '123456678', '1', '0'),
(3, '$2y$10$2f2XYPvdMjIZM85Ge1tjW.Enb6JE2gYXG2bzlXYDrcRdPmY17b6m6', '1234566782', '1', '0'),
(4, '$2y$10$yCxzY41SwfeL.C2OBmw/h.NycHI9ZgQ7DfRHS3BHEaF3ZpzV27wju', 'vladislav0351', '1', '0'),
(5, '$2y$10$jwFQPkVPmBH4WFZAt1nH2eT.qTMtxS6KRpoPdqSUDbtGc2iOR4Yf.', 'vlasov032', '1', '0'),
(6, '$2y$10$CazTTfVmVX6Sgsvcg5oc0.P81hof7LlA4BTj6ChkJ5ET0zvHtQBlm', 'vlasov342', '1', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doctor_list`
--
ALTER TABLE `doctor_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `record_patients_date`
--
ALTER TABLE `record_patients_date`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `record_patients_list`
--
ALTER TABLE `record_patients_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `record_patients_time`
--
ALTER TABLE `record_patients_time`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `doctor_list`
--
ALTER TABLE `doctor_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `record_patients_date`
--
ALTER TABLE `record_patients_date`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `record_patients_list`
--
ALTER TABLE `record_patients_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `record_patients_time`
--
ALTER TABLE `record_patients_time`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
