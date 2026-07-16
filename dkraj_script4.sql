



-- 1. Create a view showing content 
CREATE VIEW content_rating_summary AS
SELECT 
    c.title,
    c.content_type,
    AVG(r.score) AS average_rating,
    COUNT(r.score) AS number_of_ratings
FROM content c
LEFT JOIN rates r ON c.content_id = r.content_id
GROUP BY c.content_id, c.title, c.content_type;


-- 2. Prove that the view works by selecting all rows
SELECT * 
FROM content_rating_summary;


-- 3. Show  content with average rating > 4.0 and at least 2 ratings
SELECT *
FROM content_rating_summary
WHERE average_rating > 4.0
  AND number_of_ratings >= 2
ORDER BY average_rating DESC;


-- 4. Delete all viewing events for a specific user 

-- Show before deletion
SELECT *
FROM watches
WHERE user_id = (
    SELECT user_id 
    FROM users 
    WHERE email = 'bob@email.com'
);

-- Perform deletion
DELETE FROM watches
WHERE user_id = (
    SELECT user_id 
    FROM users 
    WHERE email = 'bob@email.com'
);

-- Show after deletion
SELECT *
FROM watches
WHERE user_id = (
    SELECT user_id 
    FROM users 
    WHERE email = 'bob@email.com'
);


-- 5. Attempt to delete a subscription plan that still has users

DELETE FROM subscription_plan
WHERE name = 'Basic';


