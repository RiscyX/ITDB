-- Adatbázis: it
-- Felhasználó: it_user, jelszó: it_pass

-- Adatbázis létrehozása
CREATE DATABASE IF NOT EXISTS it CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE it;

-- Felhasználó létrehozása és jogosultságok
CREATE USER IF NOT EXISTS 'it_user'@'localhost' IDENTIFIED BY 'it_pass';
GRANT ALL PRIVILEGES ON it.* TO 'it_user'@'localhost';
FLUSH PRIVILEGES;

-- Táblák

CREATE TABLE IF NOT EXISTS games (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  platform VARCHAR(50) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL,
  image VARCHAR(255),
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(100) NOT NULL,
  customer_email VARCHAR(100) NOT NULL,
  total DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  game_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (game_id) REFERENCES games(id)
);

-- Mintaadatok
INSERT INTO games (title, platform, price, stock, image, description) VALUES
('The Witcher 3', 'PC', 8990, 10, 'witcher3.jpg', 'RPG, open world'),
('Cyberpunk 2077', 'PC', 12990, 8, 'cyberpunk2077.jpg', 'Futuristic RPG'),
('God of War', 'PS5', 15990, 5, 'game_683af4e4596237.48775723.png', 'Action adventure'),
('Mario Kart 8', 'Switch', 13990, 12, 'mariokart8.jpg', 'Racing fun for all ages');
