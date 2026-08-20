<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Mail\ContactReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Verify hCaptcha response
        $captchaResponse = $request->input('captchaToken');
        $secretKey = env('HCAPTCHA_SECRET_KEY');
        $response = Http::asForm()->post('https://api.hcaptcha.com/siteverify', [
            'secret' => $secretKey,
            'response' => $captchaResponse,
        ]);

        // Check if the hCaptcha verification was successful
        if (!$response->json('success')) {
            return response()->json([
                'message' => 'Captcha verification failed.'
                ], 422);
        }

        // You can save the validated data to the database or send an email here
        // For example, you can create a new Contact model instance and save it

        $contact = Contact::create($validatedData);

        Log::info('Contact saved, about to send email', [
            'contact_id' => $contact->id,
        ]);

        try {
            Mail::to(env('CONTACT_EMAIL_ADDRESS'))
                ->send(new ContactReceived($contact));

            Log::info('Email sent successfully');

        } catch (\Throwable $e) {
    return response()->json([
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
    ], 500);
}

        return response()->json([
            'message' => 'Contact form submitted successfully.'
        ], 200);
            }
}
