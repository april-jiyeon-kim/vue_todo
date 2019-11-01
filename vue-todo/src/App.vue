<template>
  <div id="app">
    <TodoHeader></TodoHeader>
    <TodoInput v-on:addTodo="addTodo"></TodoInput>
    <TodoList  v-bind:propsdata="todoItems" v-on:checkTodo="checkTodo" @editTodo="editTodo" @removeTodo="removeTodo"></TodoList>
    <TodoFooter v-on:removeAll="clearAll"></TodoFooter>
  </div>
</template>

<script>
import TodoHeader from './components/TodoHeader.vue'
import TodoInput from './components/TodoInput.vue'
import TodoList from './components/TodoList.vue'
import TodoFooter from './components/TodoFooter.vue'
export default {
  data(){
    return {
      todoItems:[]
    }
  },
   created() {
        axios({
              url: 'http://localhost:8888/todo/db.php',
              method: 'post',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              },
              data: {
                  mode:'show'
                }
            }).then(response=>{
              fetch = response.data.fetch;
              if(fetch.length>0){
                for(var i =0;i<fetch.length;i++){
                  this.todoItems.push([fetch[i].id,fetch[i].content,fetch[i].status]);
                }
              }
            });   
		
    },
  methods:{
    showTodo(){
       axios({
              url: 'http://localhost:8888/todo/db.php',
              method: 'post',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              },
              data: {
                  mode:'show'
                }
            }).then(response=>{
              console.log(response.data.fetch)
            });
    },
    addTodo(todoItem){
      // 로컬 스토리지에 데이터를 추가
      // this.todoItems.push(todoItem);
      // localStorage.setItem(todoItem.id,JSON.stringify(todoItem));
      // db 저장
      axios({
              url: 'http://localhost:8888/todo/db.php',
              method: 'post',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              },
              data: {
                  mode:'add',
                  content:todoItem.content
                }
            }).then(response=>{
              console.log(response.data.id);
              this.todoItems.push([response.data.id,todoItem.content,0]);
            });
    },
    editTodo(todoItem,index){
       axios({
              url: 'http://localhost:8888/todo/db.php',
              method: 'post',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              },
              data: {
                  mode:'edit',
                  content:todoItem.content,
                  id:todoItem.id
                }
            }).then(response=>{
            });
    },
    clearAll(){
       axios({
              url: 'http://localhost:8888/todo/db.php',
              method: 'post',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              },
              data: {
                  mode:'delete',
                  type:'all'
                }
            }).then(response=>{
            });
      this.todoItems=[];
    },
    removeTodo(todoItem,index){
      axios({
              url: 'http://localhost:8888/todo/db.php',
              method: 'post',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              },
              data: {
                  mode:'delete',
                  type:'single',
                  id:todoItem.id
                }
            }).then(response=>{
            });
      this.todoItems.splice(index,1);
    },
    checkTodo(todoItem,index){
       axios({
              url: 'http://localhost:8888/todo/db.php',
              method: 'post',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
              },
              data: {
                  mode:'check',
                  id: todoItem.id,
                  status:(todoItem.status=="0")?"1":"0"
                }
            }).then(response=>{
              this.todoItems.splice(index,1,[todoItem.id,todoItem.content,response.data.filtered.status]);
            });
    }
    
  },
  components: {
    'TodoHeader': TodoHeader,
    'TodoInput': TodoInput,
    'TodoList': TodoList,
    'TodoFooter': TodoFooter

  }
}
</script>

<style>
  body{
    text-align: center;
    background-color: #F6F6F8;
  }
  input{
    border-style: groove;
    width: 200px;
  }
  button {
    border-style: groove;
  }
  .shadow {
    box-shadow: 5px 10px 10px rgba(0,0,0,0.03)
  }
</style>
