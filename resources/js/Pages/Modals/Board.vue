<script>
  import { ref } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  let data = ref();
  let title = ref();
  let displayDetails = ref();
  let form = ref();
  let errors = ref();

  export default {
    name: 'boardModal',
    setup() {
      return {data, title};
    },
    methods: {
      open(value) {
        const formData = {
          title: value.title,
          icon: value.icon,
          background: value.background,
          public: value.public || false,
          dark: value.dark || false,
        };
        if (value.id) {
          formData._method = 'PUT';
        }
        form = useForm(formData);
        data.value = value;
        title.value = value.title;
      },
      close() {
        data.value = null;
      },
      submit() {
        if (data.value.id) {
          form.post('/boards/' + data.value.id, {
            forceFormData: true,
            onError: (err) => {
              errors = err.msg;
            },
            onSuccess: () => {
              console.log('ello');
            }
          })
        } else {
          form.post('/boards', {
            forceFormData: true,
            onError: (err) => {
              errors = err.msg;
            },
            onSuccess: () => {
              console.log('ello');
            }
          })
        }
      }
    }
  };
</script>

<script setup>

// 


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
          <a class="cutter" @click="displayDetails = !displayDetails" :class="{expand: displayDetails}">
            <span class="icon">⏬</span> Details <span class="icon">⏬</span>
          </a>
          <div :class="{ hidden: !displayDetails }">
            <div class="form-file form-icon">
              <label for="icon">
                <img v-bind:src="form.icon" width="50" v-if="form.icon">
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
                  Dark back
                </label>
              </div>
            </div>
          </div>
          <div>
            <button type="submit" class="button w-full">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
