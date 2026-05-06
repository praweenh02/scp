<div class="page-heading">
	<h3>Add Proposal</h3>
	<hr>
</div>

<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			<section class="panel">

				<header class="panel-heading">
					Add Proposal
					<span class="mb-5 pull-right" style="margin-top: -6px;">
						<a onclick="window.history.back();" class="btn btn-danger btn-sm">
							<i class="fa fa-arrow-left"></i> Back
						</a>
					</span>
				</header>

				<div class="panel-body">
					<form class="form-horizontal adminex-form" id="form-proposal" method="post"
						enctype="multipart/form-data" action="<?= base_url('super-admin/proposal/save_data') ?>">



						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
							value="<?= $this->security->get_csrf_hash(); ?>">

						<input type="hidden" name="proposal_id" value="<?= $result->id ?? 0; ?>">

						<div class="col-md-12">

							<div class="form-group row">
								<label class="control-label col-lg-3"> Name of the document</label>
								<div class="col-lg-9">
									<input type="text" name="title" class="form-control"
										value="<?= $result->title ?? ''; ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-lg-3">Description of document *</label>
								<div class="col-lg-9">
									<textarea name="description" class="form-control"
										required><?= $result->description ?? ''; ?></textarea>
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-lg-3">Upload Files</label>

								<div class="col-lg-9">

									<div id="file-wrapper" class="file-upload-box">
										<!-- File rows will come here -->
									</div>

									<button type="button" id="add-file" class="btn btn-primary btn-sm mt-2">
										<i class="fa fa-plus"></i> Add File
									</button>

									<small class="text-muted d-block mt-2">
										Allowed: PDF, DOC, DOCX (Max 5MB each)
									</small>

								</div>
							</div>

							<div class="page-heading row">
								<h5>Details of Proposer</h5>
								<hr>
							</div>

						</div>
						<div class="form-group row">
							<label class="control-label col-lg-3">Propser's name *</label>
							<div class="col-lg-9">
								<input type="text" name="name" class="form-control" value="<?= $result->name ?? ''; ?>"
									required>
							</div>
						</div>

						<div class="form-group row">
							<label class="control-label col-lg-3">Propser's email *</label>
							<div class="col-lg-9">
								<input type="email" name="email" class="form-control"
									value="<?= $result->email ?? ''; ?>" required>
							</div>
						</div>

						<div class="form-group row">
							<label class="control-label col-lg-3">Designation *</label>
							<div class="col-lg-9">
								<input type="text" name="designation" class="form-control"
									value="<?= $result->designation ?? ''; ?>" required>
							</div>
						</div>

						<div class="form-group row">
							<label class="control-label col-lg-3">Organisation *</label>
							<div class="col-lg-9">
								<input type="text" name="organisation" class="form-control"
									value="<?= $result->organisation ?? ''; ?>" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="pull-right">
								<button class="btn btn-danger btn-sm" onclick="window.history.back();" type="button">
									<i class="fa fa-arrow-left"></i> Back
								</button>

								<button class="btn btn-success btn-sm" type="submit">
									Save changes
								</button>
							</div>
						</div>

				</div>

				</form>
		</div>

		</section>
	</div>
</div>
</div>
<script>
	$(document).ready(function() {

		// Add file row
		$("#add-file").click(function() {
			let html = `
        <div class="file-row">
            <input type="file" name="files[]" class="form-control">
            <span class="file-name"></span>
            <button type="button" class="btn btn-danger btn-sm remove-file">
                <i class="fa fa-times"></i>
            </button>
        </div>`;
			$("#file-wrapper").append(html);
		});

		// Remove file row
		$(document).on("click", ".remove-file", function() {
			$(this).closest(".file-row").remove();
		});

		// Show file name + validation
		$(document).on("change", "input[type=file]", function() {

			let file = this.files[0];

			if (file) {
				let size = file.size / 1024 / 1024; // MB
				let ext = file.name.split('.').pop().toLowerCase();

				if (size > 5) {
					alert("Max file size is 5MB");
					$(this).val('');
					return;
				}

				if (!['pdf', 'doc', 'docx'].includes(ext)) {
					alert("Only PDF, DOC, DOCX allowed");
					$(this).val('');
					return;
				}

				$(this).siblings(".file-name").text(file.name);
			}
		});

	});
</script>
<style>
	.file-upload-box {
		border: 2px dashed #dcdcdc;
		padding: 15px;
		border-radius: 10px;
		background: #fafafa;
	}

	.file-row {
		display: flex;
		align-items: center;
		gap: 10px;
		background: #fff;
		padding: 8px 10px;
		border-radius: 8px;
		margin-bottom: 8px;
		box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
		transition: 0.3s;
	}

	.file-row:hover {
		transform: translateY(-2px);
	}

	.file-row input[type=file] {
		border: none;
		flex: 1;
	}

	.file-name {
		font-size: 13px;
		color: #28a745;
	}

	.remove-file {
		border-radius: 50%;
		padding: 4px 8px;
	}
</style>
<script src="<?= base_url('ajax/proposal.js') ?>"></script>