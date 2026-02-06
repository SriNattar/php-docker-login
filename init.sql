-- Secure users table with password hashes
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT now()
);

-- Example: generate a password hash in PHP and insert it manually.
-- Run in shell to generate a hash for 'password123':
-- php -r "echo password_hash('password123', PASSWORD_DEFAULT).PHP_EOL;"
-- Then insert the user (replace <hash> with generated value):
-- INSERT INTO users (username, password_hash) VALUES ('admin', '<hash>');
