<?php
// transform results into json data array
$data = array();
if (!empty($MediaFiles)) foreach($MediaFiles as $result) {
	$data[] = array(
		'label' => $result->get('filename'),
		'value' => $result->adminDetailPageUri(),
		'img' => $HTML->image((string) $result->src(64, 64)),
	);
}
echo json_encode($data);