require("./bootstrap");

require("alpinejs");
console.log(window.location.href);
/* app.layout.blade */
if (window.location.href != "http://127.0.0.1:8000/") {
    document
        .getElementById("appMenuToggle")
        .addEventListener("click", function(e) {
            e.preventDefault();
            let appWrapper = document.getElementById("appWrapper");
            if (appWrapper.classList.contains("toggled")) {
                appWrapper.classList.remove("toggled");
            } else {
                appWrapper.classList.add("toggled");
            }
        });
}

/* appointments.blade.php */
if (window.location.href.includes("appointments")) {
    let length = 100;
    let length2 = 100;
    console.log("it works 1");
    document.getElementById("appointmentMessageCount").innerHTML =
        "0 / " + length;
    console.log("it works2");
    document
        .getElementById("appointmentsReason")
        .addEventListener("keyup", function() {
            let textLength = document.getElementById("appointmentsReason").value
                .length;
            let textLengthOver = length - textLength;

            document.getElementById("appointmentMessageCount").innerHTML =
                textLength + " / " + length;
        });
    console.log("it works 3");
    $("#appointmentsLiveToast").toast("show");
    document.getElementById("medicalHistoryCount").innerHTML = "0 / " + length2;
    console.log("it works 4");
    document
        .getElementById("appointmentsCondition")
        .addEventListener("keyup", function() {
            let textLength2 = document.getElementById("appointmentsCondition")
                .value.length;
            let textLengthOver2 = length2 - textLength2;

            document.getElementById("medicalHistoryCount").innerHTML =
                textLength2 + " / " + length2;
        });
    console.log("it works 5");
}

/* welcome.blade.php */
if (window.location.href == "http://127.0.0.1:8000/") {
    /* chatbot */
    document
        .getElementById("chatbotButton")
        .addEventListener("click", openChat);

    function openChat() {
        let main = document.getElementById("chatbotCard");

        if (main.style.display === "none") {
            main.style.display = "block";

            let button = document.getElementById("chatbotButton");
            button.innerText = "Close chat";

            fetch("http://127.0.0.1:5000/firstmessage", {
                method: "get",
                headers: {
                    "Content-Type": "application/json; charset=utf-8"
                }
            })
                .then(response => response.json())
                .then(response => {
                    showBotMessageOnChat(response);
                });
        } else {
            main.style.display = "none";
            document.getElementById("chatbotCardBody").innerHTML = "";
            //document.querySelector(".card-body").innerHTML = "";

            let button = document.getElementById("chatbotButton");
            button.innerText = "Chat with us";
        }
    }

    document
        .getElementById("UserMessageInput")
        .addEventListener("keyup", function(e) {
            let input = document.getElementById("UserMessageInput").value;
            if (e.key === "Enter") {
                if (input.trim() == "") {
                    e.preventDefault();
                } else {
                    showUserMessageOnChat(input);
                    SendUserMessageToApi(input);
                    e.preventDefault();
                }
            }
        });

    function showUserMessageOnChat(input) {
        let UserMessage =
            '<div class="ChatWindow"><p id="chatbotUserMessage">' +
            input +
            " </p></div>";

        document.querySelector(".card-body").innerHTML += UserMessage;
        document.getElementById("UserMessageInput").value = "";

        let Body = document.getElementById("chatbotCardBody");
        Body.scrollTop = Body.scrollHeight;
    }

    function showBotMessageOnChat(response) {
        let BotMessage =
            '<div class="ChatWindow"><p id="chatbotBotMessage">' +
            response +
            " </p></div>";
        document.querySelector(".card-body").innerHTML += BotMessage;

        let Body = document.getElementById("chatbotCardBody");
        Body.scrollTop = Body.scrollHeight;
    }

    function SendUserMessageToApi(message) {
        fetch("http://127.0.0.1:5000/chat", {
            method: "post",
            headers: {
                "Content-Type": "application/json; charset=utf-8"
            },
            body: JSON.stringify({
                Message: message
            })
        })
            .then(response => response.json())
            .then(response => {
                showBotMessageOnChat(response);
            });
    }

    document.getElementById("welcomeSetCookieMessage").onclick = function() {
        setMessageCookie(true);
        this.parentElement.parentElement.parentElement.style.display = "none";
    };

    function setMessageCookie($check) {
        if ($check != false) {
            document.cookie = "laravel_session_message = Accepted by user;";
        }
    }
}
