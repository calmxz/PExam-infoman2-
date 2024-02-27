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
