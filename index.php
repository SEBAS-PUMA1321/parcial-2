<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YesNo App</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Parcial Web II</h1>
    <p>Ingresa tu pregunta.</p>
    <input type="text" id="question" placeholder="¿Escribe tu pregunta aquí?" />
    <button id="askButton">Hazme una pregunta</button>
    <div id="error"></div>
    <div id="answer"></div>
    <img id="gif" />
</div>

<script>
    $(document).ready(function() {
        $('#askButton').click(function() {
            const question = $('#question').val().trim();
            const errorElement = $('#error');
            const answerElement = $('#answer');
            const gifElement = $('#gif');

            errorElement.text('');
            answerElement.text('');
            gifElement.hide();

            // Validación de la pregunta
            if (question === '' || !question.endsWith('?')) {
                errorElement.text('Por favor, introduce una pregunta válida que termine con un signo de interrogación.');
                return;
            }

            // Solicitud AJAX a get_answer.php
            $.ajax({
                url: 'get_answer.php',
                method: 'POST',
                data: { question: question },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.error) {
                        errorElement.text(data.error);
                    } else {
                        answerElement.text(data.answer);
                        gifElement.attr('src', data.image).show();
                    }
                },
                error: function() {
                    errorElement.text('Ocurrió un error al obtener la respuesta.');
                }
            });
        });
    });
</script>
</body>
</html>
