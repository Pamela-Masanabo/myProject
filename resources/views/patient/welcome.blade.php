<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Clinic System</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>
    <div class="watermark">

        <span>Welcome</span>

        <span>Wamkelekile</span>

        <span>Siyakwamukela</span>

        <span>Hi mi amukela</span>

        <span>Le amogetswe</span>

        <span>Ri amukela</span>

        <span>Re a go amogela</span>

        <span>Mi amukeriwile</span>

        <span>Welkom</span>
        
        <span>Nemukelekile</span>
        <span>Mi amukeriwile</span>
        <span>Ri a ni tanganedza</span>

    </div>

    <div class="container">

        <div class="card">

            <h1>🏥 Public Clinic System</h1>

            <p>

                Your health, our priority.

            </p>

            <a href="{{ route('patient.login') }}"

                class="btn">

                Login With ID Number

            </a>

            <p>

                Are you new here?

            </p>

            <a href="{{ route('patient.register') }}"

                class="btn secondary">

                Register

            </a>

            <div class="staff-section">

                <a href="/login"

                    class="staff-btn">

                    Staff

                </a>

            </div>

        </div>

    </div>

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