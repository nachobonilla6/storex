<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .categories {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .categories__children {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            width: 150px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Pokemon Shop</h1>
    <div class="categories">
        @foreach ($pokemons as $pokemon) 
            <div class="categories__children">
                <h2>{{ $pokemon->name }}</h2>
                <p>Price: ${{ $pokemon->price }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>
