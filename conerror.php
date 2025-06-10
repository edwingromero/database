<?php

// 1. Vulnerabilidad: SQL Injection (SQLi)
// [CRITICAL] SonarQube Rule: S5147 - SQL queries should not be vulnerable to injection
function getUserData($username) {
    // ¡RIESGO DE INYECCIÓN SQL! Concatenación directa de entrada de usuario.
    $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
    $conn = new mysqli("localhost", "user", "password", "database");
    $result = $conn->query($sql);
    if ($result) {
        return $result->fetch_assoc();
    }
    return null;
}

// 2. Code Smell: Uso de 'die()' o 'exit()' (mala práctica en funciones/librerías)
// [MAJOR] SonarQube Rule: S1160 - Functions should not use 'die()' or 'exit()'
function processPayment($amount) {
    if ($amount <= 0) {
        die("Invalid amount provided."); // Detiene la ejecución del script abruptamente
    }
    // Lógica de procesamiento de pago
    return true;
}

// 3. Code Smell: Variables no inicializadas o sin usar
// [MINOR] SonarQube Rule: S1481 - Unused local variables should be removed
// [MINOR] SonarQube Rule: S1854 - Unused parameters should be removed
function calculateDiscount($price, $quantity) {
    $tax = 0.05; // Variable declarada pero no usada
    $total = $price * $quantity;
    // ...
    return $total;
}

// 4. Bug: Comparación de tipo laxo en un contexto sensible
// [MAJOR] SonarQube Rule: S1048 - Identical branches should be avoided
// [MAJOR] SonarQube Rule: S4423 - PHP weak comparison should not be used
function checkPassword($inputPassword, $storedHash) {
    // ¡BUG POTENCIAL! Comparación laxa '==' en lugar de comparación estricta '==='
    // Puede llevar a bypass de autenticación si los tipos no coinciden como se espera
    if ($inputPassword == $storedHash) { // Debería ser '==='
        return true;
    } else {
        return false;
    }
}

// 5. Code Smell: Nombre de función que no sigue las convenciones (camelCase)
// [MINOR] SonarQube Rule: S100 - Function names should follow a naming convention
function get_Product_Details($productId) { // Usa snake_case en lugar de camelCase para funciones
    // ...
    return [];
}

// 6. Vulnerabilidad: Depreciación de funciones o funciones inseguras
// [CRITICAL/MAJOR] SonarQube Rule: S4502 - 'eval()' should not be used
// [CRITICAL/MAJOR] SonarQube Rule: S4823 - Superseded or deprecated PHP functions should not be used
function executeCode($code) {
    eval($code); // ¡RIESGO DE EJECUCIÓN DE CÓDIGO ARBITRARIO!
    // Otro ejemplo: $data = mysql_query("..."); // Si estuvieras en un PHP antiguo
}

// 7. Code Smell: Múltiples sentencias en una sola línea
// [MINOR] SonarQube Rule: S1118 - Too many statements on a single line
function processData($data) {
    $x=1; $y=2; $z=$x+$y; // Múltiples sentencias en una línea
    return $z;
}

// 8. Code Smell: Nivel de anidamiento de IF excesivo
// [MINOR] SonarQube Rule: S1118 - Conditional nesting should not be too deep
function deeplyNestedFunction($a, $b, $c) {
    if ($a) {
        if ($b) {
            if ($c) {
                echo "Nivel 3";
            }
        }
    }
}

// Llamadas a las funciones para simular uso
getUserData("testuser");
processPayment(100);
calculateDiscount(50, 2);
checkPassword("password123", "password123");
get_Product_Details(1);
executeCode("echo 'Hello';");
processData([]);
deeplyNestedFunction(true, true, true);

?>
