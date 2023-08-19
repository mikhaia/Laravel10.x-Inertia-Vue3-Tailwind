<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
<div class="grid grid-cols-7">
    <aside class="col-span-1 bg-gray-800">
      <nav class="sidenav">
        <li :class="{'active' : $page.component === 'Index' }">
          <Link href="/">🏠 Home</Link>
        </li>
        <li :class="{'active' : $page.component === 'Show' }">
          <Link href="/users/1">👤 User</Link>
        </li>
      </nav>
    </aside>
    
    <main class="col-span-6">
      <slot />
    </main>
</div>
</template>