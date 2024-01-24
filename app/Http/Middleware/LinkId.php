<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkId
{
    public function handle($request, Closure $next)
    {
        $linkId = $request->route('id');
        $user = Auth::user();
    
        $link = Link::find($linkId);
    
        if (!$link) {
            return abort(404);
        }
    
        if ($user->id != $link->user_id) {
            return abort(403);
        }
    
        return $next($request);
    }
}
