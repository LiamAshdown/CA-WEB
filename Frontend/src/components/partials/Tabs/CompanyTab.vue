<template>
  <b-row>
    <b-col xl="6" lg="12">
      <base-card>
        <b-form @submit.prevent="onSubmit">
          <b-form-row fluid>
            <b-col lg="6">
              <base-form-group
                id="name"
                label="Name"
                placeholder="Name"
                type="text"
                :optional="false"
                autocomplete="organization"
                @input="updateField"
                v-model="company.name"
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
                @input="updateField"
                v-model="company.telephoneNumber"
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
                @input="updateField"
                v-model="company.postalCode"
                :validation="errors"
              ></base-form-group>
            </b-col>
            <b-col lg="6">
              <base-form-group
                id="address"
                label="Address"
                placeholder="Address"
                type="text"
                :optional="false"
                v-model="company.address"
                autocomplete="address"
                @input="updateField"
                :textArea="true"
                :validation="errors"
              ></base-form-group>
            </b-col>
          </b-form-row>
          <base-button :loading="loading">Update</base-button>
        </b-form>
      </base-card>
    </b-col>
    <b-col xl="4" lg="12">
      <base-card></base-card>
    </b-col>
  </b-row>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'CompanyTab',
  data () {
    return {
      loading: true,
      errors: []
    }
  },
  computed: {
    ...mapGetters(['company'])
  },
  methods: {
    async loadCompany () {
      await this.$store.dispatch('getCompany')
      this.loading = false
    },
    updateField (value, field) {
      this.$store.dispatch('setCompany', {
        [field]: value
      })
    },
    async onSubmit () {
      this.loading = true

      try {
        await this.$store.dispatch('updateCompany')
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.loading = false
    }
  },
  created () {
    this.loadCompany()
  }
}
</script>
