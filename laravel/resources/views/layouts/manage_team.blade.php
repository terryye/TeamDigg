@extends('layouts.main')

@section('content')
    <div class="col-md-2" role="complementary">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                基本资料
            </a>
            <a href="#" class="list-group-item">订阅源</a>
            <a href="#" class="list-group-item">成员</a>
        </div>
    </div>

    <div class="col-md-7">
        <ol class="breadcrumb">
            @yield('breadcrumb')
        </ol>
        <div class="panel panel-default panel-team">
            <div class="panel-body">
                @yield('form')

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>填入
                            信息有误,请检查</strong><br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection