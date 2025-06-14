<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\Models\Resume;
use Illuminate\Support\Facades\Storage;
use App\Services\ResumeParserService;
use Illuminate\Support\Facades\DB;

class ResumeController extends Controller
{
   public function store(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf|max:5120',
        ]);

        $file = $request->file('resume');
        $path = $file->store('resumes');

        
        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path('app/' . $path));
        $text = $pdf->getText();

        
        $parserService = new ResumeParserService();
        $data = $parserService->extract($text);

       
        $resume = Resume::create([
            'user_id'    => $request->user()->id,
            'file_path'  => $path,
            'name'       => $data['name'],
            'email'      => $data['email'],
            'phone'      => $data['phone'],
            'education'  => json_encode($data['education']),
            'skills'     => implode(', ', $data['skills']),
            'experience' => json_encode($data['experience']),
        ]);

        return response()->json($resume);
    }
 // List resumes for the authenticated user
    public function index(Request $request)
    {
        return Resume::where('user_id', $request->user()->id)->get();
    }

    // Show a specific resume
    public function show(Request $request, $id)
    {
        \Log::info('Logging is working!');
        return Resume::where('id', $id)
                     ->where('user_id', $request->user()->id)
                     ->firstOrFail();
    }

    // Delete a resume
    public function destroy(Request $request, $id)
    {
        $resume = Resume::where('id', $id)
                        ->where('user_id', $request->user()->id)
                        ->firstOrFail();

        Storage::delete($resume->file_path);
        $resume->delete();

        return response()->json(['message' => 'Resume deleted']);
    }

    // Search resumes by skill
    public function search(Request $request)
    {
        DB::enableQueryLog();

     $skill = $request->input('skill');
    \Log::info('Skill received: ' . $skill);

    $resumes = DB::table('resumes')
        ->whereRaw('LOWER(skills) LIKE ?', ["%$skill%"])
        ->select('id', 'email', 'skills')
        ->get();

    \Log::info('Query Log:', DB::getQueryLog());
    \Log::info('Resumes matched:', $resumes->toArray());

    return response()->json($resumes);
}
    public function searchOriginal(Request $request)
    {
         DB::enableQueryLog();

    $skill = $request->query('skill');
    // $skill = $request->query('skill');

    $query = Resume::query();

    if ($skill) {
        // Case-insensitive search
        $query->whereRaw('LOWER(skills) LIKE ?', ['%' . strtolower($skill) . '%']);
    }

    $resumes = $query->get();

    // Log the executed query
    // Log::info(DB::getQueryLog());

    // Return the results
    return response()->json($resumes);
}
}