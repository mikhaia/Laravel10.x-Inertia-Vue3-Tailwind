<script setup>
import Layout from './Layout.vue'
import cardModal from './Modals/Card.vue';
import axios from 'axios'
import { Head } from '@inertiajs/vue3'
import showdown from 'showdown';

import columnModal from './Modals/Column.vue';
const props = defineProps({ board: Object, columns: Object })

const openModal = (data) => {
  columnModal.methods.open(data)
}

const openCardModal = (data) => {
    cardModal.methods.open(data);
}

const converter = new showdown.Converter();
converter.setOption('simpleLineBreaks', true);

function toHtml(text) {
  text = converter.makeHtml(text);
  text = text.replace(/\[ \]/g, '<input type="checkbox" onclick="event.stopPropagation()">');
  text = text.replace(/\[x\]/g, '<input type="checkbox" checked onclick="event.stopPropagation()">');
  return text;
}

function toTodo(text) {
  const list = text.match(/[^\r\n]+/g);
  const todo = [];
  const result = [];
  list.forEach(item => {
    const trimed = item.trim()
    const text = trimed.charAt(0) === '-' || trimed.charAt(0) === '+' ? trimmed.substring(1) : trimed;
    todo.push({
      done: trimed[0] === '+',
      text: text,
      lvl: 'todo' 
    });
    console.log(item.trim()[0]);
    // item = item.replace(/\s/g, '&nbsp;');
    // item = item.replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;');
    // todo.push('<input type="checkbox"> ' + item);
  });
  return text;
  // return todo.join('<br />');
}

/* Drag'n'Drop */
// TODO: Refactoring Drag'n'Drop
document.addEventListener("dragstart", function(event) {
  event.dataTransfer.setData("Text", event.target.id);
  event.target.classList.add('moving');
});

document.addEventListener("drag", function(event) {
  
});

document.addEventListener("dragend", function(event) {
    event.target.classList.remove('moving');
});

document.addEventListener("dragenter", function(event) {
    if ( event.target.classList.contains("droptarget") ) {
        event.target.classList.add('active');
    }
});

document.addEventListener("dragover", function(event) {
    event.preventDefault();
});

document.addEventListener("dragleave", function(event) {
    if ( event.target.classList.contains("droptarget") ) {
      event.target.classList.remove('active');
    }
});

document.addEventListener("drop", function(event) {
    event.preventDefault();
    if ( event.target.classList.contains("droptarget") ) {
       const parent = event.target.closest('.drag-container');
       parent.insertBefore(document.getElementById(event.dataTransfer.getData("Text")), event.target.closest('.drag').nextSibling)
        
        event.target.classList.remove('active');
        const order = [];
        for (var i = 0; i < parent.children.length; i++) {
          if (parent.children[i].classList.contains('drag'))
            order.push(parent.children[i].id);
        }

        axios.put('/columns/sort/'+props.board.id, order);
    }
});
</script>

<template>
  <Layout>
    <Head title="Board " />
    <div class="board"
        :style="[board?.background ? { backgroundImage: 'url('+board?.background+')'} : {}]">
        <div class="columns drag-container">
          <!-- TODO: Add droptaget to fisrt place <div class="droptarget"></div> -->
          <div v-for="column in columns" draggable="true" :id="column.id" class="drag">
            <div class="glass column">
                <h4 class="text-lg font-bold px-2 py-1" :class="{'text-white': board.dark }">
                  <a class="float-right cursor-pointer" @click="openModal(column)">⚙️</a>
                  {{ column.title }}
                </h4>
                <template v-for="card in column.cards">
                  <!-- <Card :card="card"></Card> -->
                  <div class="card cursor-pointer shadow-md" @click="openCardModal(card)">
                      <img :src="card.cover" />
                      <h6 class="px-2 py-1 title" :class="{'top-title': card.description || card.todo }">{{ card.title }}</h6>
                      <div v-if="card.description" class="description" v-html="toHtml(card.description)"></div>
                      <div v-if="card.todo" class="checklist" v-html="toTodo(card.todo)"></div>
                  </div>
                </template>
                <a class="btn-create glass" @click="openCardModal({title: '', column_id: column.id})">Create new</a>
            </div>
            <div class="droptarget"></div>
          </div>
            <div class="glass column add" @click="openModal({title: 'New column', board_id: board.id})"></div>
        </div>
      </div>
      <columnModal></columnModal>
      <cardModal></cardModal>
  </Layout>
</template>