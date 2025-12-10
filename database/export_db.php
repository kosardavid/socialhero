<?php
/**
 * Database Export Script
 * Run this locally to export database from Wedos
 */

$host = 'md395.wedos.net';
$db = 'w387379_socialhero';
$user = 'w387379_socialhero';
$pass = 'Soc1@lH3r0_2024!';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $output = "-- SocialHero Database Backup\n";
    $output .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
    $output .= "-- Host: $host\n";
    $output .= "-- Database: $db\n\n";
    $output .= "SET FOREIGN_KEY_CHECKS=0;\n";
    $output .= "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n\n";

    // Get all tables
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        // Get CREATE TABLE statement
        $create = $pdo->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_ASSOC);
        $output .= "-- --------------------------------------------------------\n";
        $output .= "-- Table: $table\n";
        $output .= "-- --------------------------------------------------------\n\n";
        $output .= "DROP TABLE IF EXISTS `$table`;\n";
        $output .= $create['Create Table'] . ";\n\n";

        // Get data
        $rows = $pdo->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            $columns = array_keys($rows[0]);
            foreach ($rows as $row) {
                $values = array_map(function($v) use ($pdo) {
                    if ($v === null) return 'NULL';
                    return $pdo->quote($v);
                }, array_values($row));
                $output .= "INSERT INTO `$table` (`" . implode('`, `', $columns) . "`) VALUES (" . implode(', ', $values) . ");\n";
            }
            $output .= "\n";
        }
    }

    $output .= "SET FOREIGN_KEY_CHECKS=1;\n";

    $filename = __DIR__ . '/backup_' . date('Y-m-d') . '.sql';
    file_put_contents($filename, $output);

    echo "Backup created successfully!\n";
    echo "File: $filename\n";
    echo "Tables exported: " . count($tables) . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
