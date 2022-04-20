<template>
  <div class="todo-app">
    <p v-for="(item, key) in managers" :key="key">
      {{ item }} <br/>
      {{ key }}
    </p>
  </div>
  <!-- Теперь можно собрать наше приложение командой npm run build либо запустить слежение за файлами при изменении командой npm run watch. -->
</template>

<style lang="scss" src="./App.scss"></style>

<script>
    export default {
        name: 'App',
        data(){
          return {
            managers: JSON.parse(window.managers)
           }    
        },
        mounted() {
          console.log(this.managers)
        }
    }
</script>



