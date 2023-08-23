<script>
  import { ref } from 'vue';
  let data = ref();
  let title = ref();

  export default {
    name: 'boardModal',
    setup() {
      return {data, title};
    },
    methods: {
      open(formData) {
        data.value = formData;
        title.value = formData.title;
      },
      close() {
        data.value = null;
      }
    }
  };
</script>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
const form = reactive(data)

function submit() {
  router.put('/board', form, {forceFormData: true});
}
</script>

<template>
  <div v-if="data" class="modal">
    <div class="glass container">
      <div class="modal-header">
        <a class="btn-close" @click="close()"></a>
        <h4 class="title">{{ title }}</h4>
      </div>
      <div class="modal-content">
        <form class="form" @submit.prevent="submit">
          <div class="form-input">
            <input type="text" v-model="form.title" id="title" placeholder="Title">
            <label for="title">Title</label>
          </div>
          <a class="cutter">⏬ Details ⏬</a>
          <div class="hide">
            <div class="form-file form-icon">
              <label for="icon">
                <img v-bind:src="form.icon" width="50">
                Icon
                <input type="file" @input="form.icon = $event.target.files[0]" id="icon" placeholder="Icon" style="display: none;">
              </label>
            </div>
            <div class="form-file">
              <label for="background">
                Background
                <img v-bind:src="form.background">
                <input type="file" @input="form.background = $event.target.files[0]"  id="background" placeholder="Background">
              </label>
            </div>
            <div class="flex">
              <div class="form-checkbox flex-1">
                <label>
                  <input type="checkbox" v-model="form.public">
                  Public
                </label>
              </div>
              <div class="form-checkbox flex-1">
                <label>
                  <input type="checkbox" v-model="form.dark">
                  Dark theme
                </label>
              </div>
            </div>
            <div>
              <button type="submit" class="button w-full">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
