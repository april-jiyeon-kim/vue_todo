<template>

    <section>
        <!-- <transition-group name="list" tag="ul"> -->
        <ul>
            <li v-for="(todoItem, index) in propsdata" :key="index" class="shadow">
                <!-- <i class="checkBtn fas fa-check" aria-hidden="true"></i> -->
                <span @click="checkTodo(todoItem,index)">
                    <i class="checkBtn far" v-bind:class="parseInt(todoItem[2])?'fa-check-square':'fa-square'"></i>
                </span>
                <!-- <input type="text" v-model="newTodoItem[index]"  v-on:keyup.enter="editTodo"> -->
                <span>
                    <input  v-bind:class="parseInt(todoItem[2])?'redLine':''" type="text" v-model="todoItem[1]" placeholder="Type what you have to do" v-on:keyup.enter="addTodo">
                </span>
                <span class="editBtn" type="button" @click="editTodo(todoItem, index)">
                    <i class="far fa-edit" aria-hidden="true"></i>
                </span>
                <span class="removeBtn" type="button" @click="removeTodo(todoItem, index)">
                    <i class="far fa-trash-alt" aria-hidden="true"></i>
                </span>
            </li>
        </ul>
        <!-- </transition-group> -->
    </section>
</template>

<script>
export default {
    props:['propsdata'],
    data() {
        return {
            newTodoItem:[]
        }
    },
    methods: {
        editTodo(todoItem,index){
            this.$emit('editTodo',{id:todoItem[0],content:todoItem[1]},index);
        },
        removeTodo(todoItem,index){
            this.$emit('removeTodo',{id:todoItem[0]},index);
        },
        checkTodo(todoItem,index){
            this.$emit('checkTodo',{id:todoItem[0],content:todoItem[1],status:todoItem[2]},index);
        },
        getPHP(){
            axios({
                url: 'http://localhost:8888/todo/db.php',
                method: 'post',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                data: {
                    mode:'show'
                }
                }).then(response=>console.log(response.data.fetch));
            }
    }
}
</script>

<style scoped>
    /* .list-enter-active, .list-leave-active {
        transition: all 1s;
    }
    .list-enter, .list-leave-to {
        opacity: 0;
        transform: translateY(30px);
    } */
    ul {
        list-style-type: none;
        padding-left:0px;
        margin-top:0;
        text-align: left;
    }

    li {
        display: flex;
        min-height: 50px;
        height: 50px;
        line-height: 50px;
        margin:0.5rem 0;
        padding: 0 0.9rem;
        background:white;
        border-radius:5px;
    }
    .checkBtn {
        line-height: 45px;
        color: #62acde;
        margin-right: 5px;
    }
    .removeBtn {
        margin-left: 10px;
        color:#de4343;
    }
    .editBtn {
        margin-left:auto;
        color:#de4343;
    }
    .redLine {
        text-decoration: line-through;
        text-decoration-color: red;
    }
</style>