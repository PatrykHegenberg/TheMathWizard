<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<link href="./../styles/mathe.css" rel="stylesheet" id="style">
</head>

<body class="h-full">
  <div class="min-h-full">
    <main>
      <div class="flex flex-col mx-auto text-center max-w-7xl py-6 sm:px-6 lg:px-8 container">
          <h3>Schreibe die richtige Zahl in die Lücke</h3>
          <div id="question"></div>
          <button id="submit-btn">Bestätigen</button>
          <p id="error-msg">Da gab es einen Fehler</p>
        </div>
        <div class="controls-container">
          <p id="result"></p>
          <button id="start-btn">Spiel starten</button>

        </div>
        <script src="./../scripts/mathe.js" id="main"></script>
      </div>
    </main>
    <?php require('partials/footer.php') ?>
