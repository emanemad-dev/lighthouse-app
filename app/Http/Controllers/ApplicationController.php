<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Mail\ApplicationSubmitted;
use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class ApplicationController extends Controller
{
    /**
     * Display all applications submitted by the authenticated user.
     */
    public function index()
    {
        $applications = Application::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('application.index', compact('applications'));
    }

    /**
     * Show the application submission form.
     */
    public function create()
    {
        return view('application.form');
    }

    /**
     * Handle the submission of a new application.
     */
    public function store(StoreApplicationRequest $request)
    {
        // Log that the store method was called
        Log::info('Store method called');

        DB::beginTransaction();

        try {
            // Prepare the data from the request
            $data = $this->prepareData($request);
            Log::info('Data prepared');

            // Save the application record
            $application = Application::create($data);
            Log::info('Application created', ['id' => $application->id]);

            // Handle uploaded files
            $files = $this->handleFiles($request, $application->id);
            $application->update(['files' => $files]);
            Log::info('Files stored');

            // Generate PDF summary
            $pdfPath = $this->generatePdf($data, $application->id);
            Log::info('PDF generated', ['pdfPath' => $pdfPath]);

            // Send email to admin
            $this->sendApplicationEmail($request, auth()->user(), $files, $pdfPath);
            Log::info('Email sent');

            DB::commit();

            return $this->successResponse();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Application store error: ' . $e->getMessage());
            return $this->errorResponse($e);
        }
    }


    /**
     * Prepare the request data for saving to the database.
     */
    private function prepareData(StoreApplicationRequest $request): array
    {
        return [
            'user_id'       => auth()->id(),
            'contact_email' => $request->input('contact_email'),
            'contact_phone' => $request->input('contact_phone'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender'        => strtolower($request->input('gender')),
            'country'       => $request->input('country'),
            'comments'      => $request->input('comments'),
            'files'         => [],
        ];
    }

    /**
     * Handle uploaded files and return an array of stored file paths.
     */
    private function handleFiles($request, int $applicationId): array
    {
        $storedFiles = [];
        $path = "applications/" . auth()->id() . "/$applicationId";

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $storedFiles[] = $file->storeAs($path, $filename, 'public');
            }
        }

        return $storedFiles;
    }

    /**
     * Generate a PDF summary of the application and return its path.
     */
    private function generatePdf(array $data, int $applicationId): string
    {
        $pdf = PDF::loadView('application.pdf', [
            'data' => $data,
            'user' => auth()->user(),
        ]);

        $pdfPath = "applications/" . auth()->id() . "/$applicationId/application.pdf";
        Storage::disk('public')->put($pdfPath, $pdf->output());

        return storage_path("app/public/$pdfPath");
    }

    /**
     * Send an email with the application data, uploaded files, and PDF.
     */
    private function sendApplicationEmail($request, $user, array $files, string $pdfPath): void
    {
        Mail::to(config('mail.admin_email', 'admin@example.com'))
            ->queue(new ApplicationSubmitted(
                [
                    'contact_email' => $request->input('contact_email'),
                    'contact_phone' => $request->input('contact_phone'),
                    'date_of_birth' => $request->input('date_of_birth'),
                    'gender'        => $request->input('gender'),
                    'country'       => $request->input('country'),
                    'comments'      => $request->input('comments'),
                ],
                $user,
                $files,
                $pdfPath
            ));
    }

    /**
     * Return a JSON response indicating success.
     */
    private function successResponse()
    {
        return response()->json([
            'success'  => true,
            'message'  => 'Application submitted successfully! Check your mail log.',
            'redirect' => route('dashboard'),
        ]);
    }

    /**
     * Return a JSON response indicating an error.
     */
    private function errorResponse(\Throwable $e)
    {
        return response()->json([
            'success' => false,
            'message' => 'Server error: ' . $e->getMessage(),
        ], 500);
    }
}
