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
					<form class="form-horizontal adminex-form"
						id="form-proposal"
						method="post"
						enctype="multipart/form-data"
						action="<?= base_url('super-admin/proposal/save_data') ?>">



						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						<input type="hidden" name="proposal_id" value="<?= $result->id ?? 0; ?>">

						<div class="col-md-12">

							<div class="form-group row">
								<label class="control-label col-lg-3">Title</label>
								<div class="col-lg-9">
									<input type="text" name="title" class="form-control" value="<?= $result->title ?? ''; ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-lg-3">Description *</label>
								<div class="col-lg-9">
									<textarea name="description" class="form-control" required><?= $result->description ?? ''; ?></textarea>
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-lg-3">File *</label>
								<div class="col-lg-9">
									<input type="file" name="file" accept=".pdf,.docx">

									<?php if (!empty($result->file)) : ?>
										<p style="margin-top:10px;">
											Existing File:
											<a href="<?= base_url('uploads/proposals/' . $result->file) ?>" target="_blank">
												View File
											</a>
										</p>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-lg-3">Name *</label>
								<div class="col-lg-9">
									<input type="text" name="name" class="form-control" value="<?= $result->name ?? ''; ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-lg-3">Email *</label>
								<div class="col-lg-9">
									<input type="email" name="email" class="form-control" value="<?= $result->email ?? ''; ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-lg-3">Designation *</label>
								<div class="col-lg-9">
									<input type="text" name="designation" class="form-control" value="<?= $result->designation ?? ''; ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="control-label col-lg-3">Department *</label>
								<div class="col-lg-9">
									<input type="text" name="department" class="form-control" value="<?= $result->department ?? ''; ?>" required>
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

<script src="<?= base_url('ajax/proposal.js') ?>"></script>