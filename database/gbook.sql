CREATE DATABASE gbook;

USE gbook;

CREATE TABLE messages(
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL, 
message TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);
INSERT INTO messages (name, email, message) VALUES
('Иван', 'ivan@mail.com', 'Привет! Отличный сайт.'),
('Анна', 'anna@example.com', 'Спасибо за возможность оставить сообщение.'),
('Дмитрий', 'dmitriy@host.com', 'Хочу узнать, как работает форма.'),
('Ольга', 'olga@gmail.com', 'Все супер, удачи в развитии!'),
('Сергей', 'sergey@mail.ru', 'Проверка работы гостевой книги.');