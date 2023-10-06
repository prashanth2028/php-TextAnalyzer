<?php
class Text {
    public function countWords($text) {
        return str_word_count($text);
    }

    public function countCharacters($text) {
        return strlen($text);
    }

    public function reverseText($text) {
        return strrev($text);
    }

    public function capitalizeText($text) {
        return ucwords($text);
    }

    public function textToArray($text) {
        return explode(' ', $text);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    $text = $data['text'];

    $task = new Text();

    $totalWords = $task->countWords($text);
    $totalCharacters = $task->countCharacters($text);
    $reversedText = $task->reverseText($text);
    $capitalizedText = $task->capitalizeText($text);
    $textArray = $task->textToArray($text);

    
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'logicaltask';

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT count FROM user_counts WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userCount);
        $stmt->fetch();

     
        $userCount++;
        $stmt->close();

        $sql = "UPDATE user_counts SET count = ? WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $userCount, $name);
        $stmt->execute();
    } else {
        
        $userCount = 1;
        $stmt->close();

        $sql = "INSERT INTO user_counts (name, count) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $name, $userCount);
        $stmt->execute();
    }
    $conn->close();

   

    $response = [
        'name' => $name,
        'count' => $userCount,
        'totalWords' => $totalWords,
        'totalCharacters' => $totalCharacters,
        'reversedText' => $reversedText,
        'capitalizedText' => $capitalizedText,
        'textArray' => $textArray,
    ];

    echo json_encode($response);
}
?>
