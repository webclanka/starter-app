<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

// Stub controllers for auth routes
class ConfirmablePasswordController extends Controller
{
    public function show() { return view('auth.confirm-password'); }
    public function store() { return redirect()->back(); }
}

class EmailVerificationNotificationController extends Controller
{
    public function store() { return redirect()->back(); }
}

class EmailVerificationPromptController extends Controller
{
    public function __invoke() { return view('auth.verify-email'); }
}

class NewPasswordController extends Controller
{
    public function create() { return view('auth.reset-password'); }
    public function store() { return redirect()->route('login'); }
}

class PasswordController extends Controller
{
    public function update() { return redirect()->back(); }
}

class PasswordResetLinkController extends Controller
{
    public function create() { return view('auth.forgot-password'); }
    public function store() { return redirect()->back(); }
}

class VerifyEmailController extends Controller
{
    public function __invoke() { return redirect('/dashboard'); }
}