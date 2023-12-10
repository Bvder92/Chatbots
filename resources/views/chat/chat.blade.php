@extends('layouts.app')
@section('content')
    <div class="py-24 container-fluid ">
        <div class="grid grid-cols-3 ">
            <div class="">
                <div class="fixed w-1/4 ">
                    <div class=" mx-4 shadow-lg rounded-xl bg-white/50 backdrop-blur-[200px]">
                        @include('include.sidebar')
                    </div>
                </div>
            </div>
            <div class="container-flex">
                <div class="bg-sky-300 rounded-lg container ">
                    <div class="font-bolg text-lg m-4">Chats</div>
                    <div class="bg-sky-500 rounded-lg p-4">
                        <chat-messages :messages="messages"></chat-messages>
                    </div>
                    <div class="bg-sky-100 rounded-lg p-4">
                        <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}" ></chat-form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


 {{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="chat">

    <!-- Header -->
    <div class="top">
        <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
        <div>
            <p>Ross Edlin</p>
            <small>Online</small>
        </div>
    </div>
    <!-- End Header -->

    <!-- Chat -->
    <div class="messages">
        @include('chat.receive', ['message' => "Hey! What's up!  👋"])
        @include('chat.receive', ['message' => 'Ask a friend to open this link and you can chat with them!'])
    </div>
    <!-- End Chat -->

    <!-- Footer -->
    <div class="bottom">
        <form>
            <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
            <button type="submit"></button>
        </form>
    </div>
    <!-- End Footer -->

</div>
</body>

<script>
    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: 'eu'
    });
    const channel = pusher.subscribe('public');

    //Receive messages
    channel.bind('chat', function(data) {
        $.post("/chat/receive", {
                _token: '{{ csrf_token() }}',
                message: data.message,
            })
            .done(function(res) {
                $(".messages > .message").last().after(res);
                $(document).scrollTop($(document).height());
            });
    });

    //Broadcast messages
    $("form").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: "/chat/broadcast",
            method: 'POST',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: '{{ csrf_token() }}',
                message: $("form #message").val(),
            }
        }).done(function(res) {
            $(".messages > .message").last().after(res);
            $("form #message").val('');
            $(document).scrollTop($(document).height());
        });
    });
</script>

</html> --}}
