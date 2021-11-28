<template>
  <v-container>
    <v-form @submit.prevent="update">
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
        :loading="loading"
        block
      >Update</v-btn>
    </v-form>
  </v-container>
</template>

<script>
export default {
  name: 'CompanyTab',
  data () {
    return {
      loading: false,
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
    async profile () {
      this.form = await this.$api.company.show()
    },
    async update () {
      this.loading = true
      this.errors = {}

      try {
        await this.$api.company.update(this.form)
      } catch (e) {
        this.errors = e.response.data.errors
      } finally {
        this.loading = false
      }
    }
  },
  mounted () {
    this.profile()
  }
}
</script>
