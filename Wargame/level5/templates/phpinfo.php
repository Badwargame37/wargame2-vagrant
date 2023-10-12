<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>File and Folder Listing</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
    }
    header {
      background-color: #50b3a2;
      color: white;
      text-align: center;
      padding: 1em;
    }
    main {
      padding: 20px;
      max-width: 800px;
      margin: auto;
    }
    .instruction, .file-list, .camelot-speech {
      background-color: #fff;
      border: 1px solid #ccc;
      padding: 20px;
      margin: 20px 0;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .file-list ul {
      list-style-type: none;
      padding: 0;
    }
    .file-list li {
      padding: 5px;
      border-bottom: 1px solid #eee;
    }
    .file-list li:last-child {
      border-bottom: none;
    }
    .camelot-speech {
      font-style: italic;
      text-align: justify;
    }
  </style>
</head>
<body>

  <header>
    <h1>Welcome to the grand File and Folder Lister!</h1>
  </header>

  <main>
    <?php
      $dir = isset($_GET['path']) ? $_GET['path'] : '/tmp/';
    ?>
    
    <div class="instruction">
      <h2>How to use: index.php?path=/var/</h2>
    </div>

    <div class="file-list">
      <h2>Listing files and folders for: <?php echo htmlspecialchars($dir); ?></h2>
      <ul>
        <?php
          if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
              if ($file != "." && $file != "..") {
                echo "<li>" . htmlspecialchars($file) . "</li>";
              }
            }
          } else {
            echo "Invalid directory!";
          }
        ?>
      </ul>
    </div>

    <div class="camelot-speech">
      <h2>Why Camelot is the Greatest Place on Earth</h2>
      <p>Listen folks, have you ever heard of Camelot? No, not the lottery game, but the legendary castle and court! In Camelot, even the air smells like victory and gluten-free bread. The Knights of the Round Table are so chivalrous, they won't even say 'boo' to a goose—mainly because geese are sacred in Camelot!</p>
      <p>But seriously, the Wi-Fi in Camelot is so strong that Merlin himself gave up wizardry and switched to streaming. There's free mead for everyone, and it's all served in Holy Grails. Yes, you heard it right, every cup is a Holy Grail. So, pack your bags and let's go!</p>
    </div>
  </main>

</body>
</html>
