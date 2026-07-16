-- show all databases
SHOW DATABASES;

-- drop database if exists
DROP DATABASE IF EXISTS dkraj_streamingdb;

-- create database
CREATE DATABASE dkraj_streamingdb;

-- use database
USE dkraj_streamingdb;

-- ta access

GRANT USAGE ON *.* TO 'ta'@'localhost';
DROP USER 'ta'@'localhost';
CREATE USER 'ta'@'localhost' IDENTIFIED BY 'cs3319';
GRANT ALL PRIVILEGES ON dkraj_streamingdb.* TO 'ta'@'localhost';
FLUSH PRIVILEGES;

SHOW TABLES;

CREATE TABLE subscription_plan (
    plan_id INT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    monthly_price DECIMAL(6,2) NOT NULL,
    max_video_quality VARCHAR(50),
    max_concurrent_streams INT
);

CREATE TABLE users (
    user_id INT PRIMARY KEY,
    plan_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    country VARCHAR(100),
    registration_date DATE,
    FOREIGN KEY (plan_id)
        REFERENCES subscription_plan(plan_id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);

CREATE TABLE content (
    content_id INT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    release_year INT,
    age_rating VARCHAR(10),
    language VARCHAR(50),
    content_type VARCHAR(20) NOT NULL,
    movie_duration INT
);

CREATE TABLE episodes (
    episode_number INT,
    content_id INT,
    title VARCHAR(200) NOT NULL,
    duration INT,
    release_date DATE,
    PRIMARY KEY (episode_number, content_id),
    FOREIGN KEY (content_id)
        REFERENCES content(content_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE profile (
    profile_name VARCHAR(100),
    user_id INT,
    age_restriction INT,
    PRIMARY KEY (profile_name, user_id),
    FOREIGN KEY (user_id)
        REFERENCES users(user_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE watches (
    user_id INT,
    content_id INT,
    watch_date DATE,
    watch_duration INT,
    completed BOOLEAN,
    PRIMARY KEY (user_id, content_id, watch_date),
    FOREIGN KEY (user_id)
        REFERENCES users(user_id)
        ON DELETE CASCADE,
    FOREIGN KEY (content_id)
        REFERENCES content(content_id)
        ON DELETE CASCADE
);

CREATE TABLE rates (
    user_id INT,
    content_id INT,
    rating_date DATE,
    score INT CHECK (score BETWEEN 1 AND 5),
    PRIMARY KEY (user_id, content_id),
    FOREIGN KEY (user_id)
        REFERENCES users(user_id)
        ON DELETE CASCADE,
    FOREIGN KEY (content_id)
        REFERENCES content(content_id)
        ON DELETE CASCADE
);

SHOW TABLES;
