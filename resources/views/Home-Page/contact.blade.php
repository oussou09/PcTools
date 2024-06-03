@extends('Home-Page.homeapp')
@section('style')
<style>
    .sectionone{
        display: flex;
        justify-content: center;
        margin-top: 70px
    }
</style>
@endsection
@section('content')
    <div style="opacity: 90%;width: 70%;background: #eeeeee;" class="form simplified">
        <div style="background: #e3e3e3;" class="form simplified">
            <form action="{{route('home.store')}}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                    <input style="background: #e3e3e3;border: 2px solid #8e8e8e;" type="text" id="email" name="email" placeholder="email">
                </div>

                <div class="input-group">
                    <label for="subject">Subject</label>
                    <input style="background: #e3e3e3;border: 2px solid #8e8e8e;" type="text" id="subject" name="subject" placeholder="Subject...">
                </div>

                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea style="border: 2px solid #8e8e8e;padding: 15px 15px;font-size: 15px;height: 15vh;width: 100%;background: #e3e3e3;" id="description" name="description" placeholder="Description..." rows="4" cols="67">Your Description Message ...</textarea>
                </div>

                <div class="buttons">
                    <button type="submit" style="width: auto; height: auto;" class="btn" id="add-btn">Send Message</button>
                </div>
            </form>
        </div>
    </div>
@endsection
