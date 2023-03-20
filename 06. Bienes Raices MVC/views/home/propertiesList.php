<div class="container-advertisements">
  <?php foreach($properties as $property) : ?>
    <!-- advertisement -->
    <div class="advertisement">
      <img src="/images/<?php echo $property->image; ?>" alt="anuncio" loading="lazy" />
      <div class="content-advertisement">
        <h3><?php echo $property->title; ?></h3>
        <p><?php echo $property->description; ?></p>
        <p class="price"><?php echo numberToCurrency($property->price); ?></p>
        <ul class="icons-properties">
          <li>
            <img src="/build/img/icono_wc.svg" alt="icono wc" loading="lazy" class="icon-property" />
            <p><?php echo $property->bathroom; ?></p>
          </li>
          <li>
            <img src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy" class="icon-property" />
            <p><?php echo $property->parking; ?></p>
          </li>
          <li>
            <img src="/build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy" class="icon-property" />
            <p><?php echo $property->room; ?></p>
          </li>
        </ul>
        <a href="/property?id=<?php echo $property->id; ?>" class="button-yellow-block">Ver propiedad</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>