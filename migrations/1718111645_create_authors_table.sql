CREATE TABLE IF NOT EXISTS authors
(
    id         INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name       VARCHAR(255) NOT NULL,
    biography  TEXT,
    birth_date DATE,
    created_at DATETIME DEFAULT NOW(),
    updated_at DATETIME DEFAULT NOW()
)