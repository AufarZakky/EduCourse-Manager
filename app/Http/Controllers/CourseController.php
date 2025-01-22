<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CoursesImport;
use Illuminate\Support\Facades\Validator;
use App\Exports\CoursesExport;
use Barryvdh\DomPDF\Facade\Pdf;

class CourseController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);
    
        $course = Course::create($request->all());
    
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Course added successfully.',
                'data' => $course,
            ]);
        }
        return redirect()->route('dashboard')->with('success', 'Course added successfully.');
    } 
    // import ke excel  
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,csv',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            Excel::import(new CoursesImport, $request->file('file'));
            return redirect()->route('courses.index')->with('success', 'Courses imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing file: ' . $e->getMessage());
        }
    } 

    //export excel    
    public function export()
    {
        return Excel::download(new CoursesExport, 'courses.xlsx');
    }

    // export pdf/print
    public function printPDF(Request $request)
    {
        $courses = Course::select('name', 'description', 'price', 'status', 'student_count')->get();

        // view
        $pdf = Pdf::loadView('print', compact('courses'))->setPaper('a4', 'landscape');

        // Unduh file PDF
        return $pdf->stream('courses.pdf'); 
    }


    public function getCourses(Request $request)
    {
        if ($request->ajax()) {
            $data = Course::all(); // Ambil semua data kursus
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '
                        <button 
                            class="edit-btn btn btn-primary btn-sm" 
                            data-id="' . $row->id . '" 
                            data-name="' . htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8') . '" 
                            data-description="' . htmlspecialchars($row->description, ENT_QUOTES, 'UTF-8') . '" 
                            data-price="' . $row->price . '" 
                            data-status="' . $row->status . '">
                            Edit
                        </button>
                        <form action="' . route('courses.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button 
                                type="submit" 
                                class="delete-btn btn btn-danger px-2 py-1 rounded"
                                data-name="' . htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8') . '">
                                Delete
                            </button>
                        </form>
                    ';
                })            
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id); // Cari data kursus berdasarkan ID
        return view('courses.edit', compact('course')); 
    }
    public function destroy($id)
    {
        $course = Course::findOrFail($id); // Cari data kursus berdasarkan ID
        $course->delete(); // Hapus kursus
    
        return response()->json(['success' => 'Course deleted successfully.']); 
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);
    
        //berdasarkan ID
        $course = Course::findOrFail($id);
    
        $course->update($request->only(['name', 'description', 'price', 'status']));
    
        return response()->json(['success' => 'Course updated successfully.']);
    }    
        
}
