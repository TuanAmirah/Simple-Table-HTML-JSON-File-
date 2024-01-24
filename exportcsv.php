<?php
if(isset($_GET['id']))
{
    $userId = $_GET['id'];

    $json = file_get_contents('evaluation-20190711.json');
    $data = json_decode($json, true);

    $userData = array_filter($data['data'], function ($user) use ($userId) {
        return $user['id'] == $userId;
    });


    if (!empty($userData)) {
        $userData = reset($userData); 

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="evaluation.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, array('Evaluation Title', 'Test', 'Score', 'Evaluation At'));

         foreach ($userData['evaluation']['score'] as $score) {
            fputcsv($output, array(
                $userData['evaluation']['title'],
                key($score), 
                current($score), 
                date('d-m-Y', strtotime($userData['evaluation']['created_at']))
            ));
        }

        fclose($output);
    } else {
        echo 'User not found';
    }
} else {
    echo 'Invalid request';
}
?>
