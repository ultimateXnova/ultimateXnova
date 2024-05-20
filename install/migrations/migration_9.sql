ALTER TABLE `%PREFIX%users` ADD `child_of` int(11) NOT NULL DEFAULT '0',
ALTER TABLE `%PREFIX%config` ADD `expedition_factor_resources` DECIMAL(4,1) unsigned NOT NULL DEFAULT 1;
ALTER TABLE `%PREFIX%config` ADD `expedition_factor_ships` DECIMAL(4,1) unsigned NOT NULL DEFAULT 1;