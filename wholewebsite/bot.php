<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="CBstyle.css">
</head>
<body>
    <div id="chat-container">
        <button id="chat-btn"><i class="fas fa-comments"></i></button>
        <div id="chat-box">
            <div id="chat-header">
                Chatbot
                <button id="close-chat">&times;</button>
            </div>
            <div id="chat-content">
                <div class="bot-message">Hello there, how can I help you?</div>
            </div>
            <div id="chat-input-area">
                <input id="chat-input" type="text" placeholder="Type a message..." required>
                <button id="send-btn"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#chat-btn").click(function(){
                $("#chat-box").fadeIn();
            });

            $("#close-chat").click(function(){
                $("#chat-box").fadeOut();
            });

            $("#send-btn").on("click", function(){
                let value = $("#chat-input").val().trim();
                if (value === '') return;
                let userMsg = '<div class="user-message">' + value + '</div>';
                $("#chat-content").append(userMsg);
                $("#chat-input").val('');
                $("#chat-content").scrollTop($("#chat-content")[0].scrollHeight);
                
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: { text: value },
                    success: function(result){
                        let botReply = '<div class="bot-message">' + result + '</div>';
                        $("#chat-content").append(botReply);
                        $("#chat-content").scrollTop($("#chat-content")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
</body>
</html>