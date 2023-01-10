CREATE
DATABASE placement;

USE
placement;

CREATE TABLE admin
(
    name     VARCHAR(20) NOT NULL,
    email    VARCHAR(30) NOT NULL,
    password VARCHAR(20) NOT NULL,
    PRIMARY KEY (email)
);

INSERT INTO admin (name, email, password)
VALUES ('Admin', 'admin@gmail.com', 'admin'),
       ('Admin', 'admin1@gmail.com', 'admin');

CREATE TABLE appliedjob
(
    id           INT AUTO_INCREMENT,
    cname        VARCHAR(255) NOT NULL,
    studentfname VARCHAR(255) NOT NULL,
    studentlname VARCHAR(255) NOT NULL,
    studentemail VARCHAR(255) NOT NULL,
    status       VARCHAR(255) NOT NULL,
    cdesc        VARCHAR(255) NOT NULL,
    cid          INT          NOT NULL,
    PRIMARY KEY (id),
    foreign KEY (cid) references company (id)
);

CREATE TABLE company
(
    id          INT AUTO_INCREMENT,
    cname       VARCHAR(255) NOT NULL,
    csalary     INT          NOT NULL,
    ccity       VARCHAR(255) NOT NULL,
    cdesc       VARCHAR(255) NOT NULL,
    cexperience VARCHAR(255) NOT NULL,
    clogo       VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);
INSERT INTO company (cname, csalary, ccity, cdesc, cexperience, clogo)
VALUES ('Whatsapp', 800000, 'Banglore', 'Software Tester, Sr. Software Developer', '3', '../upload/whatsapp.jpg'),
       ('Microsoft', 700000, 'Pune', 'Software Developer', '5', '../upload/microsoft.jpg'),
       ('Google', 1500000, 'California', 'Software Maintenance', '8', '../upload/google.jpg'),
       ('Amazon', 600000, 'Pune', 'Software Tester', '2', '../upload/amazon.jpg');

CREATE TABLE student
(
    id            INT AUTO_INCREMENT,
    fname         VARCHAR(255) NOT NULL,
    lname         VARCHAR(255) NOT NULL,
    email         VARCHAR(255) NOT NULL,
    password      VARCHAR(255) NOT NULL,
    address       VARCHAR(255) NOT NULL,
    city          VARCHAR(255) NOT NULL,
    contact       BIGINT       NOT NULL,
    qualification VARCHAR(255) NOT NULL,
    stream        VARCHAR(255) NOT NULL,
    skills        VARCHAR(255) NOT NULL,
    about         VARCHAR(255) NOT NULL,
    state         VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);
