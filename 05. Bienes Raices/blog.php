<?php
require __DIR__ . '/includes/helpers.php';
includeTemplate('header');
?>
<!-- main -->
<main class="container section content-center">
  <h1>Nuestro Blog</h1>
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
        <h2>Terraza en el techo de tu casa</h2>
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
        <h2>Guía para la decoración de tu hogar</h2>
      </a>
      <p>Escrito el <span>03/03/2023</span> por <span>Admin</span></p>
      <p>
        Maximiza el espacio en tu hogar con esta guía, aprende a combinar
        muebles y colores para darle vida a tu espacio
      </p>
    </div>
  </article>
  <!-- blog's post-->
  <article class="post-blog">
    <div class="image-post">
      <picture>
        <source srcset="/build/img/blog3.webp" type="image/webp" />
        <source srcset="/build/img/blog3.jpg" type="image/jpeg" />
        <img src="/build/img/blog3.jpg" alt="texto post blog" loading="lazy" />
      </picture>
    </div>
    <div class="text-post">
      <a href="post.php">
        <h2>Guía para la decoración de tu hogar</h2>
      </a>
      <p>Escrito el <span>03/03/2023</span> por <span>Admin</span></p>
      <p>
        Maximiza el espacio en tu hogar con esta guía, aprende a combinar
        muebles y colores para darle vida a tu espacio
      </p>
    </div>
  </article>
  <!-- blog's post-->
  <article class="post-blog">
    <div class="image-post">
      <picture>
        <source srcset="/build/img/blog4.webp" type="image/webp" />
        <source srcset="/build/img/blog4.jpg" type="image/jpeg" />
        <img src="/build/img/blog4.jpg" alt="texto post blog" loading="lazy" />
      </picture>
    </div>
    <div class="text-post">
      <a href="post.php">
        <h2>Guía para la decoración de tu hogar</h2>
      </a>
      <p>Escrito el <span>03/03/2023</span> por <span>Admin</span></p>
      <p>
        Maximiza el espacio en tu hogar con esta guía, aprende a combinar
        muebles y colores para darle vida a tu espacio
      </p>
    </div>
  </article>
</main>
<?php includeTemplate('footer'); ?>