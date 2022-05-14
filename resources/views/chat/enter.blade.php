@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $chat->name }}
    </h2>
@endsection

@section('content')
    <div class="py-12" style="height: 60vh; overflow-y: scroll;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="messagesContainer" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($chat->messages as $message)
                    <div class="p-2 bg-white border-b border-gray-200">
                        {{ $message->content }}
                        <br>
                        <strong>{{ $message->author->name }}</strong>
                        <small>
                            <em>{{ $message->created_at }}</em>
                        </small>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{ Form::open([
                    'url' => route('chat.message.send', $chat) ,
                    'class' => 'p-2 bg-white border-b border-gray-200'
                ]) }}
                    {{ Form::text('content', null, [
                        'class' => 'bg-gray border-b border-gray-400 sm:rounded-lg'
                    ]); }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('body-bottom-scripts')
    <script>
        // UI Updates

        const messagesContainer = document.getElementById("messagesContainer")
        const alertBox = document.getElementById("alertBox")
        const alertContentBox = document.getElementById("alertContentBox")

        function unfade(element, delay = 10) {
            var op = 0.1;
            element.style.display = 'block';
            var timer = setInterval(function () {
                if (op >= 1){
                    clearInterval(timer);
                }
                element.style.opacity = op;
                element.style.filter = 'alpha(opacity=' + op * 100 + ")";
                op += op * 0.1;
            }, delay);
        }

        function fade(element, delay = 10) {
            var op = 1;
            var timer = setInterval(function () {
                if (op <= 0.1){
                    clearInterval(timer);
                    element.style.display = 'none';
                }
                element.style.opacity = op;
                element.style.filter = 'alpha(opacity=' + op * 100 + ")";
                op -= op * 0.1;
            }, 30);
        }

        function getMessageHTML(msg) {
            const element = document.createElement("div")
            element.setAttribute("class", "p-2 bg-white border-b border-gray-200")
            element.innerHTML = `${msg.message}<br><strong>${msg.author}</strong><small><em>${msg.created_at}</em></small>`
            return element
        }

        function displayMessage(msg) {
            const messageElement = getMessageHTML(msg)
            messagesContainer.prepend(messageElement)
        }

        function displayAlert(msgContent) {
            alertBox.style.opacity = 0
            alertBox.style.display = ''
            unfade(alertBox)
            alertContentBox.innerHTML = msgContent
            setTimeout(() => {
                fade(alertBox)
            }, 3000);
        }

        // Events

        Pusher.logToConsole = {{ config('app.debug') }};

        var pusher = new Pusher('d1bdabed3a3f56fe70ec', { cluster: 'eu' });
        var channel = pusher.subscribe('chat-{{ $chat->id }}');

        channel.bind('pusher:subscription_succeeded', (members) => {});

        channel.bind('<chatx></chatx>-message', (data) => displayMessage(data.message));

        channel.bind('chat-user-joined', (data) => displayAlert(`Dołączył ${data.message.user}!`));
    </script>
@endsection
