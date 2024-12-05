CREATE SCHEMA if NOT EXISTS weer;
use weer;

CREATE TABLE if NOT EXISTS weeromstandighedenPerDag
(
    idWeersomstandighedenPerDag INT UNSIGNED NOT NULL AUTO_INCREMENT,
	datum DATE NOT NULL,
    aantalGraden DECIMAL NOT NULL,
    windkracht INT UNSIGNED NOT NULL,
    regenInMilimeters DECIMAL NOT NULL,
	plaats VARCHAR(120),
    PRIMARY KEY (idWeersomstandighedenPerDag),
    UNIQUE INDEX idWeersomstandighedenPerDag_UNIQUE (idWeersomstandighedenPerDag ASC) VISIBLE
    
);