<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Accueil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <header>
    <img class="bg-img" src="image/959.jpg" class=" d-block mt-3 mb-4" alt="...">

    <?php
      include 'navbar_fond_image.php';
    ?>
      </header>

      <main>
        <h1 class="my-5 text-center text-white mt-5">Accueil</h1>
      </main>
      <footer>
        <?php 
          include 'footer.php';
        ?>
      </footer>
      
      
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>