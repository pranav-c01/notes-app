<?php
$note = $_POST['note'] ?? '';

if (!empty($note)) {
    file_put_contents("/data/notes.txt", $note . PHP_EOL, FILE_APPEND);
}

header("Location: index.php");
exit;
?>

