<script setup>
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()

defineProps({ menu: String })
</script>

<template>
<div class="grid grid-cols-7">
  <aside class="col-span-1 bg-gray-800">
      <h1 class="text-white	text-4xl font-bold text-center py-4">{{ page.props.appName }}</h1>
      <nav class="sidenav">
        <li v-for="item in page.props.boards"
          :class="{'active' : $page.url.startsWith('/board/'+item.id) }"
          >
          <Link :href="'/board/'+item.id">{{  item.title }}</Link>
        </li>
        <li :class="{'active' : $page.component === 'Index' }">
          <Link href="/">🏠 Home</Link>
        </li>
        <li :class="{'active' : $page.component === 'Show' }">
          <Link href="/users/1">👤 User</Link>
        </li>
        <li><a></a></li>
      </nav>
    </aside>
    
    <main class="col-span-6">
      <slot />
    </main>
</div>
</template>