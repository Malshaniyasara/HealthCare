<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $chatFile = 'chat.txt';
    $messageToDelete = htmlspecialchars($_POST['message']);

    if (file_exists($chatFile)) {
        $messages = file($chatFile, FILE_IGNORE_NEW_LINES);
        $updatedMessages = array_filter($messages, function($msg) use ($messageToDelete) {
            return trim($msg) !== $messageToDelete;
        });
        file_put_contents($chatFile, implode("\n", $updatedMessages));
    }
}
