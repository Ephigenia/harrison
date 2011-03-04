<?php
// transform results into json data array
$data = array();
if (!empty($BlogPosts)) foreach($BlogPosts as $result) {
	$data[] = array(
		'label' => $result->get('headline'),
		'value' => $result->adminDetailPageUri(array('action' => 'edit')),
	);
}
echo json_encode($data);