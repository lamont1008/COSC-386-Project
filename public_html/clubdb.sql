CREATE TABLE Club (
    clubName VARCHAR(255) NOT NULL,
    clubWebsite TINYTEXT NOT NULL,
    Description TEXT NOT NULL,
    PRIMARY KEY (clubName)
);
CREATE TABLE Meetings (
    location VARCHAR(255) NOT NULL,
    meetingTime VARCHAR(255) NOT NULL,
    clubName VARCHAR(255) NOT NULL,
    PRIMARY KEY (location, clubName),
    FOREIGN KEY (clubName) REFERENCES Club (clubName)
);
CREATE TABLE Members (
    studentName VARCHAR(255) NOT NULL,
    semesterJoined VARCHAR(255) NOT NULL,
    major VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    clubName VARCHAR(255) NOT NULL,
    PRIMARY KEY (email),
    FOREIGN KEY (clubName) REFERENCES Club(clubName)
);
CREATE TABLE Faculty_advisor (
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    deptAffiliation VARCHAR(255) NOT NULL,
    clubName VARCHAR(255) NOT NULL,
    PRIMARY KEY (email) 
    FOREIGN KEY (clubName) REFERENCES Club(clubName)
);
CREATE TABLE Users (
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (email)
);
CREATE TABLE Tags (
    name varchar(255) NOT NULL,
    value DECIMAL(4, 2) NOT NULL,
    clubName varchar(255),
    username VARCHAR(255),
    PRIMARY KEY (name),
    UNIQUE KEY (clubName),
    UNIQUE KEY (username),
    FOREIGN KEY (clubName) REFERENCES Club(clubName),
    FOREIGN KEY (username) REFERENCES User(Email)
);