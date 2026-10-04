-- ========================================================================
-- Query untuk Update Path Gambar Produk di Database Hosting (Hostinger)
-- Salin query ini dan jalankan di tab "SQL" phpMyAdmin pada database hosting Anda
-- ========================================================================

UPDATE products 
SET image = 'uploads/products/7d24ac69-5e05-4c9e-911f-75a9cc8e2214_dreamina-2026-09-06-2975-professional-e-commerce-product-photo-of.jpeg' 
WHERE name LIKE '%BHANEX%';

UPDATE products 
SET image = 'uploads/products/74d99aa2-b416-4246-9be9-b301574ac9e3_d7ab6bb5b0adadaa9eace3493acf016e.jpg' 
WHERE name LIKE '%Bioactin%';

UPDATE products 
SET image = 'uploads/products/5e7a4fdd-d6b5-41d9-ac33-ab39023d9e60_dreamina-2026-09-06-5182-professional-e-commerce-product-photo-of.jpeg' 
WHERE name LIKE '%ATAGO%' OR name LIKE '%Refractometer%';

UPDATE products 
SET image = 'uploads/products/7961be09-3dd1-4d1d-aa55-d3c071ace594_dreamina-2026-09-06-2994-professional-e-commerce-product-photo-of.jpeg' 
WHERE name LIKE '%IWAKI%' OR name LIKE '%Beaker%';

UPDATE products 
SET image = 'uploads/products/9b93b615-bdf5-4650-82ba-f7148317406c_dreamina-2026-09-06-3221-professional-e-commerce-product-photo-of.jpeg' 
WHERE name LIKE '%OneMed%' OR name LIKE '%Transfer Pipette%';

UPDATE products 
SET image = 'uploads/products/f9c29432-0340-4838-807d-370f37ef112b_dreamina-2026-09-10-3153-professional-commercial-e-commerce-produ.jpeg' 
WHERE name LIKE '%BIOLOGIX%';

UPDATE products 
SET image = 'uploads/products/16aa4a2a-b10f-4df8-8878-a5deec0d5dd0_dreamina-2026-09-06-3615-professional-e-commerce-product-photo-of.jpeg' 
WHERE name LIKE '%Centrifuge%';

UPDATE products 
SET image = 'uploads/products/c2eb43b4-ee44-4c22-9da1-3757600a1858_dreamina-2026-09-10-8566-professional-commercial-e-commerce-produ.jpeg' 
WHERE name LIKE '%METHYLNE BLUE%';

UPDATE products 
SET image = 'uploads/products/35cef06f-ba1b-4ce9-8917-dc5705ccc761_0f5ec90d-0882-4572-ac05-3b076899c7c8.jpg' 
WHERE name LIKE '%Potassium phosphate%';
