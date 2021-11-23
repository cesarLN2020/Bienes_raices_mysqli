<?php 

    require 'includes/funciones.php';
    $inicio = true;

    incluirTemplate('header', $inicio = true);


?>

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

    <!-- main -->
    <main class="seccion contenedor">
        <h2 class="fw300 seccion">Casas y Depas en Venta</h2>

        <?php 
            $limite = 3;
            include 'includes/templates/anuncios.php';  
        ?>
        
        </div>

        <div class="alinear-derecha">
            <a href="anuncios.html" class="boton-verde">Ver Todas</a>
        </div>
    </main>

    <!-- SECCION CONTACTO -->
    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, hic?</p>
        <a href="contacto.html" class="boton-naranja">Contactanos</a>
    </section>

    <!-- section2 -->
    <div class="seccion contenedor seccion-inferior">

        <section class="blog">
            <h3 class="fw300">Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada-blog.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito: <span>20/10/2019</span> por: <span>Admin</span></p>
                        <p>Consejos para construir una terraza en el techo de tu casa,
                            con los mejores materiales y ahorrando dinero
                        </p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">

                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada-blog.html">
                        <h4>Guia para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito: <span>20/10/2019</span> por: <span>Admin</span></p>
                        <p>Consejos para construir una terraza en el techo de tu casa,
                            con los mejores materiales y ahorrando dinero
                        </p>
                    </a>
                </div>

            </article>
        </section>

        <!-- section3 TESTIMONIALES -->
        <section class="testimoniales">
            <h3 class="fw300">Testimoniales</h3>

            <div class="testimonial">

                <blockquote>
                    El personal se comportó de una excelente forma,
                    muy buena atención y la casa cumple con mis especificaciones.
                </blockquote>

                <p> -Cesar Alberto Lopez Nieves</p>
            </div>
        </section>
    </div>

<?php 
    incluirTemplate('footer');
?>