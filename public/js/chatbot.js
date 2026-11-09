
document.addEventListener('DOMContentLoaded', function () {

    const toggle = document.getElementById('chatbot-toggle');
    const close = document.getElementById('chatbot-close');
    const chatWindow = document.getElementById('chatbot-window');
    const form = document.getElementById('chatbot-form');
    const input = document.getElementById('chatbot-input');
    const messages = document.getElementById('chatbot-messages');

    // OPEN CHATBOT
    toggle.addEventListener('click', function () {
        chatWindow.classList.toggle('show');

        if (chatWindow.classList.contains('show')) {
            input.focus();
        }
    });

    // CLOSE CHATBOT
    close.addEventListener('click', function () {
        chatWindow.classList.remove('show');
    });

    // DISPLAY MESSAGES
    function addMessage(message, sender) {

        const messageDiv = document.createElement('div');

        messageDiv.className = sender + '-message';
        messageDiv.textContent = message;

        messages.appendChild(messageDiv);

        messages.scrollTop = messages.scrollHeight;

        return messageDiv;
    }

    // SEND MESSAGE TO LARAVEL
    async function sendMessage(message) {

        if (!message.trim()) {
            return;
        }

        addMessage(message, 'user');

        input.disabled = true;

        const sendButton = form.querySelector('button');
        sendButton.disabled = true;

        const typingMessage = addMessage(
            'Assistant is typing...',
            'bot'
        );

        typingMessage.classList.add('typing');

        try {

            const response = await fetch('/chatbot', {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector(
                        'meta[name="csrf-token"]'
                    ).getAttribute('content')
                },

                body: JSON.stringify({
                    message: message
                })

            });

            const data = await response.json();

            typingMessage.remove();

            if (!response.ok) {
                throw new Error(data.message || 'Request failed.');
            }

            addMessage(
                data.reply || 'Sorry, I could not process your question.',
                'bot'
            );

        } catch (error) {

            typingMessage.remove();

            addMessage(
                'Sorry, something went wrong. Please try again.',
                'bot'
            );

            console.error('Chatbot error:', error);

        } finally {

            input.disabled = false;
            sendButton.disabled = false;
            input.focus();

            messages.scrollTop = messages.scrollHeight;
        }
    }

    // MESSAGE INPUT
    form.addEventListener('submit', function (event) {

        event.preventDefault();

        const message = input.value.trim();

        if (!message) {
            return;
        }

        input.value = '';

        sendMessage(message);
    });

    // QUICK QUESTION BUTTONS
    window.quickAsk = function (question) {

        sendMessage(question);

    };

});
