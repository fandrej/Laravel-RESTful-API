-- --------------------------------------------------------
-- Хост:                         192.168.1.208
-- Версия сервера:               PostgreSQL 9.6.19 on x86_64-pc-linux-gnu, compiled by gcc (Debian 6.3.0-18+deb9u1) 6.3.0 20170516, 64-bit
-- Операционная система:         
-- HeidiSQL Версия:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES  */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица public.deps
CREATE TABLE IF NOT EXISTS "deps" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''deps_id_seq''::regclass)',
	"name" VARCHAR(300) NOT NULL,
	"address" VARCHAR(100) NULL DEFAULT NULL,
	"point" VARCHAR(50) NULL DEFAULT NULL,
	"type" VARCHAR(255) NULL DEFAULT NULL,
	PRIMARY KEY ("id")
);

-- Дамп данных таблицы public.deps: 0 rows
/*!40000 ALTER TABLE "deps" DISABLE KEYS */;
INSERT INTO "deps" ("id", "name", "address", "point", "type") VALUES
	(1, 'Офис', 'ул. Ленина, д. 1', NULL, 'Офис'),
	(2, 'Офис', 'ул. Ленина, д. 2', NULL, 'Офис'),
	(3, 'Офис', 'ул. Ленина, д. 3', NULL, 'Офис'),
	(4, 'Офис', 'ул. Ленина, д. 4', NULL, 'Офис'),
	(5, 'Офис', 'ул. Ленина, д. 5', NULL, 'Офис'),
	(6, 'ВСЕ БУДЕТ ХОРОШО', 'ул. Цветочная, д. 12', NULL, 'Кафе'),
	(7, 'КАКИЕ ЛЮДИ', 'ул. Ломаная, д. 17', NULL, 'Кафе'),
	(8, 'ХОМЯЧКИ', 'ул. Старообрядческая, д. 22', NULL, 'Кафе'),
	(9, 'ЗЕЛЕНОГЛАЗОЕ ТАКСИ', 'ул. Счастливая, д. 54', NULL, 'Кафе'),
	(10, 'МАКАРЕНА', 'Химический переулок, д. 68', NULL, 'Кафе'),
	(11, 'ЖИТЬ ХОРОШО', 'ул. Шотландская, д. 1', NULL, 'Кафе'),
	(12, 'БРАТИШКА', 'Сиреневый бульвар, д. 14', NULL, 'Кафе'),
	(13, 'ОТЖИГАЙ И ЖГИ', 'Банковский переулок, д. 32', NULL, 'Кафе'),
	(14, 'ЧИХ-ПЫХ', 'ул. Мебельная, д. 21', NULL, 'Кафе'),
	(15, 'ВИННИ ПЫХ', 'ул. Центральная, д. 11', NULL, 'Кафе'),
	(16, 'ВОДКА БЕЗ ПИВА, ДЕНЬГИ НА ВЕТЕР', 'ул. Молодежная, д. 15', NULL, 'Кафе'),
	(17, 'ВОДКА ДЛЯ ОСОБО ВАЖНЫХ ПЕРСОН', 'ул. Школьная, д. 9', NULL, 'Кафе'),
	(18, 'ПИВАСИК И КАРАСИК', 'ул. Лесная, д. 7', NULL, 'Кафе'),
	(19, 'ПИТЬ ХОЧУ', 'ул. Советская, д. 55', NULL, 'Кафе'),
	(20, 'БЕШЕНАЯ ТАБУРЕТКА', 'ул. Новая, д. 68А', NULL, 'Кафе'),
	(21, 'МАМА ПРИГОТОВИЛА', 'ул. Садовая, д. 3, к.1', NULL, 'Кафе');
/*!40000 ALTER TABLE "deps" ENABLE KEYS */;

-- Дамп структуры для таблица public.deptowns
CREATE TABLE IF NOT EXISTS "deptowns" (
	"deps_id" BIGINT NOT NULL,
	"towns_id" BIGINT NOT NULL,
	UNIQUE INDEX "deptowns_deps_id_towns_id_unique" ("deps_id", "towns_id")
);

-- Дамп данных таблицы public.deptowns: 0 rows
/*!40000 ALTER TABLE "deptowns" DISABLE KEYS */;
INSERT INTO "deptowns" ("deps_id", "towns_id") VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 2),
	(10, 2),
	(11, 3),
	(12, 3),
	(13, 3),
	(20, 3),
	(15, 4),
	(16, 5),
	(17, 5),
	(18, 5),
	(19, 5),
	(21, 5);
/*!40000 ALTER TABLE "deptowns" ENABLE KEYS */;

-- Дамп структуры для таблица public.failed_jobs
CREATE TABLE IF NOT EXISTS "failed_jobs" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''failed_jobs_id_seq''::regclass)',
	"connection" TEXT NOT NULL,
	"queue" TEXT NOT NULL,
	"payload" TEXT NOT NULL,
	"exception" TEXT NOT NULL,
	"failed_at" TIMESTAMP NOT NULL DEFAULT 'now()',
	PRIMARY KEY ("id")
);

-- Дамп данных таблицы public.failed_jobs: 0 rows
/*!40000 ALTER TABLE "failed_jobs" DISABLE KEYS */;
/*!40000 ALTER TABLE "failed_jobs" ENABLE KEYS */;

-- Дамп структуры для таблица public.firmdeps
CREATE TABLE IF NOT EXISTS "firmdeps" (
	"firms_id" BIGINT NOT NULL,
	"deps_id" BIGINT NOT NULL,
	UNIQUE INDEX "firmdeps_firms_id_deps_id_unique" ("firms_id", "deps_id"),
	CONSTRAINT "firmdeps_deps_id_foreign" FOREIGN KEY ("deps_id") REFERENCES "public"."deps" ("id") ON UPDATE NO ACTION ON DELETE CASCADE,
	CONSTRAINT "firmdeps_firms_id_foreign" FOREIGN KEY ("firms_id") REFERENCES "public"."firms" ("id") ON UPDATE NO ACTION ON DELETE CASCADE
);

-- Дамп данных таблицы public.firmdeps: 0 rows
/*!40000 ALTER TABLE "firmdeps" DISABLE KEYS */;
INSERT INTO "firmdeps" ("firms_id", "deps_id") VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(1, 6),
	(1, 7),
	(1, 8),
	(2, 9),
	(2, 10),
	(3, 11),
	(3, 12),
	(3, 13),
	(3, 20),
	(4, 15),
	(5, 16),
	(5, 17),
	(5, 18),
	(5, 19),
	(5, 21);
/*!40000 ALTER TABLE "firmdeps" ENABLE KEYS */;

-- Дамп структуры для таблица public.firms
CREATE TABLE IF NOT EXISTS "firms" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''firms_id_seq''::regclass)',
	"name" VARCHAR(300) NOT NULL,
	"ownership" VARCHAR(10) NOT NULL,
	"boss" VARCHAR(100) NOT NULL,
	PRIMARY KEY ("id")
);

-- Дамп данных таблицы public.firms: 0 rows
/*!40000 ALTER TABLE "firms" DISABLE KEYS */;
INSERT INTO "firms" ("id", "name", "ownership", "boss") VALUES
	(1, 'Рога и копыта', 'OOO', 'Самойлова Светлана Григорьевна'),
	(2, '40 лет без урожая', 'OАO', 'Коновалова Ева Ивановна'),
	(3, 'Красный лапоть', 'ЗАO', 'Данилов Егор Артёмович'),
	(4, 'ПАНЬКИ', 'OOO', 'Климов Пётр Иванович'),
	(5, 'Никифоров В. А.', 'ИП', 'Никифоров Виктор Антонович');
/*!40000 ALTER TABLE "firms" ENABLE KEYS */;

-- Дамп структуры для таблица public.migrations
CREATE TABLE IF NOT EXISTS "migrations" (
	"id" INTEGER NOT NULL DEFAULT 'nextval(''migrations_id_seq''::regclass)',
	"migration" VARCHAR(255) NOT NULL,
	"batch" INTEGER NOT NULL,
	PRIMARY KEY ("id")
);

-- Дамп данных таблицы public.migrations: 0 rows
/*!40000 ALTER TABLE "migrations" DISABLE KEYS */;
INSERT INTO "migrations" ("id", "migration", "batch") VALUES
	(33, '2014_10_12_000000_create_users_table', 1),
	(34, '2014_10_12_100000_create_password_resets_table', 1),
	(35, '2019_08_19_000000_create_failed_jobs_table', 1),
	(36, '2020_08_13_105442_create_towns_table', 1),
	(37, '2020_08_13_124633_create_firms_table', 1),
	(38, '2020_08_13_124926_create_deps_table', 1),
	(39, '2020_08_13_125220_create_firmdeps_table', 2),
	(40, '2020_08_13_130410_create_deptowns_table', 2),
	(41, '2020_08_13_141528_create_userfirms_table', 3),
	(42, '2020_08_14_161107_users_field_api_token', 4);
/*!40000 ALTER TABLE "migrations" ENABLE KEYS */;

-- Дамп структуры для таблица public.password_resets
CREATE TABLE IF NOT EXISTS "password_resets" (
	"email" VARCHAR(255) NOT NULL,
	"token" VARCHAR(255) NOT NULL,
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	INDEX "password_resets_email_index" ("email")
);

-- Дамп данных таблицы public.password_resets: 0 rows
/*!40000 ALTER TABLE "password_resets" DISABLE KEYS */;
/*!40000 ALTER TABLE "password_resets" ENABLE KEYS */;

-- Дамп структуры для таблица public.towns
CREATE TABLE IF NOT EXISTS "towns" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''towns_id_seq''::regclass)',
	"name" VARCHAR(100) NOT NULL,
	"tz" VARCHAR(7) NOT NULL,
	PRIMARY KEY ("id")
);

-- Дамп данных таблицы public.towns: 0 rows
/*!40000 ALTER TABLE "towns" DISABLE KEYS */;
INSERT INTO "towns" ("id", "name", "tz") VALUES
	(1, 'Москва', 'UTC+3'),
	(2, 'Калининград', 'UTC+2'),
	(3, 'Ростов', 'UTC+3'),
	(4, 'Екатеринбург', 'UTC+5'),
	(5, 'Владивосток', 'UTC+10');
/*!40000 ALTER TABLE "towns" ENABLE KEYS */;

-- Дамп структуры для таблица public.userfirms
CREATE TABLE IF NOT EXISTS "userfirms" (
	"firms_id" BIGINT NOT NULL,
	"users_id" BIGINT NOT NULL,
	UNIQUE INDEX "userfirms_firms_id_users_id_unique" ("firms_id", "users_id"),
	CONSTRAINT "userfirms_firms_id_foreign" FOREIGN KEY ("firms_id") REFERENCES "public"."firms" ("id") ON UPDATE NO ACTION ON DELETE CASCADE,
	CONSTRAINT "userfirms_users_id_foreign" FOREIGN KEY ("users_id") REFERENCES "public"."users" ("id") ON UPDATE NO ACTION ON DELETE CASCADE
);

-- Дамп данных таблицы public.userfirms: 0 rows
/*!40000 ALTER TABLE "userfirms" DISABLE KEYS */;
INSERT INTO "userfirms" ("firms_id", "users_id") VALUES
	(1, 3),
	(2, 4),
	(2, 5),
	(2, 6),
	(3, 7),
	(3, 8),
	(3, 9),
	(4, 10),
	(4, 11),
	(5, 12),
	(5, 13),
	(5, 14),
	(5, 15);
/*!40000 ALTER TABLE "userfirms" ENABLE KEYS */;

-- Дамп структуры для таблица public.users
CREATE TABLE IF NOT EXISTS "users" (
	"id" BIGINT NOT NULL DEFAULT 'nextval(''users_id_seq''::regclass)',
	"name" VARCHAR(50) NOT NULL,
	"fio" VARCHAR(100) NULL DEFAULT NULL,
	"email" VARCHAR(255) NOT NULL,
	"phone" VARCHAR(255) NULL DEFAULT NULL,
	"email_verified_at" TIMESTAMP NULL DEFAULT NULL,
	"password" VARCHAR(255) NOT NULL,
	"remember_token" VARCHAR(100) NULL DEFAULT NULL,
	"created_at" TIMESTAMP NULL DEFAULT NULL,
	"updated_at" TIMESTAMP NULL DEFAULT NULL,
	"is_admin" INTEGER NOT NULL DEFAULT '0',
	"api_token" VARCHAR(60) NULL DEFAULT NULL,
	PRIMARY KEY ("id"),
	UNIQUE INDEX "users_email_unique" ("email"),
	UNIQUE INDEX "users_api_token_unique" ("api_token")
);

-- Дамп данных таблицы public.users: 15 rows
/*!40000 ALTER TABLE "users" DISABLE KEYS */;
INSERT INTO "users" ("id", "name", "fio", "email", "phone", "email_verified_at", "password", "remember_token", "created_at", "updated_at", "is_admin", "api_token") VALUES
	(2, 'admin', NULL, 'admin@example.com', NULL, NULL, '$2y$10$er3.d8DjwWHYehiF6HVdZeDH8li9W7bL2sIXU75jDXIi/8F/nSH9i', NULL, '2020-08-13 15:54:41', '2020-08-13 15:54:41', 1, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i41'),
	(4, '2', 'Чернов Герман Давидович', '2@2.ru', '8(111) 222-3333', NULL, '$2y$10$I3JQsVEbBjGfqpI1/ljs0ug6tqNe87fcmVJEkrfqiP/McaZz9Ntjq', NULL, '2020-08-13 16:14:41', '2020-08-13 16:14:41', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42'),
	(3, '1', 'Беляев Дмитрий Григорьевич', '1@1.ru', NULL, NULL, '$2y$10$bOuejEoOclZZ1vtLy.eKn.5YdBrM653UJm7rcCPHUZ7nTwDerWrZ.', NULL, '2020-08-13 15:59:34', '2020-08-13 15:59:34', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i43'),
	(5, '3', 'Носкова Мила Евгеньевна', '3@3.ru', '1121223213', NULL, '$2y$10$yO7QuafkdtBARYKhgXlKfu5SMTIyehjIKTSgn8XmxWCzn4x6WAA1a', NULL, '2020-08-13 16:21:17', '2020-08-13 16:21:17', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i44'),
	(6, '4', 'Макарова Каролина Артёмовна', '4@4.ru', '434534534543', NULL, '$2y$10$nmRpVdYRDMJ.pklJgKe/c.WqXK12b0AIHnWF1.mNVeUHCRzj9AiWW', NULL, '2020-08-13 16:23:34', '2020-08-13 16:23:34', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i45'),
	(7, '5', 'Ежова Дарья Альбертовна', '5@5.ru', '556456', NULL, '$2y$10$CB/KJwVDZ/LjEHC.HGMGEe1H13YfiLw3WGrQfREoOhp8s2c9J8i6S', NULL, '2020-08-13 16:26:02', '2020-08-13 16:26:02', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i46'),
	(8, '6', 'Лебедева Виктория Кирилловна', '6@6.ru', '66667567', NULL, '$2y$10$Ns0KsBMBt1lJJ5NcbPcUjuObCiTdaH656sEstuU4f3WMSqTRR6n1q', NULL, '2020-08-13 16:26:30', '2020-08-13 16:26:30', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i47'),
	(9, '7', 'Федотов Илья Максимович', '7@7.ru', '777856785', NULL, '$2y$10$bqLB8Lm4t3ag.HiuIPaiz.2NVRYpKy.vuM8mFssCXpbnI/tcTxJP.', NULL, '2020-08-13 16:27:10', '2020-08-13 16:27:10', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i48'),
	(10, '8', 'Кожевников Егор Петрович', '8@8.ru', '88856756', NULL, '$2y$10$9VZX7Pv1JcmKG/L0/M7Rg.24diPMmiW4AsIHaxLotSj5McMBqBwcG', NULL, '2020-08-13 16:27:44', '2020-08-13 16:27:44', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i49'),
	(11, '9', 'Федотов Илья Максимович', '9@9.ru', '9995656767', NULL, '$2y$10$u4fF.Y4EWXCq2JZfYLE8yOjD.wup1bi.NB6D7vOR6fYX8d6evl1iq', NULL, '2020-08-13 16:28:20', '2020-08-13 16:28:20', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i50'),
	(12, '10', 'Островский Максим Мирославович', '10@10.ru', '109392487', NULL, '$2y$10$AjizC4W11rk6irbSCHmfVur2DLOr3YrRkPce/kecoByHnSBJQs6fm', NULL, '2020-08-13 16:32:29', '2020-08-13 16:32:29', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i51'),
	(13, '11', 'Муратов Илья Фёдорович', '11@11.ru', '111322343', NULL, '$2y$10$xbWfp0XCrw8qYS3yrQyV1eHcOand2TR/c7OQYnb3DE3SQjIw3mcLG', NULL, '2020-08-13 16:33:06', '2020-08-13 16:33:06', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i52'),
	(14, '12', 'Кузнецов Михаил Александрович', '12@12.ru', '1212121212', NULL, '$2y$10$p1glBOppHfJTge0Aufr0auSskzDmRUExlLE8YldtnWZRPxYURX6si', NULL, '2020-08-13 16:33:40', '2020-08-13 16:33:40', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i53'),
	(15, '13', 'Зубкова Мирослава Данииловна', '13@13.ru', '1313131313', NULL, '$2y$10$B3BBqS9L1RPXJBLAI/WeTu4BDO.OBFNuo3973P5aDNHLVq9DlkOhC', NULL, '2020-08-13 16:34:11', '2020-08-13 16:34:11', 0, 'AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i54');
/*!40000 ALTER TABLE "users" ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
