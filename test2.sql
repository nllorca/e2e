/* A1 */
SELECT p.id, p.name, p.short_description, p.long_description FROM products p WHERE p.short_code <> 'X12345';

/* A2 
La forma más performante de buscar es sin aplicar ninguna función  sobre el campo updated_at
Por ejemplo no es conveniente aplicar:
    WHERE DATE(p.updated_at) = CURDATE()

Ya que de esa forma el motor debería aplicar la función DATE a todos los registros de la tabla.

Existen 2 formas posibles de llegar a un resultado performante:
*/

/* Opcion 1 */
SELECT COUNT(*) FROM products p WHERE p.supplier_id = 1 
AND p.updated_at >= CURDATE() AND p.updated_at < CURDATE() + INTERVAL 1 DAY
/* Opcion 2 */
SELECT COUNT(*) FROM products p WHERE p.supplier_id = 1 
AND p.updated_at BETWEEN DATE_FORMAT(NOW(), "%Y-%m-%d 00:00:00") AND DATE_FORMAT(NOW(), "%Y-%m-%d 23:59:59")

/* A3 */
SELECT DISTINCT p.duration FROM products p 
WHERE p.reviews_average_rating BETWEEN 4 AND 4.5
AND EXISTS (SELECT * FROM product_option o WHERE o.product_id = p.id AND o.name = 'Adult');

/* A4 */
SELECT p.supplier_id, MAX(p.fetched_at) AS last_updated_date FROM products p
GROUP BY p.supplier_id;

/* B */
UPDATE products SET retail_rate_reference = retail_rate_reference * 1.2 WHERE net_rate_reference BETWEEN 100 AND 200;
UPDATE product_option SET updated_at = NOW() WHERE product_id IN (SELECT id FROM products WHERE net_rate_reference BETWEEN 100 AND 200);

