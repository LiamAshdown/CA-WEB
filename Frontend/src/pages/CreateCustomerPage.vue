<template>
  <b-container fluid>
    <div class="position-relative d-flex">
      <h1 class="page-title">Create Customer</h1>
      <base-button class="position-absolute" @click="onSubmit" :loading="loading">Save Customer</base-button>
    </div>
    <base-card>
      <b-form-group
        label-cols-lg="3"
        label="Basic Info"
        label-class="font-weight-bold pt-0"
        class="mb-0"
      >
      <b-form-row fluid>
        <b-col lg="6">
          <base-form-group
            id="name"
            label="Contact Name"
            type="text"
            :optional="false"
            autocomplete="family-name"
            v-model="customer.name"
            @input="updateField"
            :validation="errors"
          ></base-form-group>
        </b-col>

        <b-col lg="6">
          <base-form-group
            id="website"
            label="Website"
            type="url"
            v-model="customer.website"
            @input="updateField"
            :validation="errors"
          ></base-form-group>
        </b-col>
      </b-form-row>
        <b-form-row>
          <b-col lg="6">
            <base-form-group
              id="email"
              label="Email"
              type="text"
              autocomplete="email"
              v-model="customer.email"
              @input="updateField"
              :validation="errors"
            ></base-form-group>
          </b-col>

          <b-col lg="6">
            <base-form-group
              id="telephone-number"
              label="Phone"
              type="text"
              autocomplete="tel"
              v-model="customer.telephoneNumber"
              @input="updateField"
              :validation="errors"
            ></base-form-group>
          </b-col>
        </b-form-row>
      </b-form-group>
      <base-divider></base-divider>
      <b-form-group
        label-cols-lg="3"
        label="Shipping Address"
        label-class="font-weight-bold pt-0"
        class="mt-2"
      >
      <b-form-row fluid>
        <b-col lg="6">
          <base-form-group
            id="billing-name"
            label="Name"
            type="text"
            autocomplete="family-name"
            v-model="customer.billingName"
            @input="updateField"
            :validation="errors"
          ></base-form-group>
        </b-col>
      </b-form-row>
      <b-form-row>
        <b-col lg="6">
          <base-form-group
            id="billing-postal-code"
            label="Postal Code"
            type="text"
            autocomplete="postal-code"
            v-model="customer.billingPostalCode"
            @input="updateField"
            :validation="errors"
          ></base-form-group>
        </b-col>
        <b-col lg="6">
          <base-form-group
            id="billing-telephone-number"
            label="Phone"
            type="text"
            autocomplete="tel"
            v-model="customer.billingTelephoneNumber"
            @input="updateField"
            :validation="errors"
          ></base-form-group>
        </b-col>
      </b-form-row>
      <b-form-row fluid>
        <b-col lg="6">
          <base-form-group
            id="billing-address"
            label="Address"
            type="text"
            :optional="false"
            autocomplete="address"
            :textArea="true"
            v-model="customer.billingAddress"
            @input="updateField"
            :validation="errors"
          ></base-form-group>
        </b-col>
      </b-form-row>
      </b-form-group>
    </base-card>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'CreateCustomer',

  data () {
    return {
      errors: [],
      loading: false
    }
  },
  computed: {
    ...mapGetters({
      customer: 'customers/customer'
    })
  },
  methods: {
    async onSubmit () {
      this.loading = true
      this.errors = []

      try {
        await this.$store.dispatch('customers/create')
        this.$router.push({ name: 'Customers' })
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.loading = false
    }
  }
}
</script>

<style lang="scss" scoped>
button {
  right: 0px; // Boostrap V4 doesn't have format positioning
}
</style>
