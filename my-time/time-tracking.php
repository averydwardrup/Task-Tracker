<?php
/*
	Template Name: Time tracking
*/
?>
<?php get_header(); ?>

	<article class="time-tracking">
		<div class="row2">

			<!--<div class="col-md-12 new-task" style="display: none;">

				<h2>Create a website task</h2>

				<h5>This includes change requests and website fixes.</h5>

				<?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>

			</div>-->

			<div class="col-md-12 row">
				<div class="col-md-3 filters no-pad">

					<input id="myInput" type="text" placeholder="Search Tasks">

				</div>

				<div class="col-md-5 filters">
					<span class="text-muted text-uppercase">Filter By:</span>

					<select id='mySelector'>
						<option value="">Web Entity</option>
						<option value='Strong Hold'>Strong Hold</option>
						<option value='Utility Metals'>Utility Metals</option>
						<option value='Fabricated Metals'>Fabricated Metals</option>
					</select>

					<span class="text-muted text-uppercase">or</span>

					<select id='mySelector2'>
						<option value="">Task Status</option>
						<option value='In Que'>In Que</option>
						<option value='In Progress'>In Progress</option>
						<option value='On Hold'>On Hold</option>
						<option value='Complete'>Complete</option>
					</select>
				</div>

				<div class="col-md-4 text-right no-pad">
					<button type="button " class="btn btn-lg btn-primary" data-toggle="modal" data-target="#exampleModal">
					  Add New Task
					</button>

					<button id="btnExport" class="btn btn-lg btn-success right" onclick="javascript:xport.toCSV('task-table');"> Export to CSV</button>
				</div>

			<!--	<p> Test1: <button id="btnExport" onclick="javascript:xport.toXLS('task-table');"> Export to XLS</button> <em>&nbsp;&nbsp;&nbsp;Export the table to XLS with CSV fallback for IE & Edge</em>
  </p> -->



				<div class="clearfix"><p>&nbsp;</p></div>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Create a website task</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
								<h5>This includes change requests and website fixes.</h5>
				        <?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
				      </div>
				      <!--<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				      </div>-->
				    </div>
				  </div>
				</div>
				<div class="clearfix"></div>
				
					<table class="table table-striped" rules="groups" frame="hsides" id="task-table">
				    <thead>
				      <tr>
				        <th onclick="sortTable(0)">Web Entity</th>
								<th onclick="sortTable(1)">Request Received</th>
				        <th onclick="sortTable(2)">Requester</th>
				        <th onclick="sortTable(3)">Description</th>
								<th onclick="sortTable(4)">Estimated Time</th>
								<th onclick="sortTable(5)">Actual Time</th>
								<th onclick="sortTable(6)">Target Completion Date</th>
								<th onclick="sortTable(7)">Actual Completion Date</th>
								<th onclick="sortTable(8)">Status</th>
				      </tr>
				    </thead>
				    <tbody id="myTable">

							<?php // Display blog posts on any page @ https://m0n.co/l
							$temp = $wp_query; $wp_query= null;
							$wp_query = new WP_Query(); 
							$wp_query->query('posts_per_page=25' . '&paged='.$paged);
							while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
								<tr>
									<td class="web-identity <?php the_field('task_is_for'); ?>"><mark><?php the_field('task_is_for'); ?></mark></td>
					        <td><?php echo get_the_date(); ?></td>
									<td><?php the_field('requester'); ?></td>
									<td><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></td>
									<td><?php the_field('estimated_time'); ?></td>
									<td><?php the_field('actual_time_spent'); ?></td>
									<td><?php the_field('target_completion_date'); ?></td>
									<td><?php the_field('actual_completion_date'); ?></td>
									<td><?php the_field('status'); ?></td>
								</tr>
							<?php endwhile; ?>

							

						</tbody>
					</table>
				
			</div>
		</div>
		

		<nav id="nav-posts">
			<?php //wpbeginner_numeric_posts_nav(); ?>
		</nav>

		<?php wp_reset_postdata(); ?>

	</article>

<?php get_footer(); ?>
