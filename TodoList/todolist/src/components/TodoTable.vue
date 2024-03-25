<script setup>
import 'bootstrap-icons/font/bootstrap-icons.css'
</script>

<template>
        <center><h2>Todo List Table</h2></center>
        <table class="table table-dark table-hover">
            <thead >
            <tr class="tblHead">
                <th>ID</th>
                <th>TASKS</th>
                <th>STATUS</th>
                <th>DATE CREATE</th>
                <th>DATE UPDATED</th>
                <th colspan="2">ACTION</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in data" :key="item.id">
                <th scope="row">{{ item.id }}</th>
                <td>{{ item.tasks }}</td>
                <td>{{ item.status }}</td>
                <td>{{ format_date(item.created_at) }}</td>
                <td>{{ format_date(item.updated_at) }}</td>
                <td>
                    <RouterLink :to="{path: item.id+'/edit-todo'}">
                        <button class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                    </RouterLink>
                
                </td>
                <td>
                    <button type="button" @click="checkDelete(item.id)" 
                    class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </td>
                
            </tr>
            </tbody>
        </table>
</template>

<script>
import axios from 'axios';
import moment from 'moment';

export default {
  data() {
    return {
      data: []
    }
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get('http://127.0.0.1:8000/api/get')
        .then((response) => {
          this.data = response.data
        })
        .catch((error) => {
          console.error('Error fetching data:', error)
        })
    },
    format_date(value){
        if (value) {
            return moment(value).utcOffset(0).format('YYYY-MM-DD hh:mm A');
        }
    },
    checkDelete(id) {
      if (window.confirm('Are you sure you want to delete?')) {
        this.remove(id);
      } else {
        // Cancel
      }
    },
    remove(id){
      var url = `http://127.0.0.1:8000/api/${id}/delete`;
      axios.delete(url);
      alert('Data has been deleted Successfully.');
      this.fetchData();
    }
  }
}


</script>



<style>
.mr-2 {
  margin-right: 5px !important;
}
.tblHead{
    text-align: center;
}
</style>
