<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\GoogleSheetsService;
use Google\Service\Sheets\ValueRange;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('https://accounts.google.com/Logout?continue=https://appengine.google.com/_ah/logout?continue=' . urlencode(url('/')));
    }

    public function initialDataSave(Request $request){
        $email = Auth::user()->email;

        User::where('email','=',$email)->update([
            'company_name' => $request->companyName,
            'wa_number' => $request->waNum
        ]);

        $service = GoogleSheetsService::get();

        $spreadsheetId = env('GOOGLE_USER_LIST');

        $values = [
            [Auth::user()->id_user,Auth::user()->name, Auth::user()->email, $request->waNum, $request->companyName, 'Free', 3]
        ];

        $body = new ValueRange([
            'values' => $values
        ]);

        $service->spreadsheets_values->append(
            $spreadsheetId,
            'Sheet1!A:F', // only define the columns
            $body,
            [
                'valueInputOption' => 'RAW',
                'insertDataOption' => 'INSERT_ROWS'
            ]
        );
        return [
            'status' => 'success'
        ];
    }
}
