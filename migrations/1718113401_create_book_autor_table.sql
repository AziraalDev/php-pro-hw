CREATE TABLE IF NOT EXISTS book_author
(
    book_id   INT UNSIGNED NOT NULL,
    author_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (book_id, author_id),
    FOREIGN KEY (book_id) REFERENCES books (id) ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES authors (id) ON DELETE CASCADE
)