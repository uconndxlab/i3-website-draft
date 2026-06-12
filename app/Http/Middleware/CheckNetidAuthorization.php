<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AuthorizedNetid;

class CheckNetidAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( !cas()->checkAuthentication() ) {
            if ( $request->ajax() ) {
                return response('Unauthorized.', 401);
            }
            cas()->authenticate();
        }

        // Get the NetID from the CAS authentication
        // The CAS middleware stores the user in the session as 'cas_user'
        $netid = cas()->user();
        
        // If no NetID is found, the CAS middleware should handle authentication
        if (!$netid) {
            return abort(404, 'NetID not found.');
        }
        
        // Check if the NetID is authorized
        if (!AuthorizedNetid::isAuthorized($netid)) {
            return abort(404, 'Unauthorized access.');
        }

        $request->session()->regenerateToken();
        
        return $next($request);
    }
}
