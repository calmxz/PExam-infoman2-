CREATE TABLE IF NOT EXISTS user_roles(
	role_id SERIAL PRIMARY KEY,
	role_name VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS users(
	user_id SERIAL PRIMARY KEY,
	username VARCHAR(100) UNIQUE,
	hashed_password VARCHAR(255),
	first_name VARCHAR(100),
	middle_name VARCHAR(100),
	last_name VARCHAR(100),
	gender VARCHAR(10),
	civil_status VARCHAR(25),
	email VARCHAR(255) UNIQUE,
	phone_number VARCHAR(15) UNIQUE,
	role_id INT,	
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY(role_id) REFERENCES user_roles(role_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS users_address(
	id SERIAL PRIMARY KEY,
	user_id INT,
	house_no INT,
	street_name VARCHAR(100),
	barangay VARCHAR(100),
	municipality VARCHAR(100),
	zip_code INT,
	province VARCHAR(100),
	FOREIGN KEY(user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS shops(
	shop_id SERIAL PRIMARY KEY,
	shop_name VARCHAR(255),
	shop_location VARCHAR(255),
	user_id INT,
	FOREIGN KEY(user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS products(
	product_id SERIAL PRIMARY KEY,
	product_name VARCHAR(100),
	description VARCHAR(255),
	unit_price DECIMAL(10, 2),
	stock INT
);

CREATE TABLE IF NOT EXISTS product_images(
	pi_id SERIAL PRIMARY KEY,
	product_id INT,
	image_link VARCHAR(255),
	FOREIGN KEY(product_id) REFERENCES products(product_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS shop_products(
	sp_id SERIAL PRIMARY KEY,
	shop_id INT,
	product_id INT,
	FOREIGN KEY(shop_id) REFERENCES shops(shop_id) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY(product_id) REFERENCES products(product_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS orders(
	order_id SERIAL PRIMARY KEY,
	date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	total DECIMAL(10, 2)
);

CREATE TABLE IF NOT EXISTS order_details(
	od_id SERIAL PRIMARY KEY,
	order_id INT,
	product_id INT,
	shop_id INT,
	quantity INT,
	order_detail_total DECIMAL(10, 2),
	FOREIGN KEY(order_id) REFERENCES orders(order_id) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY(product_id) REFERENCES products(product_id) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY(shop_id) REFERENCES shops(shop_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO user_roles(role_name) VALUES ('Seller'), ('Customer')