-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2025 at 10:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Table structure for table `admins`
--
CREATE TABLE `admins` (
  `id` int(2) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,   
  `password` varchar(255) NOT NULL,      
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(3) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `date` varchar(11) NOT NULL,
  `time` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `user_id` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `product_id` int(10) NOT NULL,
  `size` varchar(30) NOT NULL,
  `quantity` int(10) NOT NULL,
  `user_id` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `street_address` varchar(200) NOT NULL,
  `town` varchar(100) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_id` int(3) NOT NULL,
  `status` varchar(20) NOT NULL,
  `total_price` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(400) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(5) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`, `type`, `created_at`) VALUES
(1, 'Coffee Capuccino', 'menu-1.jpg', 'Cappuccino is a traditional Italian drink that features the perfect balance of espresso, hot milk, and thick foam. Its strong espresso shot hidden under the warm foam and the smooth creamy texture of the milk make it a classic and comforting experience for coffee lovers.', '4.90', 'coffee', '2025-12-04 08:02:50'),
(2, 'Creamy Latte Coffee', 'menu-2.jpg', 'It has the depth of an espresso shot, combined with the smoothness of steamed milk and a light layer of thick foam on top, creating a sweet and warm sensation. Its the perfect and satisfying choice for a morning or afternoon treat.', '5.10', 'coffee', '2025-12-04 08:02:50'),
(3, 'Cold Coffee', 'menu-3.jpg', 'It is the perfect blend of fresh coffee, ice and milk, which instantly relieves fatigue and refreshes the mind. Its creamy texture and strong aroma of coffee make it a favorite drink among coffee lovers.', '3.65', 'coffee', '2025-12-04 08:02:50'),
(4, 'Lemonde Juice', 'drink-1.jpg', 'The sweet-sour combination of lemon Juice is a refreshing drink that cools the mind and body on a hot day. Each sip has a perfect balance of lemony tartness and honey sweetness, which is great for relieving fatigue.', '2.90', 'drink', '2025-12-04 08:02:50'),
(5, 'Pineapple Juice', 'drink-2.jpg', 'Pineapple juice is a popular drink with a sweet and sour taste, which is great for refreshing the body during summers. It is a good source of vitamin C and manganese. This juice contains the digestive enzyme bromelain, which makes it not only delicious, but also healthy. .', '3.50', 'drink', '2025-12-04 08:02:50'),
(6, 'Hot Cake Honey', 'dessert-1.jpg', 'Hot Cake Honey is a classic and satisfying treat, made with a tangy blend of melted butter and pure honey spread over soft, fluffy pancakes. The warmth of the pancakes enhances the natural sweetness and aroma of the honey. Its the perfect combination for breakfast or any sweet treat, and a quick treat.', '3.85', 'dessert', '2025-12-04 08:02:50'),
(7, 'Cherry Butter Cake', 'dessert-2.jpg', 'Cherry Butter Cake is a classic and tempting dessert, known for its rich, soft buttery texture and the juicy taste of sweet cherries. The buttery flavor of each layer of the cake is infused with cherry pieces, giving it a balanced taste. Since this cake is lightly sweet, it is a perfect companion to enjoy with a hot cup of coffee or tea.', '4.00', 'dessert', '2025-12-04 08:02:50'),
(8, 'Banana Cheery Cake', 'dessert-5.jpg', 'Banana Cherry Cake is a perfect dessert, a wonderful blend of the natural sweetness of ripe bananas and the slightly tart taste of cherries. It is known for its soft and moist texture, which will make your every bite a delight. This cake is an ideal accompaniment to any of your coffee or tea. ', '4.00', 'dessert', '2025-12-04 08:02:50'),
(9, 'Soda Drinks', 'drink-3.jpg', 'Soda drinks are sweetened beverages made with sugar, flavorings, and carbon dioxide gas. The carbon dioxide in these drinks creates bubbles and gives a fizzy feeling when you drink them. They are very popular around the world, but they are usually high in calories and sugar. ', '5.90', 'drink', '2025-12-04 08:02:50'),
(10, 'Roasted Chicken', 'dish-4.jpg', 'Roasted chicken is a classic and popular dish around the world, in which chicken is roasted in the oven at high heat until golden brown. Properly roasted chicken is crispy on the outside and juicy and tender on the inside. It is usually marinated with various herbs, spices and lemon juice, which makes it taste amazing and is ideal for any menu as a healthy source of protein. ', '10', 'main dish', '2025-12-04 08:02:50'),
(11, 'Cornish - Mackere', 'dish-1.jpg', 'Cornish mackerel is a popular oily sea fish, commonly found off the coast of Cornwall in the UK. It is known for its strong, distinctive flavour and high levels of omega-3 fatty acids. Served roasted, grilled or smoked, this fish is a great healthy addition to any seafood menu. ', '12', 'main dish', '2025-05-28 07:56:21'),
(12, ' Roasted Steak', 'dish-2.jpg', 'Roasted steak is a delicious and classic beef dish, roasted to perfection over high heat. With proper roasting, the outside of the meat is beautifully caramelized and crispy, while the inside remains juicy and tender. Typically roasted with herbs, spices, and butter, this steak is an excellent source of protein and perfect for any special dinner. ', '12', 'main dish', '2025-12-04 08:02:50'),
(13, 'Cheese Burger', 'burger-1.jpg', 'A cheeseburger is a classic American fast food that is very popular around the world. It is basically made with a grilled or fried patty (usually beef) topped with a slice of cheese. These two main ingredients are placed between a fresh bun and served with lettuce, tomato, onion, and a variety of sauces. The combination of the creamy texture of the cheese and the juicy flavor of the patty makes it a filling and satisfying meal. ', '5', 'starter', '2025-12-04 08:02:50'),
(14, 'Salad Burger', 'burger-3.jpg', 'Salad burgers are a refreshing and healthy alternative to the traditional burgers, made with a meat patty or in place of a large amount of fresh vegetables and salad leaves. They are usually topped with crispy lettuce, tomatoes, cucumbers and healthy sauces, making them light and tasty. They are a great choice for consumers who want to be health conscious while still maintaining their taste. ', '6.80', 'starter', '2025-12-04 08:02:50'),
(15, 'Chicken pasta with peas', 'Chicken_pasta_with_peas_hJpmIyD.width-510.png', 'The combination of soft pasta wrapped in a creamy sauce, juicy chicken and bright green beans makes this a healthy and delicious dish. This dish creates a beautiful balance of flavors, which is light yet very satisfying.  ', '15.80', 'starter', '2025-12-04 08:02:50');


-- --------------------------------------------------------

--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,   
  `password` varchar(255) NOT NULL,      
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `contact_messages`

CREATE TABLE `contact_messages` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `subject` VARCHAR(255) NOT NULL,
    `message` TEXT NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--  data for table `users`
--
INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'user', 'user@gmail.com', '$2y$10$wE9L0ZJgK7yH1mF5G4t4G.yMvO0xR9XvTqG8sO1nZ3j4G6h3V5eT3K5m', '2025-07-03 05:45:14');

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

COMMIT;
