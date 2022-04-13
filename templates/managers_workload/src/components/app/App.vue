<template>
  <div class="todo-app">
    <h3>Задания: {{message}}</h3>
    <input type="text" v-bind:value="rezolveMessage">
  </div>
  <!-- Теперь можно собрать наше приложение командой npm run build либо запустить слежение за файлами при изменении командой npm run watch. -->
</template>

<style lang="scss" src="./App.scss"></style>

<script>
    export default {
        name: 'App',
        data(){

          return {
            rezolveMessage:1,
            message: 'asdasdad',
           }    
        },
        mounted: function () {
          // console.log(this);
        },
        computed:{
          async message(){
            //  this.message == val;
             return rezolveMessage;
          }
        },
    }
</script>



