CREATE TABLE `civicrm_metrics_server` (
  `id` INT NULL AUTO_INCREMENT COMMENT '',
  `site_name` VARCHAR(255) NULL COMMENT 'Name of the site that is reporting these metrics',
  `url` VARCHAR(2048) NOT NULL COMMENT 'The url of the site',
  `timestamp` TIMESTAMP NULL COMMENT 'When these metrics were reported',
  `type` VARCHAR(255) NULL COMMENT 'The Metric Type',
  `data` BLOB NULL COMMENT 'The data for this metric',
  PRIMARY KEY (`id`));
