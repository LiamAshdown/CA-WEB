<template>
  <b-modal
    id="modal-add-customer"
    ref="modal"
    title="Create Customer"
    @show="resetModal"
    @hidden="resetModal"
    @ok="handleOk"
  >
    <form ref="form" @submit.stop.prevent="handleSubmit">
      <b-form-group
        label="Basic Info"
        label-class="font-weight-bold pt-0"
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
              :validation="errors"
            ></base-form-group>
          </b-col>

          <b-col lg="6">
            <base-form-group
              id="website"
              label="Website"
              type="url"
              v-model="customer.website"
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
              :validation="errors"
            ></base-form-group>
          </b-col>
        </b-form-row>
      </b-form-group>
      <base-divider></base-divider>
      <b-form-group
        label="Billing Address"
        label-class="font-weight-bold pt-0"
      >
        <b-form-row fluid>
          <b-col lg="6">
            <base-form-group
              id="billing-name"
              label="Name"
              type="text"
              autocomplete="family-name"
              v-model="customer.billingName"
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
              :validation="errors"
            ></base-form-group>
          </b-col>
        </b-form-row>
      </b-form-group>
    </form>
    <template #modal-footer="{ ok, cancel }">
      <base-button variant="secondary" @click="cancel()">
        Cancel
      </base-button>
      <base-button :loading="loading" @click="ok()">
        Create
      </base-button>
    </template>
  </b-modal>
</template>

<script>
import api from '@/api/index.js'

export default {
  name: 'AddCustomerModal',
  data () {
    return {
      errors: [],
      loading: false,
      customer: {
        name: '',
        website: '',
        email: '',
        telephoneNumber: '',
        billingName: '',
        billingTelephoneNumber: '',
        billingPostalCode: '',
        billingAddress: ''
      }
    }
  },
  methods: {
    resetModal () {
      this.loading = false
      this.errors = []
      this.customer = {
        name: '',
        website: '',
        email: '',
        telephoneNumber: '',
        billingName: '',
        billingTelephoneNumber: '',
        billingPostalCode: '',
        billingAddress: ''
      }
    },
    handleOk (bvModalEvt) {
      bvModalEvt.preventDefault()
      this.handleSubmit()
    },
    async handleSubmit () {
      this.loading = true

      try {
        const response = await api.customers.store(this.customer)

        this.$store.dispatch('toast', {
          message: response.message
        })

        this.$nextTick(() => {
          this.$store.dispatch('customers/index')
          this.$bvModal.hide('modal-add-customer')
        })
      } catch (err) {
        this.errors = err.response.data.errors
        this.loading = false
      }
    }
  }
}
</script>
