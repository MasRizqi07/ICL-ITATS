<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $feedbacks = Feedback::where('student_id', $user->id)->with('reviewer', 'evidence')->latest()->get();
        return view('pages.notifications.index', compact('user', 'feedbacks'));
    }
}
