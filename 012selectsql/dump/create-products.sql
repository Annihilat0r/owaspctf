CREATE TABLE IF NOT EXISTS `ctf` (
  `flag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ctf` (`flag`) VALUES
('FLAG{A_SQL_query_goes_into_a_bar,_walks_up_to_two_tables_and_asks,_Can_I_join_you?}');
