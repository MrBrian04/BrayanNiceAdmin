DROP DATABASE IF EXISTS nicelate_db;
CREATE DATABASE nicelate_db;
USE nicelate_db;

CREATE TABLE users (
    pk_id_user INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(50) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_datatime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO users (user_name, user_email, user_password)
VALUES ('brayan', 'brayan@gmail.com', '1234');

CREATE TABLE roles (
pk_id_role INT auto_increment primary key,
role_name VARCHAR(100)NOT NULL,
role_description varchar(255) NULL
)ENGINE=InnoDB;

CREATE TABLE user_role(
fk_id_user INT NOT NULL,
fk_id_role INT NOT NULL,
assigned_at datetime not null default current_timestamp,
primary key (fk_id_user, fk_id_role),
foreign key (fk_id_user)
	references users(pk_id_user)
    ON update cascade
    on delete cascade,
foreign key (fk_id_role)
	references roles(pk_id_role)
    on update cascade
    on delete restrict
)ENGINE=InnoDB;

select * from users;