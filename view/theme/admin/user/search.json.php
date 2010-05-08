<?php
// transform results into json data array
$data = array();
if (!empty($Users)) foreach($Users as $result) {
	$data[] = array(
		'title' => $result->get('name'),
		'uri' => $result->adminDetailPageUri(array('action' => 'view')),
		'img' => $this->renderElement('gravatar', array('User' => $result, 'size' => 64)),
	);
}
echo json_encode($data);