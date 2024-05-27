#Filling tables
INSERT INTO parks (address)
VALUES ('WoW str #1'),
       ('Downing str #1'),
       ('Avenue str #4');

INSERT INTO cars (park_id, model, price)
VALUES (1, 'Toyota Camry', 25000),
       (2, 'Honda Civic', 22000),
       (2, 'Ford Mustang', 35000),
       (3, 'Chevrolet Tahoe', 45000),
       (2, 'Toyota Supra', 77000);

INSERT INTO drivers (car_id, name, phone)
VALUES (1, 'Alice Brown', '111-111-1111'),
       (2, 'Charlie Davis', '222-222-2222'),
       (3, 'Ella Garcia', '333-333-3333'),
       (4, 'Frank Harris', '444-444-4444'),
       (5, 'Grace Martinez', '555-555-5555');

INSERT INTO customers (name, phone)
VALUES ('John Smith', '123-456-7890'),
       ('Emily Johnson', '987-654-3210'),
       ('Michael Williams', '555-123-4567'),
       ('Emma Brown', '789-456-1230'),
       ('Daniel Martinez', '321-654-9870');

#Droping
CREATE TABLE extra_services
(
    id   int PRIMARY KEY auto_increment,
    name varchar(255)
);

DROP TABLE extra_services;

#Modification
ALTER TABLE parks
    ADD COLUMN taxes float;

ALTER TABLE parks
    MODIFY COLUMN taxes SMALLINT;

ALTER TABLE parks
    RENAME COLUMN taxes TO rates;

ALTER TABLE parks
    DROP COLUMN rates;

#Updating row in tables:
UPDATE drivers
SET car_id = 3
WHERE name = 'Alice Brown';

UPDATE customers
SET name = 'Emma BLACK'
WHERE name = 'Emma Brown';

#DELETE row:
DELETE
FROM customers
WHERE name = 'Daniel Martinez';

#SELECTs + JOINS

## Cars with addresses of their parks
SELECT c.model, c.price, p.address AS park_address
FROM cars c
         INNER JOIN parks p ON c.park_id = p.id;

## Parks with the number of cars in it.
SELECT p.address, COUNT(c.id) AS num_cars_parked
FROM parks p
         LEFT JOIN cars c ON p.id = c.park_id
GROUP BY p.address;

## Who&Where report
SELECT d.name, c.model AS car_model, p.address AS park_address
FROM drivers d
         INNER JOIN cars c ON d.car_id = c.id
         INNER JOIN parks p ON c.park_id = p.id;
