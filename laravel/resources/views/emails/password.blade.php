Hello {{$user->name}},<br />

点击这里重新设置您在TeamDIGG的密码: {{ route('password.reset', ['token' => $token, 'email'=>$user->email]) }}