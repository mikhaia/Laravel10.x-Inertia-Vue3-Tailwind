<script>
  import { ref } from 'vue';
  import { useForm, usePage } from '@inertiajs/vue3';
  import Toast from '../Inc/Toast.vue';
  let data = ref();
  let title = ref();
  let form = ref();
  let errors = ref();
  let positions = ref();
  const focus = ref();
  const page = usePage();
  export default {
    name: 'cardModal',
    setup() {
      return {data, title};
    },
    methods: {
      open(value) {
        const formData = {
          title: value.title,
          cover: value.cover,
          position: value.position,
          progress: value.progress,
          todo: value.todo,
          description: value.description,
          column_id: value.column_id
        };
        console.log(formData);
        if (value.id) {
          formData._method = 'PUT';
        }

        positions = page.props.columns;

        form = useForm(formData);
        data.value = value;
        title.value = value.title;
        setTimeout(() => focus.value.focus(), 100);
      },
      close() {
        data.value = null;
      },
      submit() {
        let url = '/cards/';
        form.todo = document.getElementById('todo').value;
        if (data.value.id) url += data.value.id;
        form.post(url, {
            forceFormData: true,
            onError: (err) => {
              errors = err.msg;
            },
            onSuccess: () => {
              Toast.show('Card saved successfully', 'success');
              this.close();
            }
          })
      },
      image(event) {
        changeCover(event.target.files);
      }
    }
  };

function textareaKeys(e) {
  const target = e.target;
  if(e.keyCode === 9) {
    target.setRangeText('\t', target.selectionStart, target.selectionStart, 'end');
    e.preventDefault();
  }
}

function changeCover(files) {
  const file = files[0];
  if (file.type === 'image/png' || file.type === 'image/jpeg') {
    form.cover = file;
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
      document.getElementById('cover').previousSibling.src = reader.result;
    }
  }
}

window.addEventListener('paste', event => {
  changeCover(event.clipboardData.files);
})
</script>

<script setup>
const todoExample = 
`Example:
- An undone task
+ Finished group
  + Finished item
`;
// 
</script>

<template>
  <div v-if="data" class="modal">
    <div class="glass container card-container">
      <div class="modal-header">
        <a class="btn-close" @click="close()"></a>
        <h4 class="title">{{ title }}</h4>
      </div>
      <div class="modal-content">
        <form class="form flex gap-5" @submit.prevent="submit">
          <div class="flex-1">
          <div class="form-input pt-5 pb-2.5">
            <input type="text" v-model="form.link" id="link" placeholder="Link" ref="focus">
            <label for="link">Link (Will try to fill the empty fields)</label>
          </div>
          <div class="form-input pt-5 pb-2.5">
            <input type="text" v-model="form.title" id="title" placeholder="Title">
            <label for="title">Title</label>
          </div>
          <div class="form-input form-textarea pt-5">
            <textarea type="text" v-model="form.description" id="description" placeholder="Description" @keydown="textareaKeys($event)"></textarea>
            <label for="description">Description</label>
          </div>
          <div class="form-file pt-2.5">
              <label for="cover">
                Cover
                <img v-bind:src="form.cover">
                <input type="file"
                  id="cover"
                  @input="form.cover = $event.target.files[0]"
                  @change="image($event)">
              </label>
          </div>
        </div>
        <div class="flex-1">
          <div class="flex flex-col h-full gap-3">
            <div class="form-textarea form-todo flex-1">
              <label for="todo" class="leading-5">Todo:</label>
              <textarea v-model="form.todo" id="todo" :placeholder="todoExample" @keydown="textareaKeys($event)"></textarea>
            </div>
            <div>
              <button type="submit" class="button w-full">Save</button>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</template>
