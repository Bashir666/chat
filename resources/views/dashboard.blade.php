<x-app-layout>
    <div id="frame">
        @include('layouts.sidebar')
        <div class="content">
            <div class="blank-wrap">
                <div class="inner-blank-wrap">Select a contact to start a conversation</div>
            </div>
            <div class="loader d-none">
                <div class="loader-inner">
                    <l-waveform size="35" stroke="3.5" speed="1" color="#27ae60"></l-waveform>
                </div>
            </div>
            <div class="contact-profile">
                <img src="{{ asset('default-images/avatar.png') }}" alt="" />
                <p class="contact-name"></p>
                <div class="social-media">

                </div>
            </div>

            <div class="messages">
                <ul>
                    {{-- Dynamic content will go here --}}
                </ul>
            </div>
            <div class="message-input">
                <form action="" method="POST" class="message-form">
                    @csrf
                    <div class="wrap">
                        <input autocomplete="off" type="text" placeholder="Write your message..." name="message"
                            class="message-box" />
                        <button type="submit" class="submit"><i class="fa fa-paper-plane"
                                aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        @vite(['resources/js/app.js', 'resources/js/message.js'])
    </x-slot>
</x-app-layout>
