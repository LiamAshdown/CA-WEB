<template>
  <div class="login">
    <div class="login__top">
      <div class="test">
        <h1 class="text-h4">Create better <br/> together.</h1>
        <p class="text-subtitle-1">Join our community.</p>
      </div>
    </div>
    <div class="login__bottom">
      <h3 class="text-h5">Login</h3>

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
        >Login</v-btn>
      </v-form>

      <p class="text-body-2 text--grey mt-3">Forgot Password</p>

      <p class="login__signup text-body-2 text-center">Don't have an account? <span class="blue--text text--darken-3"> Sign Up</span></p>
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
  height: 100vh;
  background-color: #e5e6e9;

  &__top {
    background-repeat: repeat;
    height: 50%;

    padding: 20px;
    padding-top: 20%;

    p {
      padding-top: 20px;
    }
  }

  &__bottom {
    background-color: white;
    border-radius: 20px;
    height: 100%;
    padding: 40px;
    box-shadow: 0px 12px 24px -12px rgba(0, 0, 0, 0.5);

    h3 {
      padding-bottom: 20px;
    }
  }

  &__signup {
    position: absolute;
    bottom: 0px;
    left: 0px;
    right: 0px;
  }
}

</style>
