 <template>
  <div>
    <div class="container">
      <div class="alert alert-success" v-if="success" role="alert">{{success}}</div>
      <div class="alert alert-danger" v-if="error" role="alert">{{error}}</div>
      <div class="input-group mb-3">
        <input
          type="text"
          class="form-control"
          placeholder="Enter Your birthday in Y-m-d format"
          aria-label="Enter Your birthday in Y-m-d format"
          aria-describedby="basic-addon2"
          v-model="birthday"
        />
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" v-on:click="postBirthday" type="button">Submit</button>
        </div>
      </div>
    </div>
    <div class="container">
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Birthday</th>
            <th scope="col">Base</th>
            <th scope="col">GBP</th>
            <th scope="col">USD</th>
            <th scope="col">CAD</th>
            <th scope="col">JPY</th>
            <th scope="col">Occurrences</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="rate in rates" :key="rate.id">
            <th>{{rate.formatted_birthday}}</th>
            <th>{{rate.base}}</th>
            <th>{{rate.GBP}}</th>
            <th>{{rate.USD}}</th>
            <th>{{rate.CAD}}</th>
            <th>{{rate.JPY}}</th>
            <th>{{rate.occurrences}}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      rates: [],
      birthday: "",
      error: null,
      success: null
    };
  },
  mounted() {
    this.getBirthdays();
  },
  methods: {
    getBirthdays() {
      axios.get("/api/birthdays").then(response => {
        this.error = null;
        this.rates = response.data;
      });
    },
    postBirthday(event) {
      let self = this;
      axios
        .post("/api/birthdays", { birthday: this.birthday })
        .then(function(response) {
          self.success = "🎂 submitted successfully!";
          self.error = null;
          self.getBirthdays();
        })
        .catch(function(error) {
          self.success = null;
          if (error.response.data.errors) {
            self.error = error.response.data.errors;
          } else {
            self.error =
              "Something went wrong! Check your date format and try again.";
          }
        });
    }
  }
};
</script>