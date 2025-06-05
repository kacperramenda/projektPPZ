<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
| This file defines the routes for authentication-related actions in the
| application. Routes are grouped by middleware to separate guest-only
| and authenticated-only actions.
*/

/*
|--------------------------------------------------------------------------
| Guest Middleware Group
|--------------------------------------------------------------------------
| Routes in this group are accessible only to unauthenticated users.
*/
Route::middleware('guest')->group(function () {
    /**
     * Show the registration page.
     *
     * @group Authentication
     * @response 200 {"view": "Auth/Register/Index"}
     *
     * @return \Inertia\Response
     */
    Route::get('/register', function () {
        return Inertia::render('Auth/Register/Index');
    })->name('register');

    /**
     * Handle user registration.
     *
     * @group Authentication
     * @bodyParam name string required The user's first name. Example: John
     * @bodyParam surname string required The user's last name. Example: Doe
     * @bodyParam email string required The user's email address. Example: john.doe@example.com
     * @bodyParam password string required The user's password. Example: secret123
     * @bodyParam password_confirmation string required The password confirmation. Example: secret123
     * @response 201 {"message": "User registered successfully"}
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::post('register', [RegisteredUserController::class, 'store']);

    /**
     * Show the login page.
     *
     * @group Authentication
     * @response 200 {"view": "Auth/Login/Index"}
     *
     * @return \Inertia\Response
     */
    Route::get('login', function () {
        return Inertia::render('Auth/Login/Index');
    })->name('login');

    /**
     * Handle user login.
     *
     * @group Authentication
     * @bodyParam email string required The user's email address. Example: john.doe@example.com
     * @bodyParam password string required The user's password. Example: secret123
     * @response 200 {"message": "User logged in successfully"}
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    /**
     * Show the forgot password page.
     *
     * @group Authentication
     * @response 200 {"view": "Auth/ForgotPassword/Index"}
     *
     * @return \Inertia\Response
     */
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    /**
     * Handle sending a password reset link.
     *
     * @group Authentication
     * @bodyParam email string required The user's email address. Example: john.doe@example.com
     * @response 200 {"message": "Password reset link sent"}
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    /**
     * Show the password reset page.
     *
     * @group Authentication
     * @urlParam token string required The password reset token. Example: abc123
     * @response 200 {"view": "Auth/ResetPassword/Index"}
     *
     * @param string $token
     * @return \Inertia\Response
     */
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    /**
     * Handle resetting the user's password.
     *
     * @group Authentication
     * @bodyParam email string required The user's email address. Example: john.doe@example.com
     * @bodyParam password string required The new password. Example: newpassword123
     * @bodyParam password_confirmation string required The password confirmation. Example: newpassword123
     * @response 200 {"message": "Password reset successfully"}
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

/*
|--------------------------------------------------------------------------
| Auth Middleware Group
|--------------------------------------------------------------------------
| Routes in this group are accessible only to authenticated users.
*/
Route::middleware('auth')->group(function () {
    /**
     * Show the email verification prompt.
     *
     * @group Authentication
     * @response 200 {"view": "Auth/VerifyEmail/Prompt"}
     *
     * @return \Inertia\Response
     */
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    /**
     * Handle email verification.
     *
     * @group Authentication
     * @urlParam id int required The user ID. Example: 1
     * @urlParam hash string required The email verification hash. Example: abc123
     * @response 200 {"message": "Email verified successfully"}
     *
     * @param int $id
     * @param string $hash
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    /**
     * Resend the email verification notification.
     *
     * @group Authentication
     * @response 200 {"message": "Verification email sent"}
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    /**
     * Show the confirm password page.
     *
     * @group Authentication
     * @response 200 {"view": "Auth/ConfirmPassword/Index"}
     *
     * @return \Inertia\Response
     */
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    /**
     * Handle password confirmation.
     *
     * @group Authentication
     * @bodyParam password string required The user's current password. Example: secret123
     * @response 200 {"message": "Password confirmed successfully"}
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    /**
     * Update the user's password.
     *
     * @group Authentication
     * @bodyParam current_password string required The user's current password. Example: oldpassword123
     * @bodyParam password string required The new password. Example: newpassword123
     * @bodyParam password_confirmation string required The password confirmation. Example: newpassword123
     * @response 200 {"message": "Password updated successfully"}
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    /**
     * Handle user logout.
     *
     * @group Authentication
     * @response 200 {"message": "User logged out successfully"}
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
