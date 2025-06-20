<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->paginate(15);
        return view('pages.admin.book.book-index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.book.book-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|date',
            'description' => 'required|string',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.books.index')
            ->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('pages.admin.book.book-show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('pages.admin.book.book-edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|date',
            'description' => 'required|string',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Book deleted successfully.');
    }
}