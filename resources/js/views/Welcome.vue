 <template>
  <div>
    <add-birthday></add-birthday>
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
import AddBirthday from "../views/AddBirthday";

export default {
  data() {
    return {
      rates: []
    };
  },
  mounted() {
    axios.get("/api/birthdays").then(response => {
      console.log(response.data);
      this.rates = response.data;
    });
  },
  components: {
    "add-birthday": AddBirthday
  }
};
</script>