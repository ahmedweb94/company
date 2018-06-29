-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2018 at 03:41 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campany`
--

-- --------------------------------------------------------

--
-- Table structure for table `campany`
--

CREATE TABLE `campany` (
  `campany_id` int(11) NOT NULL,
  `campany_name` varchar(100) NOT NULL,
  `campany_header` varchar(100) NOT NULL,
  `campany_image` varchar(100) NOT NULL,
  `campany_description` text NOT NULL,
  `campany_phone` int(11) NOT NULL,
  `campany_website` varchar(100) NOT NULL,
  `campany_fb` varchar(100) NOT NULL,
  `campany_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campany`
--

INSERT INTO `campany` (`campany_id`, `campany_name`, `campany_header`, `campany_image`, `campany_description`, `campany_phone`, `campany_website`, `campany_fb`, `campany_email`) VALUES
(1, 'AAF', 'ahmed2', 'Owl-simple-background-abstract-hd-wallpaper_1524849359.jpg', '<p>this is test company and test edit</p>\r\n', 123456789, 'company@company.com', '#', '#'),
(2, 'new', 'ccdc', 'user.png', '<p>dcdcdscvdsc</p>\r\n', 511515, 'dcdcs', 'dcd', 'dcd');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_position` varchar(100) NOT NULL,
  `employee_image` varchar(100) NOT NULL,
  `campany_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_position`, `employee_image`, `campany_id`) VALUES
(1, 'hema', 'hhhb', 'user.png', 1),
(2, 'hey', 'ede', 'user.png', 2),
(3, 'jjj', 'jj', 'head_1525180025.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(122) UNSIGNED NOT NULL,
  `user_type` varchar(250) DEFAULT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `user_type`, `data`) VALUES
(1, 'Member', '{\"users\":{\"own_create\":\"1\",\"own_read\":\"1\",\"own_update\":\"1\",\"own_delete\":\"1\"}}'),
(2, 'admin', '{\"users\":{\"own_create\":\"1\",\"own_read\":\"1\",\"own_update\":\"1\",\"own_delete\":\"1\",\"all_create\":\"1\",\"all_read\":\"1\",\"all_update\":\"1\",\"all_delete\":\"1\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(122) UNSIGNED NOT NULL,
  `keys` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `keys`, `value`) VALUES
(1, 'website', 'User Login and Management'),
(2, 'logo', 'logo.png'),
(3, 'favicon', 'favicon.ico'),
(4, 'SMTP_EMAIL', ''),
(5, 'HOST', ''),
(6, 'PORT', ''),
(7, 'SMTP_SECURE', ''),
(8, 'SMTP_PASSWORD', ''),
(9, 'mail_setting', 'simple_mail'),
(10, 'company_name', 'Company Name'),
(11, 'crud_list', 'users,User'),
(12, 'EMAIL', ''),
(13, 'UserModules', 'yes'),
(14, 'register_allowed', '1'),
(15, 'email_invitation', '1'),
(16, 'admin_approval', '0'),
(17, 'user_type', '[\"Member\"]');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(121) UNSIGNED NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `html` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `module`, `code`, `template_name`, `html`) VALUES
(1, 'forgot_pass', 'forgot_password', 'Forgot password', '<html xmlns=\"http://www.w3.org/1999/xhtml\"><head>\n\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n\n  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n\n  <style type=\"text/css\" rel=\"stylesheet\" media=\"all\">\n\n    /* Base ------------------------------ */\n\n    *:not(br):not(tr):not(html) {\n\n      font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;\n\n      -webkit-box-sizing: border-box;\n\n      box-sizing: border-box;\n\n    }\n\n    body {\n\n      \n\n    }\n\n    a {\n\n      color: #3869D4;\n\n    }\n\n\n\n\n\n    /* Masthead ----------------------- */\n\n    .email-masthead {\n\n      padding: 25px 0;\n\n      text-align: center;\n\n    }\n\n    .email-masthead_logo {\n\n      max-width: 400px;\n\n      border: 0;\n\n    }\n\n    .email-footer {\n\n      width: 570px;\n\n      margin: 0 auto;\n\n      padding: 0;\n\n      text-align: center;\n\n    }\n\n    .email-footer p {\n\n      color: #AEAEAE;\n\n    }\n\n  \n\n    .content-cell {\n\n      padding: 35px;\n\n    }\n\n    .align-right {\n\n      text-align: right;\n\n    }\n\n\n\n    /* Type ------------------------------ */\n\n    h1 {\n\n      margin-top: 0;\n\n      color: #2F3133;\n\n      font-size: 19px;\n\n      font-weight: bold;\n\n      text-align: left;\n\n    }\n\n    h2 {\n\n      margin-top: 0;\n\n      color: #2F3133;\n\n      font-size: 16px;\n\n      font-weight: bold;\n\n      text-align: left;\n\n    }\n\n    h3 {\n\n      margin-top: 0;\n\n      color: #2F3133;\n\n      font-size: 14px;\n\n      font-weight: bold;\n\n      text-align: left;\n\n    }\n\n    p {\n\n      margin-top: 0;\n\n      color: #74787E;\n\n      font-size: 16px;\n\n      line-height: 1.5em;\n\n      text-align: left;\n\n    }\n\n    p.sub {\n\n      font-size: 12px;\n\n    }\n\n    p.center {\n\n      text-align: center;\n\n    }\n\n\n\n    /* Buttons ------------------------------ */\n\n    .button {\n\n      display: inline-block;\n\n      width: 200px;\n\n      background-color: #3869D4;\n\n      border-radius: 3px;\n\n      color: #ffffff;\n\n      font-size: 15px;\n\n      line-height: 45px;\n\n      text-align: center;\n\n      text-decoration: none;\n\n      -webkit-text-size-adjust: none;\n\n      mso-hide: all;\n\n    }\n\n    .button--green {\n\n      background-color: #22BC66;\n\n    }\n\n    .button--red {\n\n      background-color: #dc4d2f;\n\n    }\n\n    .button--blue {\n\n      background-color: #3869D4;\n\n    }\n\n  </style>\n\n</head>\n\n<body style=\"width: 100% !important;\n\n      height: 100%;\n\n      margin: 0;\n\n      line-height: 1.4;\n\n      background-color: #F2F4F6;\n\n      color: #74787E;\n\n      -webkit-text-size-adjust: none;\">\n\n  <table class=\"email-wrapper\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"\n\n    width: 100%;\n\n    margin: 0;\n\n    padding: 0;\">\n\n    <tbody><tr>\n\n      <td align=\"center\">\n\n        <table class=\"email-content\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\n\n      margin: 0;\n\n      padding: 0;\">\n\n          <!-- Logo -->\n\n\n\n          <tbody>\n\n          <!-- Email Body -->\n\n          <tr>\n\n            <td class=\"email-body\" width=\"100%\" style=\"width: 100%;\n\n    margin: 0;\n\n    padding: 0;\n\n    border-top: 1px solid #edeef2;\n\n    border-bottom: 1px solid #edeef2;\n\n    background-color: #edeef2;\">\n\n              <table class=\"email-body_inner\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\" style=\" width: 570px;\n\n    margin:  14px auto;\n\n    background: #fff;\n\n    padding: 0;\n\n    border: 1px outset rgba(136, 131, 131, 0.26);\n\n    box-shadow: 0px 6px 38px rgb(0, 0, 0);\n\n       \">\n\n                <!-- Body content -->\n\n                <thead style=\"background: #3869d4;\"><tr><th><div align=\"center\" style=\"padding: 15px; color: #000;\"><a href=\"{var_action_url}\" class=\"email-masthead_name\" style=\"font-size: 16px;\n\n      font-weight: bold;\n\n      color: #bbbfc3;\n\n      text-decoration: none;\n\n      text-shadow: 0 1px 0 white;\">{var_sender_name}</a></div></th></tr>\n\n                </thead>\n\n                <tbody><tr>\n\n                  <td class=\"content-cell\" style=\"padding: 35px;\">\n\n                    <h1>Hi {var_user_name},</h1>\n\n                    <p>You recently requested to reset your password for your {var_website_name} account. Click the button below to reset it.</p>\n\n                    <!-- Action -->\n\n                    <table class=\"body-action\" align=\"center\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"\n\n      width: 100%;\n\n      margin: 30px auto;\n\n      padding: 0;\n\n      text-align: center;\">\n\n                      <tbody><tr>\n\n                        <td align=\"center\">\n\n                          <div>\n\n                            <!--[if mso]><v:roundrect xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" href=\"{{var_action_url}}\" style=\"height:45px;v-text-anchor:middle;width:200px;\" arcsize=\"7%\" stroke=\"f\" fill=\"t\">\n\n                              <v:fill type=\"tile\" color=\"#dc4d2f\" />\n\n                              <w:anchorlock/>\n\n                              <center style=\"color:#ffffff;font-family:sans-serif;font-size:15px;\">Reset your password</center>\n\n                            </v:roundrect><![endif]-->\n\n                            <a href=\"{var_varification_link}\" class=\"button button--red\" style=\"background-color: #dc4d2f;display: inline-block;\n\n      width: 200px;\n\n      background-color: #3869D4;\n\n      border-radius: 3px;\n\n      color: #ffffff;\n\n      font-size: 15px;\n\n      line-height: 45px;\n\n      text-align: center;\n\n      text-decoration: none;\n\n      -webkit-text-size-adjust: none;\n\n      mso-hide: all;\">Reset your password</a>\n\n                          </div>\n\n                        </td>\n\n                      </tr>\n\n                    </tbody></table>\n\n                    <p>If you did not request a password reset, please ignore this email or reply to let us know.</p>\n\n                    <p>Thanks,<br>{var_sender_name} and the {var_website_name} Team</p>\n\n                   <!-- Sub copy -->\n\n                    <table class=\"body-sub\" style=\"margin-top: 25px;\n\n      padding-top: 25px;\n\n      border-top: 1px solid #EDEFF2;\">\n\n                      <tbody><tr>\n\n                        <td> \n\n                          <p class=\"sub\" style=\"font-size:12px;\">If you are having trouble clicking the password reset button, copy and paste the URL below into your web browser.</p>\n\n                          <p class=\"sub\"  style=\"font-size:12px;\"><a href=\"{var_varification_link}\">{var_varification_link}</a></p>\n\n                        </td>\n\n                      </tr>\n\n                    </tbody></table>\n\n                  </td>\n\n                </tr>\n\n              </tbody></table>\n\n            </td>\n\n          </tr>\n\n        </tbody></table>\n\n      </td>\n\n    </tr>\n\n  </tbody></table>\n\n\n\n\n\n</body></html>'),
(3, 'users', 'invitation', 'Invitation', '<p>Hello <strong>{var_user_email}</strong></p>\n\n\n\n<p>Click below link to register&nbsp;<br />\n\n{var_inviation_link}</p>\n\n\n\n<p>Thanks&nbsp;</p>\n\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(121) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `var_key` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `user_id`, `var_key`, `status`, `is_deleted`, `name`, `password`, `email`, `profile_pic`, `user_type`) VALUES
(1, '1', '', 'active', '0', 'admin', 'admin_password', 'admin_email', 'demo_pic.png', 'admin'),
(2, '1', NULL, 'active', '0', 'hr', '$2y$10$BtvTwhopcbN/9PZIRU0oHeIedBmSU/YqrWzxD6SgqLcTVMcT8AmHW', 'hr@hr.com', 'user.png', 'admin'),
(3, '1', NULL, 'active', '0', 'gg', '$2y$10$HIfYnj9ynvlam86fDHnTC.RjD3Z0m.SY.1nxnrShHvmz8TVxxwIFG', 'gg@d.g', 'user.png', 'Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campany`
--
ALTER TABLE `campany`
  ADD PRIMARY KEY (`campany_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campany`
--
ALTER TABLE `campany`
  MODIFY `campany_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(122) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(122) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(121) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(121) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
