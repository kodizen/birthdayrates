 <template>
  <div>
    <div class="container">
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
      birthday: ""
    };
  },
  mounted() {
    this.getBirthdays();
  },
  methods: {
    getBirthdays() {
      axios.get("/api/birthdays").then(response => {
        this.rates = response.data;
      });
    },
    postBirthday(event) {
      let self = this;
      axios
        .post("/api/birthdays", { birthday: this.birthday })
        .then(function(response) {
          self.getBirthdays();
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>