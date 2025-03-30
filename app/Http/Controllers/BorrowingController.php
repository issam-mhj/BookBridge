<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Requests\UpdateBorrowingRequest;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function borrow(Book $book)
    {
        $user = auth()->user();

        DB::beginTransaction();

        try {
            $book->update(["status" => "borrowed"]);

            Borrowing::create([
                "user_id" => $user->id,
                "book_id" => $book->id,
                "borrowed_at" => Carbon::now(),
                "returned_at" => Carbon::now()->addWeek(),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", "Failed to borrow the book.");
        }

        return redirect()->back()->with("done", "You have borrowed the book successfully. Check your library.");
    }


    /**
     * Show the form for creating a new resource.
     */
    public function returnBook(Borrowing $borrowing)
    {
        DB::beginTransaction();

        try {
            $borrowing->book->update(["status" => "available"]);
            $borrowing->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", "Failed to borrow the book.");
        }

        return redirect("/mybooks");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing $borrowing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowingRequest $request, Borrowing $borrowing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        //
    }
}
