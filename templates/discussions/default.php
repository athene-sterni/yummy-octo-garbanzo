<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<? include 'templates/header.php'; ?>
<h1><?=Lang::$L_DISCUSSIONS?> - <?=Lang::$L_OVERVIEW?></h1>
<div class="overview-div">
	<? foreach($this->_['entries'] as $entry) { ?>
	<div class="overview-entry">
		<span class="overview-entry-title"><?=htmlify($entry['discussion_title'])?></span><br/>
		<div class="overview-details">
			<span class="overview-entry-author"><?=htmlify($entry['author_username'])?></span><br/>
			<span class="overview-entry-num-answers"><?=htmlify($entry['num_answers'])?> <?=Lang::$L_NUM_ANSWERS?></span>, 
			<span class="overview-entry-recent-date"><?=htmlify($entry['recent_date'])?></span>
		</div>
	</div>
	<? } ?>
</div>
<? include 'templates/footer.php'; ?>
