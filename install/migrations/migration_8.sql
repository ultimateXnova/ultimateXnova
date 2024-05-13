ALTER TABLE `%PREFIX%config` ADD `expedition_chances_percent_resources` DECIMAL(4,1) unsigned NOT NULL DEFAULT 32.5;
ALTER TABLE `%PREFIX%config` ADD `expedition_chances_percent_darkmatter` DECIMAL(4,1) unsigned NOT NULL DEFAULT 9;
ALTER TABLE `%PREFIX%config` ADD `expedition_chances_percent_ships` DECIMAL(4,1) unsigned NOT NULL DEFAULT 22;
ALTER TABLE `%PREFIX%config` ADD `expedition_chances_percent_pirates` DECIMAL(4,1) unsigned NOT NULL DEFAULT 8.4;
ALTER TABLE `%PREFIX%users` ADD `bg_img` varchar(55) NOT NULL DEFAULT 'mars';