"use strict";

var KTModalUpdateUser = (function () {
    var modalEl, modal, form, submitBtn, cancelBtn, closeBtn;

    return {
        init: function () {
            modalEl = document.querySelector("#kt_modal_update_user");
            modal = new bootstrap.Modal(modalEl);
            form = modalEl.querySelector("#kt_modal_update_user_form");
            submitBtn = form.querySelector("#kt_modal_update_user_submit");
            cancelBtn = form.querySelector("#kt_modal_update_user_cancel");
            closeBtn = form.querySelector("#kt_modal_update_user_close");

            // --- Handle submit ---
            submitBtn.addEventListener("click", function (e) {
                e.preventDefault();

                // Show loading
                submitBtn.setAttribute("data-kt-indicator", "on");
                submitBtn.disabled = true;

                // Collect form data
                let formData = new FormData(form);

                // Send via fetch to update_user.php
                fetch("api/update_user.php", {
                    method: "POST",
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    submitBtn.removeAttribute("data-kt-indicator");
                    submitBtn.disabled = false;

                    if (data.success) {
                        Swal.fire({
                            text: data.message || "User updated successfully!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" },
                        }).then(() => {
                            modal.hide();
                            form.reset();
                            // OPTIONAL: refresh table or reload page
                            if (typeof reloadUserTable === "function") {
                                reloadUserTable();
                            }
                        });
                    } else {
                        Swal.fire({
                            text: data.message || "Failed to update user.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" },
                        });
                    }
                })
                .catch((error) => {
                    submitBtn.removeAttribute("data-kt-indicator");
                    submitBtn.disabled = false;

                    Swal.fire({
                        text: "Request failed. Please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" },
                    });
                    console.error("Update user error:", error);
                });
            });

            // --- Handle cancel ---
            cancelBtn.addEventListener("click", function (e) {
                e.preventDefault();
                Swal.fire({
                    text: "Are you sure you want to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light",
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.reset();
                        modal.hide();
                    }
                });
            });

            // --- Handle close ---
            closeBtn.addEventListener("click", function (e) {
                e.preventDefault();
                cancelBtn.click();
            });
        },
    };
})();

// Init
KTUtil.onDOMContentLoaded(function () {
    KTModalUpdateUser.init();
});