$(document).ready(function () {
	$("#form-proposal").on("submit", function (e) {
		e.preventDefault();

		let form = document.getElementById("form-proposal");
		let formData = new FormData(form);

		// ✅ Ensure CSRF token is included
		let csrfInput = $('#form-proposal input[type="hidden"]');
		formData.set(csrfInput.attr("name"), csrfInput.val());

		let btn = $(this).find('button[type="submit"]');
		btn.prop("disabled", true).text("Saving...");

		$.ajax({
			url: form.action,
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			cache: false,

			success: function (response) {
				console.log("Raw response:", response);
				btn.prop("disabled", false).text("Save changes");

				let res;
				try {
					res = JSON.parse(response);
				} catch (e) {
					console.error("Invalid JSON:", response);
					alert("Invalid server response");
					return;
				}

				console.log("Parsed response:", res);

				if (res.status === "success") {
					$.toast({
						heading: "Success",
						text: res.message,
						icon: "success",
						position: "bottom-center",
					});

					// ✅ Redirect
					if (res.redirect) {
						setTimeout(() => {
							window.location.href = res.redirect;
						}, 1000);
					}
				} else {
					$.toast({
						heading: "Error",
						text: res.message,
						icon: "error",
						position: "bottom-center",
					});
				}

				// ✅ Update CSRF token after every request
				if (res.csrfName && res.csrfHash) {
					$('input[name="' + res.csrfName + '"]').val(res.csrfHash);
				}
			},

			error: function (xhr) {
				btn.prop("disabled", false).text("Save changes");

				console.error(xhr.responseText);

				$.toast({
					heading: "Error",
					text: "Server error occurred",
					icon: "error",
					position: "bottom-center",
				});
			},
		});
	});
});
