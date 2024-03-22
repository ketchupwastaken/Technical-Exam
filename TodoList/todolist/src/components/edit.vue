<template>
  <div class="col-md-11 mb-5">
    <center><h2>Edit Todo List</h2></center>

    <form @submit.prevent="confirmSave">
      <div class="mb-3">
        <label for="name" class="form-label text-white">Tasks</label>
        <input type="text" id="tasks" class="form-control" v-model="data.tasks" required />
      </div>
      <div class="mb-3">
        <label for="name" class="form-label text-white">Status</label>
        <input type="text" id="status" class="form-control" v-model="data.status" required />
      </div>

      <button type="submit" class="btn btn-success w-100">UPDATE</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import moment from 'moment'
  const formattedDate = moment().utcOffset(8).format('YYYY-MM-DD hh:mm A');
  console.log(formattedDate)

export default {
  data() {
    return {
      idVal: '',
      data: {
        tasks: '',
        status: '',
        updated_at: formattedDate
      }
    }
  },
  mounted() {
    this.idVal = this.$route.params.id
    this.getData(this.$route.params.id)
  },
  methods: {
    getData(id) {
      axios
        .get(`http://127.0.0.1:8000/api/${id}/edit`)
        .then((res) => {
          this.data.tasks = res.data.todo.tasks
          this.data.status = res.data.todo.status
        })
        .catch((error) => {
          if (error.response) {
            if (error.response.status == 404) {
              alert(error.response.data.message)
              this.$router.push('/')
            }
          }
        })
    },
    confirmSave() {
      if (window.confirm('Are you sure you want to update?')) {
        this.updateData();
      } else {
        // Cancel
      }
    },

    updateData() {
      var editrecords = 'http://127.0.0.1:8000/api/' + this.idVal+'/edit';
      const jsonData = JSON.stringify(this.data);

        fetch(editrecords, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: jsonData
        })
        .then((response) => {
            if (!response.ok) {
              throw new Error('Network response was not ok')
            }
            return response.json()
        })
        .then((data) => {
            console.log('Response from Laravel:', data);
            this.data.tasks = '';
            this.data.status = '';

            alert('Data has been Updated Successfully.');
            this.$router.push('/');
        })
        .catch((error) => {
            console.error('Error sending data to Laravel:', error);
            alert("There's an error occured.");
        })
    }
  }
}
</script>

<style scoped>
h1 {
  font-weight: 500;
  font-size: 2.6rem;
  position: relative;
  top: -10px;
}

h3 {
  font-size: 1.2rem;
}

.greetings h1,
.greetings h3 {
  text-align: center;
}

@media (min-width: 1024px) {
  .greetings h1,
  .greetings h3 {
    text-align: left;
  }
}
</style>
