<template>
  <b-container fluid>
    <div class="text-right w-100 mb-3">
      <base-button class="text-right" @click="onSubmit" :loading="loading"><font-awesome-icon icon="save"/> Save Changes</base-button>
    </div>
    <b-row>
      <b-col xl="6" lg="12" class="form-group">
        <base-card :loading="initializing">
          <base-form-group
            id="invoice-prefix"
            label="Invoice Prefix"
            placeholder="INV"
            type="text"
            :optional="false"
            :value="customization.invoicePrefix"
            @input="updateField"
            :description="'Invoice would show as: ' + (customization.estimatePrefix || 'INV_') + '0001'"
            :validation="errors"
          ></base-form-group>
          <base-text-editor
            id="default-invoice-body"
            label="Default Invoice Email Body"
            :value="customization.defaultInvoiceBody"
            @input="updateField"
          ></base-text-editor>
        </base-card>
      </b-col>
      <b-col xl="6" lg="12">
        <base-card :loading="initializing">
          <base-form-group
            id="estimate-prefix"
            label="Estimate Prefix"
            placeholder="EST"
            type="text"
            :optional="false"
            :value="customization.estimatePrefix"
            @input="updateField"
            :description="'Estimate would show as: ' + (customization.estimatePrefix || 'EST_') + '0001'"
            :validation="errors"
          ></base-form-group>
          <base-text-editor
            id="default-estimate-body"
            label="Default Estimate Email Body"
            :value="customization.defaultEstimateBody"
            @input="updateField"
          ></base-text-editor>
        </base-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'CustomizationTab',
  data () {
    return {
      loading: false,
      initializing: true,
      errors: []
    }
  },
  computed: {
    ...mapGetters({
      customization: 'customization/customization'
    })
  },
  methods: {
    async loadCustomization () {
      await this.$store.dispatch('customization/show')
      this.initializing = false
    },
    updateField (value, field) {
      this.$store.dispatch('customization/set', {
        [field]: value
      })
    },
    async onSubmit () {
      this.loading = true

      try {
        await this.$store.dispatch('customization/update')
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
