-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: biopedclinic.com    Database: bioped
-- ------------------------------------------------------
-- Server version	5.6.44-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aboutus_slider`
--

DROP TABLE IF EXISTS `aboutus_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `aboutus_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `content` longtext,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aboutus_slider`
--

LOCK TABLES `aboutus_slider` WRITE;
/*!40000 ALTER TABLE `aboutus_slider` DISABLE KEYS */;
INSERT INTO `aboutus_slider` VALUES (21,'rimpi','1564742219.jpg',NULL,'Active','2019-08-09 11:44:24','2019-08-09 11:44:24'),(22,'rimpi','1564742240.jpg',NULL,'Active','2019-08-09 11:44:24','2019-08-09 11:44:24');
/*!40000 ALTER TABLE `aboutus_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_expert`
--

DROP TABLE IF EXISTS `ask_expert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ask_expert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_expert`
--

LOCK TABLES `ask_expert` WRITE;
/*!40000 ALTER TABLE `ask_expert` DISABLE KEYS */;
INSERT INTO `ask_expert` VALUES (1,'rimpi','duywudfe','98975756','wdwdwad','2019-08-09 11:44:24','2019-08-09 11:44:24'),(2,'rimpi','fefreta','8976543','scder','2019-08-09 11:44:24','2019-08-09 11:44:24'),(3,'jit','a@gmail.com','9831580843','recwa wre','2019-08-09 11:44:24','2019-08-09 11:44:24'),(4,'karuna','ah@gmail.com','9876522','fweaWefewfew??','2019-08-09 11:44:24','2019-08-09 11:44:24'),(5,'sonai','ah@gmail.com','9831580843','adwatfduyqdfifdiuqWFDUYFW?','2019-08-09 11:44:24','2019-08-09 11:44:24'),(6,'student','a@gmail.com','9831580843','ertyuikhjgf?','2019-08-09 11:44:24','2019-08-09 11:44:24');
/*!40000 ALTER TABLE `ask_expert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_questions`
--

DROP TABLE IF EXISTS `ask_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ask_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_questions`
--

LOCK TABLES `ask_questions` WRITE;
/*!40000 ALTER TABLE `ask_questions` DISABLE KEYS */;
INSERT INTO `ask_questions` VALUES (1,'rimpi','szfwefre','234567896','crefswfdqwdwe','2019-08-09 11:44:24','2019-08-09 11:44:24');
/*!40000 ALTER TABLE `ask_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `select_service` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `comment` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,'pinaki','pinaki@ugu','98765432',30,'Cosmetic Dentistry','2019-08-08','2:11PM','good','2019-08-09 11:44:24','2019-08-09 11:44:24'),(2,'rimpi','feiuwdfui','123456',22,'Cosmetic Dentistry','2019-08-08','4:16 PM','fefrwe4','2019-08-09 11:44:24','2019-08-09 11:44:24'),(3,'sonali','OGOEIG','123456',22,'Orthodontics','2019-08-08','4:17 PM','ewef','2019-08-09 11:44:24','2019-08-09 11:44:24'),(4,'sonal','werct4','2345',33,'Cosmetic Dentistry','2019-08-08','4:18 PM','dwedwe','2019-08-09 11:44:24','2019-08-09 11:44:24'),(5,'rimpi','DCrw','234567',44,'Children`s Dentistry','2019-08-08','4:19 PM','fcwrwe','2019-08-09 11:44:24','2019-08-09 11:44:24'),(7,'monali','lgfoiegfoi','98696149',27,'Orthodontics','2019-08-08','4:22 PM','deadwed','2019-08-09 11:44:24','2019-08-09 11:44:24'),(8,'rimpi','dwcE','2345678',55,'Cosmetic Dentistry','2019-08-08','4:23 PM','GOOD','2019-08-09 11:44:24','2019-08-09 11:44:24'),(9,'pratik','udiuyd','977542678',80,'Dental Implants','2019-08-08','4:28 PM','joiuytr','2019-08-09 11:44:24','2019-08-09 11:44:24'),(10,'dj','zwetr','1234567',55,'Children`s Dentistry','2019-08-08','4:34 PM','good','2019-08-09 11:44:24','2019-08-09 11:44:24'),(11,'karuna','taotrwoe','806480164',48,'Orthodontics','2019-08-08','4:35 PM','dwqdeq','2019-08-09 11:44:24','2019-08-09 11:44:24'),(12,'rani','fuwewftouewto','23456',34,'General Dentistry','2019-08-08','4:49 PM','xsDew','2019-08-09 11:44:24','2019-08-09 11:44:24'),(13,'tulika','ecer4e','123456',45,'Dental Implants','2019-08-08','4:52 PM','good','2019-08-09 11:44:24','2019-08-09 11:44:24'),(14,'radhika','ydfuyruyrfyuf','9877542',71,'Orthodontics','2019-08-08','4:53 PM','good','2019-08-09 11:44:24','2019-08-09 11:44:24'),(15,'pratik','udgwuaewtg','8976543',55,'Orthodontics','2019-08-08','4:54 PM','frts','2019-08-09 11:44:24','2019-08-09 11:44:24'),(16,'surya','hfnnyufnyj','87654',37,'Orthodontics','2019-08-08','4:57 PM','hyj','2019-08-09 11:44:24','2019-08-09 11:44:24'),(17,'arpita sinha','CFDSFEwVSFRGR@','23456789',30,'General Dentistry','2019-08-09','12:40 PM','FDYUEFDUWFDVRU','2019-08-09 11:44:24','2019-08-09 11:44:24'),(18,'ARPITA','fgeiwufgu','2345678896',22,'Dental Implants','2019-08-09','12:44 PM','fwydtewgdgifeuqgtderf','2019-08-09 11:44:24','2019-08-09 11:44:24'),(19,'sayari','addw@fafr','354256673',23,'General Dentistry','2019-08-12','1:52 PM','dfefwqfqw','2019-08-12 15:22:36','2019-08-12 15:22:36');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms`
--

DROP TABLE IF EXISTS `cms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms`
--

LOCK TABLES `cms` WRITE;
/*!40000 ALTER TABLE `cms` DISABLE KEYS */;
INSERT INTO `cms` VALUES (1,'hfhgfg','demo','<p>wow</p>','2019-08-09 11:44:24','2019-08-09 11:44:24'),(2,'home-section1','25 Years of Medical Excellence','<div class=\"row mt-2 mt-md-3 mt-lg-0\">\r\n\r\n<div class=\"col-md-6\">\r\n\r\n<div class=\"title-wrap hidden d-none d-lg-block text-center text-md-left\">\r\n\r\n<div class=\"h-sub\">25 Years of Medical Excellence</div>\r\n\r\n\r\n\r\n<h2>Welcome to Our Clinic</h2>\r\n\r\n</div>\r\n\r\n\r\n\r\n<div>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n\r\n\r\n\r\n<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n</div>\r\n\r\n\r\n\r\n<div class=\"mt-2 mt-md-4\">&nbsp;</div>\r\n\r\n</div>\r\n\r\n\r\n\r\n<div class=\"col-md-6\"><img src=\"http://biopedclinic.com/laravel-filemanager/photos/1/hbot-chamber (1).jpg\" /></div>\r\n\r\n</div>','2019-08-09 11:44:24','2019-08-12 12:46:07'),(3,'home-section2','Mission & Vision Statement','<div class=\"title-wrap text-center\">\r\n                <h2 class=\"h1\">Mission & Vision Statement</h2>\r\n                <div class=\"h-decor\"></div>\r\n            </div>\r\n            <p class=\"max-900 text-center\">We use a multi-modality approach to first identify the hurdles facing a patient’s health,\r\n                <br> and then identify methods to effectively build a better picture of health.</p>\r\n            <div class=\"row js-icn-carousel icn-carousel flex-column flex-sm-row text-center text-sm-left\" data-slick=\'{\"slidesToShow\": 3, \"responsive\":[{\"breakpoint\": 1024,\"settings\":{\"slidesToShow\": 2}}]}\'>\r\n                <div class=\"col-md\">\r\n                    <div class=\"icn-text\">\r\n                        <div class=\"icn-text-circle\"><i class=\"icon-medicine\"></i></div>\r\n                        <div>\r\n                            <h5 class=\"icn-text-title\">Our Mission</h5>\r\n                            <p>We use a multi-modality approach to first identify the hurdles facing a patient’s health, and then identify methods to effectively build a better picture of health.</p>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-md\">\r\n                    <div class=\"icn-text\">\r\n                        <div class=\"icn-text-circle\"><i class=\"icon-pharmacy\"></i></div>\r\n                        <div>\r\n                            <h5 class=\"icn-text-title\">Vision Statement</h5>\r\n                            <p>Our programs are co-developed by doctors and fitness specialists, aiming to empower our patients with the collective knowledge of our multidisciplinary team. </p>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-md\">\r\n                    <div class=\"icn-text\">\r\n                        <div class=\"icn-text-circle\"><i class=\"icon-principles\"></i></div>\r\n                        <div>\r\n                            <h5 class=\"icn-text-title\">Clinic Principles</h5>\r\n                            <p>We are committed to principles to aligning operations and strategies with universally accepted principles in the areas of human rights, environment and anti-corruption.</p>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>','2019-08-09 11:44:24','2019-08-09 11:44:24'),(4,'home-section3','Additional Services','<div class=\"row no-gutters flex-wrap flex-md-nowrap\">\r\n\r\n					<div class=\"col-md col-lg-6\">\r\n\r\n						<div class=\"services-tab-wrap float-right\">\r\n\r\n							<div class=\"service-tab-banner d-sm-none mb-3\">\r\n\r\n								<img src=\"http://localhost/laravel-filemanager/photos/1/banner-right.jpg\" alt=\"\">\r\n\r\n							</div>\r\n\r\n							<h2 class=\"h1\">Additional Services</h2>\r\n\r\n							<div class=\"d-flex flex-column flex-md-row position-relative mt-1 mt-md-3\">\r\n\r\n								<div class=\"nav nav-pills mt-2 mt-md-0\" role=\"tablist\">\r\n\r\n									<a class=\"nav-link active\" data-toggle=\"pill\" href=\"#tab-D\" role=\"tab\">Lab Services</a>\r\n\r\n									<a class=\"nav-link\" data-toggle=\"pill\" href=\"#tab-E\" role=\"tab\">Diagnostic</a>\r\n\r\n									<a class=\"nav-link\" data-toggle=\"pill\" href=\"#tab-F\" role=\"tab\">Other Services</a>\r\n\r\n								</div>\r\n\r\n							</div>\r\n\r\n							<div id=\"tab-content\" class=\"tab-content mt-1\">\r\n\r\n								<div id=\"tab-D\" class=\"tab-pane fade show active\" role=\"tabpanel\">\r\n\r\n									<p>Laboratory tests play a critical role in ensuring your diagnosis is accurate and your treatment is appropriate. </p>\r\n\r\n									<div class=\"row\">\r\n\r\n										<div class=\"col-sm\">\r\n\r\n											<ul class=\"marker-list-md-line\">\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n											</ul>\r\n\r\n										</div>\r\n\r\n										<div class=\"col-sm d-none d-sm-block\">\r\n\r\n											<ul class=\"marker-list-md-line\">\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n											</ul>\r\n\r\n										</div>\r\n\r\n									</div>\r\n\r\n								</div>\r\n\r\n								<div id=\"tab-E\" class=\"tab-pane fade\" role=\"tabpanel\">\r\n\r\n									<p>Diagnostic play a critical role in ensuring your diagnosis is accurate and your treatment is appropriate. </p>\r\n\r\n									<div class=\"row\">\r\n\r\n										<div class=\"col-sm\">\r\n\r\n											<ul class=\"marker-list-md-line\">\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n											</ul>\r\n\r\n										</div>\r\n\r\n										<div class=\"col-sm\">\r\n\r\n											<ul class=\"marker-list-md-line\">\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n											</ul>\r\n\r\n										</div>\r\n\r\n									</div>\r\n\r\n								</div>\r\n\r\n								<div id=\"tab-F\" class=\"tab-pane fade\" role=\"tabpanel\">\r\n\r\n									<p>Diagnostic play a critical role in ensuring your diagnosis is accurate and your treatment is appropriate. </p>\r\n\r\n									<div class=\"row\">\r\n\r\n										<div class=\"col-sm-7\">\r\n\r\n											<ul class=\"marker-list-md-line\">\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n											</ul>\r\n\r\n										</div>\r\n\r\n										<div class=\"col-sm-5\">\r\n\r\n											<ul class=\"marker-list-md-line\">\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n												<li>Lorem ipsum test dollor</li>\r\n\r\n											</ul>\r\n\r\n										</div>\r\n\r\n									</div>\r\n\r\n								</div>\r\n\r\n							</div>\r\n\r\n						</div>\r\n\r\n					</div>\r\n\r\n					<div class=\"col-md-auto col-lg-6 service-tab-banner d-none d-sm-block\">\r\n\r\n						<img src=\"http://localhost/laravel-filemanager/photos/1/banner-right.jpg\" alt=\"\">\r\n\r\n					</div>\r\n\r\n				</div>','2019-08-09 11:44:24','2019-08-12 12:46:53'),(5,'home-section4','Online Appointments And Prescriptions','<div class=\"banner-center bg-cover\" style=\"background-image: url(\'http://biopedclinic.com/laravel-filemanager/photos/1/banner-center-02.jpg\')\">\r\n\r\n<div class=\"banner-center-caption text-center\">\r\n\r\n<div class=\"banner-center-text1 max-450-md\">Online Appointments And Prescriptions</div>\r\n\r\n\r\n\r\n<div class=\"banner-center-text4\">You can now book a limited amount of doctors&rsquo; appointments online</div>\r\n\r\n<a href=\"#\" data-toggle=\"modal\" data-target=\"#modalBookingForm\" class=\"btn btn-white mt-2 mt-sm-3 mt-lg-5\"><i class=\"icon-right-arrow\"></i><span>Book an appointment</span><i class=\"icon-right-arrow\"></i></a>\r\n\r\n</div>\r\n\r\n</div>','2019-08-09 11:44:24','2019-08-12 12:47:41'),(6,'home-section5','Patient Information','<div id=\"tab-content\" class=\"tab-content mt-sm-2\">\r\n								<div id=\"tab-A\" class=\"tab-pane fade show active\" role=\"tabpanel\">\r\n									<div id=\"faqAccordion1\" class=\"faq-accordion\" data-children=\".faq-item\">\r\n										<div class=\"faq-item\">\r\n											<a data-toggle=\"collapse\" data-parent=\"#faqAccordion1\" href=\"#faqItem1\" aria-expanded=\"true\"><span>1.</span><span>How do I make an appointment?</span></a>\r\n											<div id=\"faqItem1\" class=\"collapse show faq-item-content\" role=\"tabpanel\">\r\n												<div>\r\n													<p>If you would like to make an appointment with one of our practitioners, please contact our reception staff. Alternatively you may book your appointments online. Every effort will be made to accommodate your preferred time and choice of practitioner. </p>\r\n												</div>\r\n											</div>\r\n										</div>\r\n										<div class=\"faq-item\">\r\n											<a data-toggle=\"collapse\" data-parent=\"#faqAccordion1\" href=\"#faqItem2\" aria-expanded=\"false\" class=\"collapsed\"><span>2.</span><span>How do I get a copy of my records to another provider? </span></a>\r\n											<div id=\"faqItem2\" class=\"collapse faq-item-content\" role=\"tabpanel\">\r\n												<div>\r\n													<p>\r\n														Everyone’s needs are different, so have a chat to your dentist about how often you need to have your teeth checked by them based on the condition of your mouth, teeth and gums. It’s recommended that children see their dentist at least once a year.\r\n													</p>\r\n												</div>\r\n											</div>\r\n										</div>\r\n										<div class=\"faq-item\">\r\n											<a data-toggle=\"collapse\" data-parent=\"#faqAccordion1\" href=\"#faqItem3\" aria-expanded=\"false\" class=\"collapsed\"><span>3.</span><span>Is there a charge for copies of my medical record? </span></a>\r\n											<div id=\"faqItem3\" class=\"collapse faq-item-content\" role=\"tabpanel\">\r\n												<div>\r\n													<p>\r\n														Everyone’s needs are different, so have a chat to your dentist about how often you need to have your teeth checked by them based on the condition of your mouth, teeth and gums. It’s recommended that children see their dentist at least once a year.\r\n													</p>\r\n												</div>\r\n											</div>\r\n										</div>\r\n										<div class=\"faq-item\">\r\n											<a data-toggle=\"collapse\" data-parent=\"#faqAccordion1\" href=\"#faqItem4\" aria-expanded=\"false\" class=\"collapsed\"><span>4.</span><span>How do I assure that my person I designate has access to my medical records? </span></a>\r\n											<div id=\"faqItem4\" class=\"collapse faq-item-content\" role=\"tabpanel\">\r\n												<div>\r\n													<p>\r\n														Everyone’s needs are different, so have a chat to your dentist about how often you need to have your teeth checked by them based on the condition of your mouth, teeth and gums. It’s recommended that children see their dentist at least once a year.\r\n													</p>\r\n												</div>\r\n											</div>\r\n										</div>\r\n									</div>\r\n								</div>\r\n								<div id=\"tab-B\" class=\"tab-pane fade\" role=\"tabpanel\">\r\n									<div id=\"faqAccordion2\" class=\"faq-accordion\" data-children=\".faq-item\">\r\n										<div class=\"faq-item\">\r\n											<a data-toggle=\"collapse\" data-parent=\"#faqAccordion2\" href=\"#faqItem21\" aria-expanded=\"true\"><span>1.</span><span>How can I improve my oral hygiene?</span></a>\r\n											<div id=\"faqItem21\" class=\"collapse show faq-item-content\" role=\"tabpanel\">\r\n												<div>\r\n													<p>\r\n														Everyone’s needs are different, so have a chat to your dentist about how often you need to have your teeth checked by them based on the condition of your mouth, teeth and gums. It’s recommended that children see their dentist at least once a year.\r\n													</p>\r\n												</div>\r\n											</div>\r\n										</div>\r\n										<div class=\"faq-item\">\r\n											<a data-toggle=\"collapse\" data-parent=\"#faqAccordion2\" href=\"#faqItem22\" aria-expanded=\"false\" class=\"collapsed\"><span>2.</span><span>How do I know if my teeth are healthy?</span></a>\r\n											<div id=\"faqItem22\" class=\"collapse faq-item-content\" role=\"tabpanel\">\r\n												<div>\r\n													<p>\r\n														Everyone’s needs are different, so have a chat to your dentist about how often you need to have your teeth checked by them based on the condition of your mouth, teeth and gums. It’s recommended that children see their dentist at least once a year.\r\n													</p>\r\n												</div>\r\n											</div>\r\n										</div>\r\n										<div class=\"faq-item\">\r\n											<a data-toggle=\"collapse\" data-parent=\"#faqAccordion2\" href=\"#faqItem23\" aria-expanded=\"false\" class=\"collapsed\"><span>3.</span>Why are regular dental assessments so important?</a>\r\n											<div id=\"faqItem23\" class=\"collapse faq-item-content\" role=\"tabpanel\">\r\n												<div>\r\n													<p>\r\n														Everyone’s needs are different, so have a chat to your dentist about how often you need to have your teeth checked by them based on the condition of your mouth, teeth and gums. It’s recommended that children see their dentist at least once a year.\r\n													</p>\r\n												</div>\r\n											</div>\r\n										</div>\r\n										<div class=\"faq-item\">\r\n											<a data-toggle=\"collapse\" data-parent=\"#faqAccordion2\" href=\"#faqItem24\" aria-expanded=\"false\" class=\"collapsed\"><span>4.</span><span>How often 1 should I visit my dentist?</span></a>\r\n											<div id=\"faqItem24\" class=\"collapse faq-item-content\" role=\"tabpanel\">\r\n												<div>\r\n													<p>\r\n														Everyone’s needs are different, so have a chat to your dentist about how often you need to have your teeth checked by them based on the condition of your mouth, teeth and gums. It’s recommended that children see their dentist at least once a year.\r\n													</p>\r\n												</div>\r\n											</div>\r\n										</div>\r\n									</div>\r\n								</div>\r\n							</div>','2019-08-09 11:44:24','2019-08-09 11:44:24'),(7,'home-section6','Looking for','<div class=\"banner-call\">\r\n\r\n<div class=\"row no-gutters\">\r\n\r\n<div class=\"col-sm-5 col-lg-5 order-2 order-sm-1 mt-3 mt-md-0 text-center text-md-right\"><img alt=\"\" class=\"shift-left-1\" src=\"http://biopedclinic.com/laravel-filemanager/photos/1/banner-callus.jpg\" /></div>\r\n\r\n\r\n\r\n<div class=\"col-sm-7 col-lg-7 col-lg-7 d-flex align-items-center order-1 order-sm-2\">\r\n\r\n<div class=\"text-center pt-2 pt-lg-8\">\r\n\r\n<h2>Looking for a <span style=\"color:#3399cc\">Certified Doctor &amp;</span></h2>\r\n\r\n\r\n\r\n<h2><span style=\"color:#3399cc\">diagnostics?</span></h2>\r\n\r\n\r\n\r\n<div class=\"h-decor\">&nbsp;</div>\r\n\r\n\r\n\r\n<p>We&#39;re always accepting new patients! We believe in providing the best possible care to all our existing patients and welcome new patients to sample the service we have to offer.</p>\r\n\r\n\r\n\r\n<div class=\"mt-3 mt-lg-4\"><a class=\"banner-call-phone\" href=\"#\">1-800-267-0000</a></div>\r\n\r\n</div>\r\n\r\n</div>\r\n\r\n</div>\r\n\r\n</div>','2019-08-09 11:44:24','2019-08-12 12:48:33'),(9,'aboutus-About-Our-Clinic','about','<div class=\"text-center mb-2  mb-md-3 mb-lg-4\">\r\n\r\n<div class=\"h-sub theme-color\">Some subtitles will goes here</div>\r\n\r\n\r\n\r\n<h1>About Our Clinic</h1>\r\n\r\n\r\n\r\n<div class=\"h-decor\">&nbsp;</div>\r\n\r\n</div>\r\n\r\n\r\n\r\n<div class=\"container\">\r\n\r\n<div class=\"row\">\r\n\r\n<div class=\"col-lg-6 text-center text-lg-left pr-md-4\"><img alt=\"\" class=\"w-100\" src=\"http://biopedclinic.com/laravel-filemanager/photos/1/about-01.jpg\" />\r\n\r\n<div class=\"row mt-3\">\r\n\r\n<div class=\"col-6\"><img alt=\"\" class=\"w-100\" src=\" http://biopedclinic.com/laravel-filemanager/photos/1/hyperbaric-therapy-chamber-1024x765.jpg\" /></div>\r\n\r\n\r\n\r\n<div class=\"col-6\"><img alt=\"\" class=\"w-100\" src=\" http://biopedclinic.com/laravel-filemanager/photos/1/hyperbaric-chamber-hbot-chamber-hyperbaric-oxygen-therapy-chamber-600x450.jpg\" /></div>\r\n\r\n</div>\r\n\r\n</div>\r\n\r\n\r\n\r\n<div class=\"col-lg-6 mt-3 mt-lg-0\">\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n\r\n\r\n\r\n<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.:</p>\r\n\r\n\r\n\r\n<ul>\r\n\r\n	<li>it is a long established fact that a reader will be distracted</li>\r\n\r\n	<li>it is a long established fact that a reader will be distracted</li>\r\n\r\n	<li>it is a long established fact that a reader will be distracted</li>\r\n\r\n	<li>it is a long established fact that a reader will be distracted</li>\r\n\r\n</ul>\r\n\r\n\r\n\r\n<div class=\"mt-3 mt-md-7\">&nbsp;</div>\r\n\r\n\r\n\r\n<h3>Mission / Vision Statement</h3>\r\n\r\n\r\n\r\n<div class=\"mt-0 mt-md-4\">Unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>\r\n\r\n</div>\r\n\r\n</div>\r\n\r\n</div>','2019-08-09 11:44:24','2019-08-12 12:49:34'),(10,'aboutus-Our-Advantages','Our Advantages','<div class=\"row no-gutters\">\r\n\r\n					<div class=\"col-xl-6 bg-grey\">\r\n\r\n						<div class=\"max-670 mx-lg-auto px-15\">\r\n\r\n							<div class=\"title-wrap\">\r\n\r\n								<h2 class=\"h1\">Our <span class=\"theme-color\">Advantages</span></h2>\r\n\r\n							</div>\r\n\r\n							<div class=\"mt-lg-5\"></div>\r\n\r\n							<div class=\"row\">\r\n\r\n								<div class=\"col-sm-7\">\r\n\r\n									<ul class=\"marker-list-md\">\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n									</ul>\r\n\r\n								</div>\r\n\r\n								<div class=\"col-sm-5 mt-1 mt-sm-0\">\r\n\r\n									<ul class=\"marker-list-md\">\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n										<li>Lorem ipsum sit ammet dollors</li>\r\n\r\n									</ul>\r\n\r\n								</div>\r\n\r\n							</div>\r\n\r\n						</div>\r\n\r\n					</div>\r\n\r\n<div class=\"col-xl-6 banner-left bg-full\" style=\"background-image: url(http://biopedclinic.com/laravel-filemanager/photos/1/banner-right.jpg)\">&nbsp;</div>\r\n\r\n</div>','2019-08-09 11:44:24','2019-08-12 12:49:59'),(11,'aboutus-Motivation-is-easy','Motivation is easy','<div class=\"title-wrap text-center\">\r\n					<div class=\"h-sub theme-color\">Motivation is easy</div>\r\n					<h2 class=\"h1\">Our Core Values</h2>\r\n					<div class=\"h-decor\"></div>\r\n				</div>\r\n				<div class=\"row js-icn-carousel icn-carousel flex-column flex-sm-row text-center text-sm-left\" data-slick=\'{\"slidesToShow\": 3, \"responsive\":[{\"breakpoint\": 1024,\"settings\":{\"slidesToShow\": 2}}]}\'>\r\n					<div class=\"col-md\">\r\n						<div class=\"icn-text\">\r\n							<div class=\"icn-text-simple\"><i class=\"icon-innovation\"></i></div>\r\n							<div>\r\n								<h5 class=\"icn-text-title\">Innovation</h5>\r\n								<p>Embrace change, encourage invention and continually remain at the forefront of advances in oral health for the good of our patients</p>\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"col-md\">\r\n						<div class=\"icn-text\">\r\n							<div class=\"icn-text-simple\"><i class=\"icon-compassion\"></i></div>\r\n							<div>\r\n								<h5 class=\"icn-text-title\">Compassion</h5>\r\n								<p>Demonstrate caring and sensitivity for the diverse backgrounds of our patients and colleagues and generosity in our communities</p>\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"col-md\">\r\n						<div class=\"icn-text\">\r\n							<div class=\"icn-text-simple\"><i class=\"icon-integrity\"></i></div>\r\n							<div>\r\n								<h5 class=\"icn-text-title\">Integrity</h5>\r\n								<p>Adhere to high ethical and professional standards, demonstrating commitment to our responsibilities with trust, honesty and respect for all</p>\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>','2019-08-09 11:44:24','2019-08-09 11:44:24'),(12,'aboutus-Our-Office','Our Office','<div class=\"title-wrap\">\r\n								<h2 class=\"h1\">Our Office </h2>\r\n								<div class=\"h-decor\"></div>\r\n							</div>\r\n							<p>Unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n							<div class=\"mt-4\"></div>\r\n							<h3>Amenities</h3>\r\n							<div class=\"mt-lg-4\"></div>\r\n							<ul class=\"marker-list-md\">\r\n								<li>TV’s in each treatment room</li>\r\n								<li>Complimentary coffee, Juice</li>\r\n								<li>Wireless Internet</li>\r\n								<li>Warm lavender towels</li>\r\n							</ul>','2019-08-09 11:44:24','2019-08-09 11:44:24'),(13,'servicepage-submenu1','submenu1','<ul class=\"services-nav flex-column flex-nowrap\">\r\n							<li class=\"nav-item\">\r\n								<a class=\"nav-link\" href=\"#submenu1\" data-toggle=\"collapse\" data-target=\"#submenu1\">Lorem Service</a>\r\n								<div class=\"collapse show\" id=\"submenu1\">\r\n									<ul class=\"flex-column nav\">\r\n										<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Sit amet dollor</a></li>\r\n										<li class=\"nav-item\"><a class=\"nav-link active\" href=\"#\">SIt amet dollor</a></li>\r\n										<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Lorem ipsum</a></li>\r\n										<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Dummy text</a></li>\r\n										<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">No Category</a></li>\r\n									</ul>\r\n								</div>\r\n							</li>\r\n							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Another service</a></li>\r\n							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Heres another one</a></li>\r\n							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Oh wait, another one</a></li>\r\n							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Are you kidding?</a></li>\r\n							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Hold on! More to come</a></li>\r\n							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">I`m here</a></li>\r\n							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Behold the service</a></li>\r\n							<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Unleash the great service</a></li>\r\n						</ul>','2019-08-09 11:44:24','2019-08-09 11:44:24'),(14,'servicepage-Lorem','Lorem','<div class=\"title-wrap\">\r\n\r\n<h1>Lorem ipsum service heading</h1>\r\n\r\n</div>\r\n\r\n\r\n\r\n<div class=\"service-img\"><img alt=\"\" class=\"img-fluid\" src=\"http://biopedclinic.com/laravel-filemanager/photos/1/hbot-init.jpg\" /></div>\r\n\r\n\r\n\r\n<div class=\"pt-2 pt-md-4\">\r\n\r\n							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>\r\n\r\n							<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n							<div class=\"mt-3 mt-lg-6\"></div>\r\n\r\n							<h3>What is Lorem Ipsum?</h3>\r\n\r\n							<div class=\"mt-0 mt-lg-4\"></div>\r\n\r\n							<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n							<div class=\"mt-3 mt-lg-6\"></div>\r\n\r\n							<h3>The procedure of Lorem Ipsum?</h3>\r\n\r\n							<div class=\"mt-0 mt-lg-4\"></div>\r\n\r\n							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>\r\n\r\n							<div class=\"mt-3\"></div>\r\n\r\n							<ul class=\"numbered-list-lg\">\r\n\r\n								<li>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock.</li>\r\n\r\n\r\n\r\n								<li>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</li>\r\n\r\n\r\n\r\n								<li>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</li>\r\n\r\n\r\n\r\n								<li>Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</li>\r\n\r\n							</ul>\r\n\r\n							<div class=\"mt-3\"></div>\r\n\r\n							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. </p>\r\n\r\n							<div class=\"mt-3 mt-md-5 px-1 pt-1 pb-15 pt-md-2 px-md-4 bg-grey\">\r\n\r\n								<div id=\"faqAccordion1\" class=\"faq-accordion\" data-children=\".faq-item\">\r\n\r\n									<div class=\"faq-item\">\r\n\r\n										<a data-toggle=\"collapse\" data-parent=\"#faqAccordion1\" href=\"#faqItem1\" aria-expanded=\"true\"><span>1.</span>Where can I get some?</a>\r\n\r\n										<div id=\"faqItem1\" class=\"collapse show faq-item-content\" role=\"tabpanel\">\r\n\r\n											<div>\r\n\r\n												<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p>\r\n\r\n											</div>\r\n\r\n										</div>\r\n\r\n									</div>\r\n\r\n									<div class=\"faq-item\">\r\n\r\n										<a data-toggle=\"collapse\" data-parent=\"#faqAccordion1\" href=\"#faqItem2\" aria-expanded=\"false\" class=\"collapsed\"><span>2.</span>Where does it come from?</a>\r\n\r\n										<div id=\"faqItem2\" class=\"collapse faq-item-content\" role=\"tabpanel\">\r\n\r\n											<div>\r\n\r\n												<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p>\r\n\r\n											</div>\r\n\r\n										</div>\r\n\r\n									</div>\r\n\r\n									<div class=\"faq-item\">\r\n\r\n										<a data-toggle=\"collapse\" data-parent=\"#faqAccordion1\" href=\"#faqItem3\" aria-expanded=\"false\" class=\"collapsed\"><span>3.</span>Why do we use it?</a>\r\n\r\n										<div id=\"faqItem3\" class=\"collapse faq-item-content\" role=\"tabpanel\">\r\n\r\n											<div>\r\n\r\n												<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.</p>\r\n\r\n											</div>\r\n\r\n										</div>\r\n\r\n									</div>\r\n\r\n								</div>\r\n\r\n							</div>\r\n\r\n						</div>','2019-08-09 11:44:24','2019-08-12 12:50:36'),(15,'contact-iframe','iframe','<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14731.50436589162!2d88.4649061!3d22.6211018!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x17591de6327d43e9!2sOPA+TECHNOLOGY+SOLUTIONS!5e0!3m2!1sen!2sin!4v1563366064079!5m2!1sen!2sin\"  height=\"450\" frameborder=\"0\" style=\"border:0; width: 100%\" allowfullscreen></iframe>','2019-08-09 11:44:24','2019-08-09 11:44:24'),(16,'contact-Clinic-Location','Clinic Location','<div class=\"title-wrap\">\r\n							<h5>Clinic Location</h5>\r\n							<div class=\"h-decor\"></div>\r\n						</div>\r\n						<ul class=\"icn-list-lg\">\r\n							<li><i class=\"icon-placeholder2\"></i> BioPed Clinic\r\n								<br>Kolkata,  Address extented\r\n								<br>India, 0002\r\n							</li>\r\n						</ul>','2019-08-09 11:44:24','2019-08-09 11:44:24'),(17,'contact-info','Contact Info','<div class=\"title-wrap\">\r\n							<h5>Contact Info</h5>\r\n							<div class=\"h-decor\"></div>\r\n						</div>\r\n						<ul class=\"icn-list-lg\">\r\n							<li><i class=\"icon-telephone\"></i>Phone: <span class=\"theme-color\"><span class=\"text-nowrap\">1-800-267-0000,</span> <span class=\"text-nowrap\">1-800-267-0001</span>\r\n								</span>\r\n								<br> Fax: <span class=\"theme-color\"><span class=\"text-nowrap\">(957) 267-0020</span>\r\n								</span>\r\n							</li>\r\n							<li><i class=\"icon-black-envelope\"></i><a href=\"mailto:info@dentco.com\">info@domain.com</a></li>\r\n						</ul>','2019-08-09 11:44:24','2019-08-09 11:44:24'),(18,'contact-get-touch','get touch','<div class=\"pr-0 pr-lg-8\">\r\n							<div class=\"title-wrap\">\r\n								<h2>Get In Touch With Us</h2>\r\n								<div class=\"h-decor\"></div>\r\n							</div>\r\n							<div class=\"mt-2 mt-lg-4\">\r\n								<p>For general questions, please send us a message and we’ll get right back to you. You can also call us directly to speak with a member of our service team or insurance expert.</p>\r\n								<p class=\"p-sm\">Fields marked with a * are required.</p>\r\n							</div>\r\n							<div class=\"mt-2 mt-md-5\"></div>\r\n							<h5>Stay Connected</h5>\r\n							<div class=\"content-social mt-15\">\r\n								<a href=\"https://www.facebook.com/\" target=\"blank\" class=\"hovicon\"><i class=\"icon-facebook-logo\"></i></a>\r\n								<a href=\"https://www.twitter.com/\" target=\"blank\" class=\"hovicon\"><i class=\"icon-twitter-logo\"></i></a>\r\n								<a href=\"https://www.instagram.com/\" target=\"blank\" class=\"hovicon\"><i class=\"icon-instagram\"></i></a>\r\n							</div>\r\n						</div>','2019-08-09 11:44:24','2019-08-09 11:44:24');
/*!40000 ALTER TABLE `cms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_form`
--

DROP TABLE IF EXISTS `contact_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_form`
--

LOCK TABLES `contact_form` WRITE;
/*!40000 ALTER TABLE `contact_form` DISABLE KEYS */;
INSERT INTO `contact_form` VALUES (1,'rimpi','a@gmail.com','9831580843','how can i reach?','2019-08-09 11:44:24','2019-08-09 11:44:24'),(2,'karuna','ah@gmail.com','9876522','cefzwecrwr?','2019-08-09 11:44:24','2019-08-09 11:44:24'),(3,'pinaki','a@gmail.com','9831580843','crRRWERfyuu?','2019-08-09 11:44:24','2019-08-09 11:44:24');
/*!40000 ALTER TABLE `contact_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_slide`
--

DROP TABLE IF EXISTS `home_slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `home_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `content` longtext NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_slide`
--

LOCK TABLES `home_slide` WRITE;
/*!40000 ALTER TABLE `home_slide` DISABLE KEYS */;
INSERT INTO `home_slide` VALUES (3,'slide1','1565002539.jpg','\n                                    <h3>Lorem ipsum dummy text</h3>\n                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n                                    \n                               ','Active','2019-08-09 11:44:24','2019-08-12 09:41:53'),(4,'slide2','1565002638.jpg','\n                                    <h3>Dummy text will goes here</h3>\n                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n                                    \n                                ','Active','2019-08-09 11:44:24','2019-08-12 09:42:31'),(5,'slide3','1565002723.jpg','\n                                    <h3>Exercise lorem ipsum</h3>\n                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n                                   \n                               ','Active','2019-08-09 11:44:24','2019-08-12 09:43:19'),(6,'slide4','1565002780.jpg','\n                                    <h3>Sit amet dollor</h3>\n                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n                                   \n                              ','Active','2019-08-09 11:44:24','2019-08-12 09:43:51');
/*!40000 ALTER TABLE `home_slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_07_04_095048_entrust_setup_tables',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_form`
--

DROP TABLE IF EXISTS `request_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `request_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `select_service` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_form`
--

LOCK TABLES `request_form` WRITE;
/*!40000 ALTER TABLE `request_form` DISABLE KEYS */;
INSERT INTO `request_form` VALUES (9,'rimpi','sfsfs','345678654','Cosmetic Dentistry','2019-08-07','3:13 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(11,'pinaki','smavxkja','998765','General Dentistry','2019-08-07','3:25 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(12,'sonal','sdfsds@','56754','General Dentistry','2019-08-07','3:29 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(15,'sapy','sdfvd','234567654','Children`s Dentistry','2019-08-07','3:31 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(23,'namita','sdfgv','76543','Orthodontics','2019-08-08','12:08 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(28,'karuna','sdf@df','786543','General Dentistry','2019-08-08','1:09 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(29,'fcer3','efce','345','Cosmetic Dentistry','2019-08-08','4:36 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(30,'asQS','SasQ','234567','Cosmetic Dentistry','2019-08-09','4:37 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(31,'XDAD','SADASD','2345678','General Dentistry','2019-08-08','4:38 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(32,'dida','SXr','345','Dental Emergency','2019-08-08','4:39 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(33,'RAJ','FESFZEW','2345','Orthodontics','2019-08-08','4:47 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(34,'rani','zfvt','3453435','Children`s Dentistry','2019-08-08','4:48 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(35,'ARPITA','fduyfdY@ds','8976543234','Orthodontics','2019-08-09','12:13 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(36,'zx','dwxE','76543235','Children`s Dentistry','2019-08-09','12:29 PM','2019-08-09 11:44:24','2019-08-09 11:44:24'),(37,'arpita','efzerw','234567','Children`s Dentistry','2019-08-09','12:39 PM','2019-08-09 11:44:24','2019-08-09 11:44:24');
/*!40000 ALTER TABLE `request_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','ADMIN','ADMIN',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `short_content` text NOT NULL,
  `content` longtext NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `featured` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (6,'HBOT','1565592608.jpg','<p>Cancer care includes a variety of treatments, systematic therapies, surgery and clinical trials.</p>\r\n\r\n<ul>\r\n	<li>Chemotherapy</li>\r\n	<li>Hormone therapy</li>\r\n	<li>Immunotherapy</li>\r\n	<li>Precision genomics</li>\r\n	<li>Radiation oncology</li>\r\n	<li>Surgical oncology</li>\r\n</ul>','<p>coming soon</p>','Active','1','2019-08-09 11:44:24','2019-08-12 13:50:08'),(8,'DOCTOR CONSULTANTS','1565594080.jpg','<p>Cancer care includes a variety of treatments, systematic therapies, surgery and clinical trials.</p>\r\n\r\n<ul>\r\n	<li>Chemotherapy</li>\r\n	<li>Hormone therapy</li>\r\n	<li>Immunotherapy</li>\r\n	<li>Precision genomics</li>\r\n	<li>Radiation oncology</li>\r\n	<li>Surgical oncology</li>\r\n</ul>','<p>coming soon</p>','Active','1','2019-08-09 11:44:24','2019-08-12 14:14:40'),(9,'Stem Cell Therapy','1565594136.png','<p>Cell Relife is a cutting edge medical technology platform providing stem cell solutions for the world. We are marketing partners for MELUHA LIFE SCIENCES from Malaysia. Meluha Life Sciences (MLS) is a leader in the development of most advanced live cell-based therapies to address major unmet medical needs. MLS&rsquo; &lsquo;off-the-shelf&rsquo; cellular medicine is Mesenchymal Stem Cells (MSCs) which have huge therapeutic potential for numerous serious and life-threatening illnesses. MLS&rsquo; lead investigational ... Read More</p>','<h2>About Cell Relife</h2>\r\n\r\n<p><img alt=\"\" src=\"http://cellrelife.com/content/images/title/dna.png\" /></p>\r\n\r\n<p>Cell Relife is a cutting edge medical technology platform&nbsp;providing stem cell solutions for the world. We are marketing partners for MELUHA LIFE SCIENCES from Malaysia.&nbsp;Meluha Life Sciences (MLS) is a leader in the development of most advanced live cell-based therapies to address major unmet medical needs. MLS&rsquo; &lsquo;off-the-shelf&rsquo; cellular medicine is Mesenchymal Stem Cells (MSCs) which have huge therapeutic potential for numerous serious and life-threatening illnesses. MLS&rsquo; lead investigational product&nbsp;Chondrokin&reg;&nbsp;and&nbsp;Chondrogen&reg;, is designed to restore damaged cartilage to get relief of painful experience and potentially to prevent progression towards the development of osteoarthritis. MLS product candidates are one of the most rigorously studied regenerative medicine for orthopaedic treatments. MLS&rsquo; is well positioned to advance human stem cell technology in the field of Regenerative Medicine.</p>\r\n\r\n<p>Cell Relife has collaborated with MLS to develop stem cell solutions using Mesenchymal Stem Cells for addressing neurological conditions like Autism, ADHD and Cerebral Palsy.&nbsp;</p>','Active','1','2019-08-09 11:44:24','2019-08-12 14:15:36'),(10,'Lorem Ipsum Dollor','1565344575.jpg','<div class=\"service-card-photo\">\r\n								<a href=\"service-page.html\"><img src=\"images/hbot-init.jpg\" class=\"img-fluid\" alt=\"\"></a>\r\n							</div>\r\n							<h5 class=\"service-card-name\"><a href=\"service-page.html\">Lorem Ipsum Dollor</a></h5>\r\n							<div class=\"h-decor\"></div>\r\n<p>Cancer care includes a variety of treatments, systematic therapies, surgery and clinical trials.</p>\r\n\r\n<ul>\r\n	<li>Chemotherapy</li>\r\n	<li>Hormone therapy</li>\r\n	<li>Immunotherapy</li>\r\n	<li>Precision genomics</li>\r\n	<li>Radiation oncology</li>\r\n	<li>Surgical oncology</li>\r\n</ul>','<p>hjljnln</p>','Active','1','2019-08-09 11:44:24','2019-08-09 11:44:24');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `content` longtext NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES (7,'slide 1','1564666485.jpg','<div class=\"slide\">\r\n                    <div class=\"img--holder\" data-bg=\"{{URL::asset(\'public/assets/frontend/images/content/slider/slide-02.jpg\')}}\"></div>\r\n                    <div class=\"slide-content center\">\r\n                        <div class=\"vert-wrap container\">\r\n                            <div class=\"vert\">\r\n                                <div class=\"container\">\r\n                                    <div class=\"slide-txt1\" data-animation=\"fadeInDown\" data-animation-delay=\"1s\">The Highest Quality\r\n                                        <br><b>Healthcare</b></div>\r\n                                    <div class=\"slide-txt2\" data-animation=\"fadeInUp\" data-animation-delay=\"1.5s\">Your good health is our greatest achievement</div>\r\n                                    <div class=\"slide-btn\"><a href=\"services\" class=\"btn btn-white\" data-animation=\"fadeInUp\" data-animation-delay=\"2s\"><i class=\"icon-right-arrow\"></i><span>Know more</span><i class=\"icon-right-arrow\"></i></a></div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>','Active','2019-08-09 11:44:24','2019-08-09 11:44:24'),(9,'slide 2','1564666755.png','<div class=\"slide-txt1\" data-animation=\"fadeInDown\" data-animation-delay=\"1s\">We Provide\r\n                                        <br><b>Full Medical Care!</b></div>\r\n                                    <div class=\"slide-txt2\" data-animation=\"fadeInUp\" data-animation-delay=\"1.5s\">Highest standards of customer service</div>\r\n                                    <div class=\"slide-btn\"><a href=\"services\" class=\"btn btn-white\" data-animation=\"fadeInUp\" data-animation-delay=\"2s\"><i class=\"icon-right-arrow\"></i><span>Know more</span><i class=\"icon-right-arrow\"></i></a></div>','Active','2019-08-09 11:44:24','2019-08-09 11:44:24');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'pinakidas','admin@gmail.com',NULL,'$2y$10$el2TOlO.YoaaQBW4LfcJQOdNvyEctRXXOORNu4NvFHzc5be213CNW',NULL,'Active','2019-07-04 08:51:09','2019-07-04 08:51:09'),(2,'pinakidas','admin@gmail.com',NULL,'$2y$10$tdqqOX3MtTKLCkUgVRZR0.BuQH5T7YXQu0vtBTwq57K1Ned6xEwYu',NULL,'Active','2019-07-04 08:52:05','2019-07-04 08:52:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-13 12:34:05
