--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sku` varchar(14) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `sku` (`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `sku`, `price`, `image`) VALUES
(1, 'Iphone', 'IPHO001', '400.00', 'images/iphone.jpg'),
(2, 'Camera', 'CAME001', '700.00', 'images/camera.jpg'),
(3, 'Watch', 'WATC002', '100.00', 'images/watch.jpg');
(4, 'Watch', 'WATC003', '100.00', 'images/watch.jpg');
(5, 'Watch', 'WATC004', '100.00', 'images/watch.jpg');
(6, 'Watch', 'WATC005', '100.00', 'images/watch.jpg');


CREATE TABLE IF NOT EXISTS `ctf` (
  `flag` varchar(100) NOT NULL,
  PRIMARY KEY (`flag`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ctf` (`flag`) VALUES
('FLAG{PRUF_FOR_ALL_THAT_I_AM_HACKER}')
