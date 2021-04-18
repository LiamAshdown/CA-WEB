<template>
  <b-container class="estimate" fluid>
    <div class="estimate__header">
      <h1 class="page-title">Create Estimate</h1>
      <base-button @click="viewDraft">View Draft</base-button>
    </div>
    <b-row class="mb-4">
      <b-col cols="12">
        <base-card :loading="initializing">
          <p class="font-weight-bold">Basic Info</p>
          <b-row>
            <b-col class="mb-4" xl="6" cols="12">
              <div class="customer">
                <label for="select-customer">Customer</label>
                <customer-dropdown id="select-customer" @selectedCustomer="selectedCustomer" :customer="customer" :validated="validation.customer.pass"></customer-dropdown>
              </div>
            </b-col>
            <b-col xl="6" cols="12">
              <b-form-row fluid>
                <b-col lg="6" cols="12">
                  <label for="estimate-due-date">Due date</label>
                  <b-form-datepicker
                    id="estimate-due-date"
                  ></b-form-datepicker>
                </b-col>
                <b-col lg="6" cols="12" class="mt-4 mt-lg-0">
                  <!-- TODO; BaseFormGroup does not support prepend/append, so using default boostrap to achieve this -->
                  <b-form-group
                    id="estimate-number-group"
                    label="Estimate Number"
                    label-for="estimate-number"
                  >
                    <b-input-group :prepend="estimate.prefix">
                      <b-form-input
                        id="estimate-number"
                        :value="estimate.estimateNumber"
                        @input="updateField($event, 'estimateNumber')"
                      ></b-form-input>
                    </b-input-group>
                  </b-form-group>
                </b-col>
              </b-form-row>
            </b-col>
          </b-row>
        </base-card>
      </b-col>
    </b-row>
    <b-row class="mb-4">
      <b-col cols="12">
        <bill-items></bill-items>
      </b-col>
    </b-row>
    <b-row>
      <b-col lg="6" cols="12">
        <base-card :loading="initializing">
          <p class="font-weight-bold">Notes & Term Conditions</p>
          <b-row>
            <b-col cols="12">
              <base-text-editor
                id="estimate-body"
                label="Estimate Body"
                :value="estimate.estimateBody"
                @input="updateField"
              ></base-text-editor>
            </b-col>
            <b-col cols="12">
              <base-text-editor
                id="terms-conditions"
                label="Terms & Conditions"
                :value="estimate.termsConditions"
                @input="updateField"
              ></base-text-editor>
            </b-col>
          </b-row>
        </base-card>
      </b-col>
      <b-col lg="6" cols="12" class="d-flex justify-content-end">
        <base-card class="w-50">
          <div class="estimate__total d-flex justify-content-between text-uppercase">
            <label class="font-weight-bold">Sub Total</label>
            <label>£{{ calculateTotalAmount }}</label>
          </div>
          <base-divider class="mt-2"></base-divider>
          <div class="estimate__total d-flex justify-content-between text-uppercase">
            <label class="font-weight-bold">Total Amount</label>
            <label class="text-primary">£{{ calculateSubTotalAmount }}</label>
          </div>
        </base-card>
      </b-col>
    </b-row>
    <add-customer-modal></add-customer-modal>
    <!-- TODO; When adding an item, the BillItem should automatically select the newly created item -->
    <add-item-modal></add-item-modal>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex'
import CustomerDropdown from '@/components/billing/CustomerDropdown.vue'
import AddCustomerModal from '@/components/modals/AddCustomerModal.vue'
import AddItemModal from '@/components/modals/AddItemModal.vue'
import BillItems from '@/components/billing/BillItems.vue'

export default {
  name: 'CreateEstimate',
  components: {
    CustomerDropdown,
    AddCustomerModal,
    AddItemModal,
    BillItems
  },
  data () {
    return {
      customer: null,
      initializing: true,
      // Used for basic validation before we submit to server
      validation: {
        customer: {
          pass: true
        }
      }
    }
  },
  computed: {
    ...mapGetters({
      estimate: 'estimates/estimate',
      items: 'estimates/items'
    }),
    calculateTotalAmount () {
      let total = 0

      for (const item of this.items) {
        total += Number(item.gross) * item.quantity
      }

      return total.toLocaleString()
    },
    calculateSubTotalAmount () {
      let subTotal = 0

      for (const item of this.items) {
        subTotal += Math.abs((item.gross * (item.vat / 100)) - item.gross)
      }

      return subTotal.toLocaleString()
    }
  },
  methods: {
    selectedCustomer (customer) {
      this.customer = customer
      this.validation.customer.pass = true
    },
    async initialize () {
      await this.$store.dispatch('estimates/create')

      this.initializing = false
    },
    updateField (value, field) {
      this.$store.dispatch('estimates/set', {
        [field]: value
      })
    },
    viewDraft () {
      // Lets validate the data first before we create a draft
      if (!this.customer) {
        this.validation.customer.pass = false
      }
    }
  },
  created () {
    // Get the required data e.g customization
    this.initialize()
  }
}
</script>

<style lang="scss">
.estimate {
  &__header {
    position: relative;

    button {
      position: absolute;
      right: 0px;
      top: 0px;
    }
  }

  &__total {
    label {
      &:first-child {
        font-size: 14px;
      }
    }
  }
}
</style>
