<?php
require __DIR__ . '/includes/helpers.php';
includeTemplate('header');
?>
<!-- main -->
<main class="container section content-center">
  <h1>Casa frente al Bosque</h1>
  <picture>
    <source srcset="/build/img/destacada.webp" type="image/webp" />
    <source srcset="/build/img/destacada.jpg" type="image/jpeg" />
    <img src="/build/img/destacada.jpg" alt="Imagen propiedad" loading="lazy" />
  </picture>
  <div>
    <p class="price">$250.000.000</p>
    <div class="container-ad-icons">
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
    </div>
    <p>
      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci
      nostrum aliquid illo ullam culpa natus optio veritatis facilis nobis.
      Minus consectetur, dolore deserunt repudiandae numquam corrupti
      praesentium cupiditate quaerat iste? Lorem ipsum dolor sit amet
      consectetur adipisicing elit. Repudiandae, cumque ut? Est obcaecati
      architecto laudantium nobis cumque facilis cupiditate inventore neque,
      exercitationem nihil autem itaque harum vitae aperiam voluptas fuga!
    </p>
    <p>
      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci
      nostrum aliquid illo ullam culpa natus optio veritatis facilis nobis.
      Minus consectetur, dolore deserunt repudiandae numquam corrupti
      praesentium cupiditate quaerat iste? Lorem ipsum dolor sit amet
      consectetur adipisicing elit. Repudiandae, cumque ut? Est obcaecati
      architecto laudantium nobis cumque facilis cupiditate inventore neque,
      exercitationem nihil autem itaque harum vitae aperiam voluptas fuga!
    </p>
  </div>
</main>
<?php includeTemplate('footer'); ?>