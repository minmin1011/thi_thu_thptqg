<div class="title-content">
	<span class="title">Danh Sách Bài Tập/Thi</span>
</div>
<div class="block-content overflow scrollbar">
	<div class="content" style="padding-top: 10px">
		<div class="display-column">
			<?php
			for ($i = 0; $i < count($tests); $i++) {
			?>
				<div class="template-column">
					<div id="tests_list">
						<span class="title">Tên: <?= $tests[$i]->test_name ?></span><br />
						<span class="title">Môn: <?= $tests[$i]->subject_detail ?></span><br />
						<span class="title">Khối: <?= $tests[$i]->grade ?></span><br />
						<span class="title">Mã Đề: <?= $tests[$i]->test_code ?></span><br />
						<span class="title">Số Câu Hỏi: <?= $tests[$i]->total_questions ?></span><br />
						<span class="title">Thời Gian: <?= $tests[$i]->time_to_do ?> Phút</span><br />
						<span class="title">Trạng Thái: <?= $tests[$i]->status ?></span><br />
						<span class="title">Ghi Chú: <?= $tests[$i]->note ?></span><br />
						<?php
						if ($tests[$i]->status_id != 2) {
							$flag = false;
							for ($j = 0; $j < count($scores); $j++) {
								if ($tests[$i]->test_code == $scores[$j]->test_code) {
									$flag = true;
									break;
								}
							}
							if ($flag)
								echo '<a href="index.php?action=show_result&test_code=' . $tests[$i]->test_code . '" class="btn full-width done-test">Làm bài (Đã làm)</a>';
							else {
						?>
								<a class="waves-effect waves-light btn modal-trigger full-width" style="margin-bottom: 7px;" href="#do-test-<?= $tests[$i]->test_code ?>" id="do_test">Làm Bài</a>
								<div id="do-test-<?= $tests[$i]->test_code ?>" class="modal">
									<div class="row col l12">
										<form class="form_test" action="" method="POST" role="form" id="form_submit_test_<?= $tests[$i]->test_code ?>">
											<div class="modal-content">
												<h5>Xác nhận vào thi</h5>
												<span>Mã đề: <?= $tests[$i]->test_code ?></span></br>
												<span>Thời gian làm bài: <?= $tests[$i]->time_to_do ?> Phút</span>
												<div class="modal-body">
													<div class="input-field">
														<input type="hidden" value="<?= $tests[$i]->test_code ?>" name="test_code" id="test_code">
														<input type="hidden" value="<?= $tests[$i]->test_code ?>" name="password" id="password">
													</div>
												</div>
											</div>
											<div class="col l12 s12">
												<div class="modal-footer">
													<a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Trở Lại</a>
													<button type="submit" class="waves-effect waves-green btn-flat modal-action modal-close">Đồng Ý</button>
												</div>
											</div>
										</form>
									</div>
								</div>
						<?php
							}
						} else {
							$flag_2 = false;
							for ($j = 0; $j < count($scores); $j++) {
								if ($tests[$i]->test_code == $scores[$j]->test_code) {
									$flag_2 = true;
									break;
								}
							}
							if ($flag_2)
								echo '<a href="index.php?action=show_result&test_code=' . $tests[$i]->test_code . '" class="btn full-width">Làm bài (Đã làm)</a>';
							else
								echo '<button class="btn full-width" disabled>Làm bài (Đã làm)</button>';
						}
						?>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>
</div>