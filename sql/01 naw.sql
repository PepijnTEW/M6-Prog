CREATE TABLE `personenNaw`.`naw` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(100) NOT NULL,
  `straat` VARCHAR(100) NOT NULL,
  `huisnummer` VARCHAR(6) NOT NULL,
  `postcode` VARCHAR(6) NOT NULL,
  `email` VARCHAR(120) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);
