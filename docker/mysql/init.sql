DROP DATABASE IF EXISTS posse;
CREATE DATABASE posse;
USE posse;

CREATE TABLE studies(
    id INT(11) AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',
    hours INT(11) COMMENT '学習時間',
    date DATE COMMENT '学習日',
    language VARCHAR(255) COMMENT '学習言語',
    content VARCHAR(255) COMMENT '学習コンテンツ'
);

INSERT INTO `studies` VALUES
(1, 3, '2022-01-14', 'PHP','ドットインストール'),
(2, 2, '2022-02-14', 'HTML','N予備校'),
(3, 4, '2022-03-14', 'Larabel','ドットインストール'),
(4, 5, '2022-04-13', 'Vue.js','ドットインストール'),
(6, 2, '2022-04-19', 'HTML','POSSE課題' ),
(7, 8, '2022-05-17', 'CSS', 'N予備校'),
(8, 2, '2022-05-20', 'Larabel', 'POSSE課題'),
(9, 2, '2022-06-01', 'JavaScript', 'N予備校'),
(10, 3, '2022-06-02', 'HTML', 'ドットインストール'),
(11, 2, '2022-06-03', 'JavaScript', 'N予備校'),
(12, 2, '2022-06-04', 'JavaScript', 'N予備校'),
(13, 2, '2022-06-05', 'JavaScript', 'N予備校'),
(14, 2, '2022-06-06', 'JavaScript', 'N予備校'),
(15, 2, '2022-06-07', 'JavaScript', 'N予備校'),
(16, 4, '2022-06-08', 'HTML', 'ドットインストール'),
(17, 2, '2022-06-09', 'JavaScript', 'N予備校'),
(18, 2, '2022-06-10', 'JavaScript', 'N予備校'),
(19, 2, '2022-06-11', 'JavaScript', 'N予備校'),
(20, 2, '2022-06-12', 'JavaScript', 'N予備校'),
(21, 2, '2022-06-13', 'JavaScript', 'N予備校'),
(22, 5, '2022-06-14', 'HTML', 'ドットインストール'),
(23, 1, '2022-06-15', 'Larabel', 'N予備校'),
(24, 1, '2022-06-15', 'Larabel', 'N予備校'),
(25, 1, '2022-06-15', 'Larabel', 'N予備校'),
(26, 1, '2022-06-15', 'Larabel', 'N予備校'),
(27, 1, '2022-06-15', 'Larabel', 'N予備校'),
(28, 1, '2022-06-18', 'Larabel', 'N予備校'),
(29, 3, '2022-07-19', 'PHP', 'POSSE課題'),
(30, 5, '2022-08-20', 'JavaScript', 'N予備校'),
(31, 3, '2022-08-20', 'CSS', 'ドットインストール'),
(32, 7, '2022-08-21', 'PHP', 'ドットインストール'),
(33, 2, '2022-09-21', 'JavaScript', 'N予備校'),
(34, 1, '2022-09-25', 'Ruby', 'POSSE課題'),
(35, 3, '2022-09-28', 'CSS', 'N予備校'),
(36, 4, '2022-10-23', 'Larabel', 'POSSE課題'),
(37, 2, '2022-11-23', '情報システム基礎知識', 'ドットインストール');

-- SELECT sum(hours) FROM studies WHERE date LIKE '%-06-%';
-- SELECT sum(hours) FROM studies WHERE date = '2022-06-18';
-- SELECT sum(hours) FROM studies;
SELECT date as `grouping_column`,
  sum(`hours`) as `sumhours`
  FROM studies
  where date LIKE "%-06-%"
  GROUP BY `grouping_column`;

-- 日にちごとに集計

