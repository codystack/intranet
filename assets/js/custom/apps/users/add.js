"use strict";

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#kt_modal_add_user_form");
    const submitBtn = document.querySelector("#kt_modal_add_user_submit");

    if (!form || !submitBtn) {
        console.error("Form or submit button not found.");
        return;
    }

    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();

        // Show loading indicator
        submitBtn.setAttribute("data-kt-indicator", "on");
        submitBtn.disabled = true;

        const formData = new FormData(form);

        fetch("/intranet/auth/add_new_user.php", {
            method: "POST",
            body: formData
        })
        .then(async (res) => {
            const contentType = res.headers.get("content-type");

            if (!res.ok) {
                throw new Error(`Server responded with ${res.status}: ${res.statusText}`);
            }

            if (contentType && contentType.includes("application/json")) {
                return res.json();
            } else {
                const text = await res.text();
                throw new Error("Expected JSON, got:\n" + text.substring(0, 200));
            }
        })
        .then((data) => {
            if (data.success) {
                Swal.fire({
                    title: "Success 🎉",
                    text: data.message,
                    icon: "success",
                    confirmButtonText: "Ok, got it!",
                    buttonsStyling: false,
                    customClass: { confirmButton: "btn btn-primary" }
                }).then(() => {
                    form.reset();
                    const modalEl = document.querySelector("#kt_modal_add_user");
                    if (modalEl) {
                        bootstrap.Modal.getInstance(modalEl)?.hide();
                    }
                });
            } else {
                Swal.fire({
                    title: "Error ⚠️",
                    text: data.message || "An error occurred.",
                    icon: "error",
                    confirmButtonText: "Ok, got it!",
                    buttonsStyling: false,
                    customClass: { confirmButton: "btn btn-primary" }
                });
            }
        })
        .catch((err) => {
            console.error("Form submit error:", err);
            Swal.fire({
                title: "Request Failed 🚨",
                text: err.message,
                icon: "error",
                confirmButtonText: "Ok, got it!",
                buttonsStyling: false,
                customClass: { confirmButton: "btn btn-primary" }
            });
        })
        .finally(() => {
            submitBtn.removeAttribute("data-kt-indicator");
            submitBtn.disabled = false;
        });
    });
});
