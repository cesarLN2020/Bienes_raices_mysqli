<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <!-- CONTENIDO PRINICPAL -->
    <main class="contenedor seccion">
        <h1 class="fw300">Conoce Sobre Nosotros</h1>

        <div class="contenido-nosotros ">

            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>25 Años de Experiencia</blockquote>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab aliquam eos tempora, accusamus non eligendi illum nostrum sapiente deserunt veniam cupiditate optio enim rerum facilis consectetur veritatis impedit corporis aperiam dignissimos. Saepe, iusto. Tenetur maiores voluptatibus nemo optio itaque voluptas, recusandae quidem minima dolore commodi animi assumenda nulla! Ullam, sint consequuntur! Dolores sunt autem inventore nihil magnam! Beatae obcaecati iste in distinctio odit! Magnam odit voluptates provident error accusamus esse ducimus. Facilis et natus ducimus eum id aliquam doloribus perspiciatis obcaecati doloremque, ab beatae quidem fuga nostrum necessitatibus, repellendus consequuntur sint sequi repellat, ipsa itaque voluptatem dignissimos quasi! Nihil, fugit.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus harum tenetur similique repellendus quisquam odio repellat delectus, quasi odit eum tempora earum, minus mollitia at omnis ipsa inventore ducimus eveniet.</p>
            </div>

        </div>
    </main>

     <!-- section1 -->
     <section class="contenedor seccion">

        <h2 class="fw300 seccion">Más Sobre Nosotros</h2>

        <div class="icono-nosotros">

            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Facere accusantium consequuntur optio veniam cumque adipisci,
                    sint officiis itaque libero asperiores aspernatur quis id, explicabo nemo sunt eveniet provident
                    blanditiis
                    molestiae?
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="">
                <h3>El Mejor Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Facere accusantium consequuntur optio veniam cumque adipisci,
                    sint officiis itaque libero asperiores aspernatur quis id, explicabo nemo sunt eveniet provident
                    blanditiis
                    molestiae?
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Facere accusantium consequuntur optio veniam cumque adipisci,
                    sint officiis itaque libero asperiores aspernatur quis id, explicabo nemo sunt eveniet provident
                    blanditiis
                    molestiae?
                </p>
            </div>

        </div>

    </section>

<?php    
    incluirTemplate('footer');
?>