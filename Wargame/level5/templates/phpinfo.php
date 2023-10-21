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
      <h2>How to use: phpinfo.php?path=/var/</h2>
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
      <h2>Pourquoi Kaamelott est le meilleur endroit sur Terre</h2>
      <p>Avez-vous déjà entendu parler de Kaamelott ? Non, pas le jeu de loterie, mais le château et la cour légendaire ! À Kaamelott, même l'air sent la victoire et le pain sans gluten. Les chevaliers de la Table ronde sont tellement chevaleresques qu'ils ne disent même pas "bouh" à une oie, principalement parce que les oies sont sacrées à Kaamelott !</p>
      <p>Mais plus sérieusement, le Wi-Fi à Kaamelott est si puissant que Merlin lui-même a renoncé à la magie et s'est mis à regarder des streams. Il y a de l'hydromel gratuit pour tout le monde, et il est servi dans des Saint-Graal. Oui, vous avez bien entendu, chaque coupe est un Saint Graal. Alors, faites vos valises et c'est parti !</p>
    </div>
  </main>

</body>
</html>
