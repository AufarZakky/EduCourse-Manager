<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'active')->get(); // Hanya course aktif
        return view('transactions', compact('courses'));
    }

    public function getData(Request $request)
    {
        $query = Transaction::with(['course' => function ($query) {
            $query->where('status', 'active'); // Hanya course aktif
        }]);
    
        if ($request->course_id) {
            $query->where('course_id', $request->course_id); // Filter by course
        }
    
        return DataTables::of($query)
            ->addColumn('course_name', function ($row) {
                return $row->course->name ?? 'N/A'; // Get course name
            })
            ->addColumn('action', function ($row) {
                return '
                    <button 
                        class="btn btn-sm btn-primary edit-btn" 
                        data-id="' . $row->id . '"
                        data-student-name="' . htmlspecialchars($row->student_name, ENT_QUOTES, 'UTF-8') . '"
                        data-course-id="' . $row->course_id . '"
                        data-enrollment-date="' . $row->enrollment_date . '"
                        data-payment-status="' . $row->payment_status . '">
                        Edit
                    </button>
                    <form action="' . route('transactions.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                    <button 
                        type="button" 
                        class="btn btn-sm btn-danger delete-btn" 
                        data-id="' . $row->id . '" 
                        data-student-name="' . htmlspecialchars($row->student_name, ENT_QUOTES, 'UTF-8') . '">
                        Delete
                    </button>
                    </form>
                ';
            })            
            ->rawColumns(['action'])
            ->make(true);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
            'payment_status' => 'required|in:paid,unpaid',
        ]);
    
        Transaction::create($request->all());
    
        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully.');
    }
    
    public function destroy($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Transaction deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete transaction.',
            ]);
        }
    }        

    public function edit($id)
    {
        $transaction = Transaction::with('course')->findOrFail($id);
        $courses = Course::all(); // Untuk dropdown pilihan course
        return view('transactions.edit', compact('transaction', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
            'payment_status' => 'required|in:paid,unpaid',
        ]);
    
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());
    
        return response()->json(['success' => true]);
    }    
}
