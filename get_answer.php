<?php
if (isset($_POST['question'])) {
    $question = trim($_POST['question']);

    // Validaciónn
    if ($question === '' || substr($question, -1) !== '?') {
        echo json_encode(['error' => 'Por favor, introduce una pregunta válida que termine con un signo de interrogación.']);
        exit;
    }

    // Realizar la solicitud
    $apiUrl = 'https://yesno.wtf/api';
    $response = file_get_contents($apiUrl);

    if ($response !== false) {
        $data = json_decode($response, true);

        // Responder con la respuesta y la imagen
        echo json_encode([
            'answer' => ucfirst($data['answer']),
            'image' => $data['image']
        ]);
    } else {
        echo json_encode(['error' => 'Ocurrió un error al conectarse con la API.']);
    }
} else {
    echo json_encode(['error' => 'No se recibió ninguna pregunta.']);
}
