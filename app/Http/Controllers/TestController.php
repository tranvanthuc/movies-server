<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{

    public function getLogin()
    {
        return view('login');
    }

    public function getLoginSlack(Request $request)
    {
        $access_token = $request->session()->get('access_token');
        if ($request->session()->has('access_token')) {
            $user = User::where('access_token', $access_token)->first();
            if (!empty($user)) {
                Auth::login($user);
                return redirect()->route('home');
            }
        }
        $url = env('SLACK_URL') . 'oauth/authorize?client_id=' . env('SlACK_CLIENT_ID') . '&scope=identity.basic,identity.email,identity.avatar';
        header('Location: ' . $url);
        die(1);
    }

    public function getToken(Request $request)
    {
        $minutes = 60 * 2;
        $code = $request->get('code');
        $url = env('SLACK_URL') . 'api/oauth.access?client_id=' . env('SlACK_CLIENT_ID') . '&client_secret=' . env('SLACK_CLIENT_SECRET') . '&code=' . $code;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($content);


        if ($data->ok == false) {

            return redirect()->route('login');

        }
        session('access_token', $data->access_token);
        $checkUser = User::where('access_token', $data->access_token)->first();
        if (!empty($checkUser)) {
            Auth::login($checkUser);
            return redirect()->route('home');
        }
        $user = new User;
        $user->access_token = $data->access_token;
        $user->name = $data->user->name;
        $user->email = $data->user->email;
        $user->image_1 = $data->user->image_32;
        $user->image_2 = $data->user->image_192;

        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }

    public function getHome()
    {
        return view('welcome');
    }

    public function sendMessage()
    {
//        $url = env('SLACK_URL') . 'oauth/authorize?client_id=' . env('SlACK_CLIENT_ID') . '&scope=chat:write:user';
//        header('Location: ' . $url);
//        die(1);
        $token = Auth::user()->access_token;
        $username = Auth::user()->name;
        $message = "My name is Tran Van Thuc";
        $icon = Auth::user()->image_1;
        $channel = 'random';
//        $data = implode(array(
//            "token=" .$token,
//            "as_user=true" ,
//            "username=". $username,
//            "channel=". $channel,
//            "text=". $message,
//            "icon_url=". $icon
//        ), "&");

        $data = array(
            'token' => $token,
            'username' => $username,
            'channel' => $channel,
            'text' => $message,
            'icon_url' => $icon
        );

        $url ='https://slack.com/api/chat.postMessage';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);

        curl_close($ch);

        return redirect()->route('home');


    }
}