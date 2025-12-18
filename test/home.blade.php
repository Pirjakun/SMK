@extends('layout')

@section('content')
    @if(Auth::user()->role == 'admin')
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Add New Book</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST" class="row g-3 align-items-end">
                    @csrf
                    <div class="col-md-3">
                        <label for="title" class="form-label visually-hidden">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                    </div>
                    <div class="col-md-3">
                        <label for="description" class="form-label visually-hidden">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description"
                            required>
                    </div>
                    <div class="col-md-2">
                        <label for="release_date" class="form-label visually-hidden">Release Date</label>
                        <input type="date" class="form-control" id="release_date" name="release_date" required>
                    </div>
                    <div class="col-md-2">
                        <label for="rating" class="form-label visually-hidden">Rating</label>
                        <input type="number" class="form-control" id="rating" name="rating" placeholder="Rating" min="1" max="5"
                            required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">All Books</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Release Date</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Created</th>
                        @if(Auth::user()->role == 'admin')
                            <th scope="col">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $loop => $book)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->description }}</td>
                            <td>{{ $book->release_date->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">{{ $book->rating }}</span>
                            </td>
                            <td>{{ $book->created_at->format('M d, Y') }}</td>
                            @if(Auth::user()->role == 'admin')
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection