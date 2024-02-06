-- Packaging and Labeling
CREATE TABLE PackagingDetails (
    id_packaging SERIAL PRIMARY KEY,
    packaging_type VARCHAR(50) NOT NULL,
    packaging_material VARCHAR(50) NOT NULL,
    packaging_date DATE DEFAULT CURRENT_DATE
);

CREATE TABLE BarcodeLabels (
    id_label SERIAL PRIMARY KEY,
    label_information VARCHAR(255) NOT NULL,
    barcode VARCHAR(20) NOT NULL
);

-- Sanitary Regulations
CREATE TABLE ComplianceRegulations (
    id_compliance SERIAL PRIMARY KEY,
    mexico_compliance BOOLEAN DEFAULT false,
    united_states_compliance BOOLEAN DEFAULT false
);

-- Distribution
CREATE TABLE DistributionClients (
    id_distribution_client SERIAL PRIMARY KEY,
    client_name VARCHAR(100) NOT NULL,
    client_type VARCHAR(20) CHECK (client_type IN ('wholesaler', 'retailer')),
    client_contact VARCHAR(100),
    client_phone VARCHAR(15),
    client_email VARCHAR(100),
    contractual_details TEXT
);

-- Special Offers and Discounts
CREATE TABLE SpecialOffers (
    id_offer SERIAL PRIMARY KEY,
    offer_description TEXT,
    start_date DATE DEFAULT CURRENT_DATE,
    end_date DATE,
    included_products TEXT
);

-- Sales
CREATE TABLE Orders (
    id_order SERIAL PRIMARY KEY,
    requested_quantity INTEGER CHECK (requested_quantity >= 0),
    order_date DATE DEFAULT CURRENT_DATE,
    expected_delivery_date DATE,
    order_status VARCHAR(20) DEFAULT 'pending' CHECK (order_status IN ('pending', 'delivered', 'cancelled')),
    id_client INTEGER REFERENCES DistributionClients(id_distribution_client),
    id_offer INTEGER REFERENCES SpecialOffers(id_offer)
);

CREATE TABLE Invoices (
    id_invoice SERIAL PRIMARY KEY,
    total_amount DECIMAL(10, 2) CHECK (total_amount >= 0),
    issuance_date DATE DEFAULT CURRENT_DATE,
    invoice_type VARCHAR(20) DEFAULT 'issued' CHECK (invoice_type IN ('issued', 'received')),
    id_order INTEGER REFERENCES Orders(id_order),
    id_distribution_client INTEGER REFERENCES DistributionClients(id_distribution_client),
    id_offer INTEGER REFERENCES SpecialOffers(id_offer)
);

-- Product Inventory
CREATE TABLE ProductInventory (
    id_inventory SERIAL PRIMARY KEY,
    available_quantity INTEGER CHECK (available_quantity >= 0),
    manufacture_date DATE DEFAULT CURRENT_DATE,
    expiration_date DATE,
    id_label INTEGER REFERENCES BarcodeLabels(id_label),
    id_packaging INTEGER REFERENCES PackagingDetails(id_packaging),
    id_compliance INTEGER REFERENCES ComplianceRegulations(id_compliance),
    id_order INTEGER REFERENCES Orders(id_order),
    id_distribution_client INTEGER REFERENCES DistributionClients(id_distribution_client),
    id_offer INTEGER REFERENCES SpecialOffers(id_offer)
);

-- Clients
CREATE TABLE CustomerProfile (
    id_customer SERIAL PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    demographic_information TEXT,
    customer_contact VARCHAR(100),
    purchase_history TEXT,
    preferences TEXT,
    id_distribution_client INTEGER REFERENCES DistributionClients(id_distribution_client)
);

-- Returns
CREATE TABLE Returns (
    id_return SERIAL PRIMARY KEY,
    returned_quantity INTEGER CHECK (returned_quantity >= 0),
    return_reason TEXT,
    corrective_actions TEXT,
    id_order INTEGER REFERENCES Orders(id_order),
    id_distribution_client INTEGER REFERENCES DistributionClients(id_distribution_client),
    id_offer INTEGER REFERENCES SpecialOffers(id_offer)
);

-- Stored Procedure to insert packaging details
CREATE OR REPLACE FUNCTION insert_packaging_details(
    p_packaging_type VARCHAR(50),
    p_packaging_material VARCHAR(50)
)
RETURNS INTEGER AS $$
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO PackagingDetails (packaging_type, packaging_material)
    VALUES (p_packaging_type, p_packaging_material)
    RETURNING PackagingDetails.id_packaging INTO new_id;

    RETURN new_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to get packaging details by ID
CREATE OR REPLACE FUNCTION get_packaging_details_by_id(p_packaging_id INTEGER)
RETURNS TABLE (
    id_packaging INTEGER,
    packaging_type VARCHAR(50),
    packaging_material VARCHAR(50),
    packaging_date DATE
) AS $$
BEGIN
    RETURN QUERY SELECT * FROM PackagingDetails WHERE PackagingDetails.id_packaging = p_packaging_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to update packaging details
CREATE OR REPLACE FUNCTION update_packaging_details(
    p_packaging_id INTEGER,
    p_packaging_type VARCHAR(50),
    p_packaging_material VARCHAR(50)
)
RETURNS BOOLEAN AS $$
BEGIN
    UPDATE PackagingDetails
    SET
        packaging_type = p_packaging_type,
        packaging_material = p_packaging_material
    WHERE PackagingDetails.id_packaging = p_packaging_id;

    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to delete packaging details by ID
CREATE OR REPLACE FUNCTION delete_packaging_details(p_packaging_id INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
    DELETE FROM PackagingDetails WHERE PackagingDetails.id_packaging = p_packaging_id;
    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to insert barcode labels
CREATE OR REPLACE FUNCTION insert_barcode_label(
    p_label_information VARCHAR(255),
    p_barcode VARCHAR(20)
)
RETURNS INTEGER AS $$
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO BarcodeLabels (label_information, barcode)
    VALUES (p_label_information, p_barcode)
    RETURNING BarcodeLabels.id_label INTO new_id;

    RETURN new_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to get barcode labels by ID
CREATE OR REPLACE FUNCTION get_barcode_label_by_id(p_label_id INTEGER)
RETURNS TABLE (
    id_label INTEGER,
    label_information VARCHAR(255),
    barcode VARCHAR(20)
) AS $$
BEGIN
    RETURN QUERY SELECT * FROM BarcodeLabels WHERE BarcodeLabels.id_label = p_label_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to update barcode labels
CREATE OR REPLACE FUNCTION update_barcode_label(
    p_label_id INTEGER,
    p_label_information VARCHAR(255),
    p_barcode VARCHAR(20)
)
RETURNS BOOLEAN AS $$
BEGIN
    UPDATE BarcodeLabels
    SET
        label_information = p_label_information,
        barcode = p_barcode
    WHERE BarcodeLabels.id_label = p_label_id;

    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to delete barcode labels by ID
CREATE OR REPLACE FUNCTION delete_barcode_label(p_label_id INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
    DELETE FROM BarcodeLabels WHERE BarcodeLabels.id_label = p_label_id;
    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to insert compliance regulations
CREATE OR REPLACE FUNCTION insert_compliance_regulation(
    p_mexico_compliance BOOLEAN,
    p_united_states_compliance BOOLEAN
)
RETURNS INTEGER AS $$
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO ComplianceRegulations (mexico_compliance, united_states_compliance)
    VALUES (p_mexico_compliance, p_united_states_compliance)
    RETURNING ComplianceRegulations.id_compliance INTO new_id;

    RETURN new_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to get compliance regulations by ID
CREATE OR REPLACE FUNCTION get_compliance_regulation_by_id(p_compliance_id INTEGER)
RETURNS TABLE (
    id_compliance INTEGER,
    mexico_compliance BOOLEAN,
    united_states_compliance BOOLEAN
) AS $$
BEGIN
    RETURN QUERY SELECT * FROM ComplianceRegulations WHERE ComplianceRegulations.id_compliance = p_compliance_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to update compliance regulations
CREATE OR REPLACE FUNCTION update_compliance_regulation(
    p_compliance_id INTEGER,
    p_mexico_compliance BOOLEAN,
    p_united_states_compliance BOOLEAN
)
RETURNS BOOLEAN AS $$
BEGIN
    UPDATE ComplianceRegulations
    SET
        mexico_compliance = p_mexico_compliance,
        united_states_compliance = p_united_states_compliance
    WHERE ComplianceRegulations.id_compliance = p_compliance_id;

    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to delete compliance regulations by ID
CREATE OR REPLACE FUNCTION delete_compliance_regulation(p_compliance_id INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
    DELETE FROM ComplianceRegulations WHERE ComplianceRegulations.id_compliance = p_compliance_id;
    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to insert distribution clients
CREATE OR REPLACE FUNCTION insert_distribution_client(
    p_client_name VARCHAR(100),
    p_client_type VARCHAR(20),
    p_client_contact VARCHAR(100),
    p_client_phone VARCHAR(15),
    p_client_email VARCHAR(100),
    p_contractual_details TEXT
)
RETURNS INTEGER AS $$
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO DistributionClients (client_name, client_type, client_contact, client_phone, client_email, contractual_details)
    VALUES (p_client_name, p_client_type, p_client_contact, p_client_phone, p_client_email, p_contractual_details)
    RETURNING DistributionClients.id_distribution_client INTO new_id;

    RETURN new_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to get distribution clients by ID
CREATE OR REPLACE FUNCTION get_distribution_client_by_id(p_client_id INTEGER)
RETURNS TABLE (
    id_distribution_client INTEGER,
    client_name VARCHAR(100),
    client_type VARCHAR(20),
    client_contact VARCHAR(100),
    client_phone VARCHAR(15),
    client_email VARCHAR(100),
    contractual_details TEXT
) AS $$
BEGIN
    RETURN QUERY SELECT * FROM DistributionClients WHERE DistributionClients.id_distribution_client = p_client_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to update distribution clients
CREATE OR REPLACE FUNCTION update_distribution_client(
    p_client_id INTEGER,
    p_client_name VARCHAR(100),
    p_client_type VARCHAR(20),
    p_client_contact VARCHAR(100),
    p_client_phone VARCHAR(15),
    p_client_email VARCHAR(100),
    p_contractual_details TEXT
)
RETURNS BOOLEAN AS $$
BEGIN
    UPDATE DistributionClients
    SET
        client_name = p_client_name,
        client_type = p_client_type,
        client_contact = p_client_contact,
        client_phone = p_client_phone,
        client_email = p_client_email,
        contractual_details = p_contractual_details
    WHERE DistributionClients.id_distribution_client = p_client_id;

    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to delete distribution clients by ID
CREATE OR REPLACE FUNCTION delete_distribution_client(p_client_id INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
    DELETE FROM DistributionClients WHERE DistributionClients.id_distribution_client = p_client_id;
    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to insert orders
CREATE OR REPLACE FUNCTION insert_order(
    p_requested_quantity INTEGER,
    p_order_date DATE,
    p_expected_delivery_date DATE,
    p_order_status VARCHAR(20),
    p_id_client INTEGER,
    p_id_offer INTEGER
)
RETURNS INTEGER AS $$
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO Orders (requested_quantity, order_date, expected_delivery_date, order_status, id_client, id_offer)
    VALUES (p_requested_quantity, p_order_date, p_expected_delivery_date, p_order_status, p_id_client, p_id_offer)
    RETURNING Orders.id_order INTO new_id;

    RETURN new_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to get orders by ID
CREATE OR REPLACE FUNCTION get_order_by_id(p_order_id INTEGER)
RETURNS TABLE (
    id_order INTEGER,
    requested_quantity INTEGER,
    order_date DATE,
    expected_delivery_date DATE,
    order_status VARCHAR(20),
    id_client INTEGER,
    id_offer INTEGER
) AS $$
BEGIN
    RETURN QUERY SELECT * FROM Orders WHERE Orders.id_order = p_order_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to update orders
CREATE OR REPLACE FUNCTION update_order(
    p_order_id INTEGER,
    p_requested_quantity INTEGER,
    p_order_date DATE,
    p_expected_delivery_date DATE,
    p_order_status VARCHAR(20),
    p_id_client INTEGER,
    p_id_offer INTEGER
)
RETURNS BOOLEAN AS $$
BEGIN
    UPDATE Orders
    SET
        requested_quantity = p_requested_quantity,
        order_date = p_order_date,
        expected_delivery_date = p_expected_delivery_date,
        order_status = p_order_status,
        id_client = p_id_client,
        id_offer = p_id_offer
    WHERE Orders.id_order = p_order_id;

    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to delete orders by ID
CREATE OR REPLACE FUNCTION delete_order(p_order_id INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
    DELETE FROM Orders WHERE Orders.id_order = p_order_id;
    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Trigger for cascading delete in Orders table when DistributionClient is deleted
CREATE OR REPLACE FUNCTION delete_cascade_distribution_clients_orders()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM Orders WHERE id_client = OLD.id_distribution_client;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_distribution_clients_orders
AFTER DELETE ON DistributionClients
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_distribution_clients_orders();

-- Trigger for cascading delete in Orders table when a SpecialOffer is deleted
CREATE OR REPLACE FUNCTION delete_cascade_special_offer_orders()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM Orders WHERE id_offer = OLD.id_offer;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_special_offer_orders
AFTER DELETE ON SpecialOffers
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_special_offer_orders();

-- Stored Procedure to insert invoices
CREATE OR REPLACE FUNCTION insert_invoice(
    p_total_amount DECIMAL(10, 2),
    p_issuance_date DATE,
    p_invoice_type VARCHAR(20),
    p_id_order INTEGER,
    p_id_distribution_client INTEGER,
    p_id_offer INTEGER
)
RETURNS INTEGER AS $$
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO Invoices (total_amount, issuance_date, invoice_type, id_order, id_distribution_client, id_offer)
    VALUES (p_total_amount, p_issuance_date, p_invoice_type, p_id_order, p_id_distribution_client, p_id_offer)
    RETURNING Invoices.id_invoice INTO new_id;

    RETURN new_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to get invoices by ID
CREATE OR REPLACE FUNCTION get_invoice_by_id(p_invoice_id INTEGER)
RETURNS TABLE (
    id_invoice INTEGER,
    total_amount DECIMAL(10, 2),
    issuance_date DATE,
    invoice_type VARCHAR(20),
    id_order INTEGER,
    id_distribution_client INTEGER,
    id_offer INTEGER
) AS $$
BEGIN
    RETURN QUERY SELECT * FROM Invoices WHERE Invoices.id_invoice = p_invoice_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to update invoices
CREATE OR REPLACE FUNCTION update_invoice(
    p_invoice_id INTEGER,
    p_total_amount DECIMAL(10, 2),
    p_issuance_date DATE,
    p_invoice_type VARCHAR(20),
    p_id_order INTEGER,
    p_id_distribution_client INTEGER,
    p_id_offer INTEGER
)
RETURNS BOOLEAN AS $$
BEGIN
    UPDATE Invoices
    SET
        total_amount = p_total_amount,
        issuance_date = p_issuance_date,
        invoice_type = p_invoice_type,
        id_order = p_id_order,
        id_distribution_client = p_id_distribution_client,
        id_offer = p_id_offer
    WHERE Invoices.id_invoice = p_invoice_id;

    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to delete invoices by ID
CREATE OR REPLACE FUNCTION delete_invoice(p_invoice_id INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
    DELETE FROM Invoices WHERE Invoices.id_invoice = p_invoice_id;
    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Trigger for cascading delete in Invoices table when DistributionClient is deleted
CREATE OR REPLACE FUNCTION delete_cascade_distribution_clients_invoices()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM Invoices WHERE id_distribution_client = OLD.id_distribution_client;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_distribution_clients_invoices
AFTER DELETE ON DistributionClients
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_distribution_clients_invoices();

-- Trigger for cascading delete in Invoices table when an Order is deleted
CREATE OR REPLACE FUNCTION delete_cascade_orders_invoices()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM Invoices WHERE id_order = OLD.id_order;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_orders_invoices
AFTER DELETE ON Orders
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_orders_invoices();

-- Trigger for cascading delete in Invoices table when a SpecialOffer is deleted
CREATE OR REPLACE FUNCTION delete_cascade_special_offer_invoices()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM Invoices WHERE id_offer = OLD.id_offer;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_special_offer_invoices
AFTER DELETE ON SpecialOffers
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_special_offer_invoices();

-- Stored Procedure to insert product inventory
CREATE OR REPLACE FUNCTION insert_product_inventory(
    p_available_quantity INTEGER,
    p_manufacture_date DATE,
    p_expiration_date DATE,
    p_id_label INTEGER,
    p_id_packaging INTEGER,
    p_id_compliance INTEGER,
    p_id_order INTEGER,
    p_id_distribution_client INTEGER,
    p_id_offer INTEGER
)
RETURNS INTEGER AS $$
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO ProductInventory (available_quantity, manufacture_date, expiration_date, id_label, id_packaging, id_compliance, id_order, id_distribution_client, id_offer)
    VALUES (p_available_quantity, p_manufacture_date, p_expiration_date, p_id_label, p_id_packaging, p_id_compliance, p_id_order, p_id_distribution_client, p_id_offer)
    RETURNING ProductInventory.id_inventory INTO new_id;

    RETURN new_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to get product inventory by ID
CREATE OR REPLACE FUNCTION get_product_inventory_by_id(p_inventory_id INTEGER)
RETURNS TABLE (
    id_inventory INTEGER,
    available_quantity INTEGER,
    manufacture_date DATE,
    expiration_date DATE,
    id_label INTEGER,
    id_packaging INTEGER,
    id_compliance INTEGER,
    id_order INTEGER,
    id_distribution_client INTEGER,
    id_offer INTEGER
) AS $$
BEGIN
    RETURN QUERY SELECT * FROM ProductInventory WHERE ProductInventory.id_inventory = p_inventory_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to update product inventory
CREATE OR REPLACE FUNCTION update_product_inventory(
    p_inventory_id INTEGER,
    p_available_quantity INTEGER,
    p_manufacture_date DATE,
    p_expiration_date DATE,
    p_id_label INTEGER,
    p_id_packaging INTEGER,
    p_id_compliance INTEGER,
    p_id_order INTEGER,
    p_id_distribution_client INTEGER,
    p_id_offer INTEGER
)
RETURNS BOOLEAN AS $$
BEGIN
    UPDATE ProductInventory
    SET
        available_quantity = p_available_quantity,
        manufacture_date = p_manufacture_date,
        expiration_date = p_expiration_date,
        id_label = p_id_label,
        id_packaging = p_id_packaging,
        id_compliance = p_id_compliance,
        id_order = p_id_order,
        id_distribution_client = p_id_distribution_client,
        id_offer = p_id_offer
    WHERE ProductInventory.id_inventory = p_inventory_id;

    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to delete product inventory by ID
CREATE OR REPLACE FUNCTION delete_product_inventory(p_inventory_id INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
    DELETE FROM ProductInventory WHERE ProductInventory.id_inventory = p_inventory_id;
    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Trigger for cascading delete in ProductInventory table when DistributionClient is deleted
CREATE OR REPLACE FUNCTION delete_cascade_distribution_clients_product_inventory()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM ProductInventory WHERE id_distribution_client = OLD.id_distribution_client;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_distribution_clients_product_inventory
AFTER DELETE ON DistributionClients
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_distribution_clients_product_inventory();

-- Trigger for cascading delete in ProductInventory table when an Order is deleted
CREATE OR REPLACE FUNCTION delete_cascade_orders_product_inventory()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM ProductInventory WHERE id_order = OLD.id_order;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_orders_product_inventory
AFTER DELETE ON Orders
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_orders_product_inventory();

-- Trigger for cascading delete in ProductInventory table when a SpecialOffer is deleted
CREATE OR REPLACE FUNCTION delete_cascade_special_offer_product_inventory()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM ProductInventory WHERE id_offer = OLD.id_offer;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_special_offer_product_inventory
AFTER DELETE ON SpecialOffers
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_special_offer_product_inventory();

-- Stored Procedure to insert customer profile
CREATE OR REPLACE FUNCTION insert_customer_profile(
    p_customer_name VARCHAR(100),
    p_demographic_information TEXT,
    p_customer_contact VARCHAR(100),
    p_purchase_history TEXT,
    p_preferences TEXT,
    p_id_distribution_client INTEGER
)
RETURNS INTEGER AS $$
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO CustomerProfile (customer_name, demographic_information, customer_contact, purchase_history, preferences, id_distribution_client)
    VALUES (p_customer_name, p_demographic_information, p_customer_contact, p_purchase_history, p_preferences, p_id_distribution_client)
    RETURNING CustomerProfile.id_customer INTO new_id;

    RETURN new_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to get customer profile by ID
CREATE OR REPLACE FUNCTION get_customer_profile_by_id(p_customer_id INTEGER)
RETURNS TABLE (
    id_customer INTEGER,
    customer_name VARCHAR(100),
    demographic_information TEXT,
    customer_contact VARCHAR(100),
    purchase_history TEXT,
    preferences TEXT,
    id_distribution_client INTEGER
) AS $$
BEGIN
    RETURN QUERY SELECT * FROM CustomerProfile WHERE CustomerProfile.id_customer = p_customer_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to update customer profile
CREATE OR REPLACE FUNCTION update_customer_profile(
    p_customer_id INTEGER,
    p_customer_name VARCHAR(100),
    p_demographic_information TEXT,
    p_customer_contact VARCHAR(100),
    p_purchase_history TEXT,
    p_preferences TEXT,
    p_id_distribution_client INTEGER
)
RETURNS BOOLEAN AS $$
BEGIN
    UPDATE CustomerProfile
    SET
        customer_name = p_customer_name,
        demographic_information = p_demographic_information,
        customer_contact = p_customer_contact,
        purchase_history = p_purchase_history,
        preferences = p_preferences,
        id_distribution_client = p_id_distribution_client
    WHERE CustomerProfile.id_customer = p_customer_id;

    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to delete customer profile by ID
CREATE OR REPLACE FUNCTION delete_customer_profile(p_customer_id INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
    DELETE FROM CustomerProfile WHERE CustomerProfile.id_customer = p_customer_id;
    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Trigger for cascading delete in CustomerProfile table when DistributionClient is deleted
CREATE OR REPLACE FUNCTION delete_cascade_distribution_clients_customer_profile()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM CustomerProfile WHERE id_distribution_client = OLD.id_distribution_client;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_distribution_clients_customer_profile
AFTER DELETE ON DistributionClients
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_distribution_clients_customer_profile();

-- Stored Procedure to insert special offers
CREATE OR REPLACE FUNCTION insert_special_offer(
    p_offer_description TEXT,
    p_start_date DATE,
    p_end_date DATE,
    p_included_products TEXT
)
RETURNS INTEGER AS $$
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO SpecialOffers (offer_description, start_date, end_date, included_products)
    VALUES (p_offer_description, p_start_date, p_end_date, p_included_products)
    RETURNING SpecialOffers.id_offer INTO new_id;

    RETURN new_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to get special offers by ID
CREATE OR REPLACE FUNCTION get_special_offer_by_id(p_offer_id INTEGER)
RETURNS TABLE (
    id_offer INTEGER,
    offer_description TEXT,
    start_date DATE,
    end_date DATE,
    included_products TEXT
) AS $$
BEGIN
    RETURN QUERY SELECT * FROM SpecialOffers WHERE SpecialOffers.id_offer = p_offer_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to update special offers
CREATE OR REPLACE FUNCTION update_special_offer(
    p_offer_id INTEGER,
    p_offer_description TEXT,
    p_start_date DATE,
    p_end_date DATE,
    p_included_products TEXT
)
RETURNS BOOLEAN AS $$
BEGIN
    UPDATE SpecialOffers
    SET
        offer_description = p_offer_description,
        start_date = p_start_date,
        end_date = p_end_date,
        included_products = p_included_products
    WHERE SpecialOffers.id_offer = p_offer_id;

    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to delete special offers by ID
CREATE OR REPLACE FUNCTION delete_special_offer(p_offer_id INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
    DELETE FROM SpecialOffers WHERE SpecialOffers.id_offer = p_offer_id;
    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to insert returns
CREATE OR REPLACE FUNCTION insert_return(
    p_returned_quantity INTEGER,
    p_return_reason TEXT,
    p_corrective_actions TEXT,
    p_id_order INTEGER
)
RETURNS INTEGER AS $$
DECLARE
    new_id INTEGER;
BEGIN
    INSERT INTO Returns (returned_quantity, return_reason, corrective_actions, id_order)
    VALUES (p_returned_quantity, p_return_reason, p_corrective_actions, p_id_order)
    RETURNING Returns.id_return INTO new_id;

    RETURN new_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to get returns by ID
CREATE OR REPLACE FUNCTION get_return_by_id(p_return_id INTEGER)
RETURNS TABLE (
    id_return INTEGER,
    returned_quantity INTEGER,
    return_reason TEXT,
    corrective_actions TEXT,
    id_order INTEGER
) AS $$
BEGIN
    RETURN QUERY SELECT * FROM Returns WHERE Returns.id_return = p_return_id;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to update returns
CREATE OR REPLACE FUNCTION update_return(
    p_return_id INTEGER,
    p_returned_quantity INTEGER,
    p_return_reason TEXT,
    p_corrective_actions TEXT,
    p_id_order INTEGER
)
RETURNS BOOLEAN AS $$
BEGIN
    UPDATE Returns
    SET
        returned_quantity = p_returned_quantity,
        return_reason = p_return_reason,
        corrective_actions = p_corrective_actions,
        id_order = p_id_order
    WHERE Returns.id_return = p_return_id;

    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Stored Procedure to delete returns by ID
CREATE OR REPLACE FUNCTION delete_return(p_return_id INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
    DELETE FROM Returns WHERE Returns.id_return = p_return_id;
    RETURN FOUND;
END;
$$ LANGUAGE plpgsql;

-- Trigger for cascading delete in Returns table when DistributionClient is deleted
CREATE OR REPLACE FUNCTION delete_cascade_distribution_clients_returns()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM Returns WHERE id_distribution_client = OLD.id_distribution_client;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_distribution_clients_returns
AFTER DELETE ON DistributionClients
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_distribution_clients_returns();

-- Trigger for cascading delete in Returns table when an Order is deleted
CREATE OR REPLACE FUNCTION delete_cascade_orders_returns()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM Returns WHERE id_order = OLD.id_order;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_orders_returns
AFTER DELETE ON Orders
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_orders_returns();

-- Trigger for cascading delete in Returns table when a SpecialOffer is deleted
CREATE OR REPLACE FUNCTION delete_cascade_special_offer_returns()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM Returns WHERE id_offer = OLD.id_offer;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

-- Trigger definition
CREATE TRIGGER cascade_delete_special_offer_returns
AFTER DELETE ON SpecialOffers
FOR EACH ROW
EXECUTE FUNCTION delete_cascade_special_offer_returns();

COPY PackagingDetails FROM '/csv_data/packaging_details.csv' DELIMITER ',' CSV HEADER;
COPY BarcodeLabels FROM '/csv_data/barcode_labels.csv' DELIMITER ',' CSV HEADER;
COPY ComplianceRegulations FROM '/csv_data/compliance_regulations.csv' DELIMITER ',' CSV HEADER;
COPY DistributionClients FROM '/csv_data/distribution_clients.csv' DELIMITER ',' CSV HEADER;
COPY SpecialOffers FROM '/csv_data/special_offers.csv' DELIMITER ',' CSV HEADER;
COPY Orders FROM '/csv_data/orders.csv' DELIMITER ',' CSV HEADER;
COPY Invoices FROM '/csv_data/invoices.csv' DELIMITER ',' CSV HEADER;
COPY ProductInventory FROM '/csv_data/product_inventory.csv' DELIMITER ',' CSV HEADER;
COPY CustomerProfile FROM '/csv_data/customer_profile.csv' DELIMITER ',' CSV HEADER;
COPY Returns FROM '/csv_data/returns.csv' DELIMITER ',' CSV HEADER;
