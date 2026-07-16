USE dkraj_streamingdb;

SELECT * FROM subscription_plan;

INSERT INTO subscription_plan VALUES
(1, 'Basic', 9.99, 'HD', 1),
(2, 'Standard', 14.99, 'Full HD', 2),
(3, 'Premium', 19.99, '4K', 4);

SELECT * FROM subscription_plan;

SELECT * FROM users;

INSERT INTO users VALUES
(1, 1, 'Alice Bro', 'alice@email.com', 'Canada', '2023-01-10'),
(2, 2, 'Bob Smith', 'bob@email.com', 'USA', '2023-02-15'),
(3, 3, 'Charlie Green', 'charlie@email.com', 'UK', '2023-03-20'),
(4, 1, 'David Lee', 'david@email.com', 'Canada', '2023-04-05'),
(5, 2, 'Emma White', 'emma@email.com', 'USA', '2023-05-12'),
(6, 3, 'Frank Black', 'frank@email.com', 'Australia', '2023-06-18');

SELECT * FROM users;

SELECT * FROM  content;

INSERT INTO content VALUES
(1, 'The Great Escape', 2020, 'PG', 'English', 'movie', 140),
(2, 'Space Journey', 2022, 'PG-13', 'English', 'movie', 155),
(3, 'Love in Paris', 2019, 'PG', 'French', 'movie', 120),
(4, 'Mystery Manor', 2021, 'PG-13', 'English', 'series', NULL),
(5, 'Tech World', 2023, 'PG', 'English', 'series', NULL),
(6, 'Ancient Wars', 2018, 'R', 'English', 'movie', 165);

SELECT * FROM content;

INSERT INTO episodes VALUES
(1, 4, 'Episode 1', 45, '2021-01-01'),
(2, 4, 'Episode 2', 50, '2021-01-08'),
(1, 5, 'Episode 1', 40, '2023-02-01'),
(2, 5, 'Episode 2', 42, '2023-02-08');

SELECT * FROM episodes;

SELECT * FROM profile;

INSERT INTO profile VALUES
('Kids', 1, 10),
('Adult', 1, 18),
('Main', 2, 18),
('Teen', 3, 15),
('Family', 4, 12);

SELECT * FROM profile;

SELECT * FROM  watches;

INSERT INTO watches VALUES
(1, 1, '2024-01-01', 140, TRUE),
(1, 4, '2024-01-05', 45, FALSE),
(2, 2, '2024-01-03', 155, TRUE),
(3, 3, '2024-01-07', 120, TRUE),
(4, 6, '2024-01-09', 165, TRUE),
(5, 1, '2024-01-10', 100, FALSE),
(6, 2, '2024-01-11', 155, TRUE),
(2, 4, '2024-01-12', 50, TRUE),
(3, 5, '2024-01-13', 40, FALSE),
(1, 6, '2024-01-15', 165, TRUE);

SELECT * FROM watches;

SELECT * FROM rates;

INSERT INTO rates VALUES
(1, 1, '2024-01-02', 5),
(2, 2, '2024-01-04', 4),
(3, 3, '2024-01-08', 3),
(4, 6, '2024-01-10', 5),
(5, 1, '2024-01-11', 4);

SELECT * FROM rates;

SELECT * FROM subscription_plan;

UPDATE subscription_plan
SET monthly_price = 11.99
WHERE plan_id = 1;

SELECT * FROM subscription_plan;

SELECT * FROM content;

UPDATE content
SET age_rating = 'PG-13'
WHERE release_year < 2020;

SELECT * FROM content;

