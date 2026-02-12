/**
  DROP TABLE
 */

DROP TABLE IF EXISTS refresh_token CASCADE;
DROP TABLE IF EXISTS store CASCADE;
DROP TABLE IF EXISTS user CASCADE;

/**
  CREATE TABLE
 */

CREATE TABLE user (
    id CHAR(36) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,

    PRIMARY KEY (id),
    UNIQUE KEY unique_email (email)
);

ALTER TABLE user MODIFY id CHAR(36) NOT NULL DEFAULT (UUID());

CREATE TABLE store (
    id CHAR(36) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    date DATE NOT NULL,
    avis INTEGER NOT NULL,
    latitude DECIMAL(10,7) NOT NULL,
    longitude DECIMAL(10,7) NOT NULL,
    contact_nom VARCHAR(255) NOT NULL,
    contact_email VARCHAR(255) NOT NULL,
    photo VARCHAR(255) NOT NULL,
    creator_id CHAR(36) NOT NULL,

    PRIMARY KEY (id),
    INDEX index_date (date),
    INDEX index_avis (avis),
    INDEX index_location (latitude, longitude),
    CONSTRAINT fk_store_user
        FOREIGN KEY (creator_id)
        REFERENCES user(id)
        ON DELETE CASCADE
);

CREATE TABLE refresh_token (
    id CHAR(36) NOT NULL,
    user_id CHAR(36) NOT NULL,
    token_hash CHAR(64) NOT NULL,
    jti CHAR(36) NOT NULL,
    expires_at DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE KEY unique_jti (jti),
    UNIQUE KEY unique_token_hash (token_hash),
    INDEX index_user_id (user_id),
    INDEX index_expires_at (expires_at),
    CONSTRAINT fk_refresh_token_user
        FOREIGN KEY (user_id)
        REFERENCES user(id)
        ON DELETE CASCADE
);

ALTER TABLE refresh_token MODIFY jti CHAR(36) NOT NULL;

/**
  INSERT DATA
 */

INSERT INTO user (id, name, email, password)
VALUES (
        UUID(),
        'Admin ADMIN',
        'admin@legomap.com',
        '$2y$10$0vWY8fxfpGWcjuzVVPXehee/Za5YVylaZ11Nu9XqeyaT6G2mMz4O2'
);
