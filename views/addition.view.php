<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>
<main>
  <div class="flex flex-col mx-auto text-center max-w-7xl py-6 sm:px-6 lg:px-8 container">
    <div class="flex justify-center">
      <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm container">
        <h3 class="text-gray-900 text-xl leading-tight font-medium mb-2">Schreibe die richtige Zahl in die Lücke</h3>
        <div id="question"></div>
        <button id="submit-btn" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Bestätigen</button>
        <p id="error-msg">Da gab es einen Fehler</p>
      </div>
      <div class="controls-container">
        <p id="result"></p>
        <button id="start-btn" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Spiel starten</button>
      </div>
    </div>
    <script src="/scripts/addition.js"></script>
  </div>
</main>
<?php require('partials/footer.php') ?>