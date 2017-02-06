<?php
	require_once("headers/security_header.php");
	require_once("headers/menu_header.php");

	if( permission_level() < $djland_permission_levels['volunteer_leader']['level']){
		header("Location: main.php");
	}
?>
<html>
	<head>
		<meta name=ROBOTS content=\"NOINDEX, NOFOLLOW\">
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
		<link rel=stylesheet href='css/style.css' type='text/css'>


		<title>DJLAND | Genre Manager</title>

		<script type='text/javascript' src='js/jquery-1.11.3.min.js'></script>
		<script type='text/javascript' src='js/jquery-ui-1.11.3.min.js'></script>
		<script type='text/javascript' src='js/constants.js'/></script>
		<script type='text/javascript' src='js/genremanager/genremanager.js'/></script>

        <script type="text/javascript" src="js/test.js"></script>

	</head>
	<body class='wallpaper'>
		<?php
        print_menu();
        ?>
		<div>
			<h2> Genre Manager</h2>
			<div class='col1 text-center'>
				<h5>Double click a row to edit the genre or subgenre</h5>
			</div>
		</div>
		<div style='width:1080px; margin-left:auto; margin-right:auto;'>
			<div id='wrapper' class='grey' style='width:50.5%;float:left'>
				<h3>Genres</h3>
				<div id="addgenre" class="right pad-bottom"><button>Add New</button></div>
				<br />
				<br />
				<div id="submisison_result" class="left overflow_auto height_cap" name="search">
					<table id="submission_table" name="search">
						<thead>
							<tr id="headerrow" style="display: table-row;">
								<th>Name</th>
								<th>Created By</th>
								<th>Modified By</th>
								<th>Last Modified</th>
								<th><button id="delete_button">Delete</button></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($djland_primary_genres as $genre){
								printf("<tr class=\"playitem border genrerow\">
								<td class=\"submission_row_element name\">$genre</td>
								<td class=\"submission_row_element email\">Digital Library</td>
								<td class=\"submission_row_element primary_phone\">Andy</td>
								<td class=\"submission_row_element submission_type\">Nov 14th, 2016</td>
								<td><input type=\"checkbox\" class=\"delete_submission\" id=\"delete_0\"><div class=\"check hidden\">❏</div></td>
								</tr>");
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div id='wrapper' class="grey" style='width:44%;float:right'>
				<h3 id="subgenretitle">Subgenres for the Electronic Genre</h3>
				<div id="addsubgenre" class="right pad-bottom"><button>Add New</button></div>
				<br />
				<br />
				<div id="submisison_result" class="left overflow_auto height_cap" name="search">
					<table id="submission_table" name="search">
						<thead>
							<tr id="headerrow" style="display: table-row;">
								<th>Name</th>
								<th>Created By</th>
								<th>Modified By</th>
								<th>Last Modified</th>
								<th><button id="delete_button">Delete</button></th>
							</tr>
						</thead>
						<tbody id=subgenrelisting>

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="genredialog" title="Edit Genre">
  			<textarea id="genrebox">Genre Here</textarea>
		</div>
		<div id="subgenredialog" title="Edit Subgenre">
			<textarea id="subgenrebox">Subgenre Here</textarea>
		</div>
		<div id="addgenredialog" title="Add Genre">
  			<textarea id="genrebox">Genre Here</textarea>
		</div>
		<div id="addsubgenredialog" title="Add Subgenre">
			<textarea id="subgenrebox">Subgenre Here</textarea>
		</div>
	</body>
</html>