<template>
    <button
      @click="handleClick" class="text-gray-700 px-4 py-2 ">
      {{ texto }}
    </button>
  </template>

    <script>
  export default {
    props: {
      texto: {
        type: String,
        default: "Botão Default", // Texto padrão caso nenhum seja passado
      },
    },
    methods: {
      handleClick() {
        this.$emit("click");
      },
    },
  };
  </script>
