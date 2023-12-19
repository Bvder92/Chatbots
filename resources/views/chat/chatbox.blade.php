@php
    //$recipient = request()->route('recipient'); // récupère le recipient_id dans l'URL
    //$recipient_id  = $recipient->id;
@endphp
<script>
    window.recipientId = {{ $recipient->id }}; // on le met dans une globale JS
    console.log('RecipientId: ');
    if (window.recipientId == "") {
        console.log('empty!');
    } else {
        console.log(window.recipientId);
    }
</script>

@extends('layouts.app')
@section('content')
    <div class="pt-20 h-full">
        <div class="grid grid-cols-4 h-full pb-2">
            <div class="h-full">
                <div class="fixed w-1/4 ">
                    <div class=" mx-4 shadow-lg rounded-xl bg-normal">
                        @include('include.sidebar')
                    </div>
                </div>
            </div>

            <div class="container rounded-xl shadow-lg col-span-2 bg-clear overflow-hidden h-full">
                <div class="overflow-hidden h-full flex flex-col space-y-2 p-4">

                    <div class="font-bold text-lg m-4">Discussion</div>

                    <div class="p-6 bg-normal rounded-lg flex items-center space-x-6 font-semibold text-lg mx-4">
                        <div class="h-12 w-12">
                            <a href="{{ route('users.show', $recipient->id) }}"><img src="{{ $recipient->getImageURL() }}" alt="" class="rounded-full"></a>
                        </div>
                        <span><a href="{{ route('users.show', $recipient->id) }}">{{ $recipient->name }}</a></span>
                    </div>
                    <div class="bg-normal overflow-hidden rounded-lg mx-4 flex-grow">
                        <chat-messages :messages="messages" :recipient="{{ $recipient }}"
                            :user="{{ $user }}"></chat-messages>
                    </div>
                    <div class="bg-normal rounded-lg mx-4 mb-4">
                        {{--  <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}" ></chat-form> --}}
                        <chat-form v-on:messagesent="addMessage" :sender="{{ Auth::user() }}"
                            :recipient="{{ $recipient }}"></chat-form>
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
