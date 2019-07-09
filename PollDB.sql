#Database structure

CREATE SCHEMA poll_assignment;

#Store poll questions and options
CREATE TABLE IF NOT EXISTS `poll_data` (
  `QuestionID` INT(9) NOT NULL AUTO_INCREMENT,
  `PollStatus` VARCHAR(10) NOT NULL DEFAULT '',
  `Question` VARCHAR(255) NOT NULL DEFAULT '',
  `Option1` VARCHAR(255) NOT NULL DEFAULT '',
  `Option2` VARCHAR(255) NOT NULL DEFAULT '',
  `Option3` VARCHAR(255) NOT NULL DEFAULT '',
  `Option4` VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`QuestionID`)
);

#Store user responses (poll results)
CREATE TABLE IF NOT EXISTS `poll_answers` (
  `AnsID` INT(5) NOT NULL AUTO_INCREMENT,
  `SessionID` VARCHAR(50) NOT NULL DEFAULT '',
  `QuestionIDFK` INT(9) NOT NULL,
  `SelectedOption` VARCHAR(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`AnsID`)
);


INSERT INTO `poll_data` (`QuestionID`, `PollStatus`, `Question`, `Option1`, `Option2`, `Option3`, `Option4`) VALUES
(1, 'Active', 'Who is your favourite author?', 'Miguel de Cervantes', 'Charles Dickens', 'J.R.R. Tolkien', 'Antoine de Saint-Exuper');


