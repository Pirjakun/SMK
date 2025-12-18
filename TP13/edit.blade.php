@extends('layout')

@section('content')
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Book</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('books.update', $book->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
                </div>
                <div class="col-md-5">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description"
                        value="{{ $book->description }}" required>
                </div>
                <div class="col-md-2">
                    <label for="release_date" class="form-label">Release Date</label>
                    <input type="date" class="form-control" id="release_date" name="release_date"
                        value="{{ $book->release_date }}" required>
                </div>
                <div class="col-md-2">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="number" class="form-control" id="rating" name="rating" value="{{ $book->rating }}" min="1"
                        max="5" required>
                </div>
                <div class="col-12 text-end">
                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-4 opacity-50">
        <div class="card-header bg-light">
            <h5 class="mb-0">All Books (Preview)</h5>
        </div>
        <div class="card-body p-0">
            <div class="alert alert-info m-3">You are currently editing a book.</div>
        </div>
    </div>
@endsection