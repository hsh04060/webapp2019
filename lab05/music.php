<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>
		
		<!-- Ex 1: Number of Songs (Variables) -->
		<?php $song_num=5678; ?>
		<p>
			I love music.
			I have <?= $song_num ?> total songs,
			which is over <?= (int)($song_num/10) ?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Billboard News</h2>
			<ol>
			<?php 
				$news_pages=array("2019-11","2019-10","2019-09","2019-08","2019-07"); 
				if(isset($_GET["newspages"])){
					$newspages = $_GET["newspages"];
				}
				else{
					$newspages = 5;
				};
				for($i=0;$i<$newspages;$i++){
					$page = explode("-",$news_pages[$i]);
					$url = implode("",$page);
			?>
			    <li><a href="https://www.billboard.com/archive/article/<?= $url ?>"><?php print $news_pages[$i]; }?></a></li>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
			<ol>
			<?php
				foreach(file("favorite.txt") as $favor_artist){
			?>
				<li><a href="http://en.wikipedia.org/wiki/<?=$favor_artist ?>"><?=$favor_artist; } ?></a></li>
			</ol>
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
			<?php
				$mp3list = glob("lab5/musicPHP/songs/*.mp3");
				
				foreach($mp3list as $mp3file){
					$file_name = basename($mp3file);
					$size = (int)(filesize($mp3file)/1024);
			?>
				<li class="mp3item">
					<a href="<?php print_r($mp3file); ?>"><?= "$file_name ($size KB)"; } ?></a>
				</li>

				<!-- Exercise 8: Playlists (Files) -->
				<?php
					$m3ulists = glob("lab5/musicPHP/songs/*.m3u");
					rsort($m3ulists);
					foreach($m3ulists as $m3ulist){
				?>
				<li class="playlistitem"><?= basename($m3ulist)?>:
					<ul>
					<?php
						$mlists = file("$m3ulist");
						shuffle($mlists);
						foreach($mlists as $mlist){
							if(strpos($mlist,"#")===0){}
							else{
					?>
						<li><?= $mlist;}} ?></li>
					</ul>
				</li>
				<?php }?>
			</ul>
		</div>

		<div>
			<a href="https://validator.w3.org/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
