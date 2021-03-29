<template>
  <b-row>
    <b-col xl="6" lg="12" class="form-group">
      <base-card :loading="initialized">
        <b-form @submit.prevent="onSubmit">
          <base-form-group
            id="invoice-prefix"
            label="Invoice Prefix"
            placeholder="INV"
            type="text"
            :optional="true"
            v-model="customization.invoicePrefix"
            @input="updateField"
            description="Invoice would show as: INV_0001"
            :validation="errors"
          ></base-form-group>
          <base-text-editor
            id="default-invoice-body"
            label="Default Invoice Email Body"
            v-model="customization.defaultInvoiceBody"
            @input="updateField"
          ></base-text-editor>
        </b-form>
      </base-card>
    </b-col>
    <b-col xl="6" lg="12">
      <base-card :loading="initialized">
        <b-form @submit.prevent="onSubmit">
          <base-form-group
            id="estimate-prefix"
            label="Estimate Prefix"
            placeholder="EST"
            type="text"
            :optional="true"
            v-model="customization.estimatePrefix"
            @input="updateField"
            description="Estimate would show as: EST_0001"
            :validation="errors"
          ></base-form-group>
          <base-text-editor
            id="default-estimate-body"
            label="Default Estimate Email Body"
            v-model="customization.defaultEstimateBody"
            @input="updateField"
          ></base-text-editor>
        </b-form>
      </base-card>
    </b-col>
  </b-row>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'CustomizationTab',
  data () {
    return {
      loading: false,
      initialized: false,
      errors: []
    }
  },
  computed: {
    ...mapGetters(['customization'])
  },
  methods: {
    updateField (value, field) {
      this.$store.dispatch('setCustomization', {
        [field]: value
      })
    },
    async onSubmit () {
      this.loading = true
      this.loading = false
    }
  },
  created () {
  }
}
</script>
