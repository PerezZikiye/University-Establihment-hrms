<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerifyStaff;




class VerifyStaffController extends Controller
{
    // Display the verification form
    public function index()
    {
        return view('verify-staff');
    }

    // Process the form submission
    public function verify(Request $request)
    {
        // Validate the form data
        $request->validate([
            'staff_no' => 'required',
            'staff_token' => 'required',
        ]);

        // Retrieve the input data from the request
        $staffNo = $request->input('staff_no');
        $staffToken = $request->input('staff_token');

        // Perform verification logic
        $verificationResult = VerifyStaff::where('staff_no', $staffNo)
            ->where('staff_token', $staffToken)
            ->first();

        if (!$verificationResult) {
            // Verification failed, redirect back with an error message
            //return redirect()->back()->with('error', 'invalid staff number or token.');
            return redirect()->route('password.setup');
        }

        else
        // Verification successful, you can proceed with further actions
        // For example, you can redirect the user to their profile page

        return redirect()->route('user.profile'); // Replace with your actual route name
    }
}

