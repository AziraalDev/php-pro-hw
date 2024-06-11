CREATE TABLE IF NOT EXISTS books
(
    id             INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title          VARCHAR(255) NOT NULL,
    description    TEXT,
    isbn           VARCHAR(13)  NOT NULL UNIQUE,
    published_date DATE,
    created_at     DATETIME DEFAULT NOW(),
    updated_at     DATETIME DEFAULT NOW()
)