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
(3, 'Drone', 'DRON001', '1600.00', 'images/dron.jpg'),
(4, 'Watch', 'WATC003', '100.00', 'images/watch.jpg'),
(5, 'Powerbank', 'PBNK001', '70.00', 'images/powerbank.jpg'),
(6, 'Wape', 'WAPE005', '150.00', 'images/wape.jpg'),
(7, 'Router', 'ROUT001', '340.00', 'images/router.jpg'),
(8, 'Fitness', 'FITN001', '120.00', 'images/fitnes.jpg'),
(9, 'Beer', 'BEER001', '13.00', 'images/beer.jpg'),
(10, 'Tank Helmet', 'TANK003', '1337.00', 'images/tank.jpg'),
(11, 'Laptop', 'LAPT001', '570.00', 'images/laptop.jpg'),
(12, 'GoPro', 'GOPR005', '650.00', 'images/gopro.jpg');


CREATE TABLE IF NOT EXISTS `ctf` (
  `flag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ctf` (`flag`) VALUES
('FLAG{PRUF_FOR_ALL_THAT_I_AM_HACKER}');
