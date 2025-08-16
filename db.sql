CREATE TABLE user_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL UNIQUE,
    is_active INT NOT NULL DEFAULT 1,
    created_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by INT
);

INSERT INTO user_types (name) VALUES
('super admin'),
('admin'),
('client'),
('manager');

CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    wg_id TEXT,
    email TEXT NOT NULL,
    phone TEXT NOT NULL,
    password TEXT NOT NULL,
    user_type_id INT NOT NULL,
    fullname TEXT,
    address TEXT,
    city TEXT,
    state TEXT,
    country TEXT,
    zipcode TEXT,
    is_verified INT NOT NULL DEFAULT 0,
    government_id TEXT,
    government_id_type TEXT,
    is_active INT NOT NULL DEFAULT 1,
    created_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by INT,
    FOREIGN KEY (user_type_id) REFERENCES user_types(id)
);

INSERT INTO users (
    wg_id, email, phone, password, user_type_id, fullname, is_active, created_by
) VALUES
('WG001', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 1, 'Tony Stark', 1, NULL),
(  'WG002', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 2, 'Sanjay Rathod', 1, NULL),
( 'WG003', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 4, 'Sanjay Rathod', 1, NULL),
(  'WG004', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 4, 'Sanjay Rathod', 1, NULL),
(  'WG005', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 4, 'Sanjay Rathod', 1, NULL),
(  'WG006', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 4, 'Sanjay Rathod', 1, NULL),
(  'WG007', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Dinesh Patel', 1, 2),
(  'WG008', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Nilesh B Naika', 1, 2),
(  'WG009', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Hemant Rathod', 1, 3),
( 'WG0010', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Anish Patel', 1, 3),
( 'WG0011', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Jitu A Patel', 1, 8),
( 'WG0012', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Sharad Patel', 1, 8),
( 'WG0013', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Hetal Naika', 1, 8),
( 'WG0014', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Ashok Patel', 1, 8),
( 'WG0015', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Nilesh D Rathod', 1, 8),
( 'WG0016', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Sharad Patel', 1, 12),
( 'WG0017', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Nitisha Patel', 1, 10),
( 'WG0018', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Dipak Pawar', 1, 10),
( 'WG0019', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Nilesh Ganvit', 1, 18),
( 'WG0020', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Suresh B Rathod', 1, 10),
( 'WG0021', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Manoj B Rathod', 1, 20),
( 'WG0022', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Kanu B Rathod', 1, 21),
( 'WG0023', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Ranjit Talavia', 1, 22),
( 'WG0024', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Hitendra Talavia', 1, 23),
( 'WG0025', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Brijesh Maisuriya', 1, 9),
( 'WG0026', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Brijesh', 1, 25),
( 'WG0027', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Rajnish Gautam', 1, 9),
( 'WG0028', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Vraj Gautam', 1, 27),
( 'WG0029', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Alpesh Patel', 1, 27),
( 'WG0030', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Hemant M Rathod', 1, 27),
( 'WG0031', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Jayvant Kamli', 1, 19),
( 'WG0032', 'support@wealthivaglobal.com', '9999999999', '$2y$12$S.rHz2Ac2FwcbJsCOCdos.NnQvANNNcy8FCjiqnUNO26B3ZliWSbe', 3, 'Bharat Gavit', 1, 31);

CREATE TABLE user_login_history (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    login_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address TEXT,
    user_agent TEXT,
    created_by INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE user_password_history (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    password TEXT NOT NULL,
    created_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

DELIMITER //
CREATE TRIGGER after_insert_user_passwords_history
AFTER INSERT ON user_passwords
FOR EACH ROW
BEGIN
  INSERT INTO user_password_history (user_id, password, created_datetime, created_by)
  VALUES (NEW.user_id, NEW.password, NEW.created_datetime, NEW.created_by);
END;
//
DELIMITER ;


CREATE TABLE user_herarchy (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    parent_id BIGINT NOT NULL,
    created_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by BIGINT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO user_herarchy (user_id, parent_id) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL),
(7, 2),
(8, 2),
(9, 3),
(10, 3),
(11, 8),
(12, 8),
(13, 8),
(14, 8),
(15, 8),
(16, 12),
(17, 10),
(18, 10),
(19, 18),
(20, 10),
(21, 20),
(22, 21),
(23, 22),
(24, 23),
(25, 9),
(26, 25),
(27, 9),
(28, 27),
(29, 27),
(30, 27),
(31, 19),
(32, 31);

-- Top-level users
INSERT INTO user_herarchy (user_id, parent_id) VALUES
(1, 'Tony Stark', NULL),
(2, 'Sanjay Rathod', NULL),
(3, 'Sanjay Rathod', NULL),
(4, 'Sanjay Rathod', NULL),
(5, 'Sanjay Rathod', NULL),
(6, 'Sanjay Rathod', NULL),
(7,  'Dinesh Patel',     2),
(8,  'Nilesh B Naika',   2),
(9,  'Hemant Rathod',    3),
(10, 'Anish Patel',      3),
(11, 'Jitu A Patel',     8),
(12, 'Sharad Patel',     8),
(13, 'Hetal Naika',      8),
(14, 'Ashok Patel',      8),
(15, 'Nilesh D Rathod',  8),
(16, 'Sharad Patel',     12),
(17, 'Nitisha Patel',    10),
(18, 'Dipak Pawar',      10),
(19, 'Nilesh Ganvit',    18),
(20, 'Suresh B Rathod',  10),
(21, 'Manoj B Rathod',   20),
(22, 'Kanu B Rathod',    21),
(23, 'Ranjit Talavia',   22),
(24, 'Hitendra Talavia', 23),
(25, 'Brijesh Maisuriya',9),
(26, 'Brijesh',          25),
(27, 'Rajnish Gautam',   9),
(28, 'Vraj Gautam',      27),
(29, 'Alpesh Patel',     27),
(30, 'Hemant M Rathod',  27),
(31, 'Jayvant Kamli',    19),
(32, 'Bharat Gavit',     31);


CREATE TABLE user_password_change_requests (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    token TEXT NOT NULL,
    user_id BIGINT NOT NULL,
    url TEXT NOT NULL,
    request_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expiry_datetime DATETIME NOT NULL,
    is_active INT NOT NULL DEFAULT 1,
    created_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by BIGINT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE meta_data (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    mkey TEXT NOT NULL UNIQUE,
    mvalue TEXT NOT NULL,
    is_active INT NOT NULL DEFAULT 1,
    created_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by BIGINT
);

CREATE TABLE user_deposite (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    amount BIGINT NOT NULL,
    entry_date DATETIME NOT NULL,
    is_active INT NOT NULL DEFAULT 1,
    created_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by BIGINT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE user_withdraw (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    amount BIGINT NOT NULL,
    entry_date DATETIME NOT NULL,
    is_active INT NOT NULL DEFAULT 1,
    created_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by BIGINT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);