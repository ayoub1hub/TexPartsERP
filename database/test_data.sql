BEGIN;

DO $$
DECLARE
    admin_id BIGINT;
    secretary_id BIGINT;
    client_1 BIGINT;
    client_2 BIGINT;
    client_3 BIGINT;
    supplier_1 BIGINT;
    supplier_2 BIGINT;
    product_1 BIGINT;
    product_2 BIGINT;
    product_3 BIGINT;
    product_4 BIGINT;
    product_5 BIGINT;
    invoice_1 BIGINT;
    invoice_2 BIGINT;
    invoice_3 BIGINT;
    now_value TIMESTAMP := CURRENT_TIMESTAMP;
BEGIN

	SELECT id INTO admin_id FROM users WHERE email = 'admin@texpart.ma' LIMIT 1;
  
    INSERT INTO users (name, email, email_verified_at, password, role, created_at, updated_at)
    VALUES ('Secretary Test', 'secretary@test.texparts.local', now_value,
        '$2y$12$Huix5bd4ZcN8E4o6F62e7uincqWwJAHmTlRARmnxVrLDT0qYVYFsK', 'secretary', now_value, now_value)
    RETURNING id INTO secretary_id;

    INSERT INTO clients (name, email, phone, address, created_at, updated_at)
    VALUES ('Atlas Textile', 'client1@test.texparts.local', '+212600000001', 'Casablanca', now_value, now_value)
    RETURNING id INTO client_1;
    INSERT INTO clients (name, email, phone, address, created_at, updated_at)
    VALUES ('Rif Industrie', 'client2@test.texparts.local', '+212600000002', 'Tanger', now_value, now_value)
    RETURNING id INTO client_2;
    INSERT INTO clients (name, email, phone, address, created_at, updated_at)
    VALUES ('Souss Confection', 'client3@test.texparts.local', '+212600000003', 'Agadir', now_value, now_value)
    RETURNING id INTO client_3;

    INSERT INTO suppliers (name, email, phone, address, created_at, updated_at)
    VALUES ('Filmaroc', 'supplier1@test.texparts.local', '+212611000001', 'Rabat', now_value, now_value)
    RETURNING id INTO supplier_1;
    INSERT INTO suppliers (name, email, phone, address, created_at, updated_at)
    VALUES ('Textile Supply', 'supplier2@test.texparts.local', '+212611000002', 'Marrakech', now_value, now_value)
    RETURNING id INTO supplier_2;

    INSERT INTO products (reference, name, quantity, description, purchase_price, selling_price, minimum_stock, active, created_at, updated_at)
    VALUES ('Prod-TEST-001', 'Fil polyester blanc', 100, 'Produit de test 1', 12.00, 20.00, 10, true, now_value, now_value)
    RETURNING id INTO product_1;
    INSERT INTO products (reference, name, quantity, description, purchase_price, selling_price, minimum_stock, active, created_at, updated_at)
    VALUES ('Prod-TEST-002', 'Fil polyester noir', 150, 'Produit de test 2', 14.00, 24.00, 10, true, now_value, now_value)
    RETURNING id INTO product_2;
    INSERT INTO products (reference, name, quantity, description, purchase_price, selling_price, minimum_stock, active, created_at, updated_at)
    VALUES ('Prod-TEST-003', 'Aiguille industrielle 90', 200, 'Produit de test 3', 3.00, 6.00, 5, true, now_value, now_value)
    RETURNING id INTO product_3;
    INSERT INTO products (reference, name, quantity, description, purchase_price, selling_price, minimum_stock, active, created_at, updated_at)
    VALUES ('Prod-TEST-004', 'Ruban textile rouge', 350, 'Produit de test 4', 8.00, 15.00, 5, true, now_value, now_value)
    RETURNING id INTO product_4;
    INSERT INTO products (reference, name, quantity, description, purchase_price, selling_price, minimum_stock, active, created_at, updated_at)
    VALUES ('TP-TEST-005', 'Article archive', 0, 'Produit inactif pour tester les filtres', 5.00, 9.00, 1, false, now_value, now_value)
    RETURNING id INTO product_5;

END $$;
COMMIT;