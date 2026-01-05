<?php

namespace App\Modules\Core\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class SwitchAccountController extends Controller
{
    /**
     * Show the switch account confirmation page for the user's role.
     * Loads mechanic/switch-account.blade.php, technician/switch-account.blade.php, etc.
     */
    public function showSwitchPage()
    {
        $user = Auth::user();

        $role = strtolower($user->role);
        $viewPath = $role . '.switch-account';

        if (view()->exists($viewPath)) {
            return view($viewPath, ['role' => ucfirst($role)]);
        }

        abort(404, 'Switch account page not found for role: ' . $role);
    }

    /**
     * Switch to mediator account.
     */
    public function switchToMediator(Request $request)
{
    $user = Auth::user();

    // Save current role in session for switching back
    session(['previous_role' => $user->role]);

    // Switch role
    $user->role = 'mediator';
    $user->save();

    // Redirect to mediator dashboard
    if (Route::has('mediator.index')) {
        return redirect()->route('mediator.index')
                         ->with('success', 'Account switched to Mediator!');
    }

    // Fallback
    return redirect('/dashboard')->with('success', 'Account switched to Mediator!');
}


    /**
     * Switch back from mediator to previous role
     */
    public function backFromMediator()
    {
        $user = Auth::user();

        if ($user->role === 'mediator') {
            $previousRole = session('previous_role', 'mechanic'); // default fallback
            $user->role = $previousRole;
            $user->save();

            session()->forget('previous_role');

            $roleRoute = strtolower($previousRole) . '.dashboard';
            if (Route::has($roleRoute)) {
                return redirect()->route($roleRoute)
                                 ->with('success', 'Switched back to ' . ucfirst($previousRole) . ' account!');
            }

            return redirect('/' . strtolower($previousRole) . '/index')
                ->with('success', 'Switched back to ' . ucfirst($previousRole) . ' account!');
        }

        abort(403, 'Unauthorized action.');
    }
    
}
