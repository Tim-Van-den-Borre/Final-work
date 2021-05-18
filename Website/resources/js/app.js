require("./bootstrap");

require("alpinejs");
console.log(window.location.href);

/* app.layout.blade */
if (window.location.href != "http://127.0.0.1:8000/") {
    if (document.getElementById("appMenuToggle")) {
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
}
/* users.blade.php */
if (window.location.href.includes("users")) {
    $("#usersLiveToast").toast("show");
}

/* appointments.blade.php */
if (window.location.href.includes("appointments")) {
    let length = 100;
    let length2 = 100;
    document.getElementById("appointmentMessageCount").innerHTML =
        "0 / " + length;
    document
        .getElementById("appointmentsReason")
        .addEventListener("keyup", function() {
            let textLength = document.getElementById("appointmentsReason").value
                .length;
            let textLengthOver = length - textLength;

            document.getElementById("appointmentMessageCount").innerHTML =
                textLength + " / " + length;
        });
    if (document.getElementById("medicalHistoryCount")) {
        document.getElementById("medicalHistoryCount").innerHTML =
            "0 / " + length2;
    }

    if (document.getElementById("appointmentsCondition")) {
        document
            .getElementById("appointmentsCondition")
            .addEventListener("keyup", function() {
                let textLength2 = document.getElementById(
                    "appointmentsCondition"
                ).value.length;
                let textLengthOver2 = length2 - textLength2;

                document.getElementById("medicalHistoryCount").innerHTML =
                    textLength2 + " / " + length2;
            });
    }

    $("#appointmentsLiveToast").toast("show");
}

/* welcome.blade.php */
if (window.location.href == "http://127.0.0.1:8000/") {
    $("#welcomeLiveToast").toast("show");

    /* chatbot */
    if (document.getElementById("chatbotButton")) {
        document
            .getElementById("chatbotButton")
            .addEventListener("click", openChat);
        let data;
        function openChat() {
            data = { patient: "", doctor: "", reason: "", date: "", time: "" };
            let main = document.getElementById("chatbotCard");

            if (main.style.display === "none") {
                main.style.display = "block";

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
                document.getElementsByClassName("ChatWindow").innerHTML = "";
                document.querySelector(".ChatWindow").innerHTML = "";
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
            let UserMessage = '<p id="chatbotUserMessage">' + input + " </p>";

            document.querySelector(".ChatWindow").innerHTML += UserMessage;
            document.getElementById("UserMessageInput").value = "";

            let Body = document.getElementById("chatbotCardBody");
            Body.scrollTop = Body.scrollHeight;
        }

        function showBotMessageOnChat(response) {
            let BotMessage = '<p id="chatbotBotMessage">' + response + " </p>";
            document.querySelector(".ChatWindow").innerHTML += BotMessage;

            let Body = document.getElementById("chatbotCardBody");
            Body.scrollTop = Body.scrollHeight;
        }

        function SendUserMessageToApi(message) {
            fetch("http://127.0.0.1:8000/api/chatbotGetUserId", {
                method: "get",
                headers: {
                    "Content-Type": "application/json; charset=utf-8"
                }
            })
                .then(response => response.json())
                .then(response => {
                    GetResponseFromChatbot(response, message);
                });
        }

        function GetResponseFromChatbot(userID, message) {
            fetch("http://127.0.0.1:5000/chat", {
                method: "post",
                headers: {
                    "Content-Type": "application/json; charset=utf-8"
                },
                body: JSON.stringify({
                    Message: message,
                    UserID: userID,
                    Data: data
                })
            })
                .then(response => response.json())
                .then(response => {
                    console.log(response);
                    showBotMessageOnChat(response.message);
                    data.patient = response.patient;
                    data.doctor = response.doctor;
                    data.reason = response.reason;
                    data.date = response.date;
                    data.time = response.time;
                });
        }
    }

    if (document.getElementById("welcomeSetCookieMessage")) {
        document.getElementById(
            "welcomeSetCookieMessage"
        ).onclick = function() {
            setMessageCookie(true);
            this.parentElement.parentElement.parentElement.style.display =
                "none";
        };
    }

    function setMessageCookie($check) {
        if ($check != false) {
            document.cookie = "laravel_session_message = Accepted by user;";
        }
    }
}
