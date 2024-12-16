<template>
    <div class="wrapper">
      <Header />
      <h1 class="p-2">{{ user }}</h1>
      <main class="home-content mt-8">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
          We invest in the world’s potential
        </h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
          Here at Flowbite we focus on markets where technology, innovation, and
          capital can unlock long-term value and drive economic growth.
        </p>
      </main>
        <Botao />
      <Footer />
    </div>
  </template>

    <script>
  import Header from "@/Pages/Header.vue";
  import Footer from "@/Pages/Footer.vue";
  import Botao from "@/Components/Botao.vue";

  import "@assets/css/style.css"; //configure no vite.js o @assets
  import "@assets/css/app.css"; //configure no vite.js o @assets

  export default {
    components: {
      Header,
      Footer,
      Botao
    },
    props: {
      user: String,
    },
  };
  </script>
