-- 1. Create Database
CREATE DATABASE IF NOT EXISTS voting_system CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE voting_system;

-- 2. Users Table (Admins & Voters)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','voter') NOT NULL DEFAULT 'voter',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Elections Table
CREATE TABLE IF NOT EXISTS elections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    status ENUM('open', 'closed') NOT NULL DEFAULT 'open',
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Candidates Table
CREATE TABLE IF NOT EXISTS candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    election_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    photo VARCHAR(255),
    position VARCHAR(100),
    FOREIGN KEY (election_id) REFERENCES elections(id) ON DELETE CASCADE
);

-- 5. Votes Table
CREATE TABLE IF NOT EXISTS votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    election_id INT NOT NULL,
    candidate_id INT NOT NULL,
    user_id INT NOT NULL,
    voted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(election_id, user_id),
    FOREIGN KEY (election_id) REFERENCES elections(id) ON DELETE CASCADE,
    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 6. Add Sample Admin & Voter
-- Password is 'admin123' and 'voter123', hashed with PHP's password_hash
INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$K2EYknZzA3p3IGJ5hzMkhuJKyA2zCeGLWDUzKk65Uemh1zGMU8B4S', 'admin'),
('voter1', '$2y$10$QFGjBpmBGiBDzrjXYiGqgOaPXf5j82QHwVFC1/R3OIrETxynGrhS2', 'voter');

-- 7. Create Presidential Election 2025
INSERT INTO elections (title, description, start_date, end_date, status) VALUES
('Presidential Election 2025', 'Choose your president for the 2025 term.', '2025-07-15 08:00:00', '2025-07-30 17:00:00', 'open');

-- 8. Insert Presidential Candidates (assumes election_id = 1)
INSERT INTO candidates (election_id, name, photo, position) VALUES
(1, 'Kathryn Bernardog', 'president.jpg', 'President'),
(1, 'Jisun Titum', 'president2.jpg', 'President'),
(1, 'Carlos Yolo', 'president3.jpg', 'President'),
(1, 'Yolo', 'president4.jpg', 'President'),
(1, 'Dionela Salvador Akumshumika', 'president5.jpg', 'President');
