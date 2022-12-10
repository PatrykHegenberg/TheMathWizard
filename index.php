<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Demo</title>
</head>
<body>
    <?php 
        $books = [
            [
                'name' => 'Do Androids Dream of Electric Sheep',
                'author' => 'Philip K. Dick',
                'releaseYear' => 1968,
                'purchaseUrl' =>'http://example.com'
            ],
            [
                'name' => 'Projekt Hail Mary',
                'author' => 'Andy Weir',
                'releaseYear' => 2021,
                'purchaseUrl' => 'http://example.com'
            ],
            [
                'name' => 'The Martian',
                'author' => 'Andy Weir',
                'releaseYear' => 2011,
                'purchaseUrl' => 'http://example.com'
            ]
        ];

        function filterByAuthor($books, $author){
            $filteredBooks = [];
            foreach($books as $book) {
                if ($book['author'] === $author) {
                    $filteredBooks[] = $book;
                }
            }
            return $filteredBooks;
        }
    ?>
    <ul>
    <?php foreach(filterByAuthor($books, 'Philip K. Dick') as $book): ?>
        <li>
            <a href="<?= $book['purchaseUrl']; ?>">
                <?= $book['name']; ?> (<?= $book['releaseYear'] ?>)
            </a>
        </li>
    <?php endforeach; ?>
    </ul>
</body>
</html>