<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro de Postulados</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.section {
    margin-bottom: 30px;
}

h2 {
    font-size: 24px;
    margin-bottom: 10px;
}

p {
    line-height: 1.5;
}
</style>
<body>
    <div class="container">
        <h1>Sistema de Registro de Postulados</h1>

        <section class="section">
            <h2>¿Qué es?</h2>
            <p>El sistema de registro de postulados es un sistema desarrollado académicamente como proyecto final de año. Este fue desarrollado para una universidad que presentaba el control de postulados de manera manual, a lo que después de realizar el levantamiento de información y la ingeniería de software requerida se logró el desarrollo del presente sistema.</p>
        </section>

        <section class="section">
            <h2>¿Quién lo desarrolló?</h2>
            <p>El sistema de registro de postulados es un sistema desarrollado por Hamilton Leon (hamiltonleon2), como proyecto de su 3er año de ingeniería informática.</p>
        </section>

        <section class="section">
            <h2>Tecnologías utilizadas</h2>
            <p>Este sistema fue desarrollado en Laravel 10, bajo PHP 8.1, con HTML, CSS. Si bien el sistema fue desarrollado y desplegado con PostgreSQL como SGBD, también fue desarrollado para poder utilizar MySQL y sus variantes basadas en SQL.</p>
        </section>

        <section class="section">
            <h2>Librerías utilizadas</h2>
            <p>Para la creación de este sistema fueron utilizadas las librerías: Laravel permission, dompdf, laravel datatables, revisionable, laravel activitylog, sweet alert, pusher, maatwebsite excel, livewire.</p>
            <p>Si bien, algunas de estas librerías no se están usando, se planean ser utilizadas.</p>
        </section>

        <section class="section">
            <h2>Disclaimer</h2>
            <p>Actualmente este proyecto está abandonado, ya que se está trabajando en su reestructuración y optimización.</p>
        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>
