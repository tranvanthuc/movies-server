<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller {

  public function getLogin()
  {
      return view('login');
  }

  public function getLoginSlack(Request $request)
  {
      $access_token = $request->session()->get('access_token');
      die(json_encode($access_token));
      if ($request->session()->has('users')) {
          $user = User::where('access_token', $access_token)->first();
          if(!empty($user)) {
              Auth::login($user);
              return redirect()->route('home');
          }
      }
      $url = env('SLACK_URL') . 'oauth/authorize?client_id='. env('SlACK_CLIENT_ID').'&scope=identity.basic,identity.email,identity.avatar';
      header('Location: '. $url);
      die(1);
  }

  public function getToken(Request $request)
  {
      $minutes = 60*2;
      $code = $request->get('code');
      $url = env('SLACK_URL') . 'api/oauth.access?client_id='. env('SlACK_CLIENT_ID').'&client_secret='. env('SLACK_CLIENT_SECRET') .'&code=' .$code;
      $ch = curl_init();
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
      $content = curl_exec($ch);
      curl_close($ch);
      $data = json_decode($content);


      if($data->ok == false) {

          return redirect()->route('login');

      }
      session('access_token', $data->access_token);
      die(json_encode(\session('access_token')));
      $user = new User;
      $user->access_token =  $data->access_token;
      $user->name =  $data->user->name;
      $user->email =  $data->user->email;
      $user->image_1 =  $data->user->image_32;
      $user->image_2 =  $data->user->image_192;

      $user->save();

      Auth::login($user);

      return redirect()->route('home');
  }

  public function getHome()
  {
      return view('welcome');
  }
}