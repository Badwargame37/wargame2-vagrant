<!DOCTYPE html>
<html>
<head>
    <title>IDOR Example with OSS 117 & Starbuck</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .chat-box {
            height: 200px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Secret Chat: OSS 117 & Starbuck</h1>
    <p>Both operatives from entirely different galaxies, but the humor is universal.</p>
    <div class="chat-box" id="chatBox">
        <p><strong>OSS 117:</strong> Bonjour, Starbuck. How about we exchange some unauthorized data? For old times' sake?</p>
        <p><strong>Starbuck:</strong> Unauthorized data? You must be frakkin' joking!</p>
    </div>

    <form id="idorForm" method="POST">
        <?php
            // Set a default value for agentX, which can be dynamically generated or fetched
            $agentX = 1; // or whatever value you decide
        ?>
        <!-- This input will be "invisible" -->
        <input type="hidden" id="agentX" name="agentX" value="<?php echo $agentX; ?>">
        
        <label for="userId">User ID to Spy On:</label>
        <input type="text" id="userId" name="userId">
        <button type="button" onclick="fetchData()">Fetch Data</button>
    </form>
    <div id="output"></div>
</div>

<script>
    async function fetchData() {
        const chatBox = document.getElementById('chatBox');
        const userId = document.getElementById('userId').value;
        const agentX = document.getElementById('agentX').value;
        chatBox.innerHTML += `<p><strong>OSS 117:</strong> Let's have a peek at User ID ${userId}, shall we?</p>`;

        const response = await fetch(`/data?id=${userId}&agentX=${agentX}`);
        const data = await response.json();

        chatBox.innerHTML += `<p><strong>Starbuck:</strong> You're digging into some serious frak here, OSS. Here's what we've got:</p>`;
        chatBox.innerHTML += `<p>${JSON.stringify(data)}</p>`;
        
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>

</body>
</html>
