<!DOCTYPE html>
<html lang="en" data-theme="bumblebee">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReGen</title>
  <!-- Custom CSS -->
  <link href="./assets/css/estilos.css" rel="stylesheet">

  <!-- DaisyUI -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <!--Animate.css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!--Google fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
</head>

<body class="bg-base-300 poetsen-one-regular text-gray-700">
  <!--Navbar-->
  <div class="navbar bg-white">
    <div class="navbar-start">
      <div class="dropdown">
        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
          </svg>
        </div>
        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
          <li><a href="#sobrenos">Sobre nós</a></li>
          <li><a href="#valores">Valores</a></li>
          <li><a href="#servicos">Serviços</a></li>
          <li><a href="#contactus">Contactos</a></li>
        </ul>
      </div>
      <img src="./assets/images/Logo_green.png" alt="" class="w-24 rounded-xl">
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal px-1">
        <li><a href="#sobrenos">Sobre nós</a></li>
        <li><a href="#valores">Valores</a></li>
        <li><a href="#servicos">Serviços</a></li>
        <li><a href="#contactus">Contactos</a></li>
      </ul>
    </div>
    <div class="navbar-end">
      <a class="btn btn-outline btn-success" onclick="location.href='login.php'">Login</a>
      <a class="btn btn-outline btn-success ml-2" onclick="location.href='signin.php'">Sign Up</a>
    </div>
  </div>

  <!--Conteúdo-->
  <!-- Seção de Imagem de Fundo -->
  <div class="bg-hero text-white text-center animate__bounceIn">
    <h1 class="text-4xl md:text-6xl lg:text-8xl font-bold">ReGen</h1>
    <p class="text-2xl md:text-3xl lg:text-4xl mt-4 font-bold"><br>Sempre a olhar para o futuro</p>
  </div>

  <!--Sobre nós-->
  <div id="sobrenos" class="container mx-auto p-8 animate__bounceIn">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
      <div class="bg-white p-6 rounded-lg flex items-center">
        <p class="text-2xl font-bold p-10 text-center ">SOMOS UM GINÁSIO DE ALTA QUALIDADE, DEDICADO À SAÚDE E BEM-ESTAR
          ACESSÍVEIS</p>
        <p class="text-lg leading-relaxed ">
          No ReGen, acreditamos que a saúde e o bem-estar são essenciais para uma vida equilibrada e feliz. Localizado
          no coração do Porto,
          o nosso ginásio oferece uma vasta gama de serviços e equipamentos modernos para ajudar os nossos membros a
          alcançar os seus objetivos de fitness e saúde.
        </p>
      </div>
    </div>
  </div>

  <!--Valores-->
  <div class="bg-hero2 w-full animate__bounceIn" id="valores">
    <div class="w-full grid grid-cols-1 md:grid-cols-1 rounded-lg" style="background-color: rgba(0, 0, 0, 0.6)">
      <div class="rounded-lg flex flex-col items-center text-white p-10">
        <p class="text-2xl font-bold text-center p-5">VALORES</p>
        <ul class="text-lg leading-relaxed list-disc list-inside text-left">
          <li>Excelência: Oferecemos serviços e atendimento de alta qualidade, sempre buscando superar as expectativas.</li>
          <li>Saúde e Bem-Estar: Encorajamos hábitos de vida equilibrados que promovem o bem-estar geral.</li>
          <li>Sustentabilidade: Implementamos práticas ecoeficientes e promovemos a consciência ambiental.</li>
          <li>Desenvolvimento Pessoal: Oferecemos oportunidades de crescimento contínuo para colaboradores e membros.</li>
          <li>Diversão: Criamos um ambiente dinâmico e prazeroso para que os treinos sejam desfrutados.</li>
        </ul>
      </div>
    </div>
  </div>
  
  

   <!--Serviços-->
   <div class="container mx-auto p-8 animate__bounceIn" id="servicos">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
      <div class="bg-white p-6 rounded-lg flex items-center">
        <p class="text-2xl  font-bold p-10 text-center">SERVIÇOS</p>
        <p class="text-lg  leading-relaxed">
        <ul class="list-disc pl-5 text-lg leading-relaxed">
          <li><strong>Instalações de Última Geração:</strong> O nosso ginásio está equipado com aparelhos de última
            geração, que incluem máquinas de cardio, pesos livres, e áreas específicas para treino funcional e
            musculação.</li>
          <li><strong>Sessões para Todos os Gostos:</strong> Oferecemos uma ampla variedade de sessoes para todos
            os níveis de condicionamento físico, conduzidas por instrutores experientes.</li>
          <li><strong>Fisiologistas:</strong> Nossos fisiologistas estão à disposição para criar planos de
            treino individuais adaptados às tuas necessidades e objetivos específicos.</li>
          <li><strong>Bem-Estar e Recuperação:</strong> Oferecemos serviços como sessões de
            fisioterapia e uma zona de relaxamento com bar.</li>
          <li><strong>Comunidade e Eventos:</strong> Organizamos regularmente eventos sociais e desportivos para que
            possas conhecer outros membros e partilhar a tua jornada.</li>
          <li><strong>Horários Flexíveis:</strong> Facilitamos a integração do exercício físico na tua rotina diária com
            horários alargados e opções de adesão flexíveis.</li>
        </ul>
        </p>
      </div>
    </div>
  </div>
  <!-- Seção de Contact Us -->
<!-- Seção de Contact Us -->
<div class="container mx-auto p-8 animate__bounceIn" id="contactus">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Informações de Contato -->
    <div class="bg-white p-6 shadow-lg rounded-lg">
      <h2 class="text-2xl font-bold mb-4">Contact Us</h2>
      <p class="text-lg text-gray-700 mb-2">Estamos aqui para ajudar! Entre em contato conosco se tiver alguma dúvida ou questão:</p>
      <ul class="list-disc pl-5 text-lg text-gray-700 leading-relaxed">
        <li><strong>Endereço:</strong> 123 Main Street, Cidade, País</li>
        <li><strong>Telefone:</strong> +123 456 789</li>
        <li><strong>Email:</strong> info@example.com</li>
      </ul>
    </div>
    <!-- Patrocinadores ao Lado do Contact Us -->
    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col justify-center items-center">
      <h2 class="text-2xl font-bold mb-4">Nossos Patrocinadores</h2>
      <div class="grid grid-cols-2 gap-4">
        <img src="assets/images/prozis.png" alt="Logo Patrocinador 1" class="w-32 h-32 object-contain rounded-lg">
        <img src="assets/images/continente.png" alt="Logo Patrocinador 2" class="w-32 h-32 object-contain rounded-lg">
        <img src="assets/images/veding.jpeg" alt="Logo Patrocinador 3" class="w-32 h-32 object-contain rounded-lg">
        <img src="assets/images/decathlon.png" alt="Logo Patrocinador 4" class="w-32 h-32 object-contain rounded-lg">
        <!-- Adicione mais logotipos conforme necessário -->
      </div>
    </div>
  </div>
</div>


  <!-- Mapa do Google -->
  <iframe class="rounded-lg container mx-auto p-8 mb-1" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3006.974343118382!2d-8.56638812505116!3d41.091407214303615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd247c851e69ff53%3A0xf5533b0ce7da193e!2sR.%20Her%C3%B3is%20do%20Ultramar%202506%2C%204430-330%20Vila%20Nova%20de%20Gaia!5e0!3m2!1spt-PT!2spt!4v1716746233149!5m2!1spt-PT!2spt" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

  <!-- Footer -->
  <footer class="footer items-center p-4 bg-neutral text-neutral-content">
    <div class="items-center grid-flow-col">
      <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
        clip-rule="evenodd" class="fill-current">
        <path
          d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z">
        </path>
      </svg>
      <p>Copyright © 2024 - All right reserved</p>
    </div>
    <div class="grid-flow-col gap-4 md:place-self-center md:justify-self-end">
      <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
          class="fill-current">
          <path
            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
          </path>
        </svg>
      </a>
      <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
          class="fill-current">
          <path
            d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z">
          </path>
        </svg></a>
      <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
          class="fill-current">
          <path
            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z">
          </path>
        </svg></a>
    </div>
  </footer>
 
</body>

</html>