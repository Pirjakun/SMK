<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Tertutup - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Perpustakaan Tertutup</a>
            <div class="ms-auto d-flex align-items-center">
                <span class="badge {{ auth()->user()->role == 'admin' ? 'bg-danger' : 'bg-secondary' }} me-2">
                    {{ ucfirst(auth()->user()->role) }}
                </span>
                <span class="me-3 text-dark">{{ auth()->user()->name }}</span>
                
                <form action="/logout" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(auth()->user()->role == 'admin')
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">Add New Book</div>
            <div class="card-body">
                <form action="/books" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-3">
                        <input type="text" name="judul" class="form-control" placeholder="Title" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="deskripsi" class="form-control" placeholder="Description" required>
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="tanggal_rilis" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="rating" step="0.1" min="1" max="5" class="form-control" placeholder="Rating (1-5)" required>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold py-3">All Books</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Release Date</th>
                            <th>Rating</th>
                            <th>Created</th>
                            @if(auth()->user()->role == 'admin')
                                <th class="text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->deskripsi }}</td>
                            <td>{{ \Carbon\Carbon::parse($book->tanggal_rilis)->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">{{ number_format($book->rating, 1) }}</span>
                            </td>
                            <td>{{ $book->created_at->format('M d, Y') }}</td>
                            
                            @if(auth()->user()->role == 'admin')
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn btn-warning btn-sm">Edit</button>
                                    <form action="/books/{{ $book->id }}" method="POST" onsubmit="return confirm('Yakin hapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role == 'admin' ? '7' : '6' }}" class="text-center text-muted py-4">
                                No books found in library.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>