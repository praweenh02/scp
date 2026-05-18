 <div class="page-heading">
 	<h3>
 		<?= $page_title; ?>
 	</h3>
 	<hr>
 </div>

 <?php $csrf = array(
		'name' => $this->security->get_csrf_token_name(),
		'hash' => $this->security->get_csrf_hash()
	);
	?>

 <input type="hidden"
 	class="csrf-token"
 	name="<?= $this->security->get_csrf_token_name(); ?>"
 	value="<?= $this->security->get_csrf_hash(); ?>">
 <div class="wrapper">
 	<div class="row">
 		<div class="col-sm-12">
 			<section class="panel">
 				<header class="panel-heading">
 					<?= $page_title; ?>
 					<span class="mb-5 pull-right" style="margin-top: -6px;">
 						<a href="#addComments" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addComments">
 							<i class="fa fa-plus"></i> New Comments
 						</a>
 					</span>

 				</header>
 				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
 				<div class="panel-body">
 					<div class="adv-table">
 						<table class="display table table-bordered table-striped">
 							<thead>
 								<tr>

 									<th>Proposal</th>
 									<th>Proposer Details</th>
 									<th>Proposal Recived Date</th>
 									<th>Status</th>
 									<th>Update On</th>

 								</tr>
 							</thead>
 							<tbody id="loadallData">
 								<tr>
 									<td><?= $proposal->title; ?></td>
 									<td>
 										<span>Name - <?= $proposal->name; ?></span><br>
 										<span>Email - <?= $proposal->email; ?></span><br>
 										<span>Designation - <?= $proposal->designation; ?></span><br>
 										<span>Organisation - <?= $proposal->organisation; ?></span><br>
 									</td>
 									<td><?= date('d M Y', strtotime($proposal->created_at)); ?></td>
 									<td>
 										<p><?= $proposal->proposal_status; ?></p>

 									</td>
 									<td>
 										<?= date('d M Y', strtotime($proposal->proposal_status_updated_date)); ?>
 									</td>
 								</tr>
 								<?php
									foreach ($proposalCommentList as $comments):
									?>
 									<tr>
 										<td></td>
 										<td></td>
 										<td></td>
 										<td>
 											<p><?= $comments->comment; ?></p>
											<p><?php if (!empty($comments->comment_file)): ?>
												<a href="<?= base_url('uploads/proposal-comments/'.$comments->comment_file); ?>" target="_blank">View File</a>
											<?php endif; ?>	</p>
 											<a href="super-admin/proposal/delete_comment/<?= $comments->id; ?>/<?= $comments->proposal_id; ?>"><label class="text-danger"><i class="fa fa-trash-o"></i>
 													Delete Comment
 												</label>
 											</a>
 										</td>
 										<td>
 											<?= date('d M Y', strtotime($comments->created_at)); ?>
 										</td>

 									</tr>
 								<?php endforeach; ?>
 							</tbody>
 						</table>
 					</div>
 				</div>
 			</section>
 		</div>
 	</div>
 </div>

 <div class="modal fade" id="addComments" tabindex="-1" role="dialog">
 	<form id="form-comments" enctype="multipart/form-data" method="post" action="<?= base_url('super-admin/proposals/save_comment'); ?>">
 		<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
 		<input type="hidden" name="proposal_id" value="<?= $proposal->id; ?>">

 		<div class="modal-dialog" role="document">
 			<div class="modal-content">

 				<div class="modal-header">
 					<h5 class="modal-title">New Comments</h5>
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 				</div>

 				<div class="modal-body">
					<div class="form-group">
						<label for="comment">Comment</label>
 					<textarea class="form-control" name="comment" placeholder="Write your comment..."></textarea>
					</div>
					<div class="form-group">
						<label for="status">File</label>
					<input type="file" name="comment_file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.txt">
					</div>
 				</div>

 				<div class="modal-footer">
 					<button class="btn btn-secondary" data-dismiss="modal">Close</button>
 					<button type="submit" class="btn btn-success">Submit</button>


 				</div>

 			</div>
 		</div>
 	</form>
 </div>

 <script src="<?= base_url('ajax/proposal.js?v=' . filemtime(FCPATH . 'ajax/proposal.js')); ?>"></script>