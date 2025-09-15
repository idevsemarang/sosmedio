INSERT INTO `countries` (`name`, `created_at`, `updated_at`) VALUES 
('Indonesia', '2025-09-12 22:27:33', NULL), 
('Jepang', '2025-09-12 22:27:33', NULL), 
('Korea', '2025-09-12 22:27:33', NULL), 
('Brazil', '2025-09-12 22:27:33', NULL);


INSERT INTO `users` (`name`, `email`, `country_id`, `password`, `created_at`, `updated_at`) VALUES 
('Joni Handoko', 'jonihan@email.com', '1', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2025-09-12 22:30:08', NULL), 
('Minamoto Novitakomo', 'minov@email.com', '2', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2025-09-12 22:30:08', NULL);


INSERT INTO `hashtags` (`title`, `initiated_by`, `created_at`, `updated_at`) VALUES 
('#alam', '1', '2025-09-12 22:32:29', NULL), 
('#hutan', '1', '2025-09-12 22:32:29', NULL), 
('#flora', '2', '2025-09-12 22:32:29', NULL), 
('#nature', '2', '2025-09-12 22:32:29', NULL), 
('#green', '1', '2025-09-12 22:32:29', NULL), 
('#wood', '2', '2025-09-12 22:32:29', NULL), 
('#fresh', '1', '2025-09-12 22:32:29', NULL), 
('#saveourworld', '1', '2025-09-12 22:32:29', NULL), 
('#hijau', '1', '2025-09-12 22:32:29', NULL);