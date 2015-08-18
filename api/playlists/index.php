<?php


require_once('../api_common.php');

include_once("../../headers/session_header.php");
//$rawdata = get_array('playsheets');

$rawdata = array();

global $_GET;
global $db;

$offset = isset($_GET['OFFSET']) && is_numeric($_GET['OFFSET']) ? $_GET['OFFSET'] * 1 : 0;
$limit  = isset($_GET['LIMIT'])  && is_numeric($_GET['LIMIT'])  ? $_GET['LIMIT']  * 1 : 100;

  $query = 'SELECT playsheets.id,
      GREATEST(playsheets.edit_date, podcast_episodes.edit_date) as edit_date
    FROM playsheets
    LEFT JOIN podcast_episodes on playsheets.podcast_episode = podcast_episodes.id

    ORDER BY
      GREATEST(playsheets.edit_date, podcast_episodes.edit_date)
    DESC limit ' . $limit . ' OFFSET ' . $offset;

if ($result = mysqli_query($db, $query) ) {

  while ($row = mysqli_fetch_assoc($result)) {

    $rawdata [] = $row;

  }
} else {
  $error .= mysqli_error($db);
}

$data = $rawdata;

finish();