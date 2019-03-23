<?php

    function getAllCategories() {
        global $connect;

        $sql = "SELECT *  FROM categories";
        $query = $connect->query($sql);
        if ($query->num_rows > 0)
        {
            return $query;
        } else {
            return false;
        }

        $connect->close();
    }
?>