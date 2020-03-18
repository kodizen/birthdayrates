 <template>
  <div class="container">
    <div class="m-b-md">
      <h2 class="title m-b-md">Welcome to Birthday Rates</h2>
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
      rates: []
    };
  },
  mounted() {
    axios.get("/api/birthdays").then(response => {
    
    console.log(response.data)
    this.rates = response.data
        
    });
  }
};
</script>