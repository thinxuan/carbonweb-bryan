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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:waitlist,email',
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Create waitlist entry
            $waitlistEntry = Waitlist::create([
                'email' => $request->email,
                'name' => $request->name,
                'company' => $request->company,
                'message' => $request->message,
            ]);

            // Send confirmation email
            Notification::route('mail', $request->email)
                ->notify(new WaitlistConfirmation($waitlistEntry));

            // Update email sent status
            $waitlistEntry->update([
                'email_sent' => true,
                'email_sent_at' => now(),
            ]);

            // Return JSON response for AJAX requests
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for joining our waitlist! Check your email for confirmation.'
                ]);
            }

            return redirect()->back()->with('success', 'Thank you for joining our waitlist! Check your email for confirmation.');

        } catch (\Exception $e) {
            // Log the actual error for debugging
            Log::error('Waitlist submission error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            // Return JSON response for AJAX requests
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withErrors(['error' => 'Something went wrong. Please try again. Error: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
