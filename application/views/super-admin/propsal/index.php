 <div class="page-heading">
 	<h3>
 		Proposal List
 	</h3>
 	<hr>
 </div>
 <?php $csrf = array(
		'name' => $this->security->get_csrf_token_name(),
		'hash' => $this->security->get_csrf_hash()
	);
	?>

 <input type="hidden" id="csrf_token_name" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
 <div class="wrapper">
 	<div class="row">
 		<div class="col-sm-12">
 			<section class="panel">
 				<header class="panel-heading">
 					Proposal List
 					<span class="mb-5 pull-right" style="margin-top: -6px;">
 						<a href="super-admin/proposal/create" class="btn btn-primary btn-sm">
 							<i class="fa fa-plus"></i> Add New
 						</a>
 					</span>
 				</header>
 				<div class="panel-body">
 					<div class="adv-table">
 						<table class="display table table-bordered table-striped" id="dynamic-table">
 							<thead>
 								<tr>
 									<th>#</th>
 									<th>Name of the document</th>
 									<th>Description of document</th>
 									<th>Proposal Details</th>
 									<th>File</th>
 									<th>Status</th>
 									<th>Action</th>

 								</tr>
 							</thead>
 							<tbody id="loadallData">
 								<?php
									$i = 1;
									foreach ($proposalList as $proposalResult) {
										$proposalFiles = $this->db
											->where('proposal_id', $proposalResult->id)
											->get('proposal_files')
											->result();
									?>
 									<tr class="gradeX">
 										<td><?= $i; ?></td>

 										<td><?= $proposalResult->title; ?></td>
 										<td><?= $proposalResult->description; ?></td>
 										<td>
 											<span><?= $proposalResult->name; ?></span><br>
 											<span> <?= $proposalResult->email; ?></span><br>
 											<span><?= $proposalResult->designation; ?></span><br>
 											<span><?= $proposalResult->organisation; ?></span><br>



 										</td>
 										<td>
 											<?php if (!empty($proposalFiles)) : ?>

 												<div class="file-list">
 													<?php foreach ($proposalFiles as $f) : ?>
 														<div class="file-item">
 															<a href="<?= base_url('uploads/proposals/' . $f->file) ?>"
 																target="_blank">
 																<i class="fa fa-file text-primary"></i>
 																<?= $f->file ?>
 															</a>
 														</div>
 													<?php endforeach; ?>
 												</div>

 											<?php else : ?>
 												<span class="text-muted">No files</span>
 											<?php endif; ?>
 										</td>
 										<td><?= ($proposalResult->status == 'Y') ?  '<button class="btn-success btn-xs">Active</button>' : '<button class="btn-danger btn-xs">Inactive</button>' ?>
 										</td>
 										<td><a href="super-admin/question/add/<?= $proposalResult->id; ?>/"
 												class="btn btn-xs btn-primary" title="Edit"><i class="fa
fa-edit"></i> Edit</a>

 											<button onclick="deleteData('<?= $proposalResult->id; ?>');"
 												class="btn btn-xs btn-danger" title="Delete"><i class="fa
fa-trash-o"></i> Delete</button>
 										</td>
 									</tr>

 								<?php $i++;
									} ?>



 							</tbody>
 						</table>
 					</div>
 				</div>
 			</section>
 		</div>
 	</div>
 </div>

 <div id="popupdiv"></div>

 <script src="ajax/question.js"></script>