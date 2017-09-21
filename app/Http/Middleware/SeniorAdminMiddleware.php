<?php
/**
 * Created by PhpStorm.
 * User: Student
 * Date: 21/09/2017
 * Time: 12:55 PM
 */

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class SeniorAdminMiddleware
{
    // It's a \Illuminate\Http\Request even though it's not declared that was in this file
    public function handle($request, Closure $next) {

        // Redirect away if the user is not the required level
        $s = $request->user();
        if ($s == null || ($s->Position != 'Manager' && $s->Position != 'Senior Admin')) {
            return redirect('badauth');
        }

        // Pass the request to the next middleware
        return $next($request);

    }
}