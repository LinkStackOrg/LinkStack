<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Closure;

class Impersonate
{
    public function handle($request, Closure $next)
    {
        $adminUser = User::where('role', 'admin')->where(function ($query) {
            $query->where('auth_as', '!=', null)
                  ->where('auth_as', '!=', '');
        })->first();

        if ($adminUser && is_numeric($adminUser->auth_as)) {

        $originalUser = $adminUser->id;

        $id = is_numeric($adminUser->auth_as) ? $adminUser->auth_as : $adminUser->id;
        $user = User::find($id);

        $name = $user->name;

        if(Auth::user()->id === $originalUser) {

        // Generate unique token
        $token = Str::random(60);
        if(\Route::currentRouteName() !== 'authAs'){
            $adminUser->remember_token = $token;
            $adminUser->save();
            echo "<script>window.location.href = '".url('studio/links')."';</script>";
        }

            Auth::loginUsingId($id);
            setcookie("display_auth_nav", "true", time() + (10 * 365 * 24 * 60 * 60), "/");
        }

if(isset($_COOKIE['display_auth_nav'])) {
if (file_exists(base_path(findAvatar($id)))) {
    $img = '<img alt="avatar" class="iimg irounded" src="' . url(findAvatar($id)) . '">';
} elseif (file_exists(base_path("assets/linkstack/images/").findFile('avatar'))) {
    $img = '<img alt="avatar" class="iimg irounded" src="' . url("assets/linkstack/images/") . "/" . findFile('avatar') . '">';
} else {
    $img = '<img alt="avatar" class="iimg" src="' . asset('assets/linkstack/images/logo.svg') . '">';
}
$dashboard = url('dashboard');
$URL = url('/auth-as');
$csrf = csrf_token();
$remember_token = User::find($originalUser);
$token = $remember_token->remember_token;
$customHtml =
<<<EOD

<style>
  .ibar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 67px;
    background-color: #4d4c51;
    z-index: 911;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
  }

  .itext1 {
    color: white;
    font-family: "Inter", sans-serif;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 17px 16px;
  }

  .itext1 span a {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .itext1 a {
    color: white;
    text-decoration: none;
  }

  .itext1 svg {
    width: 32px;
    height: 32px;
    fill: currentColor;
    margin-left: 8px;
    margin-bottom: 4px;
  }

  .iimg {
    width: 32px;
    height: 32px;
    margin-right: 8px;
    margin-bottom: 3px;
  }

  .irounded {
    border-radius: 50%;
  }

  body {
    padding-top: 60px; /* Add padding equal to the height of .ibar */
  }
</style>

<div class="ibar">
  <p class="itext1">
    <span>
      <a href="$dashboard">$img $name</a>
    </span>
    <a style="cursor:pointer" onclick="document.getElementById('submitForm').submit(); return false;">
      <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-x" viewBox="0 0 16 16">
        <path
          d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
        />
      </svg>
    </a>
  </p>
</div>

<form id="submitForm" action="$URL" method="POST" style="display: none;">
<input type="hidden" name="_token" value="$csrf">
<input type="hidden" name="token" value="$token">
<input type="hidden" name="id" value="$originalUser">
</form>

<script>
  function submitForm() {
    document.getElementById('submitForm').submit();
  }
</script>

EOD;;
} else {$customHtml = "";}

        $response = $next($request);
        $content = $response->getContent();
        $modifiedContent = preg_replace('/<body([^>]*)>/', "<body$1>{$customHtml}", $content);
        $response->setContent($modifiedContent);

        return $response;
        } else {
            if(isset($_COOKIE['display_auth_nav'])) {
                setcookie("display_auth_nav", "", time() - 3600, "/");
                Auth::logout();
            }
            return $next($request);
        }
    }
}
