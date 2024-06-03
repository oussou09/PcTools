@extends('admin.adminBody')

@section('content')
{{-- @dd($message_user) --}}
<div class="card-login-profile">
        <h1 style="text-align: center">Message</h1>
            <div class="textfield">
                <h3>Email <span style="padding: 0px 15px;" class="span-cadastre-se">{{ $message_user->email }}</span></h3>
            </div>
            <div class="textfield">
                <h3>Subject <span style="padding: 0px 15px;" class="span-cadastre-se">{{ $message_user->subject }}</span></h3>
            </div>
            <div class="textfield">
                <h3>Description <span style="padding: 0px 15px;" class="span-cadastre-se">{{ $message_user->description }}</span></h3>
            </div>
            <div class="btn-plus" style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
                <h2>Reply Message</h2>
                <a style="padding: 15px 15px 1px 15px;text-decoration: none;font-size: medium;" class="span-cadastre-se"  href= "mailto: {{ $message_user->email }}"><strong>Click to Send Mail</strong></a>
            </div>
            <div class="btn-plus" style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
                <form action="{{ route('admin.destroymessage', ['id' => $message_user->id]) }}" method="POST">
                    @csrf
                    <button onclick="return confirm('Are you sure you want to delete Message of {{ $message_user->email }}?')"
                            class="actionadmin" type="submit" style="background-color: #f44336;font-size: 18px;padding: 10px 50px;">
                        Delete
                    </button>
                </form>
            </div>
    </div>
@endsection
