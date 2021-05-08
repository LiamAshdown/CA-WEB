<template>
  <b-container fluid>
    <div class="text-right w-100 mb-3">
      <base-button class="text-right" @click="onSubmit" :loading="loading"><font-awesome-icon icon="save"/> Save Changes</base-button>
    </div>
    <b-row>
      <b-col xl="6" lg="12" class="form-group">
        <base-card :loading="initializing">
          <p class="font-weight-bold">Invoice</p>
          <base-form-group
            id="invoice-prefix"
            label="Invoice Prefix"
            placeholder="INV"
            type="text"
            :optional="false"
            v-model="customization.invoicePrefix"
            :description="'Invoice would show as: ' + (customization.estimatePrefix || 'INV_') + '0001'"
            :validation="errors"
          ></base-form-group>
          <b-form-group
            id="default-invoice-body"
            label="Default Invoice Body"
            label-for="default-invoice-body-input"
          >
            <base-text-editor
              id="default-invoice-body-input"
              v-model="customization.defaultInvoiceBody"
            ></base-text-editor>
          </b-form-group>
        </base-card>
      </b-col>
      <b-col xl="6" lg="12">
        <base-card :loading="initializing">
        <p class="font-weight-bold">Estimate</p>
          <base-form-group
            id="estimate-prefix"
            label="Estimate Prefix"
            placeholder="EST"
            type="text"
            :optional="false"
            v-model="customization.estimatePrefix"
            :description="'Estimate would show as: ' + (customization.estimatePrefix || 'EST_') + '0001'"
            :validation="errors"
          ></base-form-group>
          <b-form-group
            id="default-estimate-body"
            label="Default Estimate Email Body"
            label-for="default-estimate-body-input"
          >
            <base-text-editor
              id="default-estimate-body-input"
              v-model="customization.defaultEstimateBody"
            ></base-text-editor>
          </b-form-group>
        </base-card>
      </b-col>
    </b-row>
    <b-row>
      <b-col lg="6" cols="12">
        <base-card :loading="initializing">
          <b-form-group
            id="terms-conditions"
            label="Terms & Conditions"
            label-for="terms-conditions-input"
            description="Used for Estimate and Invoices"
          >
            <base-text-editor
              id="terms-conditions-input"
              v-model="customization.termsConditions"
            ></base-text-editor>
          </b-form-group>
        </base-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import api from '@/api/index.js'

export default {
  name: 'CustomizationTab',
  data () {
    return {
      loading: false,
      initializing: true,
      errors: [],
      customization: {
        invoicePrefix: '',
        defaultInvoiceBody: '',
        estimatePrefix: '',
        defaultEstimateBody: '',
        termsConditions: ''
      }
    }
  },
  methods: {
    async loadCustomization () {
      this.customization = await api.customization.show()
      this.initializing = false
    },
    async onSubmit () {
      this.loading = true

      try {
        const response = await api.customization.update(this.customization)

        this.$store.dispatch('toast', {
          message: response.message
        })

        this.errors = []
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.loading = false
    }
  },
  created () {
    this.loadCustomization()
  }
}
</script>
