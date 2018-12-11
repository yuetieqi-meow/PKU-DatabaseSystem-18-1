/*
 Navicat Premium Data Transfer

 Source Server         : mySQL
 Source Server Type    : MySQL
 Source Server Version : 50723
 Source Host           : localhost:3306
 Source Schema         : booksql

 Target Server Type    : MySQL
 Target Server Version : 50723
 File Encoding         : 65001

 Date: 11/12/2018 13:58:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for author_detail
-- ----------------------------
DROP TABLE IF EXISTS `author_detail`;
CREATE TABLE `author_detail`  (
  `aID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `aname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `agender` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `abirth` date NULL DEFAULT NULL,
  `adeath` date NULL DEFAULT NULL,
  `anationality` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `aprofession` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  INDEX `aID`(`aID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of author_detail
-- ----------------------------
INSERT INTO `author_detail` VALUES ('1', '斯塔夫里阿诺斯', '男', '1913-04-01', '2004-03-01', '美国', '学者、大学教授');
INSERT INTO `author_detail` VALUES ('2', '陈慧琳', '女', '1973-09-01', NULL, '中国', '大学教授');
INSERT INTO `author_detail` VALUES ('3', '郑冬子', '女', '1977-09-01', NULL, '中国', '大学教授');
INSERT INTO `author_detail` VALUES ('4', 'David Flanagan', '男', '1987-09-01', NULL, '美国', '程序员、作家');
INSERT INTO `author_detail` VALUES ('5', 'William Stallings', '男', '1985-06-01', NULL, '美国', '教授、作家');
INSERT INTO `author_detail` VALUES ('6', '丘维声', '男', '1945-04-01', NULL, '中国', '高校教师');
INSERT INTO `author_detail` VALUES ('7', '贾雷德·戴蒙德', '男', '1937-09-01', NULL, '美国', '大学教授、作家');
INSERT INTO `author_detail` VALUES ('8', 'Randal E.Bryant', '男', '1925-10-01', NULL, '美国', '教授');
INSERT INTO `author_detail` VALUES ('9', 'David O\'Hallaron', '男', '1956-12-01', NULL, '美国', '教授');
INSERT INTO `author_detail` VALUES ('10', '勒庞', '男', NULL, '1931-12-01', '法国', '心理学家、社会学家');
INSERT INTO `author_detail` VALUES ('11', '吴军', '男', '1965-11-01', NULL, '美国', '社会学家');
INSERT INTO `author_detail` VALUES ('12', '詹姆斯·里卡兹', '男', '1964-02-01', NULL, '美国', '经济学家');
INSERT INTO `author_detail` VALUES ('13', '曼昆', '男', '1958-02-01', NULL, '美国', '大学教授、政客');
INSERT INTO `author_detail` VALUES ('14', '列夫托尔斯泰', '男', NULL, '1910-11-20', '俄国', '小说家、哲学家、政治思想家');
INSERT INTO `author_detail` VALUES ('15', '王后雄', '男', '1962-08-01', NULL, '中国', '教师');
INSERT INTO `author_detail` VALUES ('16', '何书元', '男', '1954-06-01', NULL, '中国', '教授');
INSERT INTO `author_detail` VALUES ('17', '王珊', '女', '1944-04-01', NULL, '中国', '教授');
INSERT INTO `author_detail` VALUES ('18', '萨师煊', '男', '1922-12-01', '2010-07-01', '中国', '教授');
INSERT INTO `author_detail` VALUES ('19', 'Stanley B. Lippman', '男', '1978-03-01', NULL, '美国', '计算机科学家');
INSERT INTO `author_detail` VALUES ('20', 'Josee Lajoie', '男', '1988-05-01', NULL, '美国', '计算机科学家');
INSERT INTO `author_detail` VALUES ('21', 'Barbara E. Moo', '男', '1962-04-01', NULL, '美国', '教授');
INSERT INTO `author_detail` VALUES ('22', '胡运权', '男', '1942-02-01', NULL, '中国', '教授');
INSERT INTO `author_detail` VALUES ('23', '莫泊桑', '男', NULL, NULL, '法国', '小说家、诗人');
INSERT INTO `author_detail` VALUES ('24', '石黑一雄', '男', '1954-11-01', NULL, '英国', '小说家、剧作家');
INSERT INTO `author_detail` VALUES ('25', '毛姆', '男', NULL, '1965-12-01', '英国', '小说家、剧作家');
INSERT INTO `author_detail` VALUES ('26', '圣-埃克絮佩里', '男', '1900-06-01', '1944-07-01', '法国', '作家、飞行员');
INSERT INTO `author_detail` VALUES ('27', '马克·李维', '男', '1961-10-01', NULL, '法国', '作家');
INSERT INTO `author_detail` VALUES ('28', '加西亚·马尔克斯', '男', '1927-03-01', '2014-04-01', '哥伦比亚', '文学家、记者、社会活动家');
INSERT INTO `author_detail` VALUES ('29', '耿素云', '女', '1947-02-01', NULL, '中国', '教授');

-- ----------------------------
-- Table structure for book_to_author
-- ----------------------------
DROP TABLE IF EXISTS `book_to_author`;
CREATE TABLE `book_to_author`  (
  `nID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nbook` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nauthor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nauthor_order` int(8) NULL DEFAULT NULL,
  INDEX `nbook`(`nbook`) USING BTREE,
  INDEX `nauthor`(`nauthor`) USING BTREE,
  CONSTRAINT `book_to_author_ibfk_1` FOREIGN KEY (`nbook`) REFERENCES `bookall` (`bISBN`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `book_to_author_ibfk_2` FOREIGN KEY (`nauthor`) REFERENCES `author_detail` (`aID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of book_to_author
-- ----------------------------
INSERT INTO `book_to_author` VALUES ('1', '1007699860687', '1', NULL);
INSERT INTO `book_to_author` VALUES ('2', '9787030362173', '2', NULL);
INSERT INTO `book_to_author` VALUES ('3', '9787040369397', '16', NULL);
INSERT INTO `book_to_author` VALUES ('4', '9787040406441', '17', NULL);
INSERT INTO `book_to_author` VALUES ('5', '9787040494792', NULL, NULL);
INSERT INTO `book_to_author` VALUES ('6', '9787111376613', '4', NULL);
INSERT INTO `book_to_author` VALUES ('8', '9787121139253', '5', NULL);
INSERT INTO `book_to_author` VALUES ('9', '9787121139512', '11', NULL);
INSERT INTO `book_to_author` VALUES ('10', '9787121155352', '19', NULL);
INSERT INTO `book_to_author` VALUES ('11', '9787121249884', '11', NULL);
INSERT INTO `book_to_author` VALUES ('12', '9787301053669', '29', NULL);
INSERT INTO `book_to_author` VALUES ('13', '9787301053973', '6', NULL);
INSERT INTO `book_to_author` VALUES ('14', '9787301109489', '1', NULL);
INSERT INTO `book_to_author` VALUES ('15', '9787301256909', '13', NULL);
INSERT INTO `book_to_author` VALUES ('16', '9787302299585', '22', NULL);
INSERT INTO `book_to_author` VALUES ('17', '9787508321752', '8', NULL);
INSERT INTO `book_to_author` VALUES ('18', '9787511359490', '23', NULL);
INSERT INTO `book_to_author` VALUES ('19', '9787514607901', '14', NULL);
INSERT INTO `book_to_author` VALUES ('20', '9787532772322', '7', NULL);
INSERT INTO `book_to_author` VALUES ('21', '9787532777471', '12', NULL);
INSERT INTO `book_to_author` VALUES ('22', '9787532777532', '24', NULL);
INSERT INTO `book_to_author` VALUES ('23', '9787533936020', '25', NULL);
INSERT INTO `book_to_author` VALUES ('24', '9787533947279', '26', NULL);
INSERT INTO `book_to_author` VALUES ('25', '9787540455958', '27', NULL);
INSERT INTO `book_to_author` VALUES ('26', '9787540485115', '23', NULL);
INSERT INTO `book_to_author` VALUES ('27', '9787544291170', '28', NULL);
INSERT INTO `book_to_author` VALUES ('28', '9787801093660', '10', NULL);
INSERT INTO `book_to_author` VALUES ('29', '9787807329329', '15', NULL);
INSERT INTO `book_to_author` VALUES ('30', '9787040406441', '18', NULL);
INSERT INTO `book_to_author` VALUES ('31', '9787121155352', '20', NULL);
INSERT INTO `book_to_author` VALUES ('32', '9787121155352', '21', NULL);

-- ----------------------------
-- Table structure for bookall
-- ----------------------------
DROP TABLE IF EXISTS `bookall`;
CREATE TABLE `bookall`  (
  `bISBN` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bauthor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bpress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bChineseIntroduction` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `bEnglishIntroduction` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `btype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  INDEX `bISBN`(`bISBN`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bookall
-- ----------------------------
INSERT INTO `bookall` VALUES ('1007699860687', '斯塔夫里阿诺斯', '全球通史', '北京大学出版社', '本套丛书由美国时代生活公司历经多年编著而成 ，全书汇集了世界各名牌大学史学专家的智慧和 劳动，包含300多万的文字和3000余幅精美图片及珍 贵照片，从史前文明到20世纪末，涉及人类300余 万年的历史，全面展示了全球悠久和灿烂的文明。', 'Global History', '历史');
INSERT INTO `bookall` VALUES ('9787030362173', '陈慧琳', '人文地理学', '科学出版社', '《人文地理学》以人为主体，人地关系为主线，以人类各种活动的产生、发展、变化与地理环境的相互关系构建教材体系，按人地关系主要领域和问题设置章节，应用案例分析融入理论阐述，建立了一个联系各人文地理要素或现象的解释体系，以探讨和总结人地关系的时空演变及其规律，是一部通论性的人文地理学教材。 《人文地理学》与目前中学使用的新教材密切结合，特别适合作为师范院校地理科学专业本科生教材，也可作为非地理专业的公共课程教材，还可供讲授中学地理课和环境教育课的教师以及经济、规划等专业人员参考。', 'Hunamity Geography', '其他');
INSERT INTO `bookall` VALUES ('9787040369397', '何书元', '概率论与数理统计', '高等教育出版社', '《概率论与数理统计》是普通高等教育“十一五”国家级规划教材,在2001年出版的《概率论与数理统计》(第三版)的基础上增订而成。本次修订新增的内容有:在数理统计中应用Excel,bootstrap方法,户值检验法,箱线图等;同时吸收了国内外优秀教材的优点对习题的类型和数量进行了调整和充实。《概率论与数理统计》主要内容包括概率论、数理统计、随机过程三部分,每章附有习题;同时涵盖了《全国硕士研究生入学统一考试数学考试大纲》的所有知识点。《概率论与数理统计》可作为高等学校工科、理科(非数学专业)各专业的教材和研究生入学考试的参考书,也可供工程技术人员、科技工作者参考。', 'Probability and statistics', '教材');
INSERT INTO `bookall` VALUES ('9787040406441', '王珊、萨师煊', '数据库系统概论', '高等教育出版社', '《数据库系统概论》是2006年高等教育出版社出版的图书，作者是王珊、萨师煊。王珊教授，是中国人民大学信息学院教授、博士生导师。中国计算机学会副理事长，中国计算机学会数据库专委会主任，教育部第五届科学技术委员会委员，中国科学技术协会第六届全国委员会委员等。', 'Introduction to database system', '教材');
INSERT INTO `bookall` VALUES ('9787040494792', '本书编写组', '马克思主义基本原理概论', '高等教育出版社', '马克思主义是由马克思和恩格斯创立的并为后继者不断发展的科学理论体系。', 'Brief introduction of the principles of Marxism', '教材');
INSERT INTO `bookall` VALUES ('9787111376613', 'David Flanagan', 'JavaScript权威指南', '机械工业出版社', '第5版针对Ajax和Web 2.0技术进行了全新的改版。和上一版相比，更新的内容较多，总体上接近整个篇幅的1/2，而这也正是本书姗姗来迟的原因之一。具体来说，第5版在以下部分有所更新：\n第一部分关于函数的一章（第8章）进行了扩展，特别强调了嵌套的函数和闭包。新增了自定义类、名字空间、脚本化Java、嵌入JavaScript等内容。第二部分最大的改变是增加了如下的大量新内容。包括第19章“cookie和客户端持久性”，第20章“脚本化HTTP”，第21章“JavaScipt和XML”，第22章“脚本化客户端图形”，第23章“脚本化Java Applets和Flash电影”。第三部分几乎没有太大变化。而第四部分增加了对DOM API的介绍。总体上分为“基础知识点介绍”和“参考指南”两部分，这是本书的一大特色。从之前版本受欢迎的程度来看，这种结构得到了读者相当大的认可，满足了他们学习基础知识和参考查阅难点的双重需要。而这也是其他同类图书所不及的。', 'JavaScript authoritative guide', '科技');
INSERT INTO `bookall` VALUES ('9787121139253', 'William Stallings', '数据与计算机通信', '电子工业出版社', '本书是著名计算机专业作家William Stallings的经典著作之一，内容涉及基本的数据通信原理、各种类型的计算机网络以及多种网络协议和应用。新增主题包括软件定义网络，无线传输技术复杂性分析，4G蜂窝网络，千兆位WiFi，DHCP，PIM，QoS结构框架和标准因特网邮件体系结构。此外，本书还包括参考文献和缩略语，并且每章都附有习题和建议，以便读者进一步阅读。', 'Data and computer communication', '科技');
INSERT INTO `bookall` VALUES ('9787121139512', '吴军', '浪潮之巅', '电子工业出版社', '近一百多年来，总有一些公司很幸运地、有意识或者无意识地站在技术革命的浪尖之上。一旦处在了那个位置，即使不做任何事，也可以随着波浪顺顺当当地向前漂个十年甚至更长的时间。在这十几年间，它们代表着科技的浪潮，直到下一波浪潮的来临。', 'The top of the tide', '历史');
INSERT INTO `bookall` VALUES ('9787121155352', 'Stanley B. Lippman, Josee Lajoie, Barbara E. Moo', 'C++ Primer', '电子工业出版社', '这本久负盛名的C++经典教程时隔八年之久终于迎来了史无前例的重大升级。本书系统全面地概述了数据库系统的基本理论。本书内容涉及基本的数据通信原理、各种类型的计算机网络以及多种网络协议和应用。', 'C++ Primer', '科技');
INSERT INTO `bookall` VALUES ('9787121249884', 'William Stallings', '数据与计算机通信', '电子工业出版社', '本书是著名计算机专业作家William Stallings的经典著作之一，内容涉及基本的数据通信原理、各种类型的计算机网络以及多种网络协议和应用。新增主题包括软件定义网络，无线传输技术复杂性分析，4G蜂窝网络，千兆位WiFi，DHCP，PIM，QoS结构框架和标准因特网邮件体系结构。此外，本书还包括参考文献和缩略语，并且每章都附有习题和建议，以便读者进一步阅读。', 'Data and computer communication', '科技');
INSERT INTO `bookall` VALUES ('9787301053669', '耿素云', '离散数学教程', '北京大学出版社', '本书共分五编。第一编为集合论,其中包括集合的基本概念、二元关系、函数、自然数、基数、序数。第二编为图论,其中包括图的基本概念、图的连通性、欧拉图与哈密顿图、树、平面图、图的着色、图的矩阵表示、覆盖集、独立集、匹配、带权图及其实用。第三编为代数结构,其中包括代数系统的基本概念、几个重要的代数系统:半群、群、环、域、格与布尔代数。第四编为组合灵敏学,其中包括组合存在性、组合计数、级合设计与编码以及组合最优化。第五编为数理逻辑,其中包括命题逻辑、一阶谓词逻辑、Her-brand定理和直觉逻辑。', 'Discrete mathematics tutorial', '教材');
INSERT INTO `bookall` VALUES ('9787301053973', '丘维声', '简明线性代数', '北京大学出版社', '随着时代的发展，计算机的普及，线性代数这一数学分支显得越来越重要。现在几乎所有大专院校的大多数专业都在开设线性代数课程。如何教好、学好这门课程，关键是要有科学地阐述线性代数的基本内容、简明易懂的教材。这就是本书的编写目的。', 'Concise linear algebra', '教材');
INSERT INTO `bookall` VALUES ('9787301109489', '斯塔夫里阿诺斯', '全球通史', '北京大学出版社', '本套丛书由美国时代生活公司历经多年编著而成 ，全书汇集了世界各名牌大学史学专家的智慧和 劳动，包含300多万的文字和3000余幅精美图片及珍 贵照片，从史前文明到20世纪末，涉及人类300余 万年的历史，全面展示了全球悠久和灿烂的文明。', 'Global History', '历史');
INSERT INTO `bookall` VALUES ('9787301256909', '曼昆', '经济学原理', '北京大学出版社', '全书总共34章，前23章是微观部分，后11章是宏观部分，该书第一章提出了经济学的十大原理，以此作为全书的中心。在全书中，曼昆尽可能地经常回到应用与政策方面的问题上，大多数的章节也包括了如何应用经济学原理的案例研究。', 'Principles of Economics', '经济');
INSERT INTO `bookall` VALUES ('9787302299585', '胡运权', '运筹学教程', '清华大学出版社', '本书在内容方面，系统地介绍运筹学的基本理论、方法和应用；在编排上，注重内容安排上的前后衔接，重点突出理论联系实际。本书主要特点在于：注重案例分析，力求通过理论与案例的结合使读者学会对于实际问题的分析、研究和建立教学模型，掌握解决问题所需要的数学概念和解题技巧。为了方便教学，本书还配有教学课件，并在每章后增加了习题。同时，考虑到不同院校对教学内容的不同要求，书中对选讲内容标记了“*”号，供各学校在教学中予以取舍。', 'Operational Research Tutorial', '教材');
INSERT INTO `bookall` VALUES ('9787508321752', 'Randal E.Bryant', '深入理解计算机系统', '中国电力出版社', '《深入理解计算机系统》主要介绍了计算机系统的基本概念，包括最底层的内存中的数据表示、流水线指令的构成、虚拟存储器、编译系统、动态加载库，以及用户应用等。书中提供了大量实际操作，可以帮助读者更好地理解程序执行的方式，改进程序的执行效率。此书以程序员的视角全面讲解了计算机系统，深入浅出地介绍了处理器、编译器、操作系统和网络环境，是这一领域的权威之作。', 'Deep understanding of computer systems', '教材');
INSERT INTO `bookall` VALUES ('9787511359490', '莫泊桑', '莫泊桑短篇小说精选', '中国华侨出版社', '莫泊桑一生共创作了300多篇短篇小说，其中描写普法战争众生相的《羊脂球》是当之无愧的传世经典。《项链》和《我的叔叔于勒》也分别入选中国中学生语文课本。在莫泊桑笔下，有被虚伪的正派人利用并唾弃的妓女羊脂球，有为一串假项链付出一生辛劳的虚荣少女玛蒂尔德，还有误以为母亲去世任由妻子抢夺“遗物”的麻木公务员卡拉望……矛盾、计谋、虚伪、遗弃、忏悔、谅解。这些挣扎背后是小人物的生活图景，也是每个人都在面对的人生考卷。', 'Maupassant\'s short stories', '小说');
INSERT INTO `bookall` VALUES ('9787514607901', '列夫托尔斯泰', '战争与和平', '中国画报出版社', '《战争与和平》是19世纪俄国伟大的现实主义作 家列夫·托尔斯泰的代表作之一，是世界文学史 上的一部不朽名著。作家以1812年拿破仑入侵俄国 为中心，描写了俄国人民奋起抗击侵略者的英勇 场景，同时也探索了贵族阶级的历史命运问题。 小说围绕着鲍尔康斯基等四大贵族家庭的生活展 开，以四个家庭的主要成员的命运为贯穿始终的 情节线索，描绘了19世纪俄国的社会风尚，展示 了广阔的生活画卷。该书为托尔斯泰赢得了世界 文豪的声誉，2002年被评为“百部世界最伟大小说 ”。', 'javascript:', '小说');
INSERT INTO `bookall` VALUES ('9787532772322', '贾雷德·戴蒙德', '枪炮、病菌与钢铁', '上海译文出版社', '《枪炮、病菌与钢铁：人类社会的命运》（Guns, Germs, and Steel: The Fates of Human Societies）是由美国加州大学洛杉矶分校医学院生理学教授贾德·戴蒙于1997年所著。该书于1998年获得普利策奖以及英国科普书奖。国家地理学会根据本书拍摄的纪录片于2005年7月在美国公共电视网播出。根据作者，本书试图提供“最近13,000年来所有人的简短历史”。但本书并不只是描述过去历史的书；它试图解释为何欧亚文明最终可以存活下来并战胜其他文明，同时驳斥欧亚霸权是由欧亚知识份子或道德上的优越而来。戴蒙认为人类社会中权利与技术的歧异无法反映文化或种族上的差异，而是来自于被各种不同正回馈循环强力扩大的环境差异。', 'Guns, germs and steel', '历史');
INSERT INTO `bookall` VALUES ('9787532777471', '詹姆斯·里卡兹', '货币战争', '上海译文出版社', '《货币战争》\n自1694年英格兰银行成立以来的300年间，几乎每一场世界重大变故背后，都能看到国际金融资本势力的身影。他们通过左右一国的经济命脉掌握国家的政治命运，通过煽动政治事件、诱发经济危机，控制着世界财富的流向与分配。可以说，一部世界金融史，就是一部谋求主宰人类财富的阴谋史。通过描摹国际金融集团及其代言人在世界金融史上翻云覆雨的过程，本书揭示了对金钱的角逐如何主导着西方历史的发展与国家财富的分配，通过再现统治世界的精英俱乐部在政治与经济领域不断掀起金融战役的手段与结果，本书旨在告诫人们警惕潜在的金融打击，为迎接一场“不流血”的战争做好准备。随着中国金融的全面开放，国际银行家将大举深入中国的金融腹地。昨天发生在西方的故事，今天会在中国重演吗？', 'Monetary war', '经济');
INSERT INTO `bookall` VALUES ('9787532777532', '石黑一雄', '长日将尽', '上海译文出版社', '小说的主人公史蒂文斯是一位深受英国传统熏陶的典型的男管家，冷漠无情、曲意逢迎、造作虚伪。在史蒂文斯看来，只有效忠主人、格尽职守才能体现一个管家的价值和尊严。为此，他以服务达林顿勋爵为自豪，在他眼里达林顿勋爵是那些影响世界进程的伟人，自己不过是个小人物，他所做的仅是“全神贯注于属于我们的范畴的事情；那就是说，我们应全力以赴地为那些伟大的绅士们提供尽可能好的服务，因为在他们的手中真正掌握这文明的命运”。就这样一步一步地丧失自我，为达林顿府服务了近30年。期间，肯顿小姐与史蒂文斯在达林顿府一起工作多年，两人由工作关系日久生情，相互爱慕。为了他伟大的事业，他努力压抑自己的感情，眼睁睁地看着自己深爱的女人远嫁他人。后几经辗转，在思念的驱使下，史蒂文斯走出了达林顿府。在英格兰的乡村美景的熏陶下，史蒂文斯开始了反思，最终在大海边幡然悔悟，痛哭流涕，然而他的人生也近日暮。', 'The long day will be exhausted', '小说');
INSERT INTO `bookall` VALUES ('9787533936020', '毛姆', '月亮与六便士', '浙江文艺出版社', '作品以法国印象派画家保罗·高更的生平为素材，描述了一个原本平凡的伦敦证券经纪人思特里克兰德，突然着了艺术的魔，抛妻弃子，绝弃了旁人看来优裕美满的生活，奔赴南太平洋的塔希提岛，用圆笔谱写出自己光辉灿烂的生命，把生命的价值全部注入绚烂的画布的故事。贫穷的纠缠，病魔的折磨他毫不在意，只是后悔从来没有光顾过他的意识。作品表现了天才、个性与物质文明以及现代婚姻、家庭生活之间的矛盾，有着广阔的生命视角，用散发着消毒水味道的手术刀对皮囊包裹下的人性进行了犀利地解剖，混合着看客讪笑的幽默和残忍的目光。', 'The moon and six pence', '小说');
INSERT INTO `bookall` VALUES ('9787533947279', '安托万·德·圣-埃克苏佩里', '小王子', '浙江文艺出版社', '《小王子》是法国作家安托万·德·圣·埃克苏佩里于1942年写成的著名儿童文学短篇小说。本书的主人公是来自外星球的小王子。书中以一位飞行员作为故事叙述者，讲述了小王子从自己星球出发前往地球的过程中，所经历的各种历险。作者以小王子的孩子式的眼光，透视出成人的空虚、盲目，愚妄和死板教条，用浅显天真的语言写出了人类的孤独寂寞、没有根基随风流浪的命运。同时，也表达出作者对金钱关系的批判，对真善美的讴歌。', 'The little prince', '小说');
INSERT INTO `bookall` VALUES ('9787540455958', '马克·李维', '偷影子的人', '湖南文艺出版社', '《偷影子的人》是法国作家马克·李维创作的一部小说，也是其第10部作品。故事讲述了一个老是受班上同学欺负的瘦弱小男孩，因为拥有一种特殊能力而强大：他能“偷别人的影子”，因而能看见他人心事，听见人们心中不愿意说出口的秘密。他开始成为需要帮助者的心灵伙伴，为每个偷来的影子找到点亮生命的小小光芒。这部作品展现了马克·李维温柔风趣的写作风格，有催人泪下的亲情、浪漫感人的爱情和不离不弃的友情，清新浪漫的气息和温柔感人的故事相互交织，带给读者笑中带泪的阅读感受，是一部唤醒童年回忆和内心梦想的温情疗愈小说。', 'People who steal shadows', '小说');
INSERT INTO `bookall` VALUES ('9787540485115', '莫泊桑', '漂亮朋友', '湖南文艺出版社', '作品讲述了法国驻阿尔及利亚殖民军的下级军官杜洛瓦来到巴黎，进入报馆当编辑，他依仗自己漂亮的外貌和取悦女人的手段，专门勾引上流社会的女子，并以此为跳板，走上飞黄腾达的道路。最后他拐走了报馆老板的女儿，迫使老板把女儿嫁给他，自己成为该报的总编辑。小说结尾还暗示他即将当上参议员和内阁部长，前程还远大着呢。', 'Beautiful friends', '小说');
INSERT INTO `bookall` VALUES ('9787544291170', '加西亚·马尔克斯', '百年孤独', '南海出版公司', '《百年孤独》，是哥伦比亚作家加西亚·马尔克斯创作的长篇小说，是其代表作，也是拉丁美洲魔幻现实主义文学的代表作，被誉为“再现拉丁美洲历史社会图景的鸿篇巨著”。作品描写了布恩迪亚家族七代人的传奇故事，以及加勒比海沿岸小镇马孔多的百年兴衰，反映了拉丁美洲一个世纪以来风云变幻的历史。作品融入神话传说、民间故事、宗教典故等神秘因素，巧妙地糅合了现实与虚幻，展现出一个瑰丽的想象世界，成为20世纪重要的经典文学巨著之一。', 'Hundred years of solitude', '小说');
INSERT INTO `bookall` VALUES ('9787801093660', '勒庞', '乌合之众：大众心理研究', '中央编译出版社', '《乌合之众：大众心理研究》是一本研究大众心理学的著作。在书中，勒庞阐述了群体以及群体心理的特征，指出了当个人是一个孤立的个体时，他有着自己鲜明的个性化特征，而当这个人融入了群体后，他的所有个性都会被这个群体所淹没，他的思想立刻就会被群体的思想所取代。而当一个群体存在时，他就有着情绪化、无异议、低智商等特征。', 'A motley crew: mass psychology study', '其他');
INSERT INTO `bookall` VALUES ('9787807329329', '王后雄', '教材同步解读', '接力出版社', '无', 'Synchronous reading textbooks', '教材');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `cID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cgender` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cphone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cpassword` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  INDEX `cID`(`cID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('1', '张三', 'female', '15811332255', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `customer` VALUES ('2', '李四', 'male', '14455778899', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `customer` VALUES ('3', '王五', 'male', '12238969305', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `customer` VALUES ('4', '张全蛋', 'male', '14566773290', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `customer` VALUES ('5', '王司徒', 'male', '18811800001', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `customer` VALUES ('6', '面筋哥', 'male', '15399999999', '6ebe76c9fb411be97b3b0d48b791a7c9');
INSERT INTO `customer` VALUES ('8', '金坷垃', 'male', '17777777777', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `customer` VALUES ('9', '敖厂长', 'male', '12345678910', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for english_introduction_index
-- ----------------------------
DROP TABLE IF EXISTS `english_introduction_index`;
CREATE TABLE `english_introduction_index`  (
  `ID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `eword` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `eplace` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of english_introduction_index
-- ----------------------------
INSERT INTO `english_introduction_index` VALUES ('827', NULL, NULL);
INSERT INTO `english_introduction_index` VALUES ('828', 'global', '1007699860687,9787301109489');
INSERT INTO `english_introduction_index` VALUES ('829', 'history', '1007699860687,9787301109489');
INSERT INTO `english_introduction_index` VALUES ('830', 'hunamity', '9787030362173');
INSERT INTO `english_introduction_index` VALUES ('831', 'geography', '9787030362173');
INSERT INTO `english_introduction_index` VALUES ('832', 'probability', '9787040369397');
INSERT INTO `english_introduction_index` VALUES ('833', 'and', '9787040369397,9787121139253,9787121249884,9787532772322,9787533936020');
INSERT INTO `english_introduction_index` VALUES ('834', 'statistics', '9787040369397');
INSERT INTO `english_introduction_index` VALUES ('835', 'introduction', '9787040406441,9787040494792');
INSERT INTO `english_introduction_index` VALUES ('836', 'to', '9787040406441');
INSERT INTO `english_introduction_index` VALUES ('837', 'database', '9787040406441');
INSERT INTO `english_introduction_index` VALUES ('838', 'system', '9787040406441');
INSERT INTO `english_introduction_index` VALUES ('839', 'brief', '9787040494792');
INSERT INTO `english_introduction_index` VALUES ('840', 'of', '9787040494792,9787040494792,9787121139512,9787301256909,9787508321752,9787544291170');
INSERT INTO `english_introduction_index` VALUES ('841', 'the', '9787040494792,9787121139512,9787121139512,9787532777532,9787533936020,9787533947279');
INSERT INTO `english_introduction_index` VALUES ('842', 'principles', '9787040494792,9787301256909');
INSERT INTO `english_introduction_index` VALUES ('843', 'marxism', '9787040494792');
INSERT INTO `english_introduction_index` VALUES ('844', 'javascript', '9787111376613,9787514607901');
INSERT INTO `english_introduction_index` VALUES ('845', 'authoritative', '9787111376613');
INSERT INTO `english_introduction_index` VALUES ('846', 'guide', '9787111376613');
INSERT INTO `english_introduction_index` VALUES ('847', 'data', '9787121139253,9787121249884');
INSERT INTO `english_introduction_index` VALUES ('848', 'computer', '9787121139253,9787121249884,9787508321752');
INSERT INTO `english_introduction_index` VALUES ('849', 'communication', '9787121139253,9787121249884');
INSERT INTO `english_introduction_index` VALUES ('850', 'top', '9787121139512');
INSERT INTO `english_introduction_index` VALUES ('851', 'tide', '9787121139512');
INSERT INTO `english_introduction_index` VALUES ('852', 'c++', '9787121155352');
INSERT INTO `english_introduction_index` VALUES ('853', 'primer', '9787121155352');
INSERT INTO `english_introduction_index` VALUES ('854', 'discrete', '9787301053669');
INSERT INTO `english_introduction_index` VALUES ('855', 'mathematics', '9787301053669');
INSERT INTO `english_introduction_index` VALUES ('856', 'tutorial', '9787301053669,9787302299585');
INSERT INTO `english_introduction_index` VALUES ('857', 'concise', '9787301053973');
INSERT INTO `english_introduction_index` VALUES ('858', 'linear', '9787301053973');
INSERT INTO `english_introduction_index` VALUES ('859', 'algebra', '9787301053973');
INSERT INTO `english_introduction_index` VALUES ('860', 'economics', '9787301256909');
INSERT INTO `english_introduction_index` VALUES ('861', 'operational', '9787302299585');
INSERT INTO `english_introduction_index` VALUES ('862', 'research', '9787302299585');
INSERT INTO `english_introduction_index` VALUES ('863', 'deep', '9787508321752');
INSERT INTO `english_introduction_index` VALUES ('864', 'understanding', '9787508321752');
INSERT INTO `english_introduction_index` VALUES ('865', 'systems', '9787508321752');
INSERT INTO `english_introduction_index` VALUES ('866', 'maupassants', '9787511359490');
INSERT INTO `english_introduction_index` VALUES ('867', 'short', '9787511359490');
INSERT INTO `english_introduction_index` VALUES ('868', 'stories', '9787511359490');
INSERT INTO `english_introduction_index` VALUES ('869', 'guns', '9787532772322');
INSERT INTO `english_introduction_index` VALUES ('870', 'germs', '9787532772322');
INSERT INTO `english_introduction_index` VALUES ('871', 'steel', '9787532772322');
INSERT INTO `english_introduction_index` VALUES ('872', 'monetary', '9787532777471');
INSERT INTO `english_introduction_index` VALUES ('873', 'war', '9787532777471');
INSERT INTO `english_introduction_index` VALUES ('874', 'long', '9787532777532');
INSERT INTO `english_introduction_index` VALUES ('875', 'day', '9787532777532');
INSERT INTO `english_introduction_index` VALUES ('876', 'will', '9787532777532');
INSERT INTO `english_introduction_index` VALUES ('877', 'be', '9787532777532');
INSERT INTO `english_introduction_index` VALUES ('878', 'exhausted', '9787532777532');
INSERT INTO `english_introduction_index` VALUES ('879', 'moon', '9787533936020');
INSERT INTO `english_introduction_index` VALUES ('880', 'six', '9787533936020');
INSERT INTO `english_introduction_index` VALUES ('881', 'pence', '9787533936020');
INSERT INTO `english_introduction_index` VALUES ('882', 'little', '9787533947279');
INSERT INTO `english_introduction_index` VALUES ('883', 'prince', '9787533947279');
INSERT INTO `english_introduction_index` VALUES ('884', 'people', '9787540455958');
INSERT INTO `english_introduction_index` VALUES ('885', 'who', '9787540455958');
INSERT INTO `english_introduction_index` VALUES ('886', 'steal', '9787540455958');
INSERT INTO `english_introduction_index` VALUES ('887', 'shadows', '9787540455958');
INSERT INTO `english_introduction_index` VALUES ('888', 'beautiful', '9787540485115');
INSERT INTO `english_introduction_index` VALUES ('889', 'friends', '9787540485115');
INSERT INTO `english_introduction_index` VALUES ('890', 'hundred', '9787544291170');
INSERT INTO `english_introduction_index` VALUES ('891', 'years', '9787544291170');
INSERT INTO `english_introduction_index` VALUES ('892', 'solitude', '9787544291170');
INSERT INTO `english_introduction_index` VALUES ('893', 'a', '9787801093660');
INSERT INTO `english_introduction_index` VALUES ('894', 'motley', '9787801093660');
INSERT INTO `english_introduction_index` VALUES ('895', 'crew', '9787801093660');
INSERT INTO `english_introduction_index` VALUES ('896', 'mass', '9787801093660');
INSERT INTO `english_introduction_index` VALUES ('897', 'psychology', '9787801093660');
INSERT INTO `english_introduction_index` VALUES ('898', 'study', '9787801093660');
INSERT INTO `english_introduction_index` VALUES ('899', 'synchronous', '9787807329329');
INSERT INTO `english_introduction_index` VALUES ('900', 'reading', '9787807329329');
INSERT INTO `english_introduction_index` VALUES ('901', 'textbooks', '9787807329329');

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail`  (
  `oID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `obook` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `oamount` int(8) NULL DEFAULT NULL,
  `osale` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  INDEX `osale`(`osale`) USING BTREE,
  INDEX `obook`(`obook`) USING BTREE,
  CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`obook`) REFERENCES `bookall` (`bISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`osale`) REFERENCES `sale` (`sID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_detail
-- ----------------------------
INSERT INTO `order_detail` VALUES ('1', '9787040494792', 1, '1');
INSERT INTO `order_detail` VALUES ('2', '9787121139512', 1, '2');
INSERT INTO `order_detail` VALUES ('3', '9787121155352', 2, '2');
INSERT INTO `order_detail` VALUES ('4', '9787040406441', 1, '3');
INSERT INTO `order_detail` VALUES ('5', '9787121139512', 2, '4');
INSERT INTO `order_detail` VALUES ('6', '9787111376613', 2, '5');
INSERT INTO `order_detail` VALUES ('7', '9787121139253', 2, '5');
INSERT INTO `order_detail` VALUES ('8', '9787040406441', 2, '6');
INSERT INTO `order_detail` VALUES ('9', '9787040494792', 2, '6');
INSERT INTO `order_detail` VALUES ('10', '9787111376613', 2, '6');
INSERT INTO `order_detail` VALUES ('11', '9787301053669', 1, '7');
INSERT INTO `order_detail` VALUES ('12', '9787030362173', 5, '8');
INSERT INTO `order_detail` VALUES ('12', '9787030362173', 5, '8');

-- ----------------------------
-- Table structure for sale
-- ----------------------------
DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale`  (
  `sID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `scustomer` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sseller` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `stime` date NULL DEFAULT NULL,
  INDEX `sale`(`sID`) USING BTREE,
  INDEX `sseller`(`sseller`) USING BTREE,
  INDEX `scustomer`(`scustomer`) USING BTREE,
  CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`sseller`) REFERENCES `customer` (`cID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`scustomer`) REFERENCES `customer` (`cID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sale
-- ----------------------------
INSERT INTO `sale` VALUES ('1', '1', '2', '2018-10-02');
INSERT INTO `sale` VALUES ('2', '1', '3', '2018-10-02');
INSERT INTO `sale` VALUES ('3', '2', '1', '2018-10-02');
INSERT INTO `sale` VALUES ('4', '2', '3', '2018-10-02');
INSERT INTO `sale` VALUES ('5', '4', '3', '2018-10-02');
INSERT INTO `sale` VALUES ('6', '3', '2', '2018-10-02');
INSERT INTO `sale` VALUES ('7', '3', '4', '2018-10-02');
INSERT INTO `sale` VALUES ('8', '9', '4', '2018-12-06');
INSERT INTO `sale` VALUES ('8', '9', '4', '2018-12-06');

-- ----------------------------
-- Table structure for search_log
-- ----------------------------
DROP TABLE IF EXISTS `search_log`;
CREATE TABLE `search_log`  (
  `sID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sdate` date NULL DEFAULT NULL,
  `stime` time(0) NULL DEFAULT NULL,
  `skeyword` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of search_log
-- ----------------------------
INSERT INTO `search_log` VALUES ('3', '2018-10-30', '16:12:21', 'linear');
INSERT INTO `search_log` VALUES ('4', '2018-10-30', '16:13:03', 'prince');
INSERT INTO `search_log` VALUES ('5', '2018-11-02', '09:41:16', 'History');
INSERT INTO `search_log` VALUES ('6', '2018-11-02', '10:13:22', 'Primer');

-- ----------------------------
-- Table structure for warehouse
-- ----------------------------
DROP TABLE IF EXISTS `warehouse`;
CREATE TABLE `warehouse`  (
  `wID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `wbook` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `wowner` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `wdate` date NULL DEFAULT NULL,
  `wnumber` int(8) NULL DEFAULT NULL,
  `wprice` double(10, 2) NULL DEFAULT NULL,
  INDEX `wbook`(`wbook`) USING BTREE,
  INDEX `wowner`(`wowner`) USING BTREE,
  CONSTRAINT `warehouse_ibfk_1` FOREIGN KEY (`wbook`) REFERENCES `bookall` (`bISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `warehouse_ibfk_2` FOREIGN KEY (`wowner`) REFERENCES `customer` (`cID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of warehouse
-- ----------------------------
INSERT INTO `warehouse` VALUES ('1', '1007699860687', '1', '2018-10-01', 20, NULL);
INSERT INTO `warehouse` VALUES ('2', '9787030362173', '1', '2018-10-01', 150, NULL);
INSERT INTO `warehouse` VALUES ('3', '9787040406441', '1', '2018-10-01', 123, NULL);
INSERT INTO `warehouse` VALUES ('4', '9787040494792', '1', '2018-10-01', 55, NULL);
INSERT INTO `warehouse` VALUES ('5', '9787040406441', '2', '2018-10-01', 34, NULL);
INSERT INTO `warehouse` VALUES ('6', '9787040494792', '2', '2018-10-01', 455, NULL);
INSERT INTO `warehouse` VALUES ('7', '9787111376613', '2', '2018-10-01', 333, NULL);
INSERT INTO `warehouse` VALUES ('8', '9787121139253', '2', '2018-10-01', 88, NULL);
INSERT INTO `warehouse` VALUES ('9', '9787111376613', '3', '2018-10-01', 44, NULL);
INSERT INTO `warehouse` VALUES ('10', '9787121139253', '3', '2018-10-01', 11, NULL);
INSERT INTO `warehouse` VALUES ('11', '9787121139512', '3', '2018-10-01', 1111, NULL);
INSERT INTO `warehouse` VALUES ('12', '9787121155352', '3', '2018-10-01', 234, NULL);
INSERT INTO `warehouse` VALUES ('13', '9787121139512', '4', '2018-10-01', 8, NULL);
INSERT INTO `warehouse` VALUES ('14', '9787121155352', '4', '2018-10-01', 778, NULL);
INSERT INTO `warehouse` VALUES ('15', '9787121249884', '4', '2018-10-01', 67, NULL);
INSERT INTO `warehouse` VALUES ('16', '9787301053669', '4', '2018-10-01', 666, NULL);

SET FOREIGN_KEY_CHECKS = 1;
