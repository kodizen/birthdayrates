 <template>
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
</template>
<script>
export default {
  data() {
    return {
      birthday: ""
    };
  },
  mounted() {},
  methods: {
    postBirthday(event) {
      console.log("postBirthday -> this.birthday", this.birthday);
      axios
        .post("/api/birthdays", {'birthday' : this.birthday})
        .then(function(response) {
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>