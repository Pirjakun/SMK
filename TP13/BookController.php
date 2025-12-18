<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller {
    public function index() {
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('home', compact('books'));
    }

    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal_rilis' => 'required|date',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        Book::create($request->all());
        return redirect()->back()->with('success', 'Book created successfully!');
    }

    public function update(Request $request, $id) {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return redirect()->back()->with('success', 'Book updated successfully!');
    }

    public function destroy($id) {
        Book::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Book deleted successfully!');
    }
}