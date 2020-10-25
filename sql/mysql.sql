CREATE TABLE ssiframe (
    protocol   INT(1) NOT NULL DEFAULT '1',
    servername TEXT   NOT NULL,
    port       INT(5),
    path       TEXT,
    method     INT(1) NOT NULL,
    basic      INT(1) NOT NULL,
    basic_user TEXT,
    basic_pass TEXT,
    param      TEXT
)
    ENGINE = ISAM;

INSERT INTO ssiframe (protocol, servername, port, path, method, basic, basic_user, basic_pass, param)
VALUES (1, 'www.yahoo.co.jp', 80, '/', 1, 0, '', '', '');

