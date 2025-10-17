document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector("#kt_sign_in_form");
    const submitButton = document.querySelector("#kt_sign_in_submit");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        // Show loading spinner
        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.disabled = true;

        fetch("auth/login.php", {
            method: "POST",
            body: formData
        })
        .then(res => {
            if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
            return res.json();
        })
        .then(data => {
            submitButton.removeAttribute("data-kt-indicator");
            submitButton.disabled = false;

            Swal.fire({
                text: data.message,
                icon: data.success ? "success" : "error",
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            }).then(() => {
                if (data.success) {
                    // Use redirect field from PHP response or default to 'dashboard'
                    const redirectUrl = data.redirect || form.dataset.ktRedirectUrl || "dashboard";
                    window.location.href = redirectUrl;
                }
            });
        })
        .catch(error => {
            console.error("Login error:", error);
            submitButton.removeAttribute("data-kt-indicator");
            submitButton.disabled = false;

            Swal.fire({
                text: "A network error occurred. Please try again.",
                icon: "error",
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        });
    });
});
