<?php
/*
 *
 * An example file that save encoded SVG, PNG and JPG URL and creates an image of it
 *
 */

$site_url = $_SERVER['HTTP_REFERER'];

$site_ref_url = explode('/', $site_url);

$site_url = $site_ref_url[2];

$type = json_decode($_POST['type'], true);

$post_data = json_decode($_POST['object'], true);


if (isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] == 'svg') {

    $result = array();
    $filenames = array();
    foreach ($post_data as $key => $value) {

        if (!empty($value) && $value != null) {


            $destination = dirname(dirname(__FILE__)) . '/saved_design/svg/';

            // $filename = $key . 'design_' . time() . '.svg';
            $filename = $_POST['name'] . '.svg';

            $contant = file_get_contents($value);

            file_put_contents($destination . $filename, $contant);
            $filenames[] = $site_url . '/saved_design/svg/' . $filename;

        }
    }

    $result['status'] = true;
    $result['filename'] = $filenames;
    $result['message'] = 'Your designed object has been saved.';

    echo json_encode($result);

} else if (isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] == 'png') {

    $result = array();
    $filenames = array();
    foreach ($post_data as $key => $value) {

        if (!empty($value) && $value != null) {


            $destination = dirname(dirname(__FILE__)) . '/saved_design/png/';

            // $filename = $key . 'design_' . time() . '.png';
            $filename = $_POST['name'] . '.png';


            $contant = file_get_contents($value);

            file_put_contents($destination . $filename, $contant);
            $filenames[] = $site_url . '/saved_design/png/' . $filename;

        }
    }

    $result['status'] = true;
    $result['filename'] = $filenames;
    $result['message'] = 'Your design has been saved.';

    echo json_encode($result);

} else if (isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] == 'jpg') {

    $result = array();
    $filenames = array();
    foreach ($post_data as $key => $value) {
        if (!empty($value) && $value != null) {


            $destination = dirname(dirname(__FILE__)) . '/saved_design/jpg/';

            // $filename = $key . 'design_' . time() . '.jpg';
            $filename = $_POST['name'] . '.jpg';


            $contant = file_get_contents($value);

            file_put_contents($destination . $filename, $contant);
            $filenames[] = $site_url . '/saved_design/jpg/' . $filename;

        }
    }

    $result['status'] = true;
    $result['filename'] = $filenames;
    $result['message'] = 'Your design has been saved.';

    echo json_encode($result);

} else if (isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] == 'json') {

    $result = array();
    if (!empty($_POST['object']) && $_POST['object'] != null) {
        $destination = dirname(dirname(__FILE__)) . '/saved_design/json/';

        // $filename = 'design_' . time() . '.json';
        $filename = $_POST['name'] . '.json';


        file_put_contents($destination . $filename, $_POST['object']);
    }

    $result['status'] = true;
    $result['message'] = 'Your designed object has been saved.';

    echo json_encode($result);

} else {

    $result['status'] = false;
    $result['filename'] = array();
    $result['message'] = 'Something went wrong! Please try again.';

    echo json_encode($result);
}