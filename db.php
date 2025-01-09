<?php 
// Activation hook
function my_custom_plugin_activate()
{
   require_once (ABSPATH . 'wp-admin/includes/upgrade.php');

   // getting database auth details
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once $path . '/wp-config.php';

   global $wpdb;
   $host = $wpdb->dbhost;
   $user = $wpdb->dbuser;
   $pass = $wpdb->dbpassword;
   $db = $wpdb->dbname;

   $conn = mysqli_connect($host, $user, $pass, $db);
   // Code to execute on plugin activation
   global $wpdb;
   $table_name = $wpdb->prefix . 'vaccinations';

   $sql = "CREATE TABLE $table_name (
      `id` bigint NOT NULL,
      `phone` bigint NOT NULL,
      `firstname` varchar(100) NOT NULL,
      `lastname` varchar(100) NOT NULL,
      `vaccine` varchar(100) NOT NULL,
      `price` int NOT NULL,
      `doctor` varchar(100) NOT NULL,
      `vaccination_date` varchar(100) NOT NULL,
      `last_vaccination_date` varchar(100) DEFAULT NULL,
      `notes` varchar(200) DEFAULT NULL,
      `file` varchar(250) DEFAULT NULL,
      `userid` bigint NOT NULL
    );
    ";
   // dbDelta($sql);
   mysqli_query($conn, $sql);

   $sql = "ALTER TABLE $table_name
   ADD PRIMARY KEY (`id`);";
   // dbDelta($sql);
   mysqli_query($conn, $sql);

   $sql = "ALTER TABLE $table_name
   MODIFY `id` bigint NOT NULL AUTO_INCREMENT;";
   // dbDelta($sql);

   mysqli_query($conn, $sql);

}
register_activation_hook(__FILE__, 'my_custom_plugin_activate');

?>