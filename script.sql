ALTER TABLE `users_data` ADD `lead_matching_answer_ids` TEXT NOT NULL;



CREATE TABLE `lead_matching_answers` (
  `answer_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

ALTER TABLE `lead_matching_answers`
  ADD PRIMARY KEY (`answer_id`);

ALTER TABLE `lead_matching_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;



CREATE TABLE `lead_matching_questions` (
  `question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `question_variable` varchar(255) NOT NULL,
  `question_label` varchar(255) NOT NULL,
  `question_type` varchar(32) NOT NULL COMMENT 'checkbox or dropdown',
  `question_order` tinyint(4) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lead_matching_questions`
  ADD PRIMARY KEY (`question_id`);

ALTER TABLE `lead_matching_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

