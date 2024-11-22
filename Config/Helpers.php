<?php

    if (!function_exists('secure_data')) {
        function secure_data($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }

?>