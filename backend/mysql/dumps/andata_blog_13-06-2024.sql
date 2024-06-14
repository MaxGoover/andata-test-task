-- MySQL dump 10.13  Distrib 8.2.0, for Linux (x86_64)
--
-- Host: localhost    Database: andata_blog
-- ------------------------------------------------------
-- Server version	8.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `author_email` varchar(320) NOT NULL,
  `author_username` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (2,'maxgoover@gmail.com','MaxGoover','Почему это красиво? Странный эксперимент со спиралью Фибоначчи','<p>Недавно делал небольшой скрипт для браузера, который может рисовать спираль Фибоначчи поверх фотографий на веб-странице. Все это делалось для того, чтобы проверить свою догадку, по поводу форм встречающихся в природе - вписываются ли они в спираль или нет. Рисовать я ее хотел не поверх котов, а поверх фото, которые немного даже поинтереснее будут, и поэтому и пишу такое длинное предисловие, потому что в отличие от поста в личном блоге, здесь аудитория может отнестись к таком не сильно положительно. Но с другой стороны, все мы люди, поэтому я рискну рассказать об этом эксперименте тут на Хабре</p><p>В фотографии часто используется правило <a href=\"https://www.fotosklad.ru/expert/articles/vse-cto-vam-nuzno-znat-pro-zolotoe-secenie/\" rel=\"noopener noreferrer nofollow\">третей и золотое сечение </a>-  фраза буквально из статьи которая выдается первой по поиску в Яндексе, при запросе золотое сечение в фотографии. Вообще есть подозрение, что не все фото делаются специально по этому правилу,  но итоге почти все \"красивые\" фото оказываются соответствующими такому  правилу, и человек просто любуется таким фото, не подозревая что  любуется математикой. Мало того, любуясь фотографиями девушек, я обратил  внимание, что и там часто присутствует такое же золотое сечение -  женские формы и изгибы тела очень часто хорошо вписываются в золотую  спираль. Смотрите сами:  </p>','2024-06-13 19:01:58',NULL,NULL),(3,'john_doe@gmail.com','John Doe','Есть ли смысл покупать курсы для вкатывания в IT','<p>Привет, Хабр! В последние годы курсы по вхождению в сферу IT стали чем-то обыденным, но действительно ли они так хороши и представляют собой выигрышный билет в индустрию? Можно ли достичь успеха, просто оплатив их и прослушав вебинары, или необходимо вложить дополнительные усилия? Обо всем этом я расскажу в данной статье.</p><h2>Продай мне эти курсы пожалуйста</h2><p>Сегодня часто говорят, что если раньше автомобили создавали инженеры, то сейчас этим занимаются скорее маркетологи. Аналогичное утверждение можно сделать и относительно курсов по IT. До наступления золотой лихорадки в этой сфере курсы проводили обычные разработчики, записывая свои уроки на шипящий микрофон. Они делились своим опытом по тем областям, в которых работали. Многие опытные специалисты в области IT получали свои знания, занимаясь самообразованием и исследуя профессиональную литературу вместе. Основная цель этих разработчиков заключалась не в продаже, а в обмене опытом и повышении уровня знаний в сфере.</p>','2024-06-13 19:51:30',NULL,NULL),(4,'maxgoover@gmail.com','MaxGoover','Энтузиаст установил Windows 11 на Nintendo Switch','<p>Пользователь X под ником PatRyk <a href=\"https://twitter.com/Patrosi73/status/1789756239984890165\" rel=\"noopener noreferrer nofollow\">установил </a>Windows 11 на консоль Nintendo Switch. По его словам, у него получился «самый медленный компьютер в мире», что недалеко от правды: только загрузка рабочего стола занимает более двух минут.</p><p>Как <a href=\"https://www.windowslatest.com/2024/05/13/watch-dev-runs-windows-11-arm-on-nintendo-switch-using-qemu-linux-emulation/\" rel=\"noopener noreferrer nofollow\">уточняет </a>PatRyk, он использовал версию Windows 11 ARM с включённым KVM. Для начала он установил на SD-карту консоли Fedora Linux через Switchroot. По его словам, использование Switchroot-дистрибутива Fedora обязательно, потому что это единственная версия с поддержкой KVM.</p><p>После настройки Fedora он использовал <a href=\"https://gist.github.com/Vogtinator/293c4f90c5e92838f7e72610725905fd\" rel=\"noopener noreferrer nofollow\">скрипт </a>для запуска Windows 11 в эмуляторе QEMU, который ему пришлось модифицировать, чтобы он правильно работал со Switch. PatRyk выделил виртуальной машине 4 ядра и 3 ГБ ОЗУ, что близко к максимуму (у Switch всего 4 ГБ ОЗУ).</p>','2024-06-13 19:54:09',NULL,NULL);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int unsigned NOT NULL,
  `author_email` varchar(320) NOT NULL,
  `author_username` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,2,'maxgoover@gmail.com','MaxGoover','Это - заголовок комментария','Каждый раз когда вижу эти спирали к фотографиям, прям слышу как где-то кричит сова.','2024-06-13 19:56:03',NULL,NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-13 19:57:23
