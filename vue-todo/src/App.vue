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
    //  axios.get('/src/db.php').then(function(result){
    //    console.log(result.data);
    //  }).catch();
		if (localStorage.length > 0) {
			for (var i = 0; i < localStorage.length; i++) {
        // this.todoItems.push([localStorage.key(i),localStorage.key(i)[1]]);
        // this.todoItems.push([localStorage.getItem(localStorage.key(i))]);
        var item = localStorage.getItem(localStorage.key(i));
        console.log(item);
        this.todoItems.push([item[0],item[1]]);
        console.log("item"+item[2]);
			}
		}
    },
  methods:{
    addTodo(todoItem){
      // 로컬 스토리지에 데이터를 추가
      localStorage.setItem(todoItem[0],todoItem);
      this.todoItems.push(todoItem);
    },
    editTodo(todoItem,index){
      console.log(todoItem);
      //localStorage.setItem(todoItem,todoItem);
      //this.todoItems.splice(index,1,todoItem);
      
    },
    clearAll(){
      localStorage.clear();
      this.todoItems=[];
    },
    removeTodo(todoItem,index){
      localStorage.removeItem(todoItem);
      this.todoItems.splice(index,1);
    },
    checkTodo(todoItem,index){
      localStorage.setItem(todoItem[0],[todoItem[0],!todoItem[1]]);
      this.todoItems.splice(index,1,[todoItem[0],!todoItem[1]]);
      console.log("check");
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
