CREATE OR REPLACE FUNCTION insert_user(
    p_username VARCHAR(100),
    p_hashed_password VARCHAR(255),
    p_first_name VARCHAR(100),
    p_middle_name VARCHAR(100),
    p_last_name VARCHAR(100),
    p_gender VARCHAR(10),
    p_civil_status VARCHAR(25),
    p_email VARCHAR(255),
    p_phone_number VARCHAR(15),
    p_role_id INT
)
RETURNS VOID AS $$
BEGIN
    INSERT INTO users (
        username,
        hashed_password,
        first_name,
        middle_name,
        last_name,
        gender,
        civil_status,
        email,
        phone_number,
        role_id
    ) VALUES (
        p_username,
        p_hashed_password,
        p_first_name,
        p_middle_name,
        p_last_name,
        p_gender,
        p_civil_status,
        p_email,
        p_phone_number,
        p_role_id
    );
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION authenticate_user(
    p_username VARCHAR(100),
    p_password VARCHAR(255)
)
RETURNS JSON AS $$
DECLARE
    v_user_data JSON;
BEGIN
    -- Retrieve user data including role ID
    SELECT 
        json_build_object(
            'user_id', u.user_id,
            'role_id', u.role_id,
            'hashed_password', u.hashed_password,
            'first_name', u.first_name,
            'last_name', u.last_name,
            'shop_id', s.shop_id,
            'shop_name', s.shop_name,
            'shop_location', s.shop_location
        ) INTO v_user_data
    FROM 
        users u
    LEFT JOIN
        shops s ON u.user_id = s.user_id
    WHERE 
        u.username = p_username;

    -- Return user data
    RETURN v_user_data;
END;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION insert_shop(
    p_shop_name VARCHAR(255),
    p_shop_location VARCHAR(255),
    p_user_id INT
)
RETURNS VOID AS $$
BEGIN
    INSERT INTO shops (shop_name, shop_location, user_id)
    VALUES (p_shop_name, p_shop_location, p_user_id);
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION add_product_to_shop(
    p_shop_id INT,
    p_product_name VARCHAR(100),
    p_description VARCHAR(255),
    p_unit_price DECIMAL(10, 2),
    p_stock INT,
    p_image_link VARCHAR(255)
)
RETURNS VOID AS $$
DECLARE
    v_product_id INT;
BEGIN
    -- Insert the product into the products table
    INSERT INTO products (product_name, description, unit_price, stock)
    VALUES (p_product_name, p_description, p_unit_price, p_stock)
    RETURNING product_id INTO v_product_id;
    
    -- Insert the product into the shop_products table
    INSERT INTO shop_products (shop_id, product_id)
    VALUES (p_shop_id, v_product_id);
    
    -- Insert the product image link into the product_images table
    INSERT INTO product_images (product_id, image_link)
    VALUES (v_product_id, p_image_link);
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION get_seller_products(p_shop_id INT)
RETURNS TABLE (
    product_id INT,
    product_name VARCHAR(100),
    description VARCHAR(255),
    unit_price DECIMAL(10, 2),
    image_link VARCHAR(255)
) AS $$
BEGIN
    RETURN QUERY
    SELECT p.product_id, p.product_name, p.description, p.unit_price, pi.image_link 
    FROM products p
    INNER JOIN shop_products sp ON p.product_id = sp.product_id
    INNER JOIN product_images pi ON p.product_id = pi.product_id
    WHERE sp.shop_id = p_shop_id;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_product(
    p_product_id INT,
    p_product_name VARCHAR,
    p_description TEXT,
    p_unit_price NUMERIC,
    p_stock INT,
    p_image_link VARCHAR
)
RETURNS VOID AS $$
BEGIN
    -- Update the product details
    UPDATE products
    SET 
        product_name = p_product_name,
        description = p_description,
        unit_price = p_unit_price,
        stock = p_stock
    WHERE
        product_id = p_product_id;

    -- Check if the product already has an image link
    IF EXISTS (
        SELECT 1 FROM product_images WHERE product_id = p_product_id
    ) THEN
        -- Update the existing image link
        UPDATE product_images
        SET 
            image_link = p_image_link
        WHERE
            product_id = p_product_id;
    ELSE
        -- Insert the image link into the product_images table
        INSERT INTO product_images (product_id, image_link)
        VALUES (p_product_id, p_image_link);
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION delete_product(
    p_product_id INT
)
RETURNS BOOLEAN AS $$
BEGIN
    -- Delete the product from product_images table
    DELETE FROM product_images WHERE product_id = p_product_id;

    -- Delete the product from shop_products table
    DELETE FROM shop_products WHERE product_id = p_product_id;

    -- Delete the product from products table
    DELETE FROM products WHERE product_id = p_product_id;
    
    RETURN TRUE; -- Return true indicating successful deletion
EXCEPTION
    WHEN OTHERS THEN
        RETURN FALSE; -- Return false if an error occurs
END;
$$ LANGUAGE plpgsql;
