document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault();
    
    // Simulate login functionality
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Check if login credentials are valid
    if (username === "your_username" && password === "your_password") {
        // Redirect to the main page after successful login
        window.location.href = "main.html";
    } else {
        alert("Invalid username or password. Please try again.");
    }
});
