
<p><?php echo $page_post['data']; ?></p>

<div class="content-navigate-module text-center">
	<input type="hidden" name="module-number" value="<?php echo $page_post['module_num']; ?>">
	<input type="hidden" name="current-page" value="<?php echo $page_post['current_page']; ?>">
	<input type="hidden" name="first-page" value="<?php echo $page_post['first']; ?>">
	<input type="hidden" name="last-page" value="<?php echo $page_post['last']; ?>">
	<button class="learn-more btn-ajax" data='prev' load="<?php echo $page_post['prev']; ?>">Back</button>
	<button class="learn-more btn-ajax" data='next' load="<?php echo $page_post['next']; ?>">Continue</button>
	
</div>

