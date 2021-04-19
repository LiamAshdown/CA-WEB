<template>
  <b-container class="h-100 signin" fluid>
    <b-row class="h-100" no-gutters>
      <b-col md="4" class="d-none d-lg-block signin__info">
        <div class="signin__logo">
          <b-img src="images/logo.svg" alt="Contactors App"></b-img>
        </div>
        <div class="signin__info__content p-5">
          <h1 class="text-white font-weight-bold">Making your life easier.</h1>
          <p class="text-white">Built for Contractors by Contractors.</p>
        </div>
        <div class="signin__info__background">
          <b-img src="images/undraw_under_construction_46pa.svg" alt="Construction" fluid></b-img>
        </div>
      </b-col>
      <b-col lg="8" md="12" class="signin__login">
        <b-container class="mt-5 mb-5">
          <div class="signin__image mb-5 d-flex justify-content-center">
            <b-img src="images/undraw_welcome_3gvl.svg" alt="Welcome Back!"></b-img>
          </div>
          <div class="signin__content">
            <h1 class="signin__header">Welcome Back!</h1>
            <div class="signin__form mt-5">
              <b-alert :show="error" variant="danger" :fade="true" dismissible>Email and/or password is incorrect.</b-alert>
              <b-form @submit.prevent="onSubmit">
                <base-form-group
                  id="email"
                  label="Email Address"
                  placeholder="example@example.com"
                  type="email"
                  v-model="form.email"
                ></base-form-group>

                <base-form-group
                  id="password"
                  label="Password"
                  placeholder="Password"
                  type="password"
                  v-model="form.password"
                ></base-form-group>

                <base-button :loading="loading" :block="true">Sign In</base-button>
                <p class="text-center mt-5">New here? <router-link :to="{ name: 'SignUp'}" class="text-primary font-weight-bold">Sign Up</router-link></p>
              </b-form>
            </div>
          </div>
        </b-container>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  name: 'Login',

  data () {
    return {
      error: false,
      loading: false,
      form: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    async onSubmit () {
      this.error = false
      this.loading = true

      try {
        await this.$store.dispatch('login', this.form)
        this.$router.push({ name: 'Dashboard' })
      } catch (err) {
        console.log(err)
        this.error = true
      }

      this.form.password = ''
      this.loading = false
    }
  }
}
</script>

<style lang="scss">
.signin {

  &__image {
    img {
      width: 80%;
    }
  }

  &__header {
    color: $primary;
    text-align: center;
    font-weight: 500;
    font-size: 2rem;
  }

  &__info {
    background-image: linear-gradient(to top, #006bff 0%, #4894ff 100%);
    overflow: hidden;
    background-color: $primary;

    &__background {
      position: absolute;
      bottom: 0px;
      opacity: 0.6;
      transform: scale(1.8);
    }

    &__content {
      margin-top: 10%;

      p {
        font-size: 1.4rem;
      }
    }
  }
}

@include media-breakpoint-up(md) {
  .signin {
    &__image {
      img {
        width: 400px;
      }
    }
  }
}

@include media-breakpoint-up(lg) {
  .signin {
    padding: 0px;

    &__image {
      img {
        display: none;
      }
    }

    &__login {
      padding: 0px;
      display: flex;
      justify-content: center;

      .container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0px;
        padding: 0px;
      }
    }

    &__content {
      width: 500px;
    }
  }
}

</style>
