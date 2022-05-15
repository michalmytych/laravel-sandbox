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
                <form
                        autocomplete="off"
                        id="chat-message-form"
                        class="p-2 bg-white border-b border-gray-200"
                >
                    @csrf
                    <label for="content"></label>
                    <input
                            required
                            id="content"
                            name="content"
                            type="text"
                            placeholder="Napisz wiadomość..."
                            class="border-b border-gray-400 sm:rounded-lg w-full bg-slate-400"
                    />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('body-bottom-scripts')
    <script>
        // Sending form code - can be reused
        document
            .querySelector('#chat-message-form')
            .addEventListener('submit', (e) => {
                e.preventDefault();

                fetch("{{ route('chat.message.send', $chat) }}", {
                    method: 'POST',
                    body: new FormData(e.target)
                });

                e.target.reset()
            });
    </script>
    <script>
        // UI Updates

        const messagesContainer = document.getElementById("messagesContainer")
        const alertBox = document.getElementById("alertBox")
        const alertContentBox = document.getElementById("alertContentBox")

        function unfade(element, delay = 10) {
            let op = 0.1;
            element.style.display = 'block';
            const timer = setInterval(function () {
                if (op >= 1) {
                    clearInterval(timer);
                }
                element.style.opacity = op;
                element.style.filter = 'alpha(opacity=' + op * 100 + ")";
                op += op * 0.1;
            }, delay);
        }

        function fade(element, delay = 10) {
            let op = 1;
            let timer = setInterval(function () {
                if (op <= 0.1) {
                    clearInterval(timer);
                    element.style.display = 'none';
                }
                element.style.opacity = op;
                element.style.filter = 'alpha(opacity=' + op * 100 + ")";
                op -= op * 0.1;
            }, delay);
        }

        function getMessageHTML(msg) {
            const element = document.createElement("div")
            element.setAttribute("class", "p-2 bg-white border-b border-gray-200")
            element.innerHTML = `${msg.message}<br><strong>${msg.author}</strong><small><em>${msg.created_at}</em></small>`
            return element
        }

        function displayMessage(msg) {
            console.log(msg)
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

        let pusher = new Pusher('d1bdabed3a3f56fe70ec', {cluster: 'eu'});
        let channel = pusher.subscribe('chat-{{ $chat->id }}');

        channel.bind('pusher:subscription_succeeded', (members) => {
        });

        channel.bind('chat-message', (data) => displayMessage(data.message));

        channel.bind('chat-user-joined', (data) => displayAlert(`Dołączył ${data.message.user}!`));
    </script>
@endsection
