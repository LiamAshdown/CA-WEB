<template>
  <b-container class="h-100 signup" fluid>
    <b-row class="h-100" no-gutters>
      <b-col md="4" class="d-none d-lg-block signup__info">
        <div class="signin__logo">
          <b-img src="images/logo.svg" alt="Contactors App"></b-img>
        </div>
        <div class="signup__info__content p-5">
          <h1 class="text-white font-weight-bold">Making your life easier.</h1>
          <p class="text-white">Built for Contractors by Contractors.</p>
        </div>
        <div class="signup__info__background">
          <b-img src="images/undraw_under_construction_46pa.svg" alt="Lazy" fluid></b-img>
        </div>
      </b-col>
      <b-col lg="8" md="12" class="signup__login d-flex justify-content-center align-items-center">
        <b-container class="signup__content mb-5">
          <div class="signin__image mb-5 d-flex justify-content-center">
            <b-img src="images/undraw_Ride_till_I_can_no_more_44wq.svg" alt="Welcome Back!"></b-img>
          </div>
          <div class="signup__header">
            <h1 class="mb-3 text-primary">Register</h1>
            <h3>Praesent convallis viverra urna. Duis nec metus sem.</h3>
            <p class="text-muted mb-n2">Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
          </div>
          <base-divider></base-divider>
          <b-form @submit.prevent="onSubmit">
            <b-form-row fluid>
              <b-col lg="6">
                <base-form-group
                  id="first-name"
                  label="First Name"
                  placeholder="First Name"
                  type="text"
                  :optional="false"
                  autocomplete="given-name"
                  v-model="form.firstName"
                  :validation="errors"
                ></base-form-group>
              </b-col>
              <b-col lg="6">
                <base-form-group
                  id="last-name"
                  label="Last Name"
                  placeholder="Last Name"
                  type="text"
                  :optional="false"
                  autocomplete="family-name"
                  v-model="form.lastName"
                  :validation="errors"
                ></base-form-group>
              </b-col>
            </b-form-row>
            <b-form-row fluid>
              <b-col lg="6">
                <base-form-group
                  id="email"
                  label="Email"
                  placeholder="example@example.com"
                  type="email"
                  :optional="false"
                  autocomplete="email"
                  v-model="form.email"
                  :validation="errors"
                ></base-form-group>
              </b-col>
              <b-col lg="6">
                <base-form-group
                  id="password"
                  label="Password"
                  placeholder="Password"
                  type="password"
                  :optional="false"
                  autocomplete="new-password"
                  v-model="form.password"
                  :validation="errors"
                ></base-form-group>
              </b-col>
            </b-form-row>
            <p class="signup__company_details mb-n2 font-weight-bold">Company Details</p>
            <base-divider></base-divider>
            <b-form-row fluid>
              <b-col lg="6">
                <base-form-group
                  id="company-name"
                  label="Name"
                  placeholder="Name"
                  type="text"
                  :optional="false"
                  autocomplete="organization"
                  v-model="form.companyName"
                  :validation="errors"
                ></base-form-group>
              </b-col>
              <b-col lg="6">
                <base-form-group
                  id="telephone-number"
                  label="Telephone Number"
                  placeholder="Telephone Number"
                  type="tel"
                  :optional="false"
                  autocomplete="tel"
                  v-model="form.companyTelephone"
                  :validation="errors"
                ></base-form-group>
              </b-col>
            </b-form-row>
            <b-form-row fluid>
              <b-col lg="12">
                <base-form-group
                  id="postal-code"
                  label="Postal Code"
                  placeholder="Postal Code"
                  type="text"
                  :optional="false"
                  autocomplete="postal-code"
                  v-model="form.companyPostalCode"
                  :validation="errors"
                ></base-form-group>
              </b-col>
              <b-col lg="6">
                <base-form-group
                  id="company-address"
                  label="Address"
                  placeholder="Address"
                  type="text"
                  :optional="false"
                  v-model="form.companyAddress"
                  autocomplete="address"
                  :textArea="true"
                  :validation="errors"
                ></base-form-group>
              </b-col>
            </b-form-row>
            <base-button :loading="loading" class="mt-4">Create Account </base-button>
            <p class="signup__content__signin mt-4">Already got an account? <router-link :to="{ name: 'SignIn'}" class="text-primary font-weight-bold">Sign In</router-link></p>
          </b-form>
        </b-container>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import BaseButton from '@/components/ui/BaseButton.vue'
import BaseDivider from '@/components/ui/BaseDivider.vue'

export default {
  components: {
    BaseDivider,
    BaseButton
  },

  data () {
    return {
      loading: false,
      errors: [],
      form: {
        firstName: '',
        lastName: '',
        email: '',
        password: '',
        companyName: '',
        companyAddress: '',
        companyPostalCode: '',
        companyTelephone: ''
      }
    }
  },
  methods: {
    async onSubmit () {
      this.loading = true
      this.errors = []

      try {
        await this.$store.dispatch('register', this.form)
        this.$router.push({ name: 'Dashboard' })
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.form.password = ''
      this.loading = false
    }
  }
}
</script>

<style lang="scss">
.signup {
  font-family: 'Nunito';

  &__image {
    img {
      width: 100%;
    }
  }

  &__header {
    font-weight: 600;
  }

  &__content {
    &__signin {
      text-align: center;
    }

    button {
      width: 100%;
    }
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
  .signup {
    padding: 0px;

    &__image {
      img {
        display: none;
      }
    }
  }
}

@include media-breakpoint-up(xl) {
  .signup {
    &__content {
      &__signin {
        text-align: left;
      }

      button {
        width: initial
      }
    }
  }
}

</style>
