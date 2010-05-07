<?php
// transform results into json data array
$data = array();
if (!empty($MediaFiles)) foreach($MediaFiles as $result) {
	$data[] = array(
		'title' => $result->get('filename'),
		'uri' => $result->adminDetailPageUri(),
		'img' => $HTML->image((string) $result->src(64, 64)),
	);
}
echo json_encode($data);