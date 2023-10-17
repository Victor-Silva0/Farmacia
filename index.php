<?php 
require "connection.php";
require_once "header_inc.php"; 
?>
<link rel="stylesheet" href="css/style.css">
<style>
  body {background-color: #d8f2f3; font-family: 'Lato', sans-serif;}
  .container {margin-top: 30px; margin-bottom: 20px; color: #133a3a;} 
  .container > a{border: 10px solid #133a3a; border-radius: 15px;}
  .container1 {color: white; margin-top: 30px; padding: 50px; background-color: #133a3a;}
</style>

<div class="container">
  <div id="farmaciaCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active text-center">
        <h1>Medicamentos</h1>
        <a href="link-para-medicamentos.html" style="border: 10px solid #133a3a; border-radius: 15px; display: inline-block;">
          <img src="images/1.jpg" alt="Medicamentos" style="margin: 0 auto;">
        </a>
      </div>
      <div class="carousel-item text-center">
        <h1>Suplementos e Vitaminas</h1>
        <a href="link-para-suplementos.html" style="border: 10px solid #133a3a; border-radius: 15px; display: inline-block;">
          <img src="images/2.jpg" alt="Suplementos e Vitaminas" style="margin: 0 auto;">
        </a>
      </div>
      <div class="carousel-item text-center">
        <h1>Beleza</h1>
        <a href="link-para-beleza.html" style="border: 10px solid #133a3a; border-radius: 15px; display: inline-block;">
          <img src="images/3.jpg" alt="Beleza" style="margin: 0 auto;">
        </a>
      </div>
      <div class="carousel-item text-center">
        <h1>Higiene</h1>
        <a href="link-para-higiene.html" style="border: 10px solid #133a3a; border-radius: 15px; display: inline-block;">
          <img src="images/4.jpg" alt="Higiene" style="margin: 0 auto;">
        </a>
      </div>
    </div>
    <a class="carousel-control-prev" href="#farmaciaCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" style="background-color: #133a3a; border-radius: 10px; padding: 25px;" aria-hidden="true"></span>
      <span class="sr-only"></span>
    </a>
    <a class="carousel-control-next"  href="#farmaciaCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" style="background-color: #133a3a; border-radius: 10px; padding: 25px;" aria-hidden="true"></span>
      <span class="sr-only"></span>
    </a>
  </div>
</div>

<div class="container1">
  <h1 class="text-white text-center">Nossos Produtos</h1>
  <div class="d-flex justify-content-center align-items-center text-center" style="min-height: 100vh;">
    <div class="row g-5 py-5">

      <div class="col-md-6 col-lg-6">
        <div class="context-box">
          <h2 class="text-white">Medicamentos</h2>
          <a href="link-para-medicamentos.html">
            <img src="images/1.jpg" class="d-block mx-lg-auto img-fluid border border-success rounded" alt="Contexto 2" width="700" height="500" loading="lazy">
          </a><br>
          <p class="lead">Descubra nossa ampla variedade de medicamentos de alta qualidade, cuidadosamente selecionados para atender às suas necessidades de saúde. Na nossa farmácia, você encontrará medicamentos confiáveis e acessíveis para o tratamento e prevenção de diversas condições. Conte com nossos farmacêuticos experientes para fornecer orientações personalizadas e garantir que você receba o melhor cuidado para o seu bem-estar.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-6 text-center">
        <div class="context-box">
          <h2 class="text-white">Suplementos e Vitaminas</h2>
          <a href="link-para-suplementos.html">
            <img src="images/2.jpg" class="d-block mx-lg-auto img-fluid border border-success rounded" alt="Contexto 2" width="700" height="500" loading="lazy">
          </a><br>
          <p class="lead">Explore nossa gama de suplementos e vitaminas de alta qualidade, projetados para impulsionar sua saúde e bem-estar. Nossos suplementos são formulados para atender às suas necessidades específicas, desde fortalecimento do sistema imunológico até suporte para um estilo de vida ativo. Conte com a nossa farmácia para encontrar os melhores suplementos e vitaminas que ajudarão você a alcançar seus objetivos de saúde.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-6 text-center">
        <div class="context-box">
          <h2 class="text-white">Beleza</h2>
          <a href="link-para-beleza.html">
            <img src="images/3.jpg" class="d-block mx-lg-auto img-fluid border border-success rounded" alt="Contexto 3" width="700" height="500" loading="lazy">
          </a><br>
          <p class="lead">Descubra o segredo para realçar sua beleza natural com nossa coleção de produtos de beleza. Na nossa farmácia, oferecemos uma variedade de cosméticos e cuidados com a pele de alta qualidade para realçar a sua aparência e realçar a sua autoestima. Encontre os melhores produtos de beleza, desde maquiagem luxuosa até cuidados com a pele rejuvenescedores, para que você possa desfrutar de uma aparência radiante e confiante todos os dias.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-6">
        <div class="context-box">
          <h2 class="text-white">Higiene</h2>
          <a href="link-para-higiene.html">
            <img src="images/4.jpg" class="d-block mx-lg-auto img-fluid border border-success rounded" alt="Contexto 4" width="700" height="500" loading="lazy">
          </a><br>
          <p class="lead">Mantenha-se saudável e limpo com a nossa seleção de produtos de higiene de alta qualidade. Na nossa farmácia, cuidamos da sua saúde e bem-estar, oferecendo uma ampla gama de produtos de higiene pessoal. Desde produtos básicos, como sabonetes e escovas de dentes, até opções especializadas para cuidados específicos, você encontrará tudo o que precisa para manter uma rotina diária de higiene eficaz. Cuide de si e de sua família com os melhores produtos de higiene disponíveis.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once "footer_inc.php"; ?>