<script setup>
import Layout from './Layout.vue'
import { Head } from '@inertiajs/vue3'
// import boardModal from './Modals/Board.vue';

defineProps({ board: Object, columns: Object })

function editColumn() {
  // boardModal.methods.open();
}
</script>

<template>
  <Layout>
    <Head title="Board " />
    <div class="grid h-screen"
        :style="{ backgroundImage: 'url('+board.background+')'}">

        <div class="columns">
            <div v-for="column in columns" class="glass column">
                <h4 class="text-lg font-bold px-2 py-1" :class="{'text-white': board.dark }">
                  <a class="float-right cursor-pointer" @click="editColumn()">⚙️</a>
                  {{ column.title }}
                </h4>
                <div v-for="card in column.cards" class="card cursor-pointer shadow-md">
                    <img :src="card.cover" />
                    <h6 class="px-2 py-1 title">{{ card.title }}</h6>
                </div>
            </div>
        </div>
        <!-- 

        
        <div>
          <h1 class="text-4xl">Hello Board!</h1>
          <div class="py-3">Here is your details:</div>
          <code class="block whitespace-pre border-dotted border-2 p-4" v-text="board"></code>
          {{ $filters.console(columns) }}
        </div>
         -->
      </div>
  </Layout>
</template>