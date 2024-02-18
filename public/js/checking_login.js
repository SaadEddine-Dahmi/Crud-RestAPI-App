function validateAndSubmitLogin(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Reset error messages and success message
    document.getElementById("loginError").innerText = "";
    // document.getElementById("loginSuccessMessage").innerText = "";

    // Fetch input values
    var email = document.getElementsByName("loginmail")[0].value;
    var password = document.getElementsByName("loginpassword")[0].value;

    // If validation passes, send data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/login", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader(
        "X-CSRF-TOKEN",
        document.querySelector('meta[name="csrf-token"]').content
    );

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            try {
                if (xhr.status == 200) {
                    // Successful response
                    handleLoginSuccess();
                } else {
                    // Handle validation errors from the server
                    handleLoginErrors(xhr.responseText);
                }
            } catch (error) {
                console.error("Error processing the response:", error);
            }
        }
    };

    // Prepare data to send to the server
    var data =
        "loginmail=" +
        encodeURIComponent(email) +
        "&loginpassword=" +
        encodeURIComponent(password);

    // Send the data to the server
    xhr.send(data);
}

function showCustomAlert(message) {
    var customAlert = document.getElementById("customAlert");
    loginError.classList.add("hidden");
    customAlert.textContent = message;

    // Show the custom alert
    customAlert.style.display = "block";

    // Hide the alert after a delay (e.g., 2 seconds)
    setTimeout(function () {
        customAlert.style.display = "none";
    }, 1000);
}
function handleLoginSuccess() {
    // Display success message
    showCustomAlert("Login successful!");

    // Redirect to the dashboard or another page after a delay (e.g., 2 seconds)
    setTimeout(function () {
        window.location.href = "/"; // Replace with the desired redirect URL
    }, 1000);
}
function handleLoginErrors(responseText) {
    try {
        var response = JSON.parse(responseText);
        var loginError = document.getElementById("loginError");

        // Reset login error message
        document.getElementById("loginError").innerHTML = "";

        // Display login error message
        if (response.errors && typeof response.errors === "object") {
            var errorMessage = "";

            for (var key in response.errors) {
                if (response.errors.hasOwnProperty(key)) {
                    errorMessage += response.errors[key].join(", ") + "<br>";
                }
            }
            // if (
            //     errorMessage.includes("The loginmail field is required.") ||
            //     errorMessage.includes("The loginpassword field is required.")
            // ) {
            //     loginError.classList.remove("hidden");
            //     loginError.innerText =
            //         " Email and Password fields are required.";
            // }
            // if (errorMessage.includes("credentials do not match")) {
            //     loginError.classList.remove("hidden");
            //     loginError.innerText = "Incorrect email or password.";
            // }
            switch (true) {
                case errorMessage.includes("loginmail") &&
                    errorMessage.includes("loginpassword"):
                    loginError.classList.remove("hidden");
                    loginError.innerText =
                        "Email and Password fields are required.";
                    break;
                case errorMessage.includes("credentials do not match"):
                    loginError.classList.remove("hidden");
                    loginError.innerText = "Incorrect email or password.";
                    break;
                case errorMessage.includes("The loginmail field is required."):
                    loginError.classList.remove("hidden");
                    loginError.innerText = "Email field is required.";
                    break;
                case errorMessage.includes(
                    "The loginpassword field is required."
                ):
                    loginError.classList.remove("hidden");
                    loginError.innerText = "Password field is required.";
                    break;

                default:
                    loginError.classList.remove("hidden");
                    loginError.innerHTML = errorMessage;
                    if (!errorMessage) {
                        loginError.classList.add("hidden");
                    }
            }

            // loginError.innerHTML = errorMessage;
        } else if (response.message) {
            console.log(response.message);
            // Display other error messages from the server
            loginError.innerHTML = response.message;
        }
    } catch (error) {
        console.error("Error parsing JSON response:", error);
    }
}
