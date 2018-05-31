# woocommerce-attributes-import
A script that reformats JSON data to a Woocommerce friendly format

this script uses JSON data, which is the result of converting a customer excel sheet of Woocommerce variable products attributes using an online tool.

The script reformats this JSON data so that it can be imported into Woocommerce, creating and assigning all of the variable product attributes.

My plans to improve this script are to write an extra function, with a wpdb() connection, which would write the attributes directly to the DB, as currently the outputted JSON needs to be re-converted back to an excel sheet, which then uses Woocommerce's import function in the admin panel.
