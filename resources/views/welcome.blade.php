<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Catálogo en Línea</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

   <style>
      .square-img {
         position: relative;
         width: 100%;
         padding-bottom: 100%; /* 1:1 Aspect Ratio */
         overflow: hidden;
      }
      .square-img img {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         object-fit: cover;
      }
      .whatsapp-button {
         display: flex;
         align-items: center;
         justify-content: center;
         padding: 10px;
         background-color: #25D366;
         color: white;
         border-radius: 5px;
         text-decoration: none;
         font-size: 16px;
         width: 100%;
         margin-top: 10px;
      }
      .whatsapp-button i {
         margin-right: 8px;
      }
   </style>
</head>
<body>


   <!-- Barra de navegación -->
   <nav class="navbar-custom navbar navbar-expand-lg navbar-light sticky-top" style="background-color: #25d366; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 0 0 10px 10px;">
      <a class="navbar-brand" href="{{ url('/') }}" style="color: white;">
         <img src="{{ asset('imagesy/logo-dark.png') }}" alt="Acedu Site" style="height: 20px;">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
         <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" style="width: auto;">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscaxr</button>
         </form>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" href="#" style="color: white; font-family: 'Roboto', sans-serif;">Iniciar sesión</a>
            </li>
            <li class="nav-item d-none d-lg-block">
               <span class="nav-link" style="color: white; font-family: 'Roboto', sans-serif;">|</span>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#" style="color: white; font-family: 'Roboto', sans-serif;">Registro</a>
            </li>
            <li class="nav-item d-none d-lg-block">
               <a class="nav-link" href="#" style="color: white; font-family: 'Roboto', sans-serif;"><i class="fas fa-globe-americas"></i></a>
            </li>
         </ul>
      </div>
   </nav>






   <div class="container mt-4">
      <h1 class="catalog-title" style="font-size: 1.5rem; color: #53bc85; border-radius: 5px;">Catálogo en línea</h1>

      <!-- Filtros de categorías (Pestañas dinámicas) -->
      <div class="mt-4">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach ($categorias as $categoria)
               <li class="nav-item">
                  <a class="nav-link" id="tab{{ $categoria->id }}-tab" data-toggle="tab" href="#tab{{ $categoria->id }}" role="tab" aria-controls="tab{{ $categoria->id }}" aria-selected="false">{{ $categoria->nombre }}</a>
               </li>
            @endforeach
            <li class="nav-item">
               <a class="nav-link active" id="tab-all-tab" data-toggle="tab" href="#tab-all" role="tab" aria-controls="tab-all" aria-selected="true">Todas las categorías</a>
            </li>
         </ul>

         <div class="tab-content" id="myTabContent">
            @foreach ($categorias as $categoria)
               <div class="tab-pane fade" id="tab{{ $categoria->id }}" role="tabpanel" aria-labelledby="tab{{ $categoria->id }}-tab">
                  <div class="row mt-3">
                     @foreach ($productos->where('categoria_id', $categoria->id) as $producto)
                        <div class="col-6 col-md-4 col-lg-3 col-xl-2 mb-2">
                           <div class="product-card">
                              <div class="square-img" style="border: 1px solid #ddd; border-radius: 5px;">
                                 <img src="{{ $producto->image_url }}" class="card-img-top product-image" alt="Imagen de {{ $producto->nombre }}" data-toggle="modal" data-target="#productModal{{ $producto->id }}">
                              </div>
                              <h5 class="product-title text-center mt-2">{{ $producto->nombre }}</h5>
                           </div>
                        </div>
                     @endforeach
                  </div>
               </div>
            @endforeach

            <!-- Pestaña Todas las categorías -->
            <div class="tab-pane fade show active" id="tab-all" role="tabpanel" aria-labelledby="tab-all-tab">
               <div class="row mt-3">
                  @foreach ($productos as $producto)
                     <div class="col-6 col-md-4 col-lg-3 col-xl-2 mb-2">
                        <div class="product-card">
                           <div class="square-img" style="border: 1px solid #ddd; border-radius: 5px;">
                              <img src="{{ $producto->image_url }}" class="card-img-top product-image" alt="Imagen de {{ $producto->nombre }}" data-toggle="modal" data-target="#productModal{{ $producto->id }}">
                           </div>
                           <h5 class="product-title text-center mt-2">{{ $producto->nombre }}</h5>
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>

   <script>
   document.querySelectorAll('.product-image').forEach(image => {
      image.addEventListener('click', function() {
         const imageUrl = this.src;
         // Aquí obtenemos el nombre del producto a través de un atributo data o similar
         const productName = this.alt.replace('Imagen de ', '');

         Swal.fire({
            title: productName,  // El título de la modal es el nombre del producto
            html: `
               <h2>${productName}</h2>  <!-- El nombre del producto también se incluye aquí -->
               <img src="${imageUrl}" alt="Imagen del Producto" style="width: 100%; max-width: 300px; height: auto; border-radius: 8px;">
            `,
            showCloseButton: true,
            closeButtonHtml: '&times;',  
            focusConfirm: false,
            confirmButtonText: `<span>Contacta al vendedor</span> <i class="fab fa-whatsapp"></i>`,
            confirmButtonColor: '#25D366',
            background: '#f8f9fa',
            customClass: {
               popup: 'custom-popup',
               title: 'custom-title',
               confirmButton: 'custom-button',
               closeButton: 'custom-close-button'
            },
            showClass: {
               popup: 'animate__animated animate__slideInRight',
            },
            hideClass: {
               popup: 'animate__animated animate__slideOutRight',
            },
            preConfirm: () => {
               const whatsappUrl = `https://wa.me/50671249806?text=Hola,%20me%20interesa%20el%20producto:%20${encodeURIComponent(productName)}`;
               window.open(whatsappUrl, '_blank');
            },
            backdrop: `
               rgba(0, 0, 0, 0.8)
            `
         });
      });
   });
</script>

</body>
</html>
