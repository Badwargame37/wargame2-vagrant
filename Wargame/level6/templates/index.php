<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Camelot Meets OSS 117</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <header>
    <h1>Camelot Meets OSS 117: The Meeting No One Asked For!</h1>
  </header>

  <main>
    <div class="interaction">
      <h2>OSS 117 to Merlin: "Let's See What You've Got, Wizard!"</h2>
      <form action="" method="post">
        <label for="filepath">File Path: </label>
        <input type="text" id="filepath" name="filepath">
        <button type="submit">Show Me!</button>
      </form>
      
      <div class="file-content">
        <?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filepath = $_POST['filepath'];
            if (file_exists($filepath)) {
              echo nl2br(htmlspecialchars(file_get_contents($filepath)));
            } else {
              echo "That file does not exist, or Merlin is messing with us again!";
            }
          }
        ?>
      </div>
    </div>

    <div class="dark-humor">
      <h2>Why This Encounter is as Strange as Merlin's Fashion Choices</h2>
      <p>Picture this: OSS 117 walking into Camelot with his impeccable suit, only to find Merlin in a robe that looks like it was sewn by a blind cyclops. Awkward? Absolutely. Funny? You bet!</p>
      <p>Merlin, upon seeing OSS 117: "Ah, another spy. As if one James Bond was not enough!"</p>
      <p>OSS 117, unamused: "Just show me the file, wizard. Time is of the essence!"</p>
    </div>
  </main>

</body>
</html>
