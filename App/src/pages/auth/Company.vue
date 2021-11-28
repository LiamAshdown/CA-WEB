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
          v-model="form.name"
          label="Name"
          type="text"
          counter="30"
          :error-messages="errors.name"
          outlined
          required
        ></v-text-field>

        <v-text-field
          v-model="form.telephoneNumber"
          label="Telephone Number"
          type="telephone"
          :error-messages="errors.telephoneNumber"
          outlined
          required
        ></v-text-field>

        <v-text-field
          v-model="form.postalCode"
          label="Postal Code"
          type="text"
          :error-messages="errors.postalCode"
          outlined
          required
        ></v-text-field>

        <v-textarea
          v-model="form.address"
          label="Address"
          :error-messages="errors.address"
          auto-grow
          outlined
          rows="1"
          row-height="15"
        ></v-textarea>

        <v-btn
          depressed
          color="primary"
          type="submit"
          block
        >Complete</v-btn>
      </v-form>
    </div>
  </v-container>
</template>

<script>
export default {
  name: 'CompanyPage',

  data () {
    return {
      form: {
        name: '',
        telephoneNumber: '',
        postalCode: '',
        address: ''
      },
      errors: {}
    }
  },
  methods: {
    async register () {
      try {
        await this.$store.dispatch('registerCompany', this.form)

        this.$router.push({
          name: 'feed'
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
  background-color:#f6f7fc;
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
