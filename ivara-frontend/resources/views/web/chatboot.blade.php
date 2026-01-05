<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChatBase Integration</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<!-- ====== Chatbase Embed for Client Users ====== -->
<script>
  window.chatbaseConfig = {
      chatbotId: "m2Jx7j2u4mchXTsApC2xr",
      placeholder: "Ask me about services, bookings, or support...",
      greeting: "Hi! I’m your virtual assistant. How can I help you today?",
      autoShow: true,
      autoShowDelay: 2000
  };
</script>
<script src="https://www.chatbase.co/embed.min.js" id="m2Jx7j2u4mchXTsApC2xr" defer></script>

<!-- ====== Save Messages to Laravel Backend ====== -->
<script>
  window.addEventListener('load', function() {
      if (window.Chatbase) {
          window.Chatbase.on('message', function(event) {
              // Save user message
              if(event.userMessage){
                  fetch("{{ route('chat.messages.store') }}", {
                      method: "POST",
                      headers: {
                          "Content-Type": "application/json",
                          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                      },
                      body: JSON.stringify({
                          message: event.userMessage,
                          sender: 'user'
                      })
                  });
              }

              // Save bot reply
              if(event.botMessage){
                  fetch("{{ route('chat.messages.store') }}", {
                      method: "POST",
                      headers: {
                          "Content-Type": "application/json",
                          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                      },
                      body: JSON.stringify({
                          message: event.botMessage,
                          sender: 'bot'
                      })
                  });
              }
          });
      }
  });
</script>

</body>
</html>
