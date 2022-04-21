<?php

namespace App\Http\Controllers;

use App\TblFeedback;
use Illuminate\Http\Request;

class FeedBackController extends Controller
{
    public function getResults()
    {
        return TblFeedback::with('customer_details')->orderBy('feedback_date', 'desc')->paginate(5);
    }
}
