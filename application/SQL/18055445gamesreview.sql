/*
 Navicat Premium Data Transfer

 Source Server         : Framework database
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : 18055445gamesreview

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 07/03/2020 16:38:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `comment_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`comment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES (5, 1, 6, 'post');
INSERT INTO `comments` VALUES (6, 1, 2, 'post');
INSERT INTO `comments` VALUES (7, 1, 3, 'new comment');
INSERT INTO `comments` VALUES (8, 1, 6, 'i love this movie');
INSERT INTO `comments` VALUES (9, 2, 2, 'I hate the comment above');
INSERT INTO `comments` VALUES (10, 2, 9, 'i love overwatch');
INSERT INTO `comments` VALUES (11, 2, 11, 'This game is real scary');
INSERT INTO `comments` VALUES (12, 1, 2, 'i love this film');
INSERT INTO `comments` VALUES (13, 1, 2, 'comment');
INSERT INTO `comments` VALUES (14, 1, 2, 'comment2');
INSERT INTO `comments` VALUES (15, 1, 2, 'comment3');
INSERT INTO `comments` VALUES (16, 1, 2, 'comment3');
INSERT INTO `comments` VALUES (17, 1, 2, 'comment3');
INSERT INTO `comments` VALUES (18, 1, 2, 'comment3');
INSERT INTO `comments` VALUES (19, 1, 2, 'comment3');
INSERT INTO `comments` VALUES (20, 1, 2, 'comment3');
INSERT INTO `comments` VALUES (21, 1, 2, 'comment3');
INSERT INTO `comments` VALUES (22, 1, 2, 'comment3');
INSERT INTO `comments` VALUES (23, 1, 3, 'hello');
INSERT INTO `comments` VALUES (24, 1, 3, 'hello');
INSERT INTO `comments` VALUES (25, 6, 15, 'password');
INSERT INTO `comments` VALUES (26, 1, 4, 'hello');
INSERT INTO `comments` VALUES (27, 10, 2, 'hello');
INSERT INTO `comments` VALUES (28, 10, 3, 'cool profile image');

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews`  (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `review_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `review_title` varchar(52) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `review_subtitle` varchar(86) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `review_author` varchar(68) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `review_timestamp` datetime(0) NULL DEFAULT NULL,
  `review_text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `review_rating` float NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`review_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reviews
-- ----------------------------
INSERT INTO `reviews` VALUES (2, 'https://gamespot1.cbsistatic.com/uploads/scale_medium/1593/15930215/3593383-screen%20shot%202019-10-17%20at%209.26.54%20am.png', 'Zombie Army 4: Dead War', 'Killing zombie Nazis might be the oldest cliche, but it\'s still pretty fun.\r\n', 'Theo Clapperton', '2020-02-17 11:50:55', 'Zombie Army 4: Dead War feels largely familiar amid the horde of Left 4 Dead-style co-op shooters, but it isn’t without its clever mechanical touches and spins on the oldest of video game cliches: killing Nazi zombies. Between its varied and campy story campaign and an amusing horde mode, there are plenty of opportunities for harrowing teamwork and gory, disgusting X-ray kills. The weapon progression system doesn’t give a lot of reasons to branch out, though, so the pull of its replayability isn’t as strong as it could be.', 7, 'zombie-army-4-dead-war');
INSERT INTO `reviews` VALUES (3, 'https://assets1.ignimgs.com/2020/01/24/krz-doggo-blogroll-1579902400782.jpg', 'Kentucky Route Zero', 'A beautiful poetry generator in the body of a point-and-click adventure game.', 'Theo Clapperton', '2020-02-17 18:12:04', 'Kentucky Route Zero is a beautiful poetry generator in the body of a point-and-click adventure game. It’s frequently stunning to look at and beautifully written throughout. The way it tells its magical modern-day story can sometimes be hamfisted, stuttering like a dying old delivery van at times, but the creativity with which it delivers its dialogue and the freedom you have to shape it toward your interests makes this an ethereal road trip worth taking.', 8, 'kentucky-route-zero');
INSERT INTO `reviews` VALUES (4, 'https://images.nintendolife.com/719a4fbfeba11/monster-energy-supercross---the-official-videogame-3-cover.cover_large.jpg', 'Monster Energy Supercross -- The Official Videogame ', 'Braaap braaap.', 'Theo Clapperton', '2020-02-12 18:12:04', 'Deceptively technical and tricky to master, Monster Energy Supercross 3 is a modest but solid two-wheeled racer with good atmosphere and a great sense of speed. However, the fact the previous two are largely just as good makes it harder to get the heart rate up again, whether exceeding the maximum safe daily dose of Monster or not.', 8, 'monster-energy-supercross');
INSERT INTO `reviews` VALUES (5, 'https://www.roadtovr.com/wp-content/uploads/2020/01/1.-TWD_SNS_Keyart_GameplayReveal_2019.jpg', 'The Walking Dead: Saints and Sinners', 'A rotten good time.\r\n', 'Theo Clapperton', '2020-02-19 01:01:49', 'The Walking Dead: Saints & Sinners is a noteworthy step forward for VR gaming, proving that a Deus Ex-like Action-RPG can feel right at home in a headset. Every one of its many interwoven systems clearly has a level of thought and care behind it, swirling survival horror and roleplaying staples together with nuance. Even though character customization can feel limited and the story is a bit short, The Walking Dead: Saints & Sinners is a fantastic example of what VR can be.', 9, 'walking-dead-saints-and-sinners');
INSERT INTO `reviews` VALUES (6, 'https://www.theterminatorfans.com/wp-content/uploads/2019/09/Terminator-Resistance-Game.jpg', 'Terminator: Resistance', 'Resistance is futile.\r\n', 'Theo Clapperton', '2020-02-18 19:46:12', 'The most disappointing thing about Terminator: Resistance isn’t merely that it’s bad, it’s that it’s bad and yet it’s probably still the best Terminator game I’ve ever played. If you’re in the mood to mindlessly mow down waves of authentically modelled T-800s to the rhythm of Brad Fiedel’s iconic theme music, then Terminator: Resistance may well be adequate enough. But while there might already be a truly great Terminator game in some alternate universe’s timeline, in this one the wait continues.', 4, 'terminator-resistance');
INSERT INTO `reviews` VALUES (7, 'https://m.media-amazon.com/images/M/MV5BMjhhNzNmNGItZGVjYi00N2E5LTliNTktYTMyMGFkZjYzNGEwXkEyXkFqcGdeQXVyMTQ4MjM0MjA@._V1_.jpg', 'Star Wars Jedi: Fallen Order', 'Prepare to Maclunky.\r\n', 'Theo Clapperton', '2020-02-06 19:47:38', 'It’s been ages since we got a great single-player Star Wars action game, but Jedi: Fallen Order makes up for a lot of lost time. A strong cast sells a dark story while keeping things fun and loyal to Star Wars lore, and fast, challenging combat mixes with energetic platforming, decent puzzles, and diverse locations to explore for an all-around amazing game.', 9, 'star-wars-jedi-fallen-order');
INSERT INTO `reviews` VALUES (8, 'https://m.media-amazon.com/images/M/MV5BZmYzMTU4YzMtYTIzNy00MTBhLTg2MTUtMDc3MmRjZmNlZDBkL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyMjAzNjQ1Mjc@._V1_.jpg', 'Death Stranding', 'Damaged goods.\r\n', 'Theobert Clunkerton', '2020-02-22 18:43:33', 'Certain landmark games in recent years, like The Legend of Zelda: Breath of the Wild and Red Dead Redemption 2, have managed to successfully tread the line between the rigidity of realism and the exhilaration of pure escapism. But much like its stumbling protagonist, Death Stranding just can’t consistently get the balance right despite possessing equally lofty ambitions and countless inventive ideas. There is a fascinating, fleshed-out world of supernatural science fiction to enjoy across its sprawling and spectacular map, so it’s a real shame that it’s all been saddled on a gameplay backbone that struggles to adequately support its weight over the full course of the journey. It’s fitting that Kojima Productions’ latest is so preoccupied with social media inspired praise, because in some ways I did ‘Like’ Death Stranding. I just didn’t ever love it.', 6.8, 'death-stranding');
INSERT INTO `reviews` VALUES (9, 'https://s1.gaming-cdn.com/images/products/2208/orig/overwatch-cover.jpg', 'Overwatch Switch', 'Lost in transcendence.\r\n', 'Clanker Theodorth', '2020-02-03 15:03:06', 'Overwatch on Switch is a less-than optimal way to play one of the most satisfying online games ever made, but it’s still one of the best around. Technical issues are plenty, and in most cases are noticeable, but never truly ruin the fun or makes it truly unplayable. If you already play Overwatch consistently on another console then there are very few reasons to own it on Switch – and in fact it may be extremely frustrating to go back and forth between them – but if it\'s your introduction the beautifully crafted world of Overwatch then it still promises a whole lot of fun.', 7, 'overwatch-switch');
INSERT INTO `reviews` VALUES (10, 'https://www.psu.com/wp/wp-content/uploads/2019/05/Ghostbusters-1024x538.jpg', 'Ghostbusters: The Video Game Remastered', 'The flowers are still standing.\r\n', 'Banker Moneyworth', '2020-01-15 20:03:07', 'Make no mistake, Ghostbusters: The Video Game is a personal favourite purely for its loving attention to detail and will always rank amongst gaming’s most faithful and memorable movie adaptations – more than worthy of being mentioned in the same breath as The Warriors, Alien: Isolation, and The Chronicles of Riddick: Escape from Butcher Bay in that regard. But this marginally prettier and inconsistent remaster doesn’t really make for a profoundly different or improved experience over the 2009 original, and there was a lot of room for improvements that could’ve made it more enjoyable to play through and appreciate all of that fan service.', 6, 'ghostbusters-the-video-game-remastered');
INSERT INTO `reviews` VALUES (11, 'https://www.gamepur.com/wp-content/uploads/2019/12/GTFO-850x560.png', 'GTFO Early Access', 'A screamin\' good time.\r\n', 'Zingly Clummper', '2020-01-16 22:20:21', 'While a horde of zombie-like sleepers rushing mindlessly towards four men with guns may look familiar, GTFO’s early access version is anything but more of the same for the co-op shooter genre. Its stealth action is well thought-out and presents a lot of excellent opportunities for fun coordination with your squad. Its six enjoyably terrifying expeditions are creative and surprising enough to overlook the otherwise-plain lack of variety in its environment, enemies, and objectives. And while the symptoms of its early access state may be keenly felt where breadth of content is concerned there is no shortage of depth in GTFO. It’s clever, creepy, and already surprisingly polished, and I can’t wait to see where it goes from here.', 8, 'get-the-fuck-out');
INSERT INTO `reviews` VALUES (12, 'https://media.contentapi.ea.com/content/dam/walrus/en-us/migrated-images/2017/04/reveal-swbf2-fb-meta-image-alt.png.adapt.crop191x100.1200w.png', 'Star Wars Battlefront 2 (2019)', 'The Multiplayer Strikes Back.\r\n', 'Palpatine', '2020-02-20 22:21:42', 'Whether you’re brand new to the battlefield or picking your blaster back up after a long hiatus, Star Wars Battlefront 2 is a redemption story worthy of the Skywalker saga. It’s a big, broad, beautiful shooter that nails the Star Wars atmosphere almost everywhere. The campaign is still a bit of a snore, and occasionally long queue times in matchmaking and a handful of forgettable game modes give the multiplayer a couple of caveats, but highlights like Capital Supremacy and Galactic Assault make it stand out and the progression system is fair and rewarding. Overall, it’s a great package now that serves as one of the best and most thrilling ways to have an authentic Star Wars gaming experience.', 8.8, 'star-wars-battlefront-2');
INSERT INTO `reviews` VALUES (13, 'https://mk0uploadvrcom4bcwhj.kinstacdn.com/wp-content/uploads/2019/12/Boneworks-Review.jpg', 'Boneworks', 'There’s some meat on these bones.\r\n', 'Bonmartins Sho', '2020-02-15 22:22:54', 'There’s some meat on these bones. Boneworks offers a fleshed-out variety of interesting and entertaining physics-powered things to do across its full-length campaign, Arena, and Sandbox modes, and its VR action works best when you get into character and let yourself pantomime each swing, grab, and throw with intention. There’s plenty to be desired in terms of story, level design, and even the physics simulations that it so heavily leans on, but Boneworks is awesomely interactive, engaging, and has tons of replayability potential.', 7.9, 'boneworks-review');
INSERT INTO `reviews` VALUES (14, 'https://store-images.s-microsoft.com/image/apps.36764.13817186670444302.148c432a-9fce-4c7d-bf13-8a2bd3a527b3.2a7b94f3-ed66-45b6-aaf3-337c18d442cd?mode=scale&q=90&h=720&w=1280&background=%23FFFFFF', 'Halo: The Master Chief Collection (2019)', 'Redemption at last.\r\n', 'Master Chef', '2020-02-04 22:23:52', 'Overcoming its deserved reputation after a notorious launch, today the Halo Master Chief Collection is a polished, super-deluxe package of content that successfully links three generations of amazing Halo games together in a way that feels like it was made by and for people who care deeply about this legendary shooter franchise. The enhancements to the campaigns make it a joy to replay Master Chief’s story (and two other UNSC tales as well), but it’s the now-smooth multiplayer that’s worth coming back to over and over again. It’s not just a collection of some of the best first-person shooters ever made, it’s a great redemption story, too.', 9.5, 'halo-the-master-chef-collection');
INSERT INTO `reviews` VALUES (15, 'https://i.ytimg.com/vi/9LL2AtHo1gk/maxresdefault.jpg', 'Untitled Goose Game', 'Worth a gander.\r\n', 'The Goose', '2020-01-02 22:24:55', 'Video games have made me a god, a superhero, and a savior of planets, but rarely have I felt more powerful than in Untitled Goose Game. Being given control of this feathered menace and armed with a checklist of hilarious, dickish tasks to complete is some of the most fun I’ve had with a game all year. My only real complaint is its fairly short runtime – I would have gladly spent hours longer goosing around. But even still, the charming design of its world and the clever challenges within it had me laughing, smiling, and eagerly honking the whole way through.', 8, 'untitled-goose-game');
INSERT INTO `reviews` VALUES (16, 'https://assets1.ignimgs.com/2019/08/14/no-mans-sky---beyond-version---button-1565744905061.jpg', 'No Man\'s Sky Beyond', 'Beyond is another major improvement, but the core issues remain.\r\n', 'Sean Murray', '2020-02-04 22:26:03', 'No Man’s Sky, now in its third year, has vastly improved in virtually every way, from the number and scale of things you can build alone or with friends to the story and progression. But in its heart still beats a vicious grind and painful monotony that’s difficult to swallow even with all the new content and quality-of-life improvements. Even so, it’s easy to be drawn to its addictive ecosystem of upgrades and exploration, and with functional multiplayer and VR capabilities in play there’s a lot to love about this space-faring exploration adventure.\r\n\r\n', 7.8, 'no-mans-sky');
INSERT INTO `reviews` VALUES (17, 'https://assets1.ignimgs.com/thumbs/userUploaded/2019/8/15/ancestorsfirstmins-br-1565899689982.jpg', 'Ancestors: The Humankind Odyssey', 'Oh my gosh, I was wrong - it was Earth all along.\r\n', 'Daniel Stumplen', '2020-02-11 22:26:55', 'Ancestors: The Humankind Odyssey\'s greatest challenge is working out – or simply Googling – how its basic survival, crafting, and combat mechanics work. Once you understand them they become mostly trivial, and the main appeal becomes appreciating the exploration of the huge and lush prehistoric African map. Evolving your tribe’s abilities feels artificially drawn out, but it’s hard not to develop a soft spot for these disposable apes because of their authentic animations.\r\n\r\n', 7, 'ancestors-the-humankind');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dark_mode` int(1) NULL DEFAULT NULL,
  `account_type` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'bonfirepass', 'pass', 'https://moonvillageassociation.org/wp-content/uploads/2018/06/default-profile-picture1.jpg', 0, 'admin');
INSERT INTO `users` VALUES (2, 'john', 'henry', 'https://moonvillageassociation.org/wp-content/uploads/2018/06/default-profile-picture1.jpg', 0, '');
INSERT INTO `users` VALUES (3, 'gg', 'gg', 'https://moonvillageassociation.org/wp-content/uploads/2018/06/default-profile-picture1.jpg', 0, '');
INSERT INTO `users` VALUES (4, 'ggg', 'ggg', 'https://moonvillageassociation.org/wp-content/uploads/2018/06/default-profile-picture1.jpg', 0, '');
INSERT INTO `users` VALUES (5, 'bonfire2', 'gg', 'https://moonvillageassociation.org/wp-content/uploads/2018/06/default-profile-picture1.jpg', 0, '');
INSERT INTO `users` VALUES (6, 'newAccount', 'pass', 'https://moonvillageassociation.org/wp-content/uploads/2018/06/default-profile-picture1.jpg', 0, '');
INSERT INTO `users` VALUES (10, 'bonfire', 'pass', 'https://store.playstation.com/store/api/chihiro/00_09_000/container/US/en/999/UP1675-CUSA11816_00-AV00000000000044/1580198354000/image?w=240&h=240&bg_color=000000&opacity=100&_version=00_09_000', 0, 'admin');

SET FOREIGN_KEY_CHECKS = 1;
