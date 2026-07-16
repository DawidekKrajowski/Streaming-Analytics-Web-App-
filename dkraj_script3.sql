-- QUERY 1

SELECT title, release_year
FROM content 
ORDER BY title ASC;

-- Query 2

SELECT title, movie_duration
FROM content
WHERE content_type = 'Movie'
ORDER BY movie_duration  DESC;

-- query 3
SELECT c.title, count(e.episode_number) AS total_episodes
FROM content c 
JOIN episodes e ON c.content_id = e.content_id
WHERE c.content_type = 'Series'
GROUP BY c.content_id, c.title;

-- query 4
SELECT name, email
FROM users
ORDER BY name ASC;

-- query 5

SELECT c.title, w.watch_date, w.watch_duration, w.completed
FROM watches w
JOIN content c ON w.content_id = c.content_id
JOIN users u ON w.user_id = u.user_id
WHERE u.email = 'bob@email.com';

 -- query 6

SELECT title
FROM content
WHERE content_id NOT IN (
        SELECT content_id FROM watches
);
 -- query 7

SELECT c.title, AVG(r.score) AS avg_rating
FROM rates r
JOIN content c ON r.content_id = c.content_id
GROUP BY c.content_id, c.title;

-- query 8
SELECT c.title 
FROM rates r
JOIN content c ON r.content_id = c.content_id
GROUP BY c.content_id, c.title
HAVING AVG(r.score)> 4.0 AND COUNT(*) >= 2;

-- query 9
SELECT DISTINCT u.name
FROM watches w
JOIN users u ON w.user_id = u.user_id
GROUP BY w.user_id , w.content_id
HAVING COUNT(*) > 1;

-- query 10

SELECT  sp.name, COUNT(u.user_id) AS total_users
FROM subscription_plan sp
LEFT JOIN users u ON sp.plan_id = u.plan_id
GROUP BY sp.plan_id, sp.name
ORDER BY total_users DESC;

-- query 11
SELECT  e.episode_number, e.title
FROM episodes e
JOIN content c ON e.content_id = c.content_id
WHERE c.title = 'Tech World'
ORDER BY e.episode_number;

-- query 12

SELECT c.title
FROM rates r
JOIN content c ON r.content_id = c.content_id
GROUP BY c.content_id, c.title
HAVING AVG(r.score) > (SELECT AVG(score) FROM rates);

-- query 13

SELECT c.title, u.name, r.rating_date
FROM rates r
JOIN content c ON r.content_id = c.content_id
JOIN users u ON r.user_id = u.user_id
WHERE r.rating_date < DATE_SUB(CURDATE(), INTERVAL 2 YEAR);

-- query 14

SELECT u.name
FROM users u
WHERE NOT EXISTS (
	SELECT e.episode_number
	FROM episodes e
	JOIN content c ON e.content_id = c.content_id
	WHERE c.title = 'Tech World'
	AND NOT EXISTS (
		SELECT *
		FROM watches w
		WHERE  w.user_id = u.user_id
		AND w.content_id = e.content_id
	)
);

-- query 15
SELECT title
FROM content
WHERE content_type = 'Movie'
	AND movie_duration > 150

UNION

SELECT c.title
FROM content c
JOIN episodes e ON c.content_id = e.content_id
WHERE c.content_type = 'Series'
GROUP BY c.content_id, c.title
HAVING COUNT(e.episode_number) >= 10;

