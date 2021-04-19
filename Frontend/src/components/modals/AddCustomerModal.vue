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
  </b-modal>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'AddCustomerModal',
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
    checkFormValidity () {
      const valid = this.$refs.form.checkValidity()
      this.nameState = valid
      return valid
    },
    resetModal () {
      this.name = ''
      this.nameState = null
    },
    handleOk (bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault()
      // Trigger submit handler
      this.handleSubmit()
    },
    handleSubmit () {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return
      }
      // Push the name to submitted names
      this.submittedNames.push(this.name)
      // Hide the modal manually
      this.$nextTick(() => {
        this.$bvModal.hide('modal-prevent-closing')
      })
    }
  }
}
</script>
