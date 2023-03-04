<?php
require __DIR__ . '/includes/helpers.php';
includeTemplate('header', true);
?>
<!-- main -->
<main class="container section">
  <h2>Más sobre nosotros</h2>
  <div class="icons-aboutus">
    <div class="icon">
      <img src="/build/img/icono1.svg" alt="Icono seguridad" loading="lazy" />
      <h3>Seguridad</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint culpa
        nemo, voluptatum, molestias, libero dolor hic aperiam voluptatibus
        assumenda voluptate illum dolorem tenetur ipsa blanditiis accusamus
        molestiae soluta? Eaque, exercitationem.
      </p>
    </div>
    <div class="icon">
      <img src="/build/img/icono2.svg" alt="Icono precio" loading="lazy" />
      <h3>Precio</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint culpa
        nemo, voluptatum, molestias, libero dolor hic aperiam voluptatibus
        assumenda voluptate illum dolorem tenetur ipsa blanditiis accusamus
        molestiae soluta? Eaque, exercitationem.
      </p>
    </div>
    <div class="icon">
      <img src="/build/img/icono3.svg" alt="Icono tiempo" loading="lazy" />
      <h3>A tiempo</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint culpa
        nemo, voluptatum, molestias, libero dolor hic aperiam voluptatibus
        assumenda voluptate illum dolorem tenetur ipsa blanditiis accusamus
        molestiae soluta? Eaque, exercitationem.
      </p>
    </div>
  </div>
</main>
<!-- ads -->
<section class="container section">
  <h2>Casas y Departamentos en Venta</h2>
  <div class="container-advertisements">
    <!-- advertisement -->
    <div class="advertisement">
      <picture>
        <source srcset="/build/img/anuncio1.webp" type="image/webp" />
        <source srcset="/build/img/anuncio1.jpg" type="image/jpeg" />
        <img src="/build/img/anuncio1.jpg" alt="anuncio 1" loading="lazy" />
      </picture>
      <div class="content-advertisement">
        <h3>Casa de Lujo en el Lago</h3>
        <p>
          Casa en el lago con excelente vista, acabados de lujo a un
          excelente precio.
        </p>
        <p class="price">$200.000.000</p>
        <ul class="icons-properties">
          <li>
            <img src="/build/img/icono_wc.svg" alt="icono wc" loading="lazy" class="icon-property" />
            <p>3</p>
          </li>
          <li>
            <img src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy" class="icon-property" />
            <p>3</p>
          </li>
          <li>
            <img src="/build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy" class="icon-property" />
            <p>4</p>
          </li>
        </ul>
        <a href="advertisement.php" class="button-yellow-block">Ver propiedad</a>
      </div>
    </div>
    <!-- advertisement -->
    <div class="advertisement">
      <picture>
        <source srcset="/build/img/anuncio2.webp" type="image/webp" />
        <source srcset="/build/img/anuncio2.jpg" type="image/jpeg" />
        <img src="/build/img/anuncio2.jpg" alt="anuncio 2" loading="lazy" />
      </picture>
      <div class="content-advertisement">
        <h3>Casa de Lujo</h3>
        <p>
          Casa con diseño moderno, así como tecnología inteligente y
          amueblada
        </p>
        <p class="price">$300.000.000</p>
        <ul class="icons-properties">
          <li>
            <img src="/build/img/icono_wc.svg" alt="icono wc" loading="lazy" class="icon-property" />
            <p>3</p>
          </li>
          <li>
            <img src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy" class="icon-property" />
            <p>3</p>
          </li>
          <li>
            <img src="/build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy" class="icon-property" />
            <p>4</p>
          </li>
        </ul>
        <a href="advertisement.php" class="button-yellow-block">Ver propiedad</a>
      </div>
    </div>
    <!-- advertisement -->
    <div class="advertisement">
      <picture>
        <source srcset="/build/img/anuncio3.webp" type="image/webp" />
        <source srcset="/build/img/anuncio3.jpg" type="image/jpeg" />
        <img src="/build/img/anuncio3.jpg" alt="anuncio 3" loading="lazy" />
      </picture>
      <div class="content-advertisement">
        <h3>Casa con alberca</h3>
        <p>
          Casa con alberca y acabados de lujo en la ciudad, excelente
          oportunidad
        </p>
        <p class="price">$250.000.000</p>
        <ul class="icons-properties">
          <li>
            <img src="/build/img/icono_wc.svg" alt="icono wc" loading="lazy" class="icon-property" />
            <p>3</p>
          </li>
          <li>
            <img src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy" class="icon-property" />
            <p>3</p>
          </li>
          <li>
            <img src="/build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy" class="icon-property" />
            <p>4</p>
          </li>
        </ul>
        <a href="advertisement.php" class="button-yellow-block">Ver propiedad</a>
      </div>
    </div>
  </div>
  <div class="right-align">
    <a href="advertisements.php" class="button-green">Ver todas</a>
  </div>
</section>
<!-- contact -->
<section class="image-contactus">
  <h2>Encuentra la casa de tus sueños</h2>
  <p>
    Llena el formulario de contacto y un asesor se pondrá en contacto
    contigo a la brevedad
  </p>
  <a href="contact.php" class="button-yellow-inline">Contáctanos</a>
</section>
<!-- blog and testimonials-->
<div class="container section section-lower">
  <section class="section">
    <h2>Nuestro blog</h2>
    <!-- blog's post-->
    <article class="post-blog">
      <div class="image-post">
        <picture>
          <source srcset="/build/img/blog1.webp" type="image/webp" />
          <source srcset="/build/img/blog1.jpg" type="image/jpeg" />
          <img src="/build/img/blog1.jpg" alt="texto post blog" loading="lazy" />
        </picture>
      </div>
      <div class="text-post">
        <a href="post.php">
          <h3>Terraza en el techo de tu casa</h3>
        </a>
        <p>Escrito el <span>03/03/2023</span> por <span>Admin</span></p>
        <p>
          Consejos para construir una terraza en el techo de tu casa con los
          mejores materiales y ahorrando dinero
        </p>
      </div>
    </article>
    <!-- blog's post-->
    <article class="post-blog">
      <div class="image-post">
        <picture>
          <source srcset="/build/img/blog2.webp" type="image/webp" />
          <source srcset="/build/img/blog2.jpg" type="image/jpeg" />
          <img src="/build/img/blog2.jpg" alt="texto post blog" loading="lazy" />
        </picture>
      </div>
      <div class="text-post">
        <a href="post.php">
          <h3>Guía para la decoración de tu hogar</h3>
        </a>
        <p>Escrito el <span>03/03/2023</span> por <span>Admin</span></p>
        <p>
          Maximiza el espacio en tu hogar con esta guía, aprende a combinar
          muebles y colores para darle vida a tu espacio
        </p>
      </div>
    </article>
  </section>
  <section class="testimonials">
    <h2>Testimonios</h2>
    <div>
      <blockquote>
        El personal se comportó de una excelente forma, muy buena atención y
        la casa que me ofrecieron cumple con todas mis expectativas
      </blockquote>
      <p>- Tomás Guttman</p>
    </div>
  </section>
</div>
<?php includeTemplate('footer'); ?>