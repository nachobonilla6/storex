<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slider</title>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <style>
    .swiper-container {
      width: 100%;
      height: 100vh;
    }
    .swiper-slide img {
      width: 100%;
      height: auto;
    }
  </style>
</head>
<body>
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="https://photo.yupoo.com/shoes6886/6f6bc893/a3c2f53f.jpg" alt="Imagen 1">
      </div>
      <div class="swiper-slide">
        <img src="https://photo.yupoo.com/shoes6886/6f6bc893/a3c2f53f.jpg" alt="Imagen 2">
      </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
    const swiper = new Swiper('.swiper-container', {
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      history: {
        key: 'slide',
      },
    });
  </script>
</body>
</html>
