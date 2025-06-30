// Simple Alert Notification System
function showAlert(message, type = "success") {
    const bgColor = type === "success" ? "#16a34a" : "#dc2626"; // green/red
    const alert = document.createElement("div");
    alert.textContent = message;
    alert.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 14px 20px;
        background-color: ${bgColor};
        color: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        z-index: 9999;
    `;
    document.body.appendChild(alert);
    setTimeout(() => {
        alert.remove();
    }, 3000);
}

document.addEventListener("DOMContentLoaded", () => {
    console.log("BookStore frontend ready.");

    // Example of how you might use showAlert:
    // showAlert("Welcome back!", "success");
    // showAlert("Login failed!", "error");

    // --- Login Form Handling (Example) ---
    // Assuming you have a form with ID 'loginForm' and elements for email/password
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", async (event) => {
            event.preventDefault(); // Prevent default form submission

            const email = document.getElementById("email").value; // Assuming ID 'email' for email input
            const password = document.getElementById("password").value; // Assuming ID 'password' for password input

            try {
                // Call the API to log in
                const result = await apiPost("/api/login", { email, password }); // Adjust API endpoint as needed

                if (result.access_token) {
                    localStorage.setItem("token", result.access_token);
                    const role = result.user?.role || "user";

                    showAlert("Login successful!", "success");

                    if (role === "admin") {
                        window.location.href = "/admin/dashboard";
                    } else {
                        window.location.href = "/";
                    }
                } else {
                    showAlert(
                        result.message ||
                            "Login failed. Please check your credentials.",
                        "error"
                    );
                }
            } catch (error) {
                console.error("Login error:", error);
                showAlert(
                    "An error occurred during login. Please try again.",
                    "error"
                );
            }
        });
    }
});

function getToken() {
    return localStorage.getItem("token");
}

async function apiGet(url) {
    const res = await fetch(url, {
        headers: {
            Authorization: "Bearer " + getToken(),
        },
    });
    // Check if the response is OK (status 200-299)
    if (!res.ok) {
        const errorData = await res.json();
        throw new Error(
            errorData.message || `HTTP error! status: ${res.status}`
        );
    }
    return await res.json();
}

async function apiPost(url, data) {
    const res = await fetch(url, {
        method: "POST",
        headers: {
            Authorization: "Bearer " + getToken(),
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    });
    // Check if the response is OK (status 200-299)
    if (!res.ok) {
        const errorData = await res.json();
        throw new Error(
            errorData.message || `HTTP error! status: ${res.status}`
        );
    }
    return await res.json();
}

document.addEventListener("DOMContentLoaded", () => {
    // Cek jika ada notifikasi success dari server
    const flashSuccess = document.querySelector("[data-flash-success]");
    if (flashSuccess) {
        showAlert(flashSuccess.dataset.flashSuccess, "success");
    }
});

function showAlert(message, type = "success") {
    const bgColor = type === "success" ? "#16a34a" : "#dc2626";
    const alert = document.createElement("div");
    alert.textContent = message;
    alert.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 14px 20px;
        background-color: ${bgColor};
        color: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        z-index: 9999;
    `;
    document.body.appendChild(alert);
    setTimeout(() => alert.remove(), 3000);
}

fetch("/cart", {
    method: "GET",
    headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
    },
});
