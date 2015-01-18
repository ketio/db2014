-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2015-01-18: 14:17:27
-- 伺服器版本: 5.6.17
-- PHP 版本： 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `db2014`
--

-- --------------------------------------------------------

--
-- 資料表結構 `deposit`
--

CREATE TABLE IF NOT EXISTS `deposit` (
  `depositID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `money` int(100) NOT NULL,
  PRIMARY KEY (`depositID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='儲值';

--
-- 資料表的匯出資料 `deposit`
--

INSERT INTO `deposit` (`depositID`, `userID`, `time`, `money`) VALUES
('deposit-00000000000000000000000000000001', 'user-00000000000000000000000000000000', '2015-01-18 00:00:00', 500);

-- --------------------------------------------------------

--
-- 資料表結構 `having`
--

CREATE TABLE IF NOT EXISTS `having` (
  `havingID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `videoID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `buyDate` datetime NOT NULL,
  PRIMARY KEY (`havingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `having`
--

INSERT INTO `having` (`havingID`, `userID`, `videoID`, `buyDate`) VALUES
('having-43cfeb0ad4e1e07c0573e4438aab2b47', 'user-00000000000000000000000000000000', 'video-4657bcd2c345eec93cb7f004947375ae', '2015-01-18 13:56:36');

-- --------------------------------------------------------

--
-- 資料表結構 `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `publisherID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `publisherName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `publisherCountry` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`publisherID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `publisher`
--

INSERT INTO `publisher` (`publisherID`, `publisherName`, `publisherCountry`) VALUES
('publisher-0df18af26c9fb87d8444933399d0f2bb', '吉卜力工作室', '日本'),
('publisher-22b6bcb1b52203c9db3c285f9b8c1cec', '索尼影視', '美國'),
('publisher-4a8c922f9af8afaecb52de6ebfdc1717', '阿囉哈動畫', '美國'),
('publisher-58427c2321ea73bf6ee94ad32e3dfb7b', '迪士尼', '美國'),
('publisher-5ae897b4f3aac7a756dd809c87e3beeb', '日昇動畫', '日本'),
('publisher-70a1a37e010d51db35127058d5d9d255', '夢工場', '美國'),
('publisher-7439fa918297704928692db9d0a78f8d', 'MBC影像', '韓國'),
('publisher-ba478fd33fd66f33e7297b02d80e4c43', '稻田電影工作室', '台灣'),
('publisher-c1b47fd5ab82721f21dc9430ef906ba0', '民視電視台', '台灣'),
('publisher-c1d61fb802af01a4e654b5c61690485c', '冉色斯創意影像', '台灣'),
('publisher-d9ac250154e2bdf799292f8f68e654b6', '三立電視台', '台灣'),
('publisher-dac5ea4871a53173cabb1ca290271af6', '富士電視台', '日本'),
('publisher-de461e5b1427b76dae79bf7568c49c38', '東京電視台', '日本'),
('publisher-ff1236d2a9094b0aaab666eca207b49d', '華納兄弟', '美國');

-- --------------------------------------------------------

--
-- 資料表結構 `rent`
--

CREATE TABLE IF NOT EXISTS `rent` (
  `rentID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `videoID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  PRIMARY KEY (`rentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `rent`
--

INSERT INTO `rent` (`rentID`, `userID`, `videoID`, `startTime`, `endTime`) VALUES
('rent-4435e937a0c805adb5c39d4e89785cb4', 'user-00000000000000000000000000000000', 'video-80b4c86e4df515f6766c2ad3261baf92', '2015-01-18 13:58:35', '2015-02-17 13:58:35'),
('rent-c225191a88bb027f488a287a0b39c4cf', 'user-00000000000000000000000000000000', 'video-80b4c86e4df515f6766c2ad3261baf92', '2015-01-18 13:58:35', '2015-02-17 13:58:35');

-- --------------------------------------------------------

--
-- 資料表結構 `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vedioID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `purchaseType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`transactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='交易紀錄';

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userName` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `gender` enum('F','M','N') COLLATE utf8_unicode_ci NOT NULL,
  `birthday` datetime NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `Account` (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='使用者';

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`userID`, `account`, `password`, `userName`, `gender`, `birthday`) VALUES
('user-00000000000000000000000000000000', 'admin', 'admin', '管理員', 'F', '2015-01-01 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `user_feedback`
--

CREATE TABLE IF NOT EXISTS `user_feedback` (
  `userFeedbackID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `videoID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rating` int(5) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`userFeedbackID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `videoID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `videoName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `videoType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rentPrice` int(100) NOT NULL,
  `buyPrice` int(100) NOT NULL,
  `publishDate` datetime NOT NULL,
  `publisher` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`videoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `video`
--

INSERT INTO `video` (`videoID`, `videoName`, `videoType`, `rentPrice`, `buyPrice`, `publishDate`, `publisher`, `lang`, `intro`) VALUES
('video-0052119216b571be017bf7dbfe04ecde', '玩具總動員III', 'videotype-645cda47e1a647a3f9aac8aff64fbfe0', 35, 90, '2010-06-16 00:00:00', 'publisher-58427c2321ea73bf6ee94ad32e3dfb7b', '英文', '自從十一年前玩具們所經歷的大冒險後，玩具們安然無恙的度過了好幾個年頭。轉眼間，玩具們的主人安弟已經成為一個青少年，也即將離家去展開他的大學生涯。胡迪與巴斯以及其他的玩具們也都人心惶惶，深怕這個他們內心最恐懼被丟棄的一天即將來臨。這一天，安弟的媽媽來到安弟的房間，詢問他將如何處置這些伴他渡過童年的玩具們，並且要求安弟在離家前要把這些東西處理好，如果沒有將要留下的玩具放置閣樓收藏，她就會把這些玩具處理掉。安弟在媽媽的逼迫下，再次打開他的玩具箱，童年回憶湧上心頭，他根本捨不得將任何一件玩具丟掉，所以將所有的玩具都放入大黑袋子中，準備將它們放置閣樓，但正要將袋子放入閣樓的同時，安弟被妹妹呼喚去幫忙，就在陰錯陽差之下，媽媽誤以為黑袋子裡的玩具是要丟棄的。玩具有驚無險地逃過了被垃圾車收走的命運，逃到裝有要捐贈給陽光托兒所的玩具的紙箱內......'),
('video-03b0354f28576d25a2ea9c12a2ca8787', '南方四賤客-第十四季', 'videotype-f3b573d52f75392e0046482d6915a7fe', 40, 220, '2012-03-20 00:00:00', 'publisher-4a8c922f9af8afaecb52de6ebfdc1717', '英文', '《南方四賤客》（South Park）是美國喜劇中心（Comedy Central）製作的動畫劇集，由特雷·帕克和馬特·斯通創作。《南方四賤客》經常通過歪曲式的摹仿來諷刺和嘲弄美國文化和社會時事的各個方面，挑戰了許多根深蒂固的觀念和禁忌並因其中的粗口、黑色幽默和超現實幽默而著名。它在1997年首播，至2014年已播到第18季。\n本系列為第十四季。'),
('video-0c921a57f35510a7dbd973853964fb1d', '玩具總動員I', 'videotype-645cda47e1a647a3f9aac8aff64fbfe0', 30, 80, '1995-11-19 00:00:00', 'publisher-58427c2321ea73bf6ee94ad32e3dfb7b', '英文', '傳統牛仔玩偶「胡迪」（Woody）是小主人安迪（Andy）最喜歡的玩具，可是熱門玩具「巴斯光年」來了之後讓胡迪失寵。胡迪為了要趕走巴斯卻反被其他玩具們唾棄，之後意外與巴斯一起陷入致命危機，兩個冤家的冒險之旅也由此展開。巴斯光年原本深信自己是要拯救地球的太空騎警，但他後來卻發現自己只是個玩具遂陷入沮喪。當巴斯萬念俱灰，胡迪則設法要逃出玩具虐待狂阿薛的家；眼看安迪要搬家了，他們即將失去小主人，胡迪和巴斯必須團結合作，才能回到小主人的身邊。'),
('video-0fa193b68649eaa9be6048b84324618c', '風水世家IV', 'videotype-14bdc529740ecb13f48a3559c908c308', 20, 100, '2014-06-30 00:00:00', 'publisher-c1b47fd5ab82721f21dc9430ef906ba0', '中文', '《風水世家》為台灣民視於2012年製播的八點檔連續劇。全劇於2012年5月9日開鏡，拍攝與播出同步進行，於2012年7月17日接檔《父與子》首播，是台灣第一部以「風水」為主題的電視劇。'),
('video-11a3e767b5078294b0a2bf8137717739', '魔法阿嬤', 'videotype-645cda47e1a647a3f9aac8aff64fbfe0', 30, 120, '1998-04-03 00:00:00', 'publisher-ba478fd33fd66f33e7297b02d80e4c43', '中文', '民國某年的8月（農曆七月），豆豆因為媽媽必須出國照顧在國外工作受傷的爸爸，將他留在基隆鄉下的阿嬤（奶奶）家。豆豆一開始沒有辦法跟阿媽好好相處，他覺得阿媽跟自己存在祖孫時代不同而引起的代溝問題，而且在鄉下地帶，大部分老是說著他聽不太懂的閩南話（台語）。不過豆豆剛開始也不知道，阿媽擁有陰陽眼，可與鬼和靈進行接觸；後來也因為在眼睛上擦了阿媽的眼淚，而意外地看見他們。'),
('video-190e24c6be3f8dcd5107f9afbd309f38', '哈利波特VII-死神的聖物I', 'videotype-aa8f465269178db04b9dd219c4d09256', 20, 110, '2010-11-17 00:00:00', 'publisher-ff1236d2a9094b0aaab666eca207b49d', '英文', '佛地魔進一步在麻瓜及巫師的世界中施展他的魔爪，而霍格華茲亦再也不安全。哈利懷疑學校中有佛地魔的內奸在作祟，但是鄧不利多則忙於讓他準備快將來臨的最後一戰。二人合力尋找打敗佛地魔的關鍵，而鄧不利多亦召集了他的舊戰友及同袍赫瑞司·史拉轟教授，相信他掌握著重要的線索。而同時，學生們則受到不同敵人的襲擊，在校院內引發起很大的怨憤。哈利發覺自己跟丁·湯瑪斯一樣，越來越被金妮吸引。榮恩則成為了文妲·布朗的對象，但是他卻誤吃了羅咪·凡的愛情巧克力而中了她的魔法，這些都讓妙麗心生妒忌，但她卻把自己的感覺藏於心中。校園中只有一人沒有被情所困，他專心致至地要成功揚名，縱然是投靠黑暗的勢力(馬份)……雖然愛情正在他們中間慢慢滋長，但是亦有著悲劇他們面前等候著……霍格華茲將不會再如從前一樣……'),
('video-1cdafde5a8bff16bf84360875bcbbe99', '哈利波特II-消失的密室', 'videotype-aa8f465269178db04b9dd219c4d09256', 15, 100, '2002-11-15 00:00:00', 'publisher-ff1236d2a9094b0aaab666eca207b49d', '英文', '可怕的事即將發生在霍格華茲！\n多比對哈利作出警告。\n霍格華茲要回來了。\n密室被打開了。傳人的仇敵們……小心囉！（密室被打開了。與繼承人為敵者，警惕！！）\n密室被打開了……密室被打開了……\n第二年的旅程即將在9月15日開始。'),
('video-35a146b500887c0bdced3c6343bf6b36', '南方四賤客-第十三季', 'videotype-f3b573d52f75392e0046482d6915a7fe', 40, 220, '2011-12-25 00:00:00', 'publisher-4a8c922f9af8afaecb52de6ebfdc1717', '英文', '《南方四賤客》（South Park）是美國喜劇中心（Comedy Central）製作的動畫劇集，由特雷·帕克和馬特·斯通創作。《南方四賤客》經常通過歪曲式的摹仿來諷刺和嘲弄美國文化和社會時事的各個方面，挑戰了許多根深蒂固的觀念和禁忌並因其中的粗口、黑色幽默和超現實幽默而著名。它在1997年首播，至2014年已播到第18季。\n本系列為第十三季。'),
('video-3af3cab5510fac914b34d2740dd1edcb', '玩具總動員II', 'videotype-645cda47e1a647a3f9aac8aff64fbfe0', 35, 90, '1999-11-24 00:00:00', 'publisher-58427c2321ea73bf6ee94ad32e3dfb7b', '英文', '在《玩具總動員》之後的某天，主人安迪準備帶胡迪到牛仔俱樂部玩，但不慎將胡迪的胳膊縫線弄斷了，這讓胡迪十分憂鬱，擔心主人會將自己拋棄。不久，安迪的媽媽在家進行大掃除時準備將舊企鵝Wheezy扔掉，胡迪決定從院子把Wheezy拯救回來。當胡迪騎著小狗Buster將Wheezy救回時，自己卻被遺留在院子里。玩具商艾耳在院子發現了胡迪，經交涉後由於無法獲得胡迪這個絕版玩具，艾耳偷走胡迪，把他帶到了他自己的玩具工廠。巴斯光年嘗試從艾耳手中拯救胡迪卻未能成功，但是玩具們獲悉胡迪就在艾耳的玩具工廠後，巴斯和彈簧狗、番薯頭先生、恐龍及豬仔錢罐火腿開始了拯救胡迪的任務。'),
('video-3eb74530dd534fd422b7b63317f10531', '哈利波特V-鳳凰會的密令', 'videotype-aa8f465269178db04b9dd219c4d09256', 15, 100, '2007-07-11 00:00:00', 'publisher-ff1236d2a9094b0aaab666eca207b49d', '英文', '一個酷熱的暑假夜晚，催狂魔竟然出現攻擊達力和哈利，情急之下，哈利不得不打破未成年巫師使用魔法的限制規定，發出護法咒擊退了催狂魔，但卻也因此面臨被學校開除的危機…。另一方面，與魔法部分道揚鑣的鄧不利多，決定重新啟動多年前為對抗佛地魔所成立的地下組織──鳳凰會，秘密的進行多項任務……'),
('video-4657bcd2c345eec93cb7f004947375ae', '綱彈OO-第一季', 'videotype-5489db0e53fa79888b28a377af4ca1ea', 60, 270, '2007-10-06 00:00:00', 'publisher-5ae897b4f3aac7a756dd809c87e3beeb', '日文', '由於地球上的化石燃料枯竭，人類開始依靠太陽能發電作為新的能源。西元2307年，以三座長度約五萬公里的軌道升降機為中心，建構完成巨大的太陽能發電衛星；但是能夠得到此系統恩澤的，只有共同參與其興建的同盟國家而已。\n為了建造這幾座能產生半永久能源的軌道升降機，世界各區域經過統合，形成三個超大國家群。分別是以美國為中心的「世界經濟聯合」（UNION）；以中國、俄羅斯與印度為中心的「人類革新聯盟」（人革聯）；以及歐洲的「新歐洲共同體」（AEU）。軌道升降機因體積巨大而難以防禦，構造上也極其脆弱，在此緊張狀態下，三大國家群為了各自的威信和繁榮，持續著逐漸擴大的零和遊戲。\n在這無法結束紛爭的世界，出現了擁有機動戰士（Mobile Suit）「鋼彈」的私設武裝組織「天上人」（Celestial Being）。為了根絕戰爭，他們進行著超越了民族、國家、宗教的作戰行動。\n於是，以鋼彈對全戰爭行為的武力介入開始了。'),
('video-4c63edc0b34cc0e556d531409b762fe9', '神隱少女', 'videotype-af803f97b5314d1c217e85ab71734080', 50, 150, '2001-07-20 00:00:00', 'publisher-0df18af26c9fb87d8444933399d0f2bb', '日文', '年僅10歲的荻野千尋是一個看起來非常普通的四年級小學生，她隨父母搬家來到一個陌生的城鎮準備開始一個全新的生活。 然而，因為途中迷路，她和父母誤闖入了一個人類不應該進入的靈異小鎮。小鎮的主管是當地一家叫「湯屋」的澡堂的巫婆老闆：湯婆婆；而「湯屋」則是服侍日本八百萬天神洗澡的地方。 鎮上有一條規定，在鎮上凡是沒有工作的人，都要被變成豬被吃掉。\n千尋的父母由於貪吃，未經過店員允許就隨便享用食物，而遭到懲罰變成了豬。 千尋為了拯救父母，在湯婆婆的助手「白龍」的幫助下，進入澡堂，並成功的獲得了一份工作。 作為代價，她的名字被湯婆婆拿掉了筆劃太多的部分，成了「千」。 在澡堂工作的過程中，小千從一個嬌生慣養，什麼活都不會做的小女孩，逐漸成長，變得越來越堅強能幹； 同時，她善良的品格也開始得到了澡堂中其他人的尊重，而她和白龍之間也萌生出一段純真的感情。\n而為了拯救父母和對自己重要的人，面對各種困難和危險，千尋也一次次做出了自己的選擇。而影片也隨著她的心理變化歷程而展開。'),
('video-4ea7f291aa35a993d89a748e81801eda', 'Legal High王牌大律師I', 'videotype-8cadaac5984e2a2f5331fdda71717522', 60, 300, '2012-04-17 00:00:00', 'publisher-dac5ea4871a53173cabb1ca290271af6', '日文', '黛真知子（新垣結衣 飾）是一個充滿著正義感、憑著大無畏的精神，一股腦兒向前衝的熱血新進律師。因為一次訴訟而認識法律界神話—古美門研介（堺雅人 飾），一位毒舌、傲慢、自大，為了勝訴不擇手段，穿梭在法律灰色地帶但擁有著不敗紀錄的知名律師，此後並開始到古美門律師事務所工作。性格與想法完全地南轅北轍的兩人，在一次又一次的訴訟中不斷發生衝突，但同時又在法庭上攜手戰鬥。一對冤家拍擋緊守各自的信念，衝擊著日本司法界，要在公平與正義之間，還司法制度一個真面目。'),
('video-52d8324ffe2a8f92a8b844262a486988', '哈利波特III-阿茲卡班的逃犯', 'videotype-aa8f465269178db04b9dd219c4d09256', 15, 100, '2004-05-31 00:00:00', 'publisher-ff1236d2a9094b0aaab666eca207b49d', '英文', '神秘的殺人犯天狼星·布萊克從阿茲卡班監獄逃跑了，並且正對霍格華茲魔法與巫術學院虎視眈眈，在那裡由阿茲卡班守衛催狂魔進駐，他們要保護哈利波特以及他的同伴遠離天狼星的威脅。'),
('video-53128f1410581561c083cdf6c7475fac', '風水世家III', 'videotype-14bdc529740ecb13f48a3559c908c308', 20, 100, '2014-01-08 00:00:00', 'publisher-c1b47fd5ab82721f21dc9430ef906ba0', '中文', '《風水世家》為台灣民視於2012年製播的八點檔連續劇。全劇於2012年5月9日開鏡，拍攝與播出同步進行，於2012年7月17日接檔《父與子》首播，是台灣第一部以「風水」為主題的電視劇。'),
('video-5829437a8708cdc7972227b5c83e3531', '大長今(動畫)-第一季', 'videotype-339a15027618444f8cf960a1357b534f', 50, 250, '2007-03-14 00:00:00', 'publisher-7439fa918297704928692db9d0a78f8d', '韓文', '由MBC電視劇《大長今》改編而成的《大長今》動畫版，以長今的孩童時代為主軸，描述長今在禦膳廚房當小宮女時期的奮鬥歷程。\n第二季的中文副標題為《長今之夢》。'),
('video-5c11ef1c2be6ab6cf6de0b97c608ff92', '綱彈Seed', 'videotype-5489db0e53fa79888b28a377af4ca1ea', 60, 270, '2002-10-05 00:00:00', 'publisher-5ae897b4f3aac7a756dd809c87e3beeb', '日文', 'UC0079年1月2日，自護公國向聯邦軍宣戰，展開了日後稱之為『一年戰爭』的世界大戰，聯邦軍為了扭轉局勢秘密進行『V作戰』，開發了聯邦軍史上第一部MS－RX78”Gundam”。8個月後，當聯邦軍的最新銳突擊登陸艦白色基地帶著新型MS到殖民星Side7測試時遭到自護軍偷襲，在混亂中一個十六歲的少年亞姆羅．雷爾坐上鋼彈迎戰，開始了”鋼彈傳說”．．．'),
('video-5cf0a2ed3cfe5832927e9dea3d5412f6', '哈利波特I-神秘的魔法石', 'videotype-aa8f465269178db04b9dd219c4d09256', 15, 100, '2001-11-16 00:00:00', 'publisher-ff1236d2a9094b0aaab666eca207b49d', '英文', '哈利波特，表面上他和一般11歲男孩沒什麼兩樣，事實上他是一個從佛地魔的攻擊唯一下存活下來的男孩。在讓他討厭的麻瓜親戚生活了10年後，他得知他的真正身份後進入霍格華茲魔法與巫術學院就讀，在那裡有他的死黨榮恩·衛斯理和妙麗·格蘭傑；這三人碰上很多的冒險，最後這些冒險讓他們發現了石內卜想要奪取魔法石。可是哈利發現是奎若想偷走魔法石。最終哈利終於見到了佛地魔的真面目，並與奎若交手，打敗奎若，奪回了魔法石。'),
('video-5df9347820f41a381c8b7f69a3f3e072', '大長今(動畫)-第二季', 'videotype-339a15027618444f8cf960a1357b534f', 50, 250, '2007-03-14 00:00:00', 'publisher-7439fa918297704928692db9d0a78f8d', '韓文', '接續第一季《長今之夢》，描述少女長今在皇宮內當小宮女時期的奮鬥歷程。\n第二季的中文副標題為《少女長今》。'),
('video-63b24f7c4a3e71d52741cb2e922b6462', '風水世家II', 'videotype-14bdc529740ecb13f48a3559c908c308', 20, 100, '2013-01-03 00:00:00', 'publisher-c1b47fd5ab82721f21dc9430ef906ba0', '中文', '《風水世家》為台灣民視於2012年製播的八點檔連續劇。全劇於2012年5月9日開鏡，拍攝與播出同步進行，於2012年7月17日接檔《父與子》首播，是台灣第一部以「風水」為主題的電視劇。'),
('video-68857c8b417df5d933af364e5b890774', '馴龍高手II', 'videotype-af803f97b5314d1c217e85ab71734080', 40, 100, '2014-05-15 00:00:00', 'publisher-70a1a37e010d51db35127058d5d9d255', '英文', '電影的劇情設定在前作故事發生之後的五年，主角小嗝嗝（Hiccup）和他的朋友們已經是一群生活在嶄新的博克島（Berk Island）上的青少年。島上的維京人們已經和龍族和平共處，學會了騎在龍背上飛行的居民們也因此大大地擴展了他們的視野。小嗝嗝更是隨著他日漸壯大的好奇心四處探索，而前往了更多前所未達的地方，卻也因此遭遇了前所未見的敵人和困難......'),
('video-73b751b5e7fcefb12f4cd4b9964f9f97', '世間情I', 'videotype-14bdc529740ecb13f48a3559c908c308', 20, 100, '2013-11-23 00:00:00', 'publisher-d9ac250154e2bdf799292f8f68e654b6', '中文', '世間情》是三立台灣台播出的八點檔連續劇，製作公司為新路山傳播。本劇接檔於《天下女人心》之後，每週一至週五晚間八點播出。'),
('video-78c32e85ae114aa00897526531ae75cf', '哈利波特VI-混血王子的背叛', 'videotype-aa8f465269178db04b9dd219c4d09256', 15, 100, '2009-07-15 00:00:00', 'publisher-ff1236d2a9094b0aaab666eca207b49d', '英文', '佛地魔進一步在麻瓜及巫師的世界中施展他的魔爪，而霍格華茲亦再也不安全。哈利懷疑學校中有佛地魔的內奸在作祟，但是鄧不利多則忙於讓他準備快將來臨的最後一戰。二人合力尋找打敗佛地魔的關鍵，而鄧不利多亦召集了他的舊戰友及同袍赫瑞司·史拉轟教授，相信他掌握著重要的線索。而同時，學生們則受到不同敵人的襲擊，在校院內引發起很大的怨憤。哈利發覺自己跟丁·湯瑪斯一樣，越來越被金妮吸引。榮恩則成為了文妲·布朗的對象，但是他卻誤吃了羅咪·凡的愛情巧克力而中了她的魔法，這些都讓妙麗心生妒忌，但她卻把自己的感覺藏於心中。校園中只有一人沒有被情所困，他專心致至地要成功揚名，縱然是投靠黑暗的勢力(馬份)……雖然愛情正在他們中間慢慢滋長，但是亦有著悲劇他們面前等候著……霍格華茲將不會再如從前一樣……'),
('video-7b2f208a4af0f31b34c966642f254797', 'Breaking Bad絕命毒師V', 'videotype-825dab02253ae2dec9b9ec64acb9e832', 50, 290, '2013-08-11 00:00:00', 'publisher-22b6bcb1b52203c9db3c285f9b8c1cec', '英文', '講述高中化學教師瓦特·懷特（Walter White）的犯罪故事。他患上了末期肺癌，加上事業不如意，在化學的天份才能無法發揮之下而人生陷入低谷，絕望的他協同曾受教於他的傑西·平克曼（Jesse Pinkman）製作及販賣冰毒，希望在他死後留下金錢解決他家庭面對的迫切財務危機。'),
('video-80b4c86e4df515f6766c2ad3261baf92', '綱彈OO-第二季', 'videotype-5489db0e53fa79888b28a377af4ca1ea', 60, 270, '2008-10-05 00:00:00', 'publisher-5ae897b4f3aac7a756dd809c87e3beeb', '日文', '西元2312年，天上人與聯合國軍在2308年進行大決戰的四年後。人類已建立地球聯邦政府。為了追求更進一步的國家間之統合，以及人類意識的統一，該政府在地球聯邦正規軍之外，設立獨立治安維持部隊「A-Laws」，目的為對所有危害地球聯邦的勢力與主義、思想等，進行非人道的壓迫，對象包括反地球聯邦的國家、純源（Katharon）反抗組織，以及再次出現的天上人。\n為了遵守與露意絲·哈利維的約定，朝著成為太空工程師之路前進的沙慈·克洛斯羅德，也身不由己地，捲進了地球聯邦政府的變革中。\n另一方面，在四年前的最終決戰中，存活下來的剎那·F·塞耶，默默注視著因為受天上人影響而變革的世界，所產生出來的變化。打倒監視者亞歷漢卓·科納後，他夢想著世界從此變得和平，再沒有任何紛爭。可是，他所看到的卻是一個由「A-Laws」所製造出來的、扭曲的和平，世界維持在「歪斜」的狀態。於是他決定與能夠改變世界的力量——「鋼彈」再次一同戰鬥。\n再次開始變化的世界中，剎那的未來將朝向何方？'),
('video-8130b7883d2f3cfa5e04295db7a733bb', 'Legal High王牌大律師II', 'videotype-8cadaac5984e2a2f5331fdda71717522', 60, 300, '2014-01-15 00:00:00', 'publisher-dac5ea4871a53173cabb1ca290271af6', '日文', '黛真知子（新垣結衣 飾）是一個充滿著正義感、憑著大無畏的精神，一股腦兒向前衝的熱血新進律師。因為一次訴訟而認識法律界神話—古美門研介（堺雅人 飾），一位毒舌、傲慢、自大，為了勝訴不擇手段，穿梭在法律灰色地帶但擁有著不敗紀錄的知名律師，此後並開始到古美門律師事務所工作。性格與想法完全地南轅北轍的兩人，在一次又一次的訴訟中不斷發生衝突，但同時又在法庭上攜手戰鬥。一對冤家拍擋緊守各自的信念，衝擊著日本司法界，要在公平與正義之間，還司法制度一個真面目。'),
('video-822756a9cf8f7dea2b424621623ad4e7', '南方四賤客-第十二季', 'videotype-f3b573d52f75392e0046482d6915a7fe', 40, 220, '2011-08-16 00:00:00', 'publisher-4a8c922f9af8afaecb52de6ebfdc1717', '英文', '《南方四賤客》（South Park）是美國喜劇中心（Comedy Central）製作的動畫劇集，由特雷·帕克和馬特·斯通創作。《南方四賤客》經常通過歪曲式的摹仿來諷刺和嘲弄美國文化和社會時事的各個方面，挑戰了許多根深蒂固的觀念和禁忌並因其中的粗口、黑色幽默和超現實幽默而著名。它在1997年首播，至2014年已播到第18季。\n本系列為第十二季。'),
('video-86bda999675b8431df7eda7e337d7154', '世間情III', 'videotype-14bdc529740ecb13f48a3559c908c308', 20, 100, '2014-10-17 00:00:00', 'publisher-d9ac250154e2bdf799292f8f68e654b6', '中文', '世間情》是三立台灣台播出的八點檔連續劇，製作公司為新路山傳播。本劇接檔於《天下女人心》之後，每週一至週五晚間八點播出。'),
('video-8e071d4f1a87843340b219e7e6dbe325', '哈利波特IV-火盃的考驗', 'videotype-aa8f465269178db04b9dd219c4d09256', 15, 100, '2005-11-18 00:00:00', 'publisher-ff1236d2a9094b0aaab666eca207b49d', '英文', '才一開學，霍格華茲魔法學校的師生們就為了即將舉行的『三巫鬥法大賽』而興奮不已，但是當『火盃』選出哈利波特成為第四位鬥士時，卻引起全校的不諒解。憑什麼才14歲的哈利波特跨越『17歲』的年齡限制，而將名字投入『火盃』中呢？ \n\n\n\n百口莫辯的哈利波特，只好承受所有人的猜疑，努力去挑戰鬥法大賽的三項艱鉅任務。但是，『佛地魔的僕人』早已盯上了哈利波特，暗中虎視眈眈的準備獵取『仇人之血』……這場『三巫鬥法大賽』背後究竟隱藏了什麼駭人聽聞的詭計？哈利波特又是否能順利通過『火盃』的考驗呢？'),
('video-9ae9ef59f98d4e20a28178eb8db8078e', 'Breaking Bad絕命毒師II', 'videotype-825dab02253ae2dec9b9ec64acb9e832', 50, 290, '2009-02-23 00:00:00', 'publisher-22b6bcb1b52203c9db3c285f9b8c1cec', '英文', '講述高中化學教師瓦特·懷特（Walter White）的犯罪故事。他患上了末期肺癌，加上事業不如意，在化學的天份才能無法發揮之下而人生陷入低谷，絕望的他協同曾受教於他的傑西·平克曼（Jesse Pinkman）製作及販賣冰毒，希望在他死後留下金錢解決他家庭面對的迫切財務危機。'),
('video-aa9ca7499dd993584f6241d005dddc71', '馴龍高手I', 'videotype-af803f97b5314d1c217e85ab71734080', 40, 100, '2010-03-26 00:00:00', 'publisher-70a1a37e010d51db35127058d5d9d255', '英文', '故事開場於虛構的維京世界，名為小嗝嗝（Hiccup）的年輕維京人渴望跟隨部落的傳統成為一位「屠龍高手」。在一天晚上意外地捕捉到了一隻傳說中的龍「夜煞」後，就逐漸地開始建立起與龍的交流，此契機進而幫助部落對他的改觀，他發現殺龍並無法解決問題，而是應以馴服來取代之。'),
('video-ab0209400397ad8f0490793a52270bf3', 'Breaking Bad絕命毒師I', 'videotype-825dab02253ae2dec9b9ec64acb9e832', 50, 290, '2008-01-20 00:00:00', 'publisher-22b6bcb1b52203c9db3c285f9b8c1cec', '英文', '講述高中化學教師瓦特·懷特（Walter White）的犯罪故事。他患上了末期肺癌，加上事業不如意，在化學的天份才能無法發揮之下而人生陷入低谷，絕望的他協同曾受教於他的傑西·平克曼（Jesse Pinkman）製作及販賣冰毒，希望在他死後留下金錢解決他家庭面對的迫切財務危機。'),
('video-ac4af3a14836d3039f0671b6aeceec0b', '哈利波特VII-死神的聖物II', 'videotype-aa8f465269178db04b9dd219c4d09256', 20, 110, '2011-07-14 00:00:00', 'publisher-ff1236d2a9094b0aaab666eca207b49d', '英文', '在終極篇的第二部，正邪一戰將會全面爆發。危機升級至前所未見的凶險，沒有一個人能置身事外。但是，只有哈利波特一人會需要獨自與佛地魔展開終極一戰。'),
('video-bf0db0fb7f092084327345e8cb5e46cf', '世間情II', 'videotype-14bdc529740ecb13f48a3559c908c308', 20, 100, '2014-04-08 00:00:00', 'publisher-d9ac250154e2bdf799292f8f68e654b6', '中文', '世間情》是三立台灣台播出的八點檔連續劇，製作公司為新路山傳播。本劇接檔於《天下女人心》之後，每週一至週五晚間八點播出。'),
('video-c71076a93b78ac335b61fe8acfb867fe', '綱彈AGE', 'videotype-5489db0e53fa79888b28a377af4ca1ea', 50, 250, '2011-10-09 00:00:00', 'publisher-5ae897b4f3aac7a756dd809c87e3beeb', '日文', '自人類移民至太空殖民地以來，經過了數百年的宇宙時代，圍繞地球圈霸權的爭奪戰爭結束，大家以為和平的時代終於到來。\nA.G.101年，突然出現的未知敵人（Unknown Enemy。以下簡稱「UE」）前來襲擊，太空殖民地「天使」完全崩毀，死傷無數。這事件就是「天使的落日」，它讓居住於地球圈的人類，再度陷入漫長的苦痛之中，而此事亦為長達一百年的戰爭揭開序幕。'),
('video-cdfb73f1c0275b0bf24a02ab136f8332', '綱彈Seed Destiny', 'videotype-5489db0e53fa79888b28a377af4ca1ea', 60, 270, '2004-10-09 00:00:00', 'publisher-5ae897b4f3aac7a756dd809c87e3beeb', '日文', '《機動戰士鋼彈 SEED DESTINY》是《機動戰士鋼彈 SEED》的續篇，機動戰士鋼彈系列之一。'),
('video-cee91e5b73173894ccb72dd7def3d601', '綱彈G Reconquista', 'videotype-5489db0e53fa79888b28a377af4ca1ea', 70, 300, '2014-10-02 00:00:00', 'publisher-5ae897b4f3aac7a756dd809c87e3beeb', '日文', '宇宙移民與宇宙戰爭的歷史—宇宙世紀（UC）終結後，時光飛逝，人們迎來新的歷史Regild Century（RC），並開始了繁榮與和平的生活。\nRC1014年，聳立大地、連接地球和宇宙的軌道天梯「首都塔」，從宇宙中為人類帶來作為地球能量之源的光子電池（Photon Battery），故被視為聖地。其守護組織「首都衛隊」候補生貝爾利・傑納姆在初次飛行的時候遭到所屬不明的MS「G-Self」攻擊。貝爾利使用作業用MS「雷克汀」與其交戰並成功捕獲。然而「G-Self」的駕駛者，名為艾妲·雷哈頓的宇宙海賊少女卻對貝爾利產生了某種感覺，不滿足特定條件便不會啟動的「G-Self」亦對貝爾利產生了某種反應。宇宙海賊和艾妲的目的、被「G-Self」選中的貝爾利的命運、令RC全體動搖的真相――這一切只不過是Reconguista的開始。'),
('video-ea81475120aad331430459880bd78364', '閻小妹', 'videotype-f3b573d52f75392e0046482d6915a7fe', 60, 250, '2012-08-17 00:00:00', 'publisher-c1d61fb802af01a4e654b5c61690485c', '中文', '妖怪世界裡分為東、西兩大城域，雙方距離遙遠少有往來，即使偶有接觸也因彼此不了解而發生衝突；為了促進交流，西方的西冥市市長派出自己的兒子迪米歐前往東方的東閰鎮留學。來到東閰鎮的迪米歐與鎮長的女兒閰小妹結為好友，兩人一起學習、一起探險，帶領觀眾重新認識華人文化裡最具奇幻魅力的異想世界。\n故事主舞台東閰鎮的設計採用中國古代街景，角色有人類、東方傳說人物、妖怪、擬人化的動物。'),
('video-eef9c0f246fd5271d966c290a9c6fcf3', 'Breaking Bad絕命毒師IV', 'videotype-825dab02253ae2dec9b9ec64acb9e832', 50, 290, '2012-01-03 00:00:00', 'publisher-22b6bcb1b52203c9db3c285f9b8c1cec', '英文', '講述高中化學教師瓦特·懷特（Walter White）的犯罪故事。他患上了末期肺癌，加上事業不如意，在化學的天份才能無法發揮之下而人生陷入低谷，絕望的他協同曾受教於他的傑西·平克曼（Jesse Pinkman）製作及販賣冰毒，希望在他死後留下金錢解決他家庭面對的迫切財務危機。'),
('video-f42df0e5dc3952ece60ceb41375a20f4', '風水世家II', 'videotype-14bdc529740ecb13f48a3559c908c308', 20, 100, '2013-07-23 00:00:00', 'publisher-c1b47fd5ab82721f21dc9430ef906ba0', '中文', '《風水世家》為台灣民視於2012年製播的八點檔連續劇。全劇於2012年5月9日開鏡，拍攝與播出同步進行，於2012年7月17日接檔《父與子》首播，是台灣第一部以「風水」為主題的電視劇。'),
('video-f61e9cebdbe6a7c53187257157e4649b', '風水世家I', 'videotype-14bdc529740ecb13f48a3559c908c308', 20, 100, '2012-07-17 00:00:00', 'publisher-c1b47fd5ab82721f21dc9430ef906ba0', '中文', '《風水世家》為台灣民視於2012年製播的八點檔連續劇。全劇於2012年5月9日開鏡，拍攝與播出同步進行，於2012年7月17日接檔《父與子》首播，是台灣第一部以「風水」為主題的電視劇。'),
('video-f90895683b39242478ca50900ff45f62', 'Breaking Bad絕命毒師III', 'videotype-825dab02253ae2dec9b9ec64acb9e832', 50, 290, '2010-05-21 00:00:00', 'publisher-22b6bcb1b52203c9db3c285f9b8c1cec', '英文', '講述高中化學教師瓦特·懷特（Walter White）的犯罪故事。他患上了末期肺癌，加上事業不如意，在化學的天份才能無法發揮之下而人生陷入低谷，絕望的他協同曾受教於他的傑西·平克曼（Jesse Pinkman）製作及販賣冰毒，希望在他死後留下金錢解決他家庭面對的迫切財務危機。'),
('video-f916ec317ec664898def6ba860496537', '花木蘭', 'videotype-af803f97b5314d1c217e85ab71734080', 35, 90, '1998-06-18 00:00:00', 'publisher-58427c2321ea73bf6ee94ad32e3dfb7b', '英文', '故事開始於中國的邊境，『萬里長城』。以『單于』（Shan Yu）為首的『匈奴人』攻破了長城的防線，入侵了中國。『中國皇帝』（Emperor）於是發動了一個動員令，要求每一個家庭都要派出一位男人上戰場準備攻打匈奴。\n花家（Fa Family）的獨生女『花木蘭』（Mulan）正準備前往媒婆那裡請求她為自己找到適合的丈夫。但是，由於蟋蟀（Cri-kee）的跟隨，導致發生了突發狀況，不但惹怒了媒婆，還以一個很尷尬的場面結束。之後，花家也接到了參戰的通知書，原本應該是花家唯一的男人，也就是木蘭的父親花弧（Fa Zhou）應該要代表花家參戰的，但由於花弧年紀已長，身體又有障礙，所以不太適合上戰場，木蘭就挺身而出，向官兵提出這個意見，但花弧阻止了木蘭。木蘭後來在不經父親的同意下，偷偷離開了家，前往軍營。花家的守護龍木須（Mushu）被花家的祖先派遣了一個任務，就是跟著木蘭一起旅行，確保她的安全，並榮耀花家，而好奇的蟋蟀也跟著他一起前去......'),
('video-f9c6736bb2a9b8cee3d0ab37894d1c1b', '風起', 'videotype-a3cace6e71b49a080207305189b88eff', 50, 150, '2013-07-20 00:00:00', 'publisher-0df18af26c9fb87d8444933399d0f2bb', '日文', '堀越二郎從小夢想設計出自己的飛機，翱翔天際。經歷關東大地震及經濟大蕭條，乃至東京就讀大學畢業後，成了航空工業的菁英，並與以前在火車上邂逅的女孩菜穗子重逢。\n雖身患肺結核，但菜穗子仍一直支持、鼓勵二郎；在愛情的力量及努力不懈的精神驅使下，二郎終於實現夢想，研發出優異的九試單座戰鬥機……');

-- --------------------------------------------------------

--
-- 資料表結構 `videotype`
--

CREATE TABLE IF NOT EXISTS `videotype` (
  `videoTypeID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `videoTypeName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `videoTypeMode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`videoTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `videotype`
--

INSERT INTO `videotype` (`videoTypeID`, `videoTypeName`, `videoTypeMode`) VALUES
('videotype-14bdc529740ecb13f48a3559c908c308', '影集', '鄉土劇'),
('videotype-339a15027618444f8cf960a1357b534f', '動畫', '電視劇改編'),
('videotype-5489db0e53fa79888b28a377af4ca1ea', '動畫', '機器人動畫'),
('videotype-645cda47e1a647a3f9aac8aff64fbfe0', '電影', '喜劇'),
('videotype-825dab02253ae2dec9b9ec64acb9e832', '影集', '犯罪驚悚劇'),
('videotype-8cadaac5984e2a2f5331fdda71717522', '影集', '喜劇'),
('videotype-a3cace6e71b49a080207305189b88eff', '電影', '青春'),
('videotype-aa8f465269178db04b9dd219c4d09256', '電影', '奇幻魔法'),
('videotype-af803f97b5314d1c217e85ab71734080', '電影', '冒險'),
('videotype-f3b573d52f75392e0046482d6915a7fe', '動畫', '奇幻喜劇');

-- --------------------------------------------------------

--
-- 資料表結構 `wanted`
--

CREATE TABLE IF NOT EXISTS `wanted` (
  `wantedID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vedioID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`wantedID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
