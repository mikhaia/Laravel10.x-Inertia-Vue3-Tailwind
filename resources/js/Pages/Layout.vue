<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import boardModal from './Modals/Board.vue'

const page = usePage()

const openModal = (data) => {
  boardModal.methods.open(data)
}
</script>

<template>
<Toast></Toast>
<div class="grid grid-cols-7 h-screen">
  <aside class="col-span-1 bg-gray-800">
      <h1 class="text-white	text-4xl font-bold text-center py-4">{{ page.props.appName }}</h1>
      <nav class="sidenav">
        <li>
          <a @click="openModal({title: 'New Board'})" class="cursor-pointer">🆕 Create New Board</a>
        </li>
        <li :class="{'active' : $page.url.startsWith('/boards/'+item.id) }"
          v-for="item in page.props.boards">
          <button class="edit-board-btn" @click="openModal(item)">⚙️</button>
          <Link :href="'/boards/'+item.id">{{ item.title }}</Link>
        </li>
        <li :class="{'active' : $page.component === 'Index' }">
          <Link href="/">🏠 Home</Link>
        </li>
        <li :class="{'active' :$page.url.startsWith('/users/1') }">
          <Link href="/users/1">👤 User</Link>
        </li>
        <li><a></a></li>
      </nav>
    </aside>
    
    <main class="col-span-6 relative">
      <div class="user-panel">
        {{ page.props.user.name }}
        <Link href="/logout" class="exit">x</Link>
      </div>
      <slot />
      <boardModal></boardModal>
    </main>
</div>
</template>
