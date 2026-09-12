<!DOCTYPE html>
<html>
<head>
    <title>Satyam - Notes App</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            min-height: 100vh;
            align-items: center;
        }

        .container {
            max-width: 700px;
            width: 90%;
            background: #fff;
            margin: 20px;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        h1 {
            text-align: center;
            color: #0d6efd;
            margin-bottom: 25px;
            font-size: 28px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 30px;
        }

        textarea {
            padding: 14px;
            border: 2px solid #0d6efd;
            border-radius: 10px;
            font-size: 15px;
            resize: vertical;
            min-height: 120px;
            margin-bottom: 14px;
            transition: 0.3s;
        }

        textarea:focus {
            border-color: #6610f2;
            outline: none;
            box-shadow: 0 0 5px rgba(102,16,242,0.4);
        }

        button {
            align-self: flex-start;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            border: none;
            padding: 12px 22px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(135deg, #6610f2, #0d6efd);
            transform: translateY(-2px);
        }

        h2 {
            color: #333;
            margin-bottom: 12px;
            border-left: 5px solid #0d6efd;
            padding-left: 10px;
            font-size: 22px;
        }

        .notes-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #ddd;
            max-height: 300px;
            overflow-y: auto;
        }

        pre {
            background: none;
            padding: 0;
            margin: 0;
            border: none;
            white-space: pre-wrap; 
            word-wrap: break-word; 
            font-size: 15px;
            line-height: 1.5;
            color: #222;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #555;
        }

        .footer span {
            font-weight: bold;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Qualibytes - Notes App</h1>
        <form action="save.php" method="post">
            <textarea name="note" placeholder="Write your notes here..."></textarea><br>
            <button type="submit">💾 Save Note</button>
        </form>

        <h2>Saved Notes:</h2>
        <div class="notes-box">
            <pre>
<?php
if (file_exists("/data/notes.txt")) {
    echo file_get_contents("/data/notes.txt");
} else {
    echo "No notes yet. Start writing your first note!";
}
?>
            </pre>
        </div>

        <div class="footer">
            Made with ❤ by <span>Qualibytes</span>
        </div>
    </div>
</body>
</html>
