<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/patient-dashboard.css') }}   ">
</head>
<body>
<div class="container">

    <!-- HEADER -->

    <div class="header">

        <h2>

            Welcome,

            {{ $patient->first_name }}

        </h2>

        <p>

            Public Clinic System

        </p>

    </div>
@if(session('error'))

<div class="error">

    {{ session('error') }}

</div>

@endif


@if(session('success'))

<div class="success">

    {{ session('success') }}

</div>

@endif
    <!-- STATUS CARD -->

    <div class="status-card">

        <h3>

            Today's Status

        </h3>

        @if($latestVisit)

            <p>

                Status:

                {{ $latestVisit->status }}

            </p>

            <p>

                Queue Number:

                {{ $latestVisit->queue_number ?? 'Not Assigned Yet' }}

            </p>

        @else

            <p>

                No active visit today.

            </p>

        @endif

    </div>

    <!-- ACTIONS -->

    <div class="actions">

        <a href="{{ route('visit.create') }}"

           class="btn">

           Start Visit

        </a>

        <a href="#" class="btn">
           View History

        </a>

    </div>

</div>

<form id="logoutForm" 

      action="{{ route('patient.logout') }}" 

      method="POST" 

      style="display: none;">

    @csrf

</form>

@if(session('success'))

<script>

    setTimeout(function () {
     
    document.getElementById('logoutForm').submit();
    }, 3000); // 3000 milliseconds = 3 seconds  

</script>

@endif

<!-- CHATBOT -->

<!-- DPCMS CHATBOT -->

<div class="chatbot-container">

    <!-- FLOATING BUTTON -->
    <button type="button" id="chatbot-toggle" class="chatbot-toggle">
        💬 Chat with us
    </button>

    <!-- CHAT WINDOW -->
    <div id="chatbot-window" class="chatbot-window">

        <!-- HEADER -->
        <div class="chatbot-header">
            <div>
                <h3>DPCMS Assistant 🤖</h3>
                <small>Virtual Clinic Help Desk</small>
            </div>

            <button type="button" id="chatbot-close">&times;</button>
        </div>

        <!-- MESSAGES -->
        <div id="chatbot-messages" class="chatbot-messages">

            <div class="bot-message">
                Hello! 👋 Welcome to DPCMS.
                I am your virtual clinic assistant.
                How can I help you today?
            </div>

        </div>

        <!-- QUICK QUESTIONS -->
        <div class="quick-questions">

            <button type="button" onclick="quickAsk('How do I register?')">
                Registration
            </button>

            <button type="button" onclick="quickAsk('How do I start a visit?')">
                Start Visit
            </button>

            <button type="button" onclick="quickAsk('Where is my queue number?')">
                Queue Number
            </button>

            <button type="button" onclick="quickAsk('What services do you offer?')">
                Clinic Services
            </button>

            <button type="button" onclick="quickAsk('What are your operating hours?')">
                Clinic Hours
            </button>

        </div>

        <!-- INPUT -->
        <form id="chatbot-form" class="chatbot-form">

            <input
                type="text"
                id="chatbot-input"
                placeholder="Type your question..."
                autocomplete="off"
                required
            >

            <button type="submit">Send</button>

        </form>

        <div class="chatbot-footer">
            DPCMS Virtual Assistant
        </div>

    </div>

</div>

<script src="{{ asset('js/chatbot.js') }}" defer></script>

</body>

</html>