{{-- resources/views/admin/users/index.blade.php --}}

@extends('admin.adminBody')

@section('content')
<div class="messagecontent">

    <div class="container mx-auto px-4 py-8" style="text-align:center">
        @auth('admin')
            <h1>Hello {{ Auth::guard('admin')->user()->username }}</h1>  {{-- session('usernameinfo') --}}
        @else
            <h1>Hello Admin ..</h1>
        @endauth
    </div>

    <div style="margin-bottom: 50px;width: 85vw;" class="container mx-auto px-4 py-8">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 16px;text-align:center">All Messages</h1>

        <div style="overflow-x: auto;text-align: center">
            <table style="width: 100%; background-color: white; border: 1px solid #ddd; border-radius: 8px;text-align: center">
                <thead style="text-align: center">
                    <tr>
                        <th width="10%" style="padding: 8px; border-bottom: 1px solid #ddd; font-size: 16px">Email</th>
                        <th width="10%" style="padding: 8px; border-bottom: 1px solid #ddd; font-size: 16px">Subject</th>
                        <th width="40%" style="padding: 8px; border-bottom: 1px solid #ddd; font-size: 16px">Description</th>
                        <th width="30%" style="padding: 8px; border-bottom: 1px solid #ddd; font-size: 16px">Actions</th>
                        <th width="10%" style="padding: 8px; border-bottom: 1px solid #ddd; font-size: 16px">Created_At</th>
                    </tr>
                </thead>
                <tbody style="text-align: center">
                    @if ($messages->isEmpty())
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;"> There Is No Messages In Database </td>
                        </tr>
                    @else
                        @foreach($messages as $message)
                            <tr style="background-color: {{ $loop->iteration % 2 == 0 ? '#dedede' : 'white' }};">
                                <td style="padding: 8px; font-size: 15px">{{ $message->email }}</td>
                                <td style="padding: 8px; font-size: 15px">{{ $message->subject }}</td>
                                <td style="padding: 8px; font-size: 15px">{!! $message->formatted_description !!}</td>
                                <td style="padding: 8px;display: flex;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;align-items: center;margin: 10px;">
                                    <a href="mailto:{{ $message->email }}"><button type="button" style="background-color: #4CAF50; color: white; border: none; padding: 5px 12px; text-align: center; text-decoration: none; display: inline-block; font-size: 13px;margin:5px; border-radius: 5px;">Reply</button></a>
                                    <a href="{{ route('admin.showmessage',['id' => $message->id]) }}"><button type="button" style="background-color: #008CBA; color: white; border: none; padding: 5px 12px; text-align: center; text-decoration: none; display: inline-block; font-size: 13px;margin:5px; border-radius: 5px;">Show</button></a>
                                    <form action="{{ route('admin.destroymessage', ['id' => $message->id]) }}" method="POST">
                                        @csrf
                                        <button onclick="return confirm('Are you sure you want to delete Message Of {{ $message->email }}?')"
                                                type="submit" style="background-color: #f44336; color: white; border: none; padding: 5px 12px; text-align: center; text-decoration: none; display: inline-block; font-size: 13px;margin:5px; border-radius: 5px;">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <td style="font-size: 15px">
                                    <div style="display: flex;align-items: center;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;">
                                        <span>{{ $message->created_at->format('H:i') }}</span>
                                        <span>{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
