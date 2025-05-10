<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Library Data</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Genres</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($genres as $genre)
                                <li class="list-group-item">
                                    <strong>{{ $genre['id'] }}.</strong> {{ $genre['name'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Authors</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($authors as $author)
                                <li class="list-group-item">
                                    <strong>{{ $author['id'] }}.</strong> {{ $author['name'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
