drop table if exists ingredient;
drop table if exists customer;
drop table if exists kitchenstaff;
drop table if exists waitstaff;
drop table if exists tablet;
drop table if exists table_status;
drop table if exists table_order;
drop table if exists order_ingredient;
drop table if exists weborder_status;

-- Weborder_status
CREATE TABLE weborder_status
(
	tablet_id char(110),
	table_number int,
	order_number int
) ENGINE = INNODB;

-- Table ingredient 
CREATE TABLE ingredient
( 	
	ingredient_name char(25) PRIMARY KEY, 
	quantity int, 
	ingredient_type char(10) DEFAULT '\0',
	ingredient_desc text,
	ingredient_calories int,
	ingredient_price float(3, 2)
) ENGINE = INNODB;

-- Table customer 
CREATE TABLE customer
( 
	customer_firstname char(30) DEFAULT '\0', 
	customer_lastname char(30) DEFAULT '\0',
	password char(20) DEFAULT '\0', 
	email char(30) PRIMARY KEY,
	date_of_birth_year int,
	date_of_birth_month int,
	date_of_birth_day int,
	coupon int,
	sent_coupon char(1)
) ENGINE = INNODB;

-- Table kitchenstaff 
CREATE TABLE kitchenstaff
(
	kitchenstaff_id int PRIMARY KEY,
	kitchenstaff_firstname char(30),
	kitchenstaff_lastname char(30),
	password char(20),
	kitchenstaff_ip char(110)
) ENGINE = INNODB;

-- Table waitstaff 
CREATE TABLE waitstaff
(
	waitstaff_id int PRIMARY KEY,
	waitstaff_firstname char(30),
	waitstaff_lastname char(30),
	password char(20),
	waitstaff_ip char(110)
) ENGINE = INNODB;

-- Table table_status
CREATE TABLE table_status
(
	table_number int PRIMARY KEY,
	occupied char(1) NOT NULL DEFAULT 'N',
	refill char(1) NOT NULL DEFAULT 'N',
	assign_to char(110) REFERENCES waitstaff(waitstaff_ip),
	checkout char(1) NOT NULL DEFAULT 'N',
	call_staff char(1) NOT NULL DEFAULT 'N',
	tips float(7, 2),
	total float(7, 2),
	split_check char(1) NOT NULL DEFAULT 'N',
	split_check_num int,
	split_check_amount float(7, 2)
) ENGINE = INNODB;

-- Table tablet
CREATE TABLE tablet
(
	tablet_id char(110),
	table_number int REFERENCES table_status(table_number)
) ENGINE = INNODB;

-- Table order_ingredient
CREATE TABLE order_ingredient
(
	table_number int REFERENCES table_status(table_number),
	order_number int,
	ingredient_name char(20),
	serve char(1),
	cook char(1),
	time_ordered_hour int,
	time_ordered_min int,
	time_ordered_sec int
) ENGINE = INNODB;

-- Table table_order
-- CREATE TABLE table_order
-- (
-- 	table_number int,
-- 	FOREIGN KEY (table_number) REFERENCES table_status(table_number),
-- 	order_number int REFERENCES order_ingredient(order_number),
-- 	PRIMARY KEY (table_number, order_number)
-- );

-- Look at the tables that we just created 
show tables;

-- 
-- Populate the tables 
-- 

-- Populate ingredient
-- Populate bread
INSERT INTO ingredient VALUES('Wheat', 180, 'Bread', 'Unbleached Flour (Wheat, Malted Barley), Water, Salt, Sugar, Contains less than 2% of each of the following: Soybean Oil, Guar Gun, Wheat Gluten, Datem, L-Cysteine, Ascorbic Acid, Enzymes, Monoglycerides, ADA, Corn Flour, Acetic Acid, Lactic Acid. CONTAINS: Wheat.', 270, 5.50);
INSERT INTO ingredient VALUES('White', 180, 'Bread', 'Unbleached Flour (Wheat, Malted Barley), Water, Whole Wheat Flour, Honey, Salt, Yeast, Contains less than 2% of each of the following: Corn Flour, Soybean Oil, Monoglycerides, Acetic Acid, Lactic Acid, Guar Gun, Wheat Gluten, Datem, Enzyme, L-Cysteine, Ascorbic Acid, ADA and Calcium Propionate (preservative). CONTAINS: Wheat.', 250, 5.50);

-- Populate meat
INSERT INTO ingredient VALUES('Beef', 30, 'Meat', 'Rubbed with Salt, Sugar, Dextrose, Caramel Color, Garlic Powder, Onion Powder, Spices. Ingredients: Beef, Water, Isolated Soy Protein, Salt, Sodium Phosphates, Sugar, Flavoring, Seasoning (Salt, Flavoring).', 110, 0);
INSERT INTO ingredient VALUES('Chicken', 30, 'Meat', 'Chicken Breast Meat, Water, Salt, Dextrose, Sodium Phosphate, Vegetable Oil. Browned in Vegetable Oil.', 90, 0);
INSERT INTO ingredient VALUES('Turkey', 30, 'Meat', 'Turkey Breast Meat, Turkey Broth, Salt, Modified Food Starch, Sugar, Sodium Phosphate, Flavoring.', 90, 0);
INSERT INTO ingredient VALUES('Tuna', 30, 'Meat', 'Light Tuna, Water, Vegetable Broth (Contains Soy), Salt. Mayonnaise. CONTAINS: Fish, Eggs, Soy.', 275, 0);
INSERT INTO ingredient VALUES('Ham', 30, 'Meat', 'Cured with Water, Salt, Dextrose, Corn Syrup Solids, Sodium Phosphates, Sodium Erythorbate, Sodium Nitrite.', 110, 0);

-- Populate veggie
INSERT INTO ingredient VALUES('Avocado', 180, 'Veggie', '100% Pure Avocado.', 45, 0);
INSERT INTO ingredient VALUES('Cucumber', 180, 'Veggie', 'Fresh Select Cucumbers.', 4, 0);
INSERT INTO ingredient VALUES('Lettuce', 180, 'Veggie', 'Fresh Shredded Iceberg.', 4, 0);
INSERT INTO ingredient VALUES('Mushroom', 180, 'Veggie', 'Fresh Sliced Mushroom.', 2, 0);
INSERT INTO ingredient VALUES('Olive', 180, 'Veggie', 'Ripe Olives, Water, Salt and Ferrous Gluconate.', 16, 0);
INSERT INTO ingredient VALUES('Onion', 180, 'Veggie', 'Fresh Red Onion.', 3, 0);
INSERT INTO ingredient VALUES('Tomato', 180, 'Veggie', 'Fresh Red Ripe Tomato.', 5, 0);

-- Populate dressing
INSERT INTO ingredient VALUES('1000_island', 180, 'Dressing', 'Soybean Oil, Water, High Fructose Corn Syrup, Corn Syrup, Vinegar, Pickles, Tomato Paste, Modified Food Starch, Egg Yolk, Contains less than 2% of Salt, Spice, Sodium Benzoate, Potassium Sorbate and Calcium Disodium EDTA(preservatives), Propylene Glycol Alginate, Bell Pepper, Garlic*, Paprika, Oleoresin Turmeric, Natural Flavor. *Dried Contains: Egg. Portland(P): Soybean Oil, Water, Corn Syrup, High Fructose Corn Syrup, Vinegar, Pickles, Tomato Paste, Eggs, Modified Food Starch, Contains less than 2% of Salt, Egg Yolk, Spice, Xanthan Gum, Sodium Benzoate and Potassium Sorbate (preservatives), Onion*, Propylene Glycol Alginate, Bell Pepper, Garlic*, Paprika, Oleoresin Turmeric, Natural Flavor. *DRIED CONTAINS: Egg.', 50, 0);
INSERT INTO ingredient VALUES('Honey_mustard', 180, 'Dressing', 'Soybean Oil, High Fructose Corn Syrup, Water, Prepared Mustard (Distilled Vinegar, Water, Mustard Seed, Salt, Turmeric, Paprika, Spice, Garlic Powder, Natural Flavor), Honey, Vinegar, Egg Yolk, Salt, Contains less than 2% of Spice, Paprika, Xanthan Gum, Natural and Artificial Flavor, Caramel Color, Yellow 5, Yellow 6. CONTAINS: Egg.', 110, 0);
INSERT INTO ingredient VALUES('Italian', 180, 'Dressing', 'Water, Vinegar, Sugar, Salt, Contains less than 2% of Modified Food Starch, Natural Flavor, Garlic*, Onion*, Xanthan Gum, Sodium Benzoate and Potassium Sorbate (preservatives), Bell Pepper*, Spice, Phosphoric Acid, Yellow 5, Yellow 6. *Dried.', 9, 0);
INSERT INTO ingredient VALUES('Ranch', 180, 'Dressing', 'Soybean Oil, Water, Buttermilk, Egg Yolk, Distilled Vinegar, Contain less than 2% Salt, Monosodium Glutanate, Modified Food Starch, Buttermilk Solids,Sugar, Garlic, Spices, Xanthan Gum, Egg Whites, Onion, Citric Acid, Sorbic Acid, Calciu, Disodium EDTA. CONTAINS: Egg, Milk.', 55, 0);
INSERT INTO ingredient VALUES('Mayonnaise', 180, 'Dressing', 'Soybean Oil, Water, Corn Syrup, Egg Yolk, Vinegar, Salt, Spice, Calcium Disodium EDTA (to protect flavor). CONTAINS: Egg.', 100, 0);

-- Populate drink
INSERT INTO ingredient VALUES('Water', 200, 'Drink', 'Water', 0, 0);
INSERT INTO ingredient VALUES('Coke', 200, 'Drink', 'Coke', 100, 1.50);
INSERT INTO ingredient VALUES('Sprite', 200, 'Drink', 'Sprite', 100, 1.50);
INSERT INTO ingredient VALUES('Pepsi', 200, 'Drink', 'Pepsi', 100, 1.50);

-- Populate dessert
INSERT INTO ingredient VALUES('Cookie', 200, 'Dessert', 'Wheat flour (bleached & enriched with niacin, iron, thiamin mononitrate, riboflavin, folic acid), chocolate chips (sugar, chocolate liquor, cocoa butter, soy lecithin, vanilla, salt), sugar, vegetable oil blend ([soybean, palm, canola & olive oils], lactic acid, vitamin E acetate, potassium sorbate, calcium disodium EDTA preservative, natural flavor), pasteurized whole eggs, invert sugar, corn syrup, molasses, butter flavor, salt, baking soda.', 230, 1.50);

-- Populate customer
INSERT INTO customer VALUES('Ka Son', 'Chan', 'csce4444', 'kasonl.chan@gmail.com', 1990, 11, 1, 1, 'Y');

-- Populate kitchenstaff
INSERT INTO kitchenstaff VALUES(1, 'Suraj', 'Shresrtha', 'csce4444', '0');
INSERT INTO kitchenstaff VALUES(2, 'Kelly', 'Wu', 'csce4444', '0');

-- Populate waitstaff
INSERT INTO waitstaff VALUES(1001, 'John', 'Smith', 'csce4444', '0');
INSERT INTO waitstaff VALUES(1002, 'Amy', 'Chan', 'csce4444', '0');
