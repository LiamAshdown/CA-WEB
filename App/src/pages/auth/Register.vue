<template>
  <v-container class="register">
    <div class="register__title">
      <v-img
        src="@/assets/images/profile_details.svg"
      ></v-img>
    </div>
    <div class="register__form elevation-6">
      <p class="text-body-1 font-weight-light">We just need a few details to get you started.</p>
      <v-form @submit.prevent="register">
        <v-text-field
          v-model="form.firstName"
          label="First Name"
          type="text"
          counter="30"
          :error-messages="errors.firstName"
          outlined
          required
        ></v-text-field>

        <v-text-field
          v-model="form.lastName"
          label="Last Name"
          type="text"
          counter="30"
          :error-messages="errors.lastName"
          outlined
          required
        ></v-text-field>

        <v-text-field
          v-model="form.email"
          label="Email"
          type="email"
          :error-messages="errors.email"
          outlined
          required
        ></v-text-field>

        <v-text-field
          v-model="form.password"
          label="Password"
          type="password"
          :error-messages="errors.password"
          outlined
          required
        ></v-text-field>

        <v-btn
          depressed
          color="primary"
          type="submit"
          block
        >Next</v-btn>
      </v-form>
    </div>
  </v-container>
</template>

<script>
export default {
  name: 'RegisterPage',

  data () {
    return {
      form: {
        firstName: '',
        lastName: '',
        email: '',
        password: ''
      },
      errors: {}
    }
  },
  methods: {
    async register () {
      try {
        await this.$store.dispatch('registerUser', this.form)

        this.$router.push({
          name: 'registerCompany'
        })
      } catch (e) {
        this.errors = e.response.data.errors
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.register {
  background-color: #f6f7fc;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 0px !important;

  &__title {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }

  &__form {
    background-color: white;
    width: 100%;
    padding: 20px;
    border-radius: 10px;
  }
}
</style>
