{{-- resources/views/admin/users/index.blade.php --}}

@extends('admin.adminBody')

@section('content')

<div class="container mx-auto px-4 py-8" style="text-align:center">
    @auth('admin')
        <h1>Hello {{ Auth::guard('admin')->user()->username }}</h1>  {{-- session('usernameinfo') --}}
    @else
        <h1>Hello Admin ..</h1>
    @endauth
</div>

<div style="margin-bottom: 50px;" class="container mx-auto px-4 py-8">
    <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 16px;text-align:center">All Users</h1>

    <div style="overflow-x: auto;text-align: center">
        <table style="width: 100%; background-color: white; border: 1px solid #ddd; border-radius: 8px;text-align: center;font-size: 12px;">
            <thead style="text-align: center">
                <tr>
                    <th width="10%" style="padding: 8px; border-bottom: 1px solid #ddd;">ID</th>
                    <th width="20%" style="padding: 8px; border-bottom: 1px solid #ddd;">Name</th>
                    <th width="10%" style="padding: 8px; border-bottom: 1px solid #ddd;">As</th>
                    <th width="20%" style="padding: 8px; border-bottom: 1px solid #ddd;">Email</th>
                    <th width="40%" style="padding: 8px; border-bottom: 1px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody style="text-align: center">
                @if ($users->isEmpty())
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd;"> There Is No Users In Database </td>
                    </tr>
                @else
                    @foreach($users as $user)
                        <tr style="background-color: {{ $loop->iteration % 2 == 0 ? '#dedede' : 'white' }};">
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $user->id }}</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $user->name }}</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                @if ($user->account_type === 1)
                                    Seller!
                                @else
                                    Buyer
                                @endif
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $user->email }}</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                <ul style="display:flex;align-content:center;justify-content:center;align-items:center;flex-direction:row; flex-wrap:wrap;">
                                    <li><a class="actionadmin" style="background-color: #4CAF50;" href="{{ route('user.edituser',['id'=>$user->email]) }}">Edit User N:{{ $user->id }}</a></li>
                                    <li><a class="actionadmin" style="background-color: #008CBA;" href="#">Show User N:{{ $user->id }}</a></li>
                                    <li><a class="actionadmin" style="background-color: #f44336;" href="#">Delete User N:{{ $user->id }}</a></li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    </div>
</div>

@endsection
