CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(50),
    password VARCHAR(50)
);

INSERT INTO users (username, password)
VALUES ('admin', '123');
