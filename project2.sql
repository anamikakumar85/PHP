-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2020 at 10:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie_table`
--

CREATE TABLE `categorie_table` (
  `sno` int(5) NOT NULL,
  `categorie` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie_table`
--

INSERT INTO `categorie_table` (`sno`, `categorie`) VALUES
(1, 'Meal Type'),
(2, 'Dish Type'),
(3, 'Ingredients'),
(4, 'Cookiing Style'),
(5, 'Diet and Health'),
(6, 'World Cuisine'),
(7, 'Seasonal'),
(8, 'Special');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_table`
--

CREATE TABLE `ingredient_table` (
  `sno` int(11) NOT NULL,
  `ingredient` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredient_table`
--

INSERT INTO `ingredient_table` (`sno`, `ingredient`) VALUES
(1, 'Unflavored gelatin'),
(2, 'White sugar'),
(3, 'Cornstarch'),
(4, 'Eggs'),
(5, 'Milk'),
(6, 'Vanilla ice cream'),
(7, 'Heavy whipping cream'),
(21, 'Brown sugar'),
(20, 'Butter-softened'),
(19, 'Banana'),
(18, 'Lemon'),
(17, 'Apple'),
(22, 'Vanilla Extract'),
(23, 'Baking soda'),
(24, 'Hot water'),
(25, 'All-purpose flour'),
(26, 'Salt'),
(27, 'Semisweet chocolate chips'),
(28, 'Cold water'),
(29, 'Pie crust ,baked'),
(33, 'Spinach'),
(32, 'Eggs medium sized'),
(34, 'Fenugreek leaves'),
(35, 'Canola oil'),
(36, 'Paneer'),
(37, 'Cumin seed'),
(38, 'Onion'),
(39, 'Grated fresh ginger'),
(40, 'Garlic'),
(41, 'Garam masala'),
(42, 'Ground turmeric'),
(45, ' fusilli (spiral) pasta'),
(46, 'Cherry tomatoes'),
(47, 'Salami cubed'),
(48, 'Pepporoni'),
(49, 'Green bell pepper'),
(50, 'Italian salad dressing'),
(51, 'Chicken,boneless'),
(52, 'Cooking oil'),
(53, 'Chooped onion'),
(54, 'Minced garlic'),
(55, 'Ginger'),
(56, 'Curry powder'),
(57, 'Crushed tomatoes'),
(58, 'Plain yogurt'),
(59, 'English cucumber'),
(60, 'Gochujang (Korean hot pepper paste)'),
(61, 'Soy sauce'),
(62, 'Olive oil'),
(63, 'Carrots'),
(64, 'White rice'),
(65, 'Mayonnaise'),
(66, 'Rice wine vinegar'),
(67, 'Dijon mustard'),
(68, 'Fresh dill'),
(69, 'Water'),
(70, 'Butter'),
(71, 'All-purpose-flour'),
(72, 'Egg'),
(73, 'Bone in chicken thigh,skin on'),
(74, 'Kosher'),
(75, 'Dried oregano'),
(76, 'Black pepper'),
(77, 'Lemon juice'),
(78, 'Italian sausage'),
(79, 'Beef'),
(80, 'Chopped onion'),
(81, 'Tomato sauce'),
(82, 'Whole wheat flour'),
(83, 'Wheat germ'),
(84, 'Baking powder'),
(85, ''),
(86, 'Butter,unsalted'),
(87, 'Buttermilk'),
(88, 'White vinegar'),
(89, 'Butter,melted'),
(90, 'Lemons,juiced'),
(91, 'Sugar'),
(92, 'Strawberries'),
(93, 'Ground cinnamon'),
(94, 'Vegetable oil'),
(95, 'Quinoa');

-- --------------------------------------------------------

--
-- Table structure for table `quantity_table`
--

CREATE TABLE `quantity_table` (
  `recipe_id` int(10) NOT NULL,
  `ingredient_id` int(10) NOT NULL,
  `amount` float NOT NULL,
  `unit_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quantity_table`
--

INSERT INTO `quantity_table` (`recipe_id`, `ingredient_id`, `amount`, `unit_id`) VALUES
(2, 59, 1, 1),
(150, 20, 1, 4),
(150, 21, 1, 4),
(1, 58, 1, 4),
(150, 22, 2, 3),
(150, 23, 1, 3),
(150, 24, 2, 3),
(150, 25, 3, 4),
(1, 57, 1, 21),
(150, 27, 2, 4),
(150, 2, 1, 4),
(9, 1, 1, 1),
(183, 94, 1, 3),
(1, 56, 1, 3),
(9, 3, 2.5, 2),
(1, 55, 2, 3),
(9, 5, 1, 4),
(9, 6, 1, 4),
(9, 22, 1, 3),
(9, 7, 2, 4),
(9, 29, 1, 1),
(1, 54, 1, 2),
(150, 31, 1, 4),
(1, 53, 2, 19),
(1, 52, 1, 4),
(158, 35, 1, 2),
(1, 26, 2, 3),
(1, 51, 2.5, 11),
(182, 50, 1, 20),
(158, 36, 2, 11),
(158, 34, 1, 10),
(158, 33, 2, 9),
(182, 49, 1, 1),
(182, 48, 1, 11),
(182, 47, 1, 11),
(182, 46, 3, 19),
(182, 45, 1, 18),
(158, 38, 1, 1),
(158, 39, 1, 3),
(158, 40, 3, 17),
(158, 41, 2, 3),
(158, 42, 2, 3),
(158, 26, 0, 7),
(2, 60, 0, 4),
(2, 33, 1, 10),
(2, 61, 1, 2),
(2, 62, 1, 3),
(2, 63, 2, 1),
(2, 40, 1, 22),
(2, 4, 4, 1),
(2, 64, 4, 19),
(3, 4, 6, 23),
(3, 65, 1, 4),
(3, 66, 1, 3),
(3, 67, 1, 3),
(3, 26, 0, 3),
(3, 68, 12, 24),
(161, 5, 1, 4),
(161, 69, 1, 4),
(161, 70, 0, 4),
(161, 71, 5, 4),
(161, 2, 2, 2),
(161, 72, 1, 1),
(12, 73, 4, 11),
(12, 74, 1, 2),
(12, 75, 1, 2),
(12, 76, 1, 3),
(12, 77, 1, 4),
(11, 78, 1, 11),
(11, 79, 1, 11),
(11, 80, 1, 4),
(11, 40, 4, 17),
(11, 81, 2, 21),
(11, 57, 1, 21),
(4, 82, 1, 4),
(4, 71, 2, 19),
(4, 83, 1, 4),
(4, 84, 2, 3),
(4, 23, 1, 3),
(4, 21, 2, 2),
(10, 5, 2, 4),
(4, 26, 1, 3),
(4, 86, 5, 2),
(4, 87, 2, 4),
(4, 4, 2, 1),
(10, 88, 2, 2),
(10, 71, 1, 4),
(10, 2, 2, 2),
(10, 84, 1, 3),
(10, 23, 1, 3),
(10, 26, 1, 3),
(10, 89, 2, 2),
(8, 90, 4, 1),
(8, 69, 1, 26),
(8, 91, 1, 4),
(5, 92, 2, 19),
(5, 71, 3, 19),
(5, 2, 2, 19),
(5, 93, 1, 2),
(5, 26, 1, 3),
(5, 23, 1, 3),
(5, 94, 1, 4),
(183, 38, 1, 1),
(183, 40, 3, 17),
(183, 95, 3.5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_table`
--

CREATE TABLE `recipe_table` (
  `sno` int(5) NOT NULL,
  `sub_categorie_id` int(5) NOT NULL,
  `recipe` varchar(50) NOT NULL,
  `difficulty_level` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `content` mediumtext NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe_table`
--

INSERT INTO `recipe_table` (`sno`, `sub_categorie_id`, `recipe`, `difficulty_level`, `date`, `content`, `photo`) VALUES
(1, 21, 'Chicken Curry', 'Medium', '2020-04-19 17:36:42', 'Heat olive oil in a large skillet with a lid over medium heat until hot but not smoking. Drop in mustard seeds and cumin seeds, cover skillet, and wait until the mustard seeds have all popped. Add onion, ginger, and curry leaves. Saute over medium heat for about 5 minutes. Add tomatoes, coriander, red chili powder, turmeric, and cinnamon stick; stir well.\r\nAdd chicken and enough water to barely cover the chicken. Bring to a boil, cover, and simmer over medium or medium-low heat for about 45 minutes, checking every 10 minutes to make sure there is enough moisture in the skillet to keep the chicken from burning.\r\n Add more water if necessary. When the chicken is tender, season with salt and serve.', 'photo_5ebe6cc1ae664.jpg'),
(2, 20, 'Bibimbap(korean rice)', 'Medium', '2020-04-19 18:10:23', 'Stir cucumber pieces with 1/4 cup gochujang paste in a bowl; set aside.\r\nBring about 2 cups of water to a boil in a large nonstick skillet and stir in spinach; cook until spinach is bright green and wilted, 2 to 3 minutes. Drain spinach and squeeze out as much moisture as possible; set spinach aside in a bowl and stir soy sauce into spinach.\r\nHeat 1 teaspoon olive oil in large nonstick skillet and cook and stir carrots until softened, about 3 minutes; stir in garlic and cook just until fragrant, about 1 more minute. Stir in cucumber pieces with gochujang paste; sprinkle with red pepper flakes, and set the mixture aside in a bowl.\r\nBrown beef in a clean nonstick skillet over medium heat, about 5 minutes per side, and set aside. In a separate nonstick skillet, heat 1 more teaspoon olive oil over medium-low heat and fry the eggs just on one side until yolks are runny but whites are firm, 2 to 4 minutes each.To assemble the dish, divide cooked rice into 4 large serving bowls; top with spinach mixture, a few pieces of beef, and cucumber mixture. Place 1 egg atop each serving. Drizzle each bowl with 1 teaspoon of sesame oil, a sprinkle of sesame seeds, and a small amount of gochujang paste if desired.', 'photo_5ebda7545c14f.jpg'),
(3, 1, 'Deviled Eggs', 'Easy', '2020-04-19 18:15:17', 'Place eggs in a saucepan and cover with water. Bring to a boil, remove from heat, and let eggs stand in hot water for 15 minutes. Remove eggs from hot water, cool under cold running water, and peel.\r\nSlice eggs in half lengthwise and set the whites aside. Place yolks in a mini blender or food processor; pulse several times until finely chopped. Add yogurt, mustard, vinegar, Worcestershire sauce, and sugar and blend until smooth.\r\nTransfer yolk mixture to pastry bag fitted with a large star tip and pipe filling into the egg whites (or stuff filling into egg whites with a spoon). Sprinkle with everything bagel seasoning and garnish with sliced scallions. Chill in the refrigerator until ready serve.', 'photo_5ebda7a05878d.jpg'),
(4, 2, 'Whole wheat pancakes', 'Easy', '2020-04-19 18:18:35', 'Preheat oven to 350 degrees F (175 degrees C).\r\nSpread wheat germ over a baking sheet.\r\nBake in the preheated oven until toasted, about 5 minutes. Cool slightly, then transfer wheat germ to a large bowl.\r\nStir flour, baking soda, and salt into wheat germ. Beat buttermilk, eggs, and oil in another bowl until smooth; pour egg mixture into flour mixture and stir until batter is just blended.\r\nHeat griddle over medium-high heat and coat with cooking spray. Pour 1/4 cup portions of batter onto the griddle and cook until bubbles form and the edges are dry, about 2 minutes. Flip and cook until browned on the other side, about 3 minutes more. Repeat with remaining batter.', 'photo_5ebda877df455.jpg'),
(5, 6, 'Strawberry Bread', 'Medium', '2020-04-19 18:22:00', 'Preheat oven to 350 degrees F (175 degrees C). Butter and flour two 9 x 5-inch loaf pans.\r\nSlice strawberries and place in medium-sized bowl. Sprinkle lightly with sugar, and set aside while preparing batter.\r\nCombine flour, sugar, cinnamon, salt and baking soda in large bowl; mix well. Blend oil and eggs into strawberries. Add strawberry mixture to flour mixture, blending until dry ingredients are just moistened. Stir in pecans. Divide batter into pans.\r\nBake in preheated oven until a tester inserted in the center comes out clean, 45 to 50 minutes (test each loaf separately). Let cool in pans on wire rack for 10 minutes. Turn loaves out of pans, and allow to cool before slicing.', 'photo_5ebda9c6a0ef3.jpg'),
(8, 5, 'Lemonade', 'Easy', '2020-04-29 11:49:19', 'In a 2 quart pitcher, combine the lemon juice, water and sugar. Stir until sugar is dissolved. Chill in refrigerator.', 'photo_5ebdac749c41e.jpg'),
(9, 3, 'Vanilla Bavarian Cream Pie', 'Easy', '2020-04-29 20:32:50', 'Step 1\r\nSoften gelatin in cold water. Scald the milk.\r\n\r\n Step 2\r\nIn a mixing bowl, mix together sugar and cornstarch. Add eggs and mix thoroughly. Add milk and softened gelatin, stirring constantly.\r\n\r\n Step 3\r\nCook custard in double boiler over hot water until it thickens and coats spoon. Remove from heat. Add ice cream while custard is hot. Cool thoroughly.\r\n\r\n Step 4\r\nAdd vanilla. Whip the cream, and fold 1 1/2 cups into cooled custard. Pour filling into pie shell, and refrigerate until set. Garnish with remaining whipped cream.', 'photo_5ebdae1812e71.jpg'),
(10, 2, 'Fluffy Pancakes', 'Easy', '2020-04-30 07:53:16', 'Combine milk with vinegar in a medium bowl and set aside for 5 minutes to \"sour\".\r\nCombine flour, sugar, baking powder, baking soda, and salt in a large mixing bowl. Whisk egg and butter into \"soured\" milk. Pour the flour mixture into the wet ingredients and whisk until lumps are gone.\r\nHeat a large skillet over medium heat, and coat with cooking spray. Pour 1/4 cupfuls of batter onto the skillet, and cook until bubbles appear on the surface. Flip with a spatula, and cook until browned on the other side.\r\n', 'photo_5ec93665b54b8.jpg'),
(11, 4, 'Lasagna', 'Hard', '2020-04-30 08:02:08', 'In a Dutch oven, cook sausage, ground beef, onion, and garlic over medium heat until well browned. Stir in crushed tomatoes, tomato paste, tomato sauce, and water. Season with sugar, basil, fennel seeds, Italian seasoning, 1 teaspoon salt, pepper, and 2 tablespoons parsley. Simmer, covered, for about 1 1/2 hours, stirring occasionally.\r\nBring a large pot of lightly salted water to a boil. Cook lasagna noodles in boiling water for 8 to 10 minutes. Drain noodles, and rinse with cold water. In a mixing bowl, combine ricotta cheese with egg, remaining parsley, and 1/2 teaspoon salt.\r\nPreheat oven to 375 degrees F (190 degrees C).\r\nTo assemble, spread 1 1/2 cups of meat sauce in the bottom of a 9x13 inch baking dish. Arrange 6 noodles lengthwise over meat sauce. Spread with one half of the ricotta cheese mixture. Top with a third of mozzarella cheese slices. Spoon 1 1/2 cups meat sauce over mozzarella, and sprinkle with 1/4 cup Parmesan cheese. Repeat layers, and top with remaining mozzarella and Parmesan cheese. Cover with foil: to prevent sticking, either spray foil with cooking spray, or make sure the foil does not touch the cheese.\r\nBake in preheated oven for 25 minutes. Remove foil, and bake an additional 25 minutes. Cool for 15 minutes before serving.\r\n ', 'photo_5ec943d8cceb6.jpg'),
(12, 4, 'Greek Lemon Chicken and Potatoes', 'Medium', '2020-04-30 08:07:32', 'Preheat oven to 425 degrees F (220 degrees C). Lightly oil a large roasting pan.\r\nPlace chicken pieces in large bowl. Season with salt, oregano, pepper, rosemary, and cayenne pepper. Add fresh lemon juice, olive oil, and garlic. Place potatoes in bowl with the chicken; stir together until chicken and potatoes are evenly coated with marinade.\r\nTransfer chicken pieces, skin side up, to prepared roasting pan, reserving marinade. Distribute potato pieces among chicken thighs. Drizzle with 2/3 cup chicken broth. Spoon remainder of marinade over chicken and potatoes.\r\nPlace in preheated oven. Bake in the preheated oven for 20 minutes. Toss chicken and potatoes, keeping chicken skin side up; continue baking until chicken is browned and cooked through, about 25 minutes more. An instant-read thermometer inserted near the bone should read 165 degrees F (74 degrees C). Transfer chicken to serving platter and keep warm.\r\nSet oven to broil or highest heat setting. Toss potatoes once again in pan juices. Place pan under broiler and broil until potatoes are caramelized, about 3 minutes. Transfer potatoes to serving platter with chicken.\r\nPlace roasting pan on stove over medium heat. Add a splash of broth and stir up browned bits from the bottom of the pan. Strain; spoon juices over chicken and potatoes. Top with chopped oregano.\r\n\r\n', 'photo_5ebdaebc1f3e2.jpg'),
(161, 6, 'Burger or Hot Dog Buns', 'Easy', '2020-05-24 14:10:34', 'Step 1\r\nIn a small saucepan, heat milk, water and butter until very warm, 120 degrees F (50 degrees C).\r\n\r\n Step 2\r\nIn a large bowl, mix together 1 3/4 cup flour, yeast, sugar and salt. Mix milk mixture into flour mixture, and then mix in egg. Stir in the remaining flour, 1/2 cup at a time, beating well after each addition. When the dough has pulled together, turn it out onto a lightly floured surface, and knead until smooth and elastic, about 8 minutes.\r\n\r\n Step 3\r\nDivide dough into 12 equal pieces. Shape into smooth balls, and place on a greased baking sheet. Flatten slightly. Cover, and let rise for 30 to 35 minutes.\r\n\r\n Step 4\r\nBake at 400 degrees F (200 degrees C) for 10 to 12 minutes, or until golden brown.\r\n\r\n Step 5\r\nFor Hot Dog Buns: Shape each piece into a 6x4 inch rectangle. Starting with the longer side, roll up tightly, and pinch edges and ends to seal. Let rise about 20 to 25 minutes. Bake as above. These buns are pretty big. I usually make 16 instead of 12.', 'photo_5eca805ad3fa2.jpg'),
(158, 21, 'Authentic Saag Paneer', 'Medium', '2020-05-23 13:35:01', 'step 1\r\nBring a large saucepan of water to a boil. Cook spinach and fenugreek in the boiling water until wilted, about 3 minutes. Drain well and transfer to a food processor. Puree until finely chopped, about 5 pulses.\r\n\r\nstep 2\r\nHeat 1 tablespoon canola oil in a large skillet over medium heat. Fry paneer cubes, stirring constantly, until browned on all sides, about 5 minutes. Set aside.\r\n\r\nstep3\r\nHeat 2 tablespoons canola oil in the skillet and fry the cumin seeds until lightly toasted and aromatic, about 3 minutes. Add onion; cook and stir until onion begins to soften, 4 to 5 minutes. Stir in ginger, garlic, tomato, garam masala, turmeric, and cayenne pepper; cook and stir until tomatoes break down and onions are translucent, about 10 minutes.\r\n\r\nstep 4\r\nStir in spinach and fenugreek, cream, paneer cubes, and salt to taste. Cover and cook for 15 minutes, stirring occasionally.', 'photo_5ec92685d2af6.jpg'),
(150, 3, 'Chocolate Chip Cookies', 'medium', '2020-05-21 14:10:02', 'Step 1\r\nPreheat oven to 350 degrees F (175 degrees C).\r\n\r\n Step 2\r\nCream together the butter, white sugar, and brown sugar until smooth. Beat in the eggs one at a time, then stir in the vanilla. Dissolve baking soda in hot water. Add to batter along with salt. Stir in flour, chocolate chips, and nuts. Drop by large spoonfuls onto ungreased pans.\r\n\r\n Step 3\r\nBake for about 10 minutes in the preheated oven, or until edges are nicely browned.', 'photo_5ec68bba48df7.jpg'),
(183, 17, 'Quinoa and Black Beans', 'Easy', '2020-05-28 15:01:35', 'Step 1\r\nHeat oil in a saucepan over medium heat; cook and stir onion and garlic until lightly browned, about 10 minutes.\r\n\r\n Step 2\r\nMix quinoa into onion mixture and cover with vegetable broth; season with cumin, cayenne pepper, salt, and pepper. Bring the mixture to a boil. Cover, reduce heat, and simmer until quinoa is tender and broth is absorbed, about 20 minutes.\r\n\r\n Step 3\r\nStir frozen corn into the saucepan, and continue to simmer until heated through, about 5 minutes; mix in the black beans and cilantro.', 'photo_5ecfd24f5eb1e.jpg'),
(182, 8, 'Pasta salad', 'Easy', '2020-05-25 09:07:32', 'step1:\r\nBring a large pot of lightly salted water to a boil. Add pasta, and cook for 8 to 10 minutes or until al dente. Drain, and rinse with cold water.\r\n\r\nstep2:\r\nIn a large bowl, combine pasta with tomatoes, cheese, salami, pepperoni, green pepper, olives, and pimentos. Pour in salad dressing, and toss to coat.', 'photo_5ecb8ad4a4074.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categorie_table`
--

CREATE TABLE `sub_categorie_table` (
  `sno` int(5) NOT NULL,
  `categorie_id` int(5) NOT NULL,
  `sub_categorie` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_categorie_table`
--

INSERT INTO `sub_categorie_table` (`sno`, `categorie_id`, `sub_categorie`) VALUES
(1, 1, 'Snacks'),
(2, 1, 'Breakfast and Brunch'),
(3, 1, 'Desserts'),
(4, 1, 'Dinner'),
(5, 1, 'Drinks'),
(6, 2, 'Breads'),
(7, 2, 'Cakes'),
(8, 2, 'Salad'),
(9, 2, 'Soups'),
(10, 3, 'Beef'),
(11, 3, 'Chicken'),
(12, 3, 'Pasta'),
(13, 3, 'Pork'),
(14, 4, 'BBQ and Grilling'),
(15, 4, 'Quick and Easy'),
(16, 4, 'Vegetarian'),
(17, 5, 'Gluten Free'),
(18, 5, 'Low Calories'),
(19, 5, 'Healthy'),
(20, 6, 'Asian'),
(21, 6, 'Indian'),
(22, 6, 'Italian'),
(23, 6, 'Mexican'),
(24, 7, 'Mother\'s Day'),
(25, 8, 'Quarantine Cooking');

-- --------------------------------------------------------

--
-- Table structure for table `unit_table`
--

CREATE TABLE `unit_table` (
  `term` varchar(50) NOT NULL,
  `nr` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit_table`
--

INSERT INTO `unit_table` (`term`, `nr`) VALUES
('Piece', 1),
('Tbsp', 2),
('Tsp', 3),
('Cup', 4),
('Gramm', 5),
('Pinch', 6),
('To taste', 7),
('Kilo gramms', 8),
('Bunches', 9),
('Bunch', 10),
('Pound', 11),
('Cloves', 17),
('Package', 18),
('Cups', 19),
('Bottle', 20),
('Can', 21),
('Clove', 22),
('No', 23),
('Springs', 24),
('', 25),
('Quart', 26);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `userno` int(5) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'user',
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `user_password` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`userno`, `user_type`, `first_name`, `last_name`, `user_id`, `user_password`) VALUES
(1, 'admin', 'Anamika', 'Kumar', 'admin', '$2y$10$L2SrVQ8Ll5lO.OvyBHBzYOXuzXwGoIBwrzTHuFwKzCUNAVNk47uXe'),
(15, 'user', 'Brita', 'Fisher', 'brita@rp', '$2y$10$L2SrVQ8Ll5lO.OvyBHBzYOXuzXwGoIBwrzTHuFwKzCUNAVNk47uXe'),
(20, 'user', 'Fröhlich', 'Fritz', 'ff@rp', 'plan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie_table`
--
ALTER TABLE `categorie_table`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `ingredient_table`
--
ALTER TABLE `ingredient_table`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `ingredient` (`ingredient`);

--
-- Indexes for table `recipe_table`
--
ALTER TABLE `recipe_table`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `sub_categorie_table`
--
ALTER TABLE `sub_categorie_table`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `unit_table`
--
ALTER TABLE `unit_table`
  ADD PRIMARY KEY (`nr`),
  ADD UNIQUE KEY `term` (`term`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`userno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie_table`
--
ALTER TABLE `categorie_table`
  MODIFY `sno` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ingredient_table`
--
ALTER TABLE `ingredient_table`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `recipe_table`
--
ALTER TABLE `recipe_table`
  MODIFY `sno` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `sub_categorie_table`
--
ALTER TABLE `sub_categorie_table`
  MODIFY `sno` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `unit_table`
--
ALTER TABLE `unit_table`
  MODIFY `nr` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `userno` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
