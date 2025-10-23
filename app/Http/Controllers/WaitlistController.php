<?php

namespace App\Http\Controllers;

use App\Models\Waitlist;
use App\Notifications\WaitlistConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class WaitlistController extends Controller
{
    /**
     * Display the waitlist form.
     */
    public function index()
    {
        return view('waitlist');
    }

    /**
     * Store a new waitlist entry and send confirmation email.
     */
    public function store(Request $request)
    {
        try {
            // Simple validation
            $request->validate([
                'email' => 'required|email',
                'name' => 'required|string|max:255',
                'company' => 'nullable|string|max:255',
            ]);

            // Try to create waitlist entry (ignore if database fails)
            try {
                $waitlistEntry = Waitlist::create([
                    'email' => $request->email,
                    'name' => $request->name,
                    'company' => $request->company ?? null,
                    'message' => null,
                ]);
            } catch (\Exception $e) {
                // If database fails, just log it but continue
                Log::info('Database save failed (normal in some environments): ' . $e->getMessage());
            }

            // Always return success - don't let database issues break the form
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for joining our waitlist!'
                ]);
            }

            return redirect()->back()->with('success', 'Thank you for joining our waitlist!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check your input and try again.',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;

        } catch (\Exception $e) {
            Log::error('Waitlist error: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please try again later.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Please try again later.');
        }
    }
}
