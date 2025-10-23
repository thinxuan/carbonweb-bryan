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
                'email' => 'required|email|unique:waitlist,email',
                'name' => 'required|string|max:255',
                'company' => 'nullable|string|max:255',
            ]);

            // Create waitlist entry
            $waitlistEntry = Waitlist::create([
                'email' => $request->email,
                'name' => $request->name,
                'company' => $request->company ?? null,
                'message' => null, // Not used in the form
            ]);

            // Try to send email (optional - won't fail if it doesn't work)
            try {
                Notification::route('mail', $request->email)
                    ->notify(new WaitlistConfirmation($waitlistEntry));
                $waitlistEntry->update(['email_sent' => true, 'email_sent_at' => now()]);
            } catch (\Exception $e) {
                Log::info('Email not sent (normal in production): ' . $e->getMessage());
            }

            // Always return success for AJAX requests
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
