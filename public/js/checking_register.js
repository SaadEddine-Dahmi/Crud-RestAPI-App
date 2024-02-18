function validateAndSubmit(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Fetch input values
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var nameRegex = /^[a-zA-Z\s'-]+$/; // Regex for allowing letters, spaces, single quotes, and hyphens

    if (!name.trim()) {
        document.getElementById("nameError").classList.remove("hidden");
        document.getElementById("nameError").innerText = "Name is required";
    } else if (!nameRegex.test(name)) {
        document.getElementById("nameError").classList.remove("hidden");
        document.getElementById("nameError").innerText =
            "Name Invalid, try another Name";
        return;
    } else {
        document.getElementById("nameError").classList.add("hidden");
    }

    // Check that the email value isn't empty and match the email regex pattern
    if (!email.trim()) {
        document.getElementById("emailError").classList.remove("hidden");
        document.getElementById("emailError").innerText = "Email is required";
    } else {
        document.getElementById("emailError").classList.add("hidden");
    }

    // Check that the Password value isn't empty
    if (!password.trim()) {
        document.getElementById("passwordError").classList.remove("hidden");
        document.getElementById("passwordError").innerText =
            "Password is required";
    } else {
        document.getElementById("passwordError").classList.add("hidden");
    }

    // Reset error messages
    document.getElementById("nameError").innerText = "";
    document.getElementById("emailError").innerText = "";
    document.getElementById("passwordError").innerText = "";

    // If validation passes, send data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/register", true);
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
                    var response = JSON.parse(xhr.responseText);
                    // console.log(response);

                    // Check if the message is "Registration successful"
                    if (response.message === "Registration successful") {
                        document
                            .getElementById("successMessage")
                            .classList.remove("hidden");
                        document.getElementById("successMessage").innerText =
                            "Registration successful!";

                        // Redirect to the login page after a delay (e.g., 1 second)
                        setTimeout(function () {
                            window.location.href = "/login";
                        }, 1000);
                    } else {
                        // Handle other scenarios as needed
                        console.log("Handle other scenarios");
                    }
                } else {
                    // Handle validation errors from the server
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);
                    handleServerValidationErrors(response);
                }
            } catch (error) {
                console.error("Error parsing JSON response:", error);
            }
        }
    };

    // Prepare data to send to the server
    var data =
        "name=" +
        encodeURIComponent(name) +
        "&email=" +
        encodeURIComponent(email) +
        "&password=" +
        encodeURIComponent(password);

    // Send the data to the server
    xhr.send(data);
}

function handleServerValidationErrors(response) {
    // Reset all error messages first
    document.getElementById("nameError").innerText = "";
    document.getElementById("emailError").innerText = "";
    document.getElementById("passwordError").innerText = "";

    // Check if 'errors' object is present in the response
    if (response.errors && typeof response.errors === "object") {
        // Collect all error messages
        var nameError = response.errors.name
            ? response.errors.name.join(", ")
            : "";
        var emailError = response.errors.email
            ? response.errors.email.join(", ")
            : "";
        var passwordError = response.errors.password
            ? response.errors.password.join(", ")
            : "";

        // Display all error messages
        if (nameError) {
            document.getElementById("nameError").classList.remove("hidden");
            document.getElementById("nameError").innerText = nameError;
        } else {
            document.getElementById("nameError").classList.add("hidden");
        }
        if (emailError) {
            document.getElementById("emailError").classList.remove("hidden");
            document.getElementById("emailError").innerText = emailError;
        } else {
            document.getElementById("emailError").classList.add("hidden");
        }
        if (passwordError) {
            document.getElementById("passwordError").classList.remove("hidden");
            document.getElementById("passwordError").innerText = passwordError;
        } else {
            document.getElementById("passwordError").classList.add("hidden");
        }

        if (passwordError.includes("The password field format is invalid.")) {
            document.getElementById("passwordError").classList.remove("hidden");
            document.getElementById("passwordError").innerHTML =
                "*The password field must be at least 8 characters <br> *Should contains at least one lowercase letter. <br> *Should contains at least one uppercase letter. <br> *Should contains at least one Number. <br> *Should contains at least one special character. ";
        }
    }
}
