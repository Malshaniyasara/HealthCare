<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with Nurse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('pic3.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .chat-container {
            width: 100%;
            max-width: 500px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .chat-box {
            height: 300px;
            overflow-y: auto;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f1f1f1;
        }
        .message {
            margin-bottom: 10px;
            padding: 8px 12px;
            border-radius: 20px;
            position: relative;
        }
        .message.user {
            background-color: #007bff;
            color: white;
            text-align: right;
            align-self: flex-end;
        }
        .message.nurse {
            background-color: #6c757d;
            color: white;
            text-align: left;
            align-self: flex-start;
        }
        .message button {
            position: absolute;
            top: 5px;
            right: 5px;
            border: none;
            background: transparent;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <h4 class="text-center">Chat with us</h4>

    <?php
    $chatFile = 'chat.txt';
    $detailsFile = 'user_details.txt';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['details'])) {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            file_put_contents($detailsFile, "Name: $name, Email: $email\n");
        } else if (isset($_POST['message']) && !empty($_POST['message'])) {
            $message = htmlspecialchars($_POST['message']);
            $sender = $_POST['sender'];
            file_put_contents($chatFile, "$sender: $message\n", FILE_APPEND);
        } else if (isset($_POST['delete'])) {
            $lineToDelete = $_POST['lineToDelete'];
            $messages = file($chatFile, FILE_IGNORE_NEW_LINES);
            unset($messages[$lineToDelete]);
            file_put_contents($chatFile, implode("\n", $messages));
        }
    }

    if (file_exists($chatFile)) {
        $messages = file($chatFile, FILE_IGNORE_NEW_LINES);
        foreach ($messages as $index => $msg) {
            $parts = explode(': ', $msg, 2);
            if (count($parts) == 2) {
                $sender = $parts[0];
                $message = $parts[1];
                $class = ($sender === 'User') ? 'user' : 'nurse';
                echo "<div class='message $class'>
                        <strong>$sender:</strong> $message
                        <form method='post' style='display:inline;'>
                            <input type='hidden' name='delete' value='true'>
                            <input type='hidden' name='lineToDelete' value='$index'>
                            <button type='submit'>&times;</button>
                        </form>
                      </div>";
            }
        }
    }

    if (!file_exists($detailsFile)) {
        echo '<form method="post" class="mb-4">
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="details" class="btn btn-primary">Provide Details</button>
                </div>
              </form>';
    }
    ?>

    <form method="post">
        <div class="mb-3">
            <input type="hidden" name="sender" value="User">
            <input type="text" name="message" class="form-control" placeholder="Type your message..." required>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>

    <form method="post" class="mt-2">
        <div class="mb-3">
            <input type="hidden" name="sender" value="Nurse">
            <input type="text" name="message" class="form-control" placeholder="staff's reply..." required>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-secondary">Reply as Staff</button>
        </div>
    </form>
</div>
<ul class="pager">
<button type="button" class="btn btn-outline-info"><a href="../index.php">&larr; Back Home Page</a></button>
           
        </ul>

</body>
</html>
