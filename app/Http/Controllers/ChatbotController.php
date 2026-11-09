<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = strtolower(trim($validated['message']));

        // PATIENT REGISTRATION
        if (
            str_contains($message, 'register') ||
            str_contains($message, 'registration')
        ) {
            $reply = "To register as a patient, select Patient Registration on the clinic home page. Complete your personal details and submit the registration form.";
        }

        // START A VISIT
        elseif (
            str_contains($message, 'visit') ||
            str_contains($message, 'check-in') ||
            str_contains($message, 'check in')
        ) {
            $reply = "To start a clinic visit, log in using your patient ID, select Start Visit, choose your reason for visiting and submit the information.";
        }

        // QUEUE NUMBER
        elseif (
            str_contains($message, 'queue') ||
            str_contains($message, 'number')
        ) {
            $reply = "Your queue number and current visit status can be viewed on your patient dashboard after successfully starting a visit.";
        }

        // CLINIC SERVICES
        elseif (
            str_contains($message, 'service') ||
            str_contains($message, 'services')
        ) {
            $reply = "Our clinic offers patient registration, screening, general consultations, chronic care, maternity services, pediatric care and hospital referrals.";
        }

        // CLINIC HOURS
        elseif (
            str_contains($message, 'hour') ||
            str_contains($message, 'open') ||
            str_contains($message, 'closing')
        ) {
            $reply = "For information about the clinic's current operating hours, please contact the reception desk.";
        }

        // SCREENING
        elseif (
            str_contains($message, 'screening') ||
            str_contains($message, 'nurse') ||
            str_contains($message, 'vitals')
        ) {
            $reply = "After checking in, please wait for the staff nurse to call you for screening and vital-sign measurements.";
        }

        // DOCTOR CONSULTATION
        elseif (
            str_contains($message, 'doctor') ||
            str_contains($message, 'consultation')
        ) {
            $reply = "After screening, patients are directed to the appropriate healthcare professional for consultation. If you have urgent symptoms, alert clinic staff immediately.";
        }

        // HOSPITAL REFERRAL
        elseif (str_contains($message, 'referral')) {
            $reply = "If further medical attention is required, the doctor can prepare a hospital referral for the patient.";
        }

        // GREETINGS
        elseif (
            str_contains($message, 'hello') ||
            str_contains($message, 'hi') ||
            str_contains($message, 'hey')
        ) {
            $reply = "Hello! Welcome to DPCMS. How can I assist you today?";
        }

        // HELP
        elseif (str_contains($message, 'help')) {
            $reply = "I can help you with patient registration, starting a visit, queue information, clinic screening, consultations, referrals, clinic services and operating hours.";
        }

        // UNKNOWN QUESTIONS
        else {
            $reply = "Sorry, I do not understand that question yet. Please ask me about patient registration, visits, queue numbers, screening, consultations, referrals or clinic services.";
        }

        return response()->json([
            'reply' => $reply
        ]);
    }
}
