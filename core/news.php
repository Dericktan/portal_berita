<?php
	function getAllNews($category) {
		global $connect;
		
		$sql = "SELECT news.id, news.title, news.content, news.created_by, news.created_at, users.firstname, users.lastname, categories.name AS category_name, categories.id AS category_id FROM news JOIN users ON news.created_by = users.id JOIN categories ON news.category_id = categories.id";
		if ($category != false) $sql .= " WHERE category_id = '$category'";
		$sql .= " ORDER BY news.created_at DESC";
		
		$query = $connect->query($sql);
		if ($query != false && $query->num_rows > 0)
		{
			return $query;
		} else {
			return false;
		}

		$connect->close();
	}

	function getAllNewsByUser($id) {
		global $connect;
		
		$sql = "SELECT news.id, news.title, news.content, news.created_by, news.created_at, users.firstname, users.lastname, categories.name AS category_name FROM news JOIN users ON news.created_by = users.id JOIN categories ON news.category_id = categories.id";
		if ($id != false) $sql .= " WHERE created_by = '$id'";

		$query = $connect->query($sql);
		if ($query != false && $query->num_rows > 0)
		{
			return $query;
		} else {
			return false;
		}

		$connect->close();
	}

	function titleExist($title) {
		global $connect;

        $sql = "SELECT * FROM news WHERE title = '$title'";
        $query = $connect->query($sql);
        if($query->num_rows == 1) {
            return true;
        } else {
            return false;
        }

        $connect->close();
	}

	function createNews() {
		global $connect;

		$title = $_POST['title'];
		$content = $_POST['content'];
		$category_id = $_POST['category_id'];
		$id = $_SESSION['id'];
		$sql = "INSERT INTO news (title, content, category_id, created_by) VALUES ('$title', '$content', '$category_id', '$id')";
		$query = $connect->query($sql);
		if($query === TRUE) {
			return true;
		} else {
			return false;
		}

		$connect->close();
	}
?>