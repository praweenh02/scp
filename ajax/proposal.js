$(document).ready(function () {

    $("#form-proposal").on("submit", function (e) {

        e.preventDefault();

        let source = $('input[name="file_source"]:checked').val();

        // =========================
        // FILE VALIDATION
        // =========================
        if (source === 'upload') {

            let filesSelected = false;

            $('#file-wrapper input[type="file"]').each(function () {

                if (this.files && this.files.length > 0) {
                    filesSelected = true;
                }
            });

            if (!filesSelected) {

                alert('Please upload at least one document.');

                return;
            }
        }

        // =========================
        // URL VALIDATION
        // =========================
        else if (source === 'url') {

            let validUrlFound = false;
            let invalidUrlFound = false;

            $('input[name="file_urls[]"]').each(function () {

                let fileUrl = $.trim($(this).val());

                // Skip empty rows
                if (fileUrl === '') {
                    return true;
                }

                let validUrl = /^(https?:\/\/).+/i.test(fileUrl);

                if (validUrl) {

                    validUrlFound = true;

                } else {

                    invalidUrlFound = true;
                }
            });

            // No valid URLs entered
            if (!validUrlFound) {

                alert('Please enter at least one valid document URL.');

                return;
            }

            // Invalid URL exists
            if (invalidUrlFound) {

                alert('Please enter valid URLs starting with http:// or https://');

                return;
            }
        }

        // =========================
        // FORM DATA
        // =========================
        let form = document.getElementById("form-proposal");

        let formData = new FormData(form);

        // =========================
        // CSRF TOKEN
        // =========================
        let csrfInput = $('#form-proposal input[type="hidden"]').first();

        formData.set(
            csrfInput.attr("name"),
            csrfInput.val()
        );

        // =========================
        // SUBMIT BUTTON
        // =========================
        let btn = $(this).find('button[type="submit"]');

        btn.prop("disabled", true)
           .text("Saving...");

        // =========================
        // AJAX
        // =========================
        $.ajax({

            url: form.action,

            type: "POST",

            data: formData,

            processData: false,

            contentType: false,

            cache: false,

            success: function (response) {

                console.log("Raw response:", response);

                btn.prop("disabled", false)
                   .text("Save changes");

                let res;

                try {

                    res = JSON.parse(response);

                } catch (e) {

                    console.error("Invalid JSON:", response);

                    alert("Invalid server response");

                    return;
                }

                console.log("Parsed response:", res);

                // =========================
                // SUCCESS
                // =========================
                if (res.status === "success") {

                    $.toast({
                        heading: "Success",
                        text: res.message,
                        icon: "success",
                        position: "bottom-center",
                    });

                    // Redirect
                    if (res.redirect) {

                        setTimeout(function () {

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

                // =========================
                // UPDATE CSRF TOKEN
                // =========================
                if (res.csrfName && res.csrfHash) {

                    $('input[name="' + res.csrfName + '"]')
                        .val(res.csrfHash);
                }
            },

            // =========================
            // ERROR
            // =========================
            error: function (xhr) {

                btn.prop("disabled", false)
                   .text("Save changes");

                console.error(xhr.responseText);

                $.toast({
                    heading: "Error",
                    text: "Server error occurred",
                    icon: "error",
                    position: "bottom-center",
                });
            }
        });
    });
});
//Save Comments
$(document).ready(function () {
	$("#form-comments").on("submit", function (e) {
		e.preventDefault();
		let form = document.getElementById("form-comments");
		let formData = new FormData(form);
		// ✅ Ensure CSRF token is included
		let csrfInput = $('#form-comments input[type="hidden"]');
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
				if (res.status === true) {
					$.toast({
						heading: "Success",
						text: res.message,
						icon: "success",
						position: "bottom-center",
					});
					//Hide Popup
					$('#form-comments')[0].reset();
					$('#addComments').modal('hide');
					$('#loadallData').load(location.href + ' #loadallData > *');

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
			}
		});
	});
});
//Delete Comment
function deleteComment(comment_id, btn) {

	if (!confirm("Are you sure you want to delete this comment?")) {
		return;
	}

	let csrfInput = document.querySelector('.csrf-token');
	let csrfName = csrfInput.name;
	let csrfHash = csrfInput.value;

	let formData = new FormData();
	formData.append('comment_id', comment_id);
	formData.append(csrfName, csrfHash);

	fetch(SITEROOT + 'super-admin/proposal/deleteProposalComment', {
		method: 'POST',
		body: formData
	})
		.then(response => response.json())
		.then(response => {

			// ✅ update CSRF token
			if (response.csrfName && response.csrfHash) {
				csrfInput.name = response.csrfName;
				csrfInput.value = response.csrfHash;
			}

			if (response.status) {

				alert(response.message);

				// ✅ remove row (no jQuery)
				let row = btn.closest('tr');
				if (row) row.remove();

			} else {
				alert(response.message);
			}

		})
		.catch(error => {
			console.error(error);
			alert("Server error");
		});
}