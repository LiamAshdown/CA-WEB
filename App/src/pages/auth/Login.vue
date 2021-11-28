<template>
  <div class="login">
    <div class="login__title">
      <h1 class="text-h4 mb-3">Let's sign you in.</h1>
      <h1 class="text-h5 font-weight-light">Welcome back.</h1>
      <h1 class="text-h5 font-weight-light">You've been missed!.</h1>
    </div>
    <div class="login__form">
      <v-form
        ref="form"
        v-model="valid"
        lazy-validation
      >
        <v-text-field
          v-model="form.email"
          label="Email"
          type="email"
          outlined
          required
        ></v-text-field>

        <v-text-field
          v-model="form.password"
          label="Password"
          type="password"
          outlined
          required
        ></v-text-field>

        <v-btn
          depressed
          color="primary"
          block
        >Sign In</v-btn>
      </v-form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LoginPage',

  data () {
    return {
      form: {
        email: '',
        password: ''
      },
      valid: false
    }
  }
}
</script>

<style lang="scss">
.login {
  padding: 40px 20px;
  display: flex;
  flex-direction: column;
  height: 100vh;
  gap: 15%;
}

</style>
